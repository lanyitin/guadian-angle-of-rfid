<div class="row">
	<h2 class="form-signin-heading">Please Key In Dog's Information</h2>
	<h3 style="color:red">
		<?php echo validation_errors();?>
	</h3>
</div>
<div class="row">
	<form class="form form-horizontal" action="<?php echo site_url('dog/register'); ?>"
	method="POST">
		<div class="span6">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="inputName">Picture</label>
					<div class="controls">
						<button type="button" onclick="window.open(CKEDITOR.config.filebrowserImageBrowseUrl, null, 'status=0, titlebar=0, toolbar=0')">Choose a picture</button>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputName">Name</label>
					<div class="controls">
						<input type="text" class="input" id="inputName" placeholder="Dog name" name="name"
						value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputBirthday">Birthday</label>
					<div class="controls">
						<input type="text" id="inputBirthday" class="input datepicker" placeholder="Birthday"
						name="birthday" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Gender</label>
					<div class="controls">
						<select id="inputGender" name="gender">
							<?php foreach($dogGenderList as $item): ?>
								<option value="<?php echo $item->id;?>">
									<?php echo $item->title; ?></option>
								<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Breed</label>
					<div class="controls">
						<select id="inputBreed" name="breed">
							<?php foreach($dogBreedList as $item): ?>
								<option value="<?php echo $item->id;?>">
									<?php echo $item->title; ?></option>
								<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Region</label>
					<div class="controls">
						<select id="inputRegion" name="region">
							<?php foreach($dogRegionList as $item): ?>
								<option value="<?php echo $item->id;?>">
									<?php echo $item->title; ?></option>
								<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Trainer</label>
					<div class="controls">
						<select id="inputTrainer" name="trainer">
							<?php foreach ($staffs as $_staff): ?>
								<option value="<?php echo $_staff->hfcard; ?>">
									<?php echo $_staff->name ;?>
										<?php echo $_staff->phone ;?>
								</option>
								<?php endforeach ?>
						</select>
					</div>
				</div>
				<!-- Region -->
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-large" type="submit">Register</button>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputName">Register Date</label>
					<div class="controls">
						<p><?php echo date("Y-m-d"); ?></p>
					</div>
				</div>
				<input type="hidden" class="CK_image" name="image" id="inputImage" />
			</fieldset>
		</div>
	<div class="span4">
		<img class="CK_image" />
	</div>
	</form>
</div>
