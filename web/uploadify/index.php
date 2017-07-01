<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css">
</head>
<body>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'uploadify.swf',
                'uploader' : 'index.php?r=app/attachment/up'
			});
		});
	</script>
</body>
</html>