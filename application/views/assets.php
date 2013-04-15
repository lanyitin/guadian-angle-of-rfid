<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-dropdown.js')?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-datepicker.js')?>"></script>
<script src="<?php echo base_url('js/ckeditor/ckeditor.js');?>" type="text/javascript"></script>

<script>
$(function () {
	$('.dropdown-toggle').dropdown();
	$('.datepicker').datepicker({
		format: "yyyy-mm-dd"
	});
});
CKEDITOR.config.filebrowserBrowseUrl = '<?php echo base_url("js/ckeditor/filemanager/browser/default/browser.html");?>?Connector=<?php echo base_url("js/ckeditor/filemanager/connectors/php/connector.php"); ?>';
CKEDITOR.config.filebrowserImageBrowseUrl = '<?php echo base_url("js/ckeditor/filemanager/browser/default/browser.html");?>?Type=Image&Connector=<?php echo base_url("js/ckeditor/filemanager/connectors/php/connector.php");?>';
CKEDITOR.config.filebrowserFlashBrowseUrl = '<?php echo base_url("js/ckeditor/filemanager/browser/default/browser.html");?>?Type=Flash&Connector=<?php echo base_url("js/ckeditor/filemanager/connectors/php/connector.php");?>';
CKEDITOR.config.filebrowserUploadUrl  ='<?php echo base_url("js/ckeditor/filemanager/connectors/php/upload.php?Type=File")?>';
CKEDITOR.config.filebrowserImageUploadUrl = '<?php echo base_url("js/ckeditor/filemanager/connectors/php/upload.php?Type=Image");?>';
CKEDITOR.config.filebrowserFlashUploadUrl = '<?php echo base_url("js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash") ?>';
</script>
