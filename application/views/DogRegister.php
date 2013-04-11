<h1 style="color:red"><?php echo validation_errors();?></h1>
<form class="form form-horizontal" action="<?php echo site_url('dog/register'); ?>" method="POST">
	<h2 class="form-signin-heading">Please Key In Dog's Information</h2>
	<div class="control-group">
		<label class="control-label" for="inputName">Picture</label>
		<div class="controls">
			<input type="file" class="input" id= "inputPicture" name="picture"/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" class="input" id= "inputName" placeholder="Dog name" name="name"/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputBirthday">Birthday</label>
		<div class="controls">
			<input type="text" id="inputBirthday" class="input datepicker" placeholder="Birthday" name="birthday"/>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Gender</label>
		<div class="controls">
			<div class="btn-group" data-toggle="buttons-radio">
				<button type="button" class="btn " onclick="$('#inputGender').val('MD')">Male</button>
				<button type="button" class="btn " onclick="$('#inputGender').val('FD')">Female</button>
			</div>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Breed</label>
		<div class="controls">
			<div id="breedButtons" class="btn-group" data-toggle="buttons-radio">
				<?php foreach($dogBreedList as $item): ?>
				<button type="button" class="btn " onclick="$('#inputBreed').val('<?php echo $item->id; ?>');"><?php echo $item->title; ?></button>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Region</label>
		<div class="controls">
			<div id="regionButtons" class="btn-group" data-toggle="buttons-radio">
				<?php foreach($regionList as $item): ?>
				<button type="button" class="btn " onclick="$('#inputRegion').val('<?php echo $item->id; ?>')"><?php echo $item->title; ?></button>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<!-- Region --> 
	<div class="control-group">
		<div class="controls">
			<button class="btn btn-large " type="submit">Register</button>
		</div>
	</div>
	<input type="hidden" name="gender" id="inputGender"/>
	<input type="hidden" name="breed" id="inputBreed"/>
	<input type="hidden" name="region" id="inputRegion"/>
</form>
