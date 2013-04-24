<div class="row">
   <h2 class="form-signin-heading">Please Key In Dog's Information</h2>
   <h3 style="color:red"><?php echo validation_errors();?></h3>
</div>
<div class="row">
   <form class="form form-horizontal" action="<?php echo site_url('dog/register'); ?>" method="POST">
	  <div class="span6">
		 <fieldset>
			<div class="control-group">
			   <label class="control-label" for="inputName">Picture</label>
			   <div class="controls">
				  <button type="button" onclick="window.open(CKEDITOR.config.filebrowserImageBrowseUrl, null, 'status=0, titlebar=0, toolbar=0')">Choose a picture</button>
				  <img class="CK_image"/>
			   </div>
			</div>
			<div class="control-group">
			   <label class="control-label" for="inputName">Name</label>
			   <div class="controls">
				  <input type="text" class="input" id="inputName" placeholder="Dog name" name="name" value=""/>
			   </div>
			</div>
			<div class="control-group">
			   <label class="control-label" for="inputBirthday">Birthday</label>
			   <div class="controls">
				  <input type="text" id="inputBirthday" class="input datepicker" placeholder="Birthday" name="birthday" value=""/>
			   </div>
			</div>

			<div class="control-group">
			   <label class="control-label">Gender</label>
			   <div class="controls">
				  <div class="btn-group" data-toggle="buttons-radio">
					 <button type="button" class="btn" data-value="MD" onclick="$('#inputGender').val('MD')">Male</button>
					 <button type="button" class="btn" data-value="FD" onclick="$('#inputGender').val('FD')">Female</button>
				  </div>
			   </div>
			</div>

			<div class="control-group">
			   <label class="control-label">Breed</label>
			   <div class="controls">
			   <select id="inputBreed" name="breed">
					 <?php foreach($dogBreedList as $item): ?>
			   <option value="<?php echo item->id;?>"><?php echo $item->title; ?></option>
					 <?php endforeach ?>
				</select>
			   </div>
			</div>
			<div class="control-group">
			   <label class="control-label">Region</label>
			   <div class="controls">
				  <div id="regionButtons" class="btn-group" data-toggle="buttons-radio">
					 <?php foreach($regionList as $item): ?>
					 <button type="button" class="btn" data-value="<?php echo $item->id; ?>" onclick="$('#inputRegion').val('<?php echo $item->id; ?>')"><?php echo $item->title; ?></button>
					 <?php endforeach ?>
				  </div>
			   </div>
			</div>
			<!-- Region --> 
			<div class="control-group">
			   <div class="controls">
				  <button class="btn btn-large" type="submit">Register</button>
			   </div>
			</div>
			<input type="hidden" name="gender" id="inputGender"/>
			<input type="hidden" name="region" id="inputRegion"/>
			<input type="hidden" name="trainer" id="inputTrainer"/>
			<input type="hidden" class="CK_image" name="image" id="inputImage"/>
		 </fieldset>
	  </div>
	  <div class="span5">
		 <table class="table" id="trainerlist" style="cursor:pointer">
			<tr>
			   <td>Name</td>
			   <td>Phone</td>
			</tr>
			<?php foreach ($staffs as $_staff): ?>
			<tr onclick="$('#trainerlist tr').removeClass('success'); $(this).addClass('success'); $('#inputTrainer').val('<?php echo $_staff->hfcard; ?>')">
			   <td><?php echo $_staff->name ;?></td>
			   <td><?php echo $_staff->phone ;?></td>
			</tr>
			<?php endforeach ?>
		 </table>
	  </div>
   </form>
</div>
