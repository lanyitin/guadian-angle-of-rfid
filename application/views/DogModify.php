<div class="row">
    <h2 class="form-signin-heading">Please Key In Dog's Information</h2>
    <h3 style="color:red">
        <?php echo validation_errors();?>
    </h3>
</div>
<div class="row">
    <form class="form form-horizontal" action="<?php echo site_url('dog/modify/' . $dog->getUhf()); ?>"
    method="POST">
        <div class="span6">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="inputName">Picture</label>
                    <div class="controls">
                        <button type="button" onclick="window.open(CKEDITOR.config.filebrowserImageBrowseUrl, null, 'status=0, titlebar=0, toolbar=0')">Choose a picture</button>
                        <img class="CK_image" src="<?php echo $dog->image;?>"
                        />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName">Name</label>
                    <div class="controls">
                        <input type="text" class="input" id="inputName" placeholder="Dog name" name="name"
                        value="<?php echo $dog->name;?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputBirthday">Birthday</label>
                    <div class="controls">
                        <input type="text" id="inputBirthday" class="input datepicker" placeholder="Birthday"
                        name="birthday" value="<?php echo $dog->birthday;?>" />
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
                                <option value="<?php echo $item->id;?>">
                                    <?php echo $item->title; ?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Region</label>
                    <div class="controls">
                        <div id="regionButtons" class="btn-group" data-toggle="buttons-radio">
                            <?php foreach($regionList as $item): ?>
                                <button type="button" class="btn" data-value="<?php echo $item->id; ?>" onclick="$('#inputRegion').val('<?php echo $item->id; ?>')">
                                    <?php echo $item->title; ?></button>
                                <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
					<label class="control-label">Trainer</label>
                    <div class="controls">
                        <select id="inputTrainer" name="trainer">
                            <?php foreach ($staffs as $_staff): ?>
                                <option value="<?php echo $_staff->id; ?>">
                                    <?php echo $_staff->name ;?></td>
                                        <?php echo $_staff->phone ;?></td>
                                </option>
                                <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!-- Region -->
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-large" type="submit">Modify</button>
                    </div>
                </div>
                <input type="hidden" name="id" id="inputId" value="<?php echo $dog->getId();?>"
                />
                <input type="hidden" name="uhf" id="inputUhf" value="<?php echo $dog->getUhf();?>"
                />
                <input type="hidden" name="gender" id="inputGender" />
                <input type="hidden" name="region" id="inputRegion" />
                <input type="hidden" class="CK_image" name="image" id="inputImage" value="<?php echo $dog->image;?>"
                />
            </fieldset>
        </div>
    </form>
</div>
<script>
    $(function(){
    	$("[data-value='<?php echo $dog->gender;?>']").click();
		$("[data-value='<?php echo $dog->region;?>']").click();
		$("#inputTrainer").val("<?php echo $dog->trainer; ?>");
    	$("#inputBreed").val("<?php echo $dog->breed;?>");
    });
</script>
