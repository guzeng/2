<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title><?php echo (Cache::has('website_name') ? Cache::get('website_name') : '')?></title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">

    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Global styles START -->
    <?php echo HTML::style('assets/plugins/font-awesome/css/font-awesome.min.css');?>
    <?php echo HTML::style('assets/plugins/bootstrap/css/bootstrap.min.css');?>

    <!-- Global styles END --> 

    <!-- Page level plugin styles START -->
    <?php echo HTML::style('assets/plugins/fancybox/source/jquery.fancybox.css');?>
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <?php echo HTML::style('assets/css/frontend/components.css');?>
    <?php echo HTML::style('assets/css/frontend/style.css');?>
    <?php echo HTML::style('assets/css/frontend/red.css');?>
    <?php echo HTML::style('assets/css/frontend/style-responsive.css');?>
    <?php echo HTML::style('assets/css/custom.css');?>
    <!--[if lt IE 8]>
    <?php echo HTML::style('assets/css/bootstrap-ie7.css');?>
    <![endif]--> 
  <!-- Theme styles END -->
  <script type="text/javascript">
    var msg = {
        'base_url':"<?php echo asset('');?>"
    };
  </script>
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                        <li><i class="fa fa-envelope-o"></i><span>info@keenthemes.com</span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="<?php echo asset('login')?>"><?php echo Lang::get('text.login')?></a></li>
                        <li><a href="<?php echo asset('register')?>"><?php echo Lang::get('text.register')?></a></li>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="index.html">
            <img src="../../assets/frontend/layout/img/logos/logo-corp-red.png" alt="Metronic FrontEnd">
        </a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>
            <li class="">
              <a href="<?php echo asset('')?>">
                首页
              </a>
            </li>
            <li class="">
                <a href="#">
                    在线托运
                </a>
            </li>
            <li class="">
                <a href="#">
                    托运流程
                </a>
            </li>
            <li class="">
                <a href="#">
                    用户须知
                </a>
            </li>
            <li class="">
                <a href="#">
                    常见问题
                </a>
            </li>
            <li class="">
                <a href="#">
                    资讯
                </a>
            </li>
            <!-- BEGIN TOP SEARCH -->
            <li class="menu-search">
                <span class="sep"></span>
                <i class="fa fa-search search-btn"></i>
                <div class="search-box">
                    <form action="#">
                      <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                      </div>
                    </form>
                </div> 
            </li>
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->


@yield('content')


    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2>About us</h2>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat.</p>
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->


        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

    <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-12 col-sm-12 padding-top-10 text-center">
            2014 © Metronic Shop UI. ALL Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
          </div>
          <!-- END COPYRIGHT -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <?php echo HTML::script('assets/plugins/jquery-1.10.2.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery-migrate-1.2.1.min.js');?>
    <?php echo HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js');?>
    <?php echo HTML::script('assets/scripts/frontend/back-to-top.js');?>
    <!--[if lt IE 9]>
        <script src="<?php echo asset('assets/plugins/respond.min.js');?>"></script>
        <script src="<?php echo asset('assets/plugins/excanvas.min.js');?>"></script> 
    <![endif]-->
    <?php echo HTML::script('assets/scripts/common.js');?>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <?php echo HTML::script('assets/plugins/fancybox/source/jquery.fancybox.pack.js');?>
    <!-- BEGIN RevolutionSlider -->
    <?php echo HTML::script('assets/scripts/frontend/layout.js');?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
    @yield('script')
</body>

<!-- END BODY -->
</html>