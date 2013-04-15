<?php if($this->session->userdata("privilege") & (1+2+4+8)): ?>
<ul class="nav">
	<li class="dropdown <?php if (strpos($url, "dog") !== false) echo "active";?>">
	<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Dog Manipulation<b class="caret"></b></a>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	<?php if($this->session->userdata("privilege") & (1)): ?>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('dog/register');?>">Dog Register</a></li>	
	<?php endif ?>
	<?php if($this->session->userdata("privilege") & (8)): ?>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('dog/info');?>">Dog Information</a></li>	
	<?php endif ?>
	</ul>
	</li>
</ul>
<?php endif ?>

<?php if($this->session->userdata("privilege") & (16+32+64+128)): ?>
<ul class="nav">
	<li class="dropdown <?php if (strpos($url, "staff") !== false) echo "active";?>">
	<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Staff Manipulation<b class="caret"></b></a>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	<?php if($this->session->userdata("privilege") & (16)): ?>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('staff/register');?>">Staff Register</a></li>	
	<?php endif ?>
	<?php if($this->session->userdata("privilege") & (128)): ?>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('staff/info');?>">Staff Information</a></li>	
	<?php endif ?>
	</ul>
	</li>
</ul>
<?php endif ?>
