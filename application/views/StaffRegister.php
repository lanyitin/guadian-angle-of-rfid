<h1 style="color:red"><?php echo validation_errors();?></h1>
<form class="form form-horizontal" action="<?php echo site_url('staff/register'); ?>" method="POST">
	<h2 class="form-signin-heading">Please Key In Staff's Information</h2>
	<div class="control-group">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" class="input" id= "inputName" placeholder="Dog name" name="name"/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPhone">Phone</label>
		<div class="controls">
			<input type="text" id="inputPhone" class="input" placeholder="Phone" name="phone"/>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">HFCard</label>
		<div class="controls">
			<input type="text" id="inputHFCard" class="input" placeholder="HFCard" name="hfcard"/>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Privilege</label>
		<div class="controls">
				<select multiple="multiple">
				<?php foreach($PrivilegeList as $item): ?>
				<option value="<?php echo $item->hex_code?>"><?php echo $item->title?></option> 
				<?php endforeach ?>
				</select>
		</div>
	</div>
	<!-- Region --> 
	<div class="control-group">
		<div class="controls">
			<button class="btn btn-large " type="submit">Register</button>
		</div>
	</div>
</form>
