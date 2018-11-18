<!Doctype html>
<html>
	<head>
		<title>Upload file Error</title>
	</head>
	<body>
		<h1>Oops! Seems there is some issue while uploading. Please see the below detail of error</h1><hr>
		<?php echo $error; ?>
		<hr />
		<a href="<?php echo base_url();?>convertor">Click here to go back and try again</a>
	</body>
</html>