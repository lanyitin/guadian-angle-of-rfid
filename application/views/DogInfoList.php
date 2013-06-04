<h1>Dog List</h1>
<div class="form form-horizontal">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="select-gender">Gender</label>
			<div class="controls">
				<select id="select-gender" name="gender">
					<option value="ALL">ALL</option>
					<option value="MD">Male</option>
					<option value="FD">Female</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="select-breed">Breed</label>
			<div class="controls">
				<select id="select-breed" name="breed">
					<option value="ALL">ALL</option>
					<option value="GOLDEN">Golden Retriever</option>
					<option value="LABRAD">Labrador Retriever</option>
					<option value="GERMAN">German Shepherd Dog</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="cardid">Card Number</label>
			<div class="controls">
				<input type="text" id="cardid" placeholder="ALL"/><div class="btn">Read</div>
			</div>
		</div>

	</fieldset>
</div>
<table id="listview" class="table" style="overflow: scroll; overflow-x: hidden; height:100%">
	<tr>
		<th></th>
		<th>Name</th>
		<th>Gender</th>
		<th>Breed</th>
		<th>Birthday</th>
		<th>Trainer</th>
		<th>UHF Number</th>
		<th></th>
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
					$("#listview tr:nth-child(even)").css("background", "#eeeeee");
				});
			}
		}
		var loader = new EntryLoader({});
		loader.load();
		$("#select-breed, #select-gender").change(function(event){
			new_condiction = {breed:$("#select-breed").val(), gender:$("#select-gender").val(), card:$("#cardid").val()};
			if (!loader.isSameCondiction(new_condiction)) {
				$("#listview").html("");
				loader = new EntryLoader(new_condiction);
				loader.load();
			}
		});

		$("#cardid").change(function(){
			if ($.trim($("#cardid").val()).length == 0) {
				$("#cardid").val("ALL");
			}
			new_condiction = {breed:$("#select-breed").val(), gender:$("#select-gender").val(), card:$("#cardid").val()};
			if (!loader.isSameCondiction(new_condiction)) {
				$("#listview").html("");
				loader = new EntryLoader(new_condiction);
				loader.load();
			}
		});
		$("#cardid").on("input", function () {
			$("cardid").change();
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
