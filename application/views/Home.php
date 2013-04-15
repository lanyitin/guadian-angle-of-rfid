<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<?php include_once(APPPATH . "views/assets.php");?>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="#">RFID Guide Dog Management System</a>
					<ul class="nav">
					<li class="<?php if (strpos($url, "home") !== false) echo "active"; ?>"><a href="<?php echo base_url("home"); ?>">Home</a></li>
						<?php include_once(APPPATH . "views/menubar.php");?>
					</ul>
					<?php if (isset($name)): ?>
					<ul class="nav pull-right">
						<li class="dropdown">
						<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Login as <?php echo $name;?></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('auth/logout');?>">Logout</a></li>	
						</ul>
						</li>
					</ul>
					<?php endif ?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span9">
				<?php if (isset($content))echo $content; ?>
			</div><!--/span-->
		</div><!--/row-->

		<hr>

		<footer>
		<p>&copy; Company 2013</p>
		</footer>

	</div><!--/.fluid-container-->
</body>
</html>
