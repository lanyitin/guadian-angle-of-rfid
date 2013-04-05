<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Authentication</title>
	<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
</head>
<body>
<div class="container">
	<h1 style="color:red"><?php echo validation_errors();if (isset($error_msg)) {echo $error_msg;}?></h1>
	<form class="form-signin" action="<?php echo site_url('auth/login'); ?>" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
</body>
</html>
