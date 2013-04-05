<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<style type="text/css">
	body {
		padding-top: 60px;
		padding-bottom: 40px;
	}
	.sidebar-nav {
		padding: 9px 0;
	}

	@media (max-width: 980px) {
		/* Enable use of floated navbar text */
		.navbar-text.pull-right {
			float: none;
			padding-left: 5px;
			padding-right: 5px;
		}
	}
</style>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-dropdown.js')?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-datepicker.js')?>"></script>

<script>
$(function () {
	$('.dropdown-toggle').dropdown();
	$('.datepicker').datepicker({
		format: "yyyy-mm-dd"
	});
});
</script>
