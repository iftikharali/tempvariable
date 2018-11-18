<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>resources/images/ico/tempvariable.ico" />
		<link href="<?php echo base_url();?>resources/css/bootstrap.min.css" rel="stylesheet">
		<meta property="og:image" content="<?php echo base_url();?>resources/images/logo/logo_blue.png" /> 
		<?php foreach ($meta as $name=>$content):?>
		<meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" />
		<?php endforeach; ?>
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- custom css -->
		<?php foreach($css as $c):?>
		    
		<link href="<?php echo base_url();?>resources/css/<?php echo $c ?>" rel="stylesheet">
		<?php endforeach;?>
		
		<!-- end custom css -->
		<link href="<?php echo base_url();?>resources/css/styles.css" rel="stylesheet">
	</head>
	<body <?php echo 'class="'.$body_class.'"'?>>

		<?php echo $body_content; ?>
  
	<!-- script references -->
		<script src="<?php echo base_url();?>resources/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>resources/js/bootstrap.min.js"></script>
		<!-- custom javascript -->
		<?php foreach($javascript as $js):?>
		    
		<script src="<?php echo base_url();?>resources/js/<?php echo $js ?>"></script>
		<?php endforeach;?>
		<!-- end custom javascript -->
	</body>
</html>