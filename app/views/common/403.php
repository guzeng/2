<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo Lang::get('msg.permission_denied')?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->          
	<link href="<?php echo asset('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES --> 
	<link href="<?php echo asset('assets/css/style-metronic.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo asset('assets/css/pages/error.css')?>" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-500-full-page">
	<div class="row">
		<div class="col-md-12 page-500">
			<div class=" number">
				403
			</div>
			<div class=" details">
				<h2><?php echo Lang::get('msg.permission_denied')?></h2>
				<p>
					<button class='btn btn-lg blue' onclick="javascript:history.go(-1);" title="<?php echo Lang::get('text.back')?>"><i class='fa fa-mail-reply '></i> <?php echo Lang::get('text.back')?></button>
				</p>
			</div>
		</div>
	</div>
</body>
<!-- END BODY -->
</html>