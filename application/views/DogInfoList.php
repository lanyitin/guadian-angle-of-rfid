<h1>Dog List</h1>
<div class="form-horizontal">
	<label class="select inline">	Gender
		<select id="select-gender" name="gender">
			<option value="ALL">ALL</option>
			<option value="MD">Male</option>
			<option value="FD">Female</option>
		</select>
	</label>
	<label class="select inline">
		Breed
		<select id="select-breed" name="breed">
			<option value="ALL">ALL</option>
			<option value="GOLDEN">Golden Retriever</option>
			<option value="LABRAD">Labrador Retriever</option>
			<option value="GERMAN">German Shepherd Dog</option>
		</select>
	</label>
</div>
<table id="listview" class="table" style="overflow: scroll; overflow-x: hidden; height:100%">
<tr>
	<td></td>
	<td>Name</td>
	<td>Gender</td>
	<td>Breed</td>
	<td>Birthday</td>
	<td>Trainer</td>
	<td></td>
</tr>
</table>
<script>
	var EntryLoader = function(para_condictions) {
		private_attrs = { begin:0, count:10, condictions:para_condictions };

		this.isSameCondiction = function (para_condiction) {	
			return JSON.stringify(para_condiction) === JSON.stringify(private_attrs.condiction);
		}

		this.load = function () {
			var attrs = private_attrs;
			var url = "<?php echo site_url("dog/getByCondiction"); ?>"+"/"+private_attrs.begin+"/"+private_attrs.count;
			$.post(url, private_attrs.condictions).done(function (data) {
				json_data = JSON.parse(data);
				attrs.begin += json_data.length;
				for(i = 0; i < json_data.length; i++) {
					$("#listview").append($("<tr/>").html(json_data[i]));
				}
			});
		}
	}
	var loader = new EntryLoader({});
	loader.load();
	$("#select-breed, #select-gender").change(function(event){
		new_condiction = {breed:$("#select-breed").val(), gender:$("#select-gender").val()};
		if (!loader.isSameCondiction(new_condiction)) {
			$("#listview").html("");
			loader = new EntryLoader(new_condiction);
			loader.load();
		}
	});
	$("#listview").scroll(function (event) {
		if( $("#listview").scrollTop() === $("#listview").height() ) {
			console.log("load entry");
			loader.load();
		}
	}).css("max-height", $(document).height() - $("#listview").offset().top);
	$(window).resize(function (){
		$("#listview").css("max-height", $(document).height() - $("#listview").offset().top);

	});
</script>
