<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<?php include_once(APPPATH . "views/assets.php");?>
	</head>
	<body>
		<div style="width:940px; margin:auto;">
			<div style="width:400px; margin:auto; text-align:center">
				<object width="400" height="40"
					classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
					codebase="http://fpdownload.macromedia.com/
					pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
					<param name="SRC" value="swf/home.swf">
					<param name="LOOP" value="false">
					<embed src="<?php echo base_url("swf/home.swf"); ?>" width="400" height="400" loop="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
					</embed>
				</object>
				<h1>Please Sign In</h1>
				<form class="form" action="<?php echo site_url('auth/login'); ?>" method="POST">
					<div><input name="username" type="text" Placeholder="Username"/></div>
					<div><input name="password" type="password" Placeholder="Password"/></div>
					<div><input type="submit" value="Sign in" /></div>
				</form>
			</div>
		</div>
	</body>
</html>
