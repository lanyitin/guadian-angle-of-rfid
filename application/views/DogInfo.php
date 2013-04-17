<div class="DogInfo span3">
   <img src="<?php echo $dog->image;?>" alt="" />
   <div class="uhf"><?php echo $dog->getUhf();?></div>
   <div class="name"><?php echo $dog->name;?></div>
   <div class="gender"><?php echo $dog->gender;?></div>
   <div class="birthday"><?php echo $dog->birthday;?></div>
   <div class="region"><?php echo $dog->region;?></div>
   <div class="operation btn-group">
	  <?php if ($this->staff->privilege & 2):?>
	  <div class="btn"><a href="<?php echo site_url("dog/modify/". $dog->getUhf());?>">Modify</a></div>
	  <?php endif ?>
	  <?php if ($this->staff->privilege & 4):?>
	  <div class="btn"><a href="<?php echo site_url("dog/delete/". $dog->getUhf());?>">Delete</a></div>
	  <?php endif ?>
   </div>
</div>
