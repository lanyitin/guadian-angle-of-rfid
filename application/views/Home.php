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
					<ul class="nav">
						<li class="<?php if (strpos($url, "home") !== false) echo "active"; ?>"><a href="<?php echo site_url("home"); ?>">Home</a></li>
						<?php include_once(APPPATH . "views/menubar.php");?>
					</ul>
					<?php if (isset($name)): ?>
					<ul class="nav pull-right">
						<li class="dropdown">
						<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Login as <?php echo $this->staff->name;?></a>
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
	<div class="container">
		<div class="container">
			<?php if (isset($content)) {
				echo $content;
			} else { ?>
				<h1>Statistics</h1>
				<div class="row">
					<table class="table">
						<tr>
							<th width="50%">Gender</th>
							<th width="50%">Count</th>
						</tr>
						<tbody>
						<?php foreach($dog_gender_count as $gender): ?>
						<tr>
							<td><?php echo $gender->gender; ?></td>
							<td><?php echo $gender->count; ?></td>
						</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<table class="table">
						<tr>
							<th width="50%">Breed</th>
							<th width="50%">Count</th>
						</tr>
						<?php foreach($dog_breed_count as $breed): ?>
						<tr>
							<td><?php echo $breed->breed; ?></td>
							<td><?php echo $breed->count; ?></td>
						</tr>
						<?php endforeach ?>
					</table>
					<table class="table">
						<tr>
							<th width="50%">Trainer's name</th>
							<th width="50%">Count</th>
						</tr>
						<?php foreach($trainer_dog_count as $count): ?>
						<tr>
							<td><?php echo $count->trainer; ?></td>
							<td><?php echo $count->count; ?></td>
						</tr>
						<?php endforeach ?>
					</table>
				</div>
			<?php } ?>
		</div>
		<hr/>
		<footer> </footer>
	</div>
</body>
</html>
