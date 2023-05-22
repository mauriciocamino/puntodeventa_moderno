<div id="filemanager-wrapper">
	<div class="ng-cloak">
	  <angular-filemanager></angular-filemanager>
	</div>
</div>

<?php 
$target = isset($request->get["target"]) ? $request->get["target"] : "p_image";
$thumb = isset($request->get["thumb"]) ? $request->get["thumb"] : "p_thumb"; ?>

<script type="text/javascript">
function pickFileCallback(item) {
	var fileName = item.name;
	var fileExtension = fileName.substr(fileName.lastIndexOf(".") + 1);
	if (fileExtension == "jpg" 
	|| fileExtension == "JPEG" 
	|| fileExtension == "png" 
	|| fileExtension == "svg" 
	|| fileExtension == "pdf" 
	|| fileExtension == "gif") {
		var target = "<?php echo $target; ?>";
	    var thumb = "<?php echo $thumb; ?>";

	    $(document).find("#"+target).val(item.fullPath());
	    $(document).find("#"+thumb + " img").attr("src", "<?php echo FILEMANAGERURL ? FILEMANAGERURL : root_url().'/storage/products'; ?>/" + item.fullPath());
	    if ($(document).find('.modal:first')) {
	    	$(document).find('.modal:first').remove();
	    	$(document).find('.modal-backdrop:first').remove();
	    }
	    setTimeout(function() {
	    	if ($(document).find('.modal').length) {
		    	$("body").addClass("modal-open");
		    }
	    }, 1000);
	} else {
		swal("Error!", "Por favor, seleccione un archivo válido. es decir, jpg, png, gif, svg,pdf", "error");
	}
}
</script>