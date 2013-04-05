<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
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
