<h1 style="color:red"><?php echo validation_errors();?></h1>
<form class="form" action="<?php echo site_url('dog/register'); ?>" method="POST">
	<h2 class="form-signin-heading">Please Key In Dog's Information</h2>
	<input type="text" class="input-block-level" placeholder="Dog name" name="name">
	<input type="text" class="input-block-level datepicker" placeholder="Birthday" name="birthday">

	<div style="padding:4px 0px 16px;">
		<div class="btn-group" data-toggle="buttons-radio">
			<button type="button" class="btn btn-primary" onclick="$('#inputGender').val('MD')">Male</button>
			<button type="button" class="btn btn-primary" onclick="$('#inputGender').val('FD')">Female</button>
		</div>
	</div>

	<div style="padding:4px 0px 16px;">
		<div id="breedButtons" class="btn-group" data-toggle="buttons-radio">
		<?php foreach($dogBreedList as $item): ?>
			<button type="button" class="btn btn-primary" onclick="$('#inputBreed').val('<?php echo $item->id; ?>')"><?php echo $item->title; ?></button>
		<? endforeach ?>
		</div>
	</div>
	<div style="padding:4px 0px 16px;">
		<div id="regionButtons" class="btn-group" data-toggle="buttons-radio">
		<?php foreach($regionList as $item): ?>
			<button type="button" class="btn btn-primary" onclick="$('#inputRegion').val('<?php echo $item->id; ?>')"><?php echo $item->title; ?></button>
		<? endforeach ?>
		</div>
	</div>
	<!-- Region --> 
	<button class="btn btn-large btn-primary" type="submit">Register</button>
	<input type="hidden" name="gender" id="inputGender"/>
	<input type="hidden" name="breed" id="inputBreed"/>
	<input type="hidden" name="region" id="inputRegion"/>
</form>
<script>
$(function(){
$(".btn-group .btn:first-child").click();
});
</script>
