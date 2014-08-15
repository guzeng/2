<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo Lang::get('msg.error_page_title');?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->          
	<link href="<?php echo asset('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo asset('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES --> 
	<link href="<?php echo asset('assets/css/style-metronic.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo asset('assets/css/style.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo asset('assets/css/style-responsive.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo asset('assets/css/pages/error.css')?>" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-404-3">
	<div class="page-inner">
		<img src="<?php echo asset('assets/img/earth.jpg')?>" class="img-responsive" alt="">
	</div>
	<div class="container error-404">
		<h1>404</h1>

		<p><?php echo Lang::get('msg.error_page_title');?></p>
		<h2>
			<?php echo isset($msg) ? $msg : Lang::get('msg.404_page');?> 
		</h2>
		<p> &nbsp; </p>
		<p>
			<button class='btn btn-lg blue' onclick="javascript:history.go(-1);" title="<?php echo Lang::get('text.back')?>"><i class='fa fa-mail-reply '></i> <?php echo Lang::get('text.back')?></button>
			<br>
		</p>
	</div>
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>