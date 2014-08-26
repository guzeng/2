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
                        <li><a href="page-login.html">Log In</a></li>
                        <li><a href="page-reg-page.html">Registration</a></li>
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
              <a href="#">
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

            <div class="photo-stream">
              <h2>Photos Stream</h2>                   
            </div>
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2>Our Contacts</h2>
            <address class="margin-bottom-40">
              35, Lorem Lis Street, Park Ave<br>
              California, US<br>
              Phone: 300 323 3456<br>
              Fax: 300 323 1456<br>
              Email: <a href="mailto:info@metronic.com">info@metronic.com</a><br>
              Skype: <a href="skype:metronic">metronic</a>
            </address>

            <div class="pre-footer-subscribe-box pre-footer-subscribe-box-vertical">
              <h2>Newsletter</h2>
              <p>Subscribe to our newsletter and stay up to date with the latest news and deals!</p>
              <form action="#">
                <div class="input-group">
                  <input type="text" placeholder="youremail@mail.com" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <!-- END BOTTOM CONTACTS -->

          <!-- BEGIN TWITTER BLOCK --> 
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2 class="margin-bottom-0">Latest Tweets</h2>
            <a class="twitter-timeline" href="https://twitter.com/twitterapi" data-tweet-limit="2" data-theme="dark" data-link-color="#57C8EB" data-widget-id="455411516829736961" data-chrome="noheader nofooter noscrollbar noborders transparent">Loading tweets by @keenthemes...</a>
          </div>
          <!-- END TWITTER BLOCK -->
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
    <!--[if lt IE 9]>
    <?php echo HTML::script('assets/plugins/respond.min.js');?>
    <![endif]--> 
    <?php echo HTML::script('assets/plugins/jquery-1.10.2.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery-migrate-1.2.1.min.js');?>
    <?php echo HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js');?>
    <?php echo HTML::script('assets/scripts/frontend/back-to-top.js');?>
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