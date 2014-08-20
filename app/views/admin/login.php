<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0.2
Version: 1.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo Lang::get('text.login')?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->          
	<?php echo HTML::style('assets/plugins/font-awesome/css/font-awesome.min.css')?>
	<?php echo HTML::style('assets/plugins/bootstrap/css/bootstrap.min.css')?>
	<?php echo HTML::style('assets/plugins/uniform/css/uniform.default.css')?>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<?php echo HTML::style('assets/plugins/select2/select2_metro.css')?>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES --> 
	<?php echo HTML::style('assets/css/style-metronic.css')?>
	<?php echo HTML::style('assets/css/style.css')?>
	<?php echo HTML::style('assets/css/style-responsive.css')?>
	<?php echo HTML::style('assets/css/plugins.css')?>
	<?php echo HTML::style('assets/css/themes/default.css')?>
	<?php echo HTML::style('assets/css/pages/login-soft.css')?>
	<?php echo HTML::style('assets/css/custom.css')?>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript">
        var msg = {
            'success':"<?php echo Lang::get('msg.success');?>",
            'failed':"<?php echo Lang::get('msg.failed');?>",
            'loading':"<?php echo Lang::get('msg.loading');?>...",
            'error':"<?php echo Lang::get('msg.error')?>",
            'submit_error':"<?php echo Lang::get('msg.submit_error');?>",
            'completed':"<?php echo Lang::get('msg.completed');?>",
            'base_url' : "<?php echo asset('');?>",
            'lang' : "<?php echo App::getLocale();?>"
        };
    </script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		LOGO
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="<?php echo asset('admin/login/verify')?>" method="post" >
			<h3 class="form-title">Login to your account</h3>
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span>Enter any username and password.</span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="input-icon">
					<i class="fa fa-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="pwd"/>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> Remember me
				</label>
				<button type="submit" class="btn blue pull-right" id='submit_btn'>
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
			<div class="forget-password">
				<h4>Forgot your password ?</h4>
				<p>
					no worries, click <a href="javascript:;"  id="forget-password">here</a>
					to reset your password.
				</p>
			</div>
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		</form>
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="forget-form" action="index.html" method="post">
			<h3 >Forget Password ?</h3>
			<p>Enter your e-mail address below to reset your password.</p>
			<div class="form-group">
				<div class="input-icon">
					<i class="fa fa-envelope"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Back
				</button>
				<button type="submit" class="btn blue pull-right">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		2014 &copy; Yuexingtrip.com
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<?php echo HTML::script('assets/plugins/respond.min.js');?>
	<?php echo HTML::script('assets/plugins/excanvas.min.js');?>
	<![endif]-->   
	<?php echo HTML::script('assets/plugins/jquery-1.10.2.min.js');?>
	<?php echo HTML::script('assets/plugins/jquery.form.js');?>

	<?php echo HTML::script('assets/plugins/jquery-migrate-1.2.1.min.js');?>
	<?php echo HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js');?>
	<?php echo HTML::script('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js');?>
	<?php echo HTML::script('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>
	<?php echo HTML::script('assets/plugins/jquery.blockui.min.js');?>
	<?php echo HTML::script('assets/plugins/jquery.cookie.min.js');?>
	<?php echo HTML::script('assets/plugins/uniform/jquery.uniform.min.js');?>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<?php echo HTML::script('assets/plugins/jquery-validation/jquery.validate.min.js');?>
	<?php echo HTML::script('assets/plugins/backstretch/jquery.backstretch.min.js');?>
	<?php echo HTML::script('assets/plugins/select2/select2.min.js');?>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<?php echo HTML::script('assets/scripts/common.js');?>
	<?php echo HTML::script('assets/scripts/app.js');?>
	<?php echo HTML::script('assets/scripts/login-soft.js');?>
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		  $('input[name=username]').focus();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>