<li class="nav-header">Sidebar</li>
<?php if($this->session->userdata("privilege") & (1+2+4+8)): ?>
	<li class="nav-header">Dog Manipulation</li>
	<?php if($this->session->userdata("privilege") & (1)): ?>
		<li class="<?php if (isset($url) && $url == "dog/register") {echo "active";}?>"><a href="<?php echo site_url("dog/register");?>">Dog Register</a></li>
	<?php endif ?>
	<?php if($this->session->userdata("privilege") & (8)): ?>
	<li class="<?php if (isset($url) && $url == "dog/info") {echo "active";}?>"><a href="<?php echo site_url("dog/info");?>">Dog Information</a></li>
	<?php endif ?>
<?php endif ?>
<?php if($this->session->userdata("privilege") & (16+32+64+128)): ?>
<li class="nav-header">Staff Manipulation</li>
	<?php if($this->session->userdata("privilege") & (16)): ?>
	<li class="<?php if (isset($url) && $url == "staff/register") {echo "active";}?>"><a href="<?php echo site_url("staff/register");?>">Staff Register</a></li>
	<?php endif ?>
	<?php if($this->session->userdata("privilege") & (128)): ?>
	<li class="<?php if (isset($url) && $url == "staff/info") {echo "active";}?>"><a href="<?php echo site_url("staff/info");?>">Staff Information</a></li>
	<?php endif ?>
<?php endif ?>
