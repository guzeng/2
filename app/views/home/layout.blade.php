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
    <?if( App::getLocale() == "en"):?>
    <style type="text/css">
    body{
        margin: 0;
        padding: 0;
        background-color:#fafafa;
        font-family:"Segoe UI",Verdana,Arial,sans-serif;
    }
    button,input{font-family:"Segoe UI",Verdana,Arial,sans-serif;}
    </style>
<?endif;?>
  <!-- Theme styles END -->
  <script type="text/javascript">
    var msg = {
        'base_url':"<?php echo asset('');?>",
        'success':"<?php echo Lang::get('msg.success')?>",
        'failed':"<?php echo Lang::get('msg.failed')?>",
        'loading':"<?php echo Lang::get('msg.loading')?>",
        'submit_error':"<?php echo Lang::get('msg.submit_error')?>",
        'error':"<?php echo Lang::get('msg.error')?>",
        'lang':"<?php echo App::getLocale(); ?>",
        'delete_confirm':"<?php echo Lang::get('msg.delete_confirm');?>",
        'sure_to_delete':"<?php echo Lang::get('msg.sure_to_delete');?>",
        'cancel_confirm':"<?php echo Lang::get('msg.cancel_confirm');?>",
        'sure_to_cancel':"<?php echo Lang::get('msg.sure_to_cancel')?>"
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
                        <li><i class="fa fa-phone"></i><span><?php echo Cache::get('hotline')?></span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <?php if(Auth::guest()):?>
                        <li><a href="<?php echo asset('login')?>"><?php echo Lang::get('text.login')?></a></li>
                        <li><a href="<?php echo asset('register')?>"><?php echo Lang::get('text.register')?></a></li>
                        <?php else:?>
                            <li><a href="<?php echo asset('user/profile')?>"><?php echo Auth::user()->name;?></a></li>
                            <li><a href="<?php echo asset('login/out')?>"><?php echo Lang::get('text.exit')?></a></li>
                        <?php endif;?>
                        <?if( App::getLocale() == "zh"):?> 
                            <li><span class='grey'>中文版</span> &nbsp; <a href="<?php echo asset('change-lang/en');?>">English</a></li>
                        <?else:?>
                            <li><a href="<?php echo asset('change-lang/zh');?>">中文版</a> &nbsp; <span class='grey'>English</span></li>
                        <?endif;?>
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
        <a class="site-logo" href="<?php echo asset('')?>">
            <img src="<?php echo file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'logo.png') ? asset('uploads/logo.png') : asset('assets/img/logo.png')?>" class='logoPic' height='50'>
        </a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
            <?php
                $action = Route::currentRouteAction();
                $a = explode('@', $action);
                $_action_name = $a[1];
                $a2 = explode('_', $a[0]);
                $_controller_name = isset($a2[1]) ? $a2[1] : $a2[0];
            ?>
          <ul>
            <li class="<?php if($_controller_name=='IndexController'):?>active<?endif;?>">
              <a href="<?php echo asset('')?>">
                <?php echo Lang::get('text.homepage')?>
              </a>
            </li>
            <li class="<?php if($_controller_name=='OrderController'):?>active<?endif;?>">
                <a href="<?php echo asset('order')?>">
                    <?php echo Lang::get('text.online_order')?>
                </a>
            </li>
            
            <li class="<?php if($_controller_name=='WorkflowController'):?>active<?endif;?>">
                <a href="<?php echo asset('workflow')?>">
                    <?php echo Lang::get('text.ship_process')?>
                </a>
            </li>
            <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getGrude'):?>active<?endif;?>">
                <a href="<?php echo asset('news/grude')?>">
                    <?php echo Lang::get('text.newcomer_grude')?>
                </a>
            </li>
            <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getFaq'):?>active<?endif;?>">
                <a href="<?php echo asset('news/faq')?>">
                    <?php echo Lang::get('text.FAQ')?>
                </a>
            </li>
            <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getIndex'):?>active<?endif;?>">
                <a href="<?php echo asset('news')?>">
                    <?php echo Lang::get('text.news')?>
                </a>
            </li>
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
            <!--
            <div class='pull-right'>
                <a data-original-title='' data-content="<img src='<?php echo asset('assets/img/weidian.png')?>' height='100'>" class='popovers' href='javascript:;'  data-placement='top' data-trigger='hover'>
                    <img src="<?php echo asset('assets/img/weidian.jpg')?>">
                </a>
            </div>
            -->
        <div class="row m-t-20">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-12 col-sm-12 pre-footer-col text-center">
                <ul class="list-inline">
                    <li><a href="<?php echo asset('about')?>"><?php echo Lang::get('text.aboutus')?></a></li>
                    <li> | </li>
                    <li><a href="<?php echo asset('about/contact')?>"><?php echo Lang::get('text.contact_us')?></a></li>
                    <li> | </li>
                    <li><a href="<?php echo asset('job')?>"><?php echo Lang::get('text.join_us')?></a></li>
                    <li> | </li>
                    <a href="<?php echo asset('news/grude')?>"><?php echo News::category(1)?></a>
                    <li> | </li>
                    <a href="<?php echo asset('news/faq')?>"><?php echo News::category(2)?></a>
                </ul>
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
            <?php echo Cache::get('copyright')?> <a href="http://www.miitbeian.gov.cn" target='_blank'><?php echo Cache::get('icp');?></a>
          </div>
          <!-- END COPYRIGHT -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->

    <!-- 登录表单 -->
    <div id='_login_form' class='modal hide' role="dialog" tabindex="-1" aria-hidden="false" style='display:none;z-index:2015'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo Lang::get('text.login')?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo asset('login/verify')?>" id='_relogin_form'>
                        <div class="form-group" >
                            <label class="control-label col-md-3"><?php echo Lang::get('text.username')?> :</label>
                            <div class="col-md-7">
                                <input type="text" id="username" name='username' value=""  maxlength='30' class="form-control" >
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-md-3"><?php echo Lang::get('text.password')?> :</label>
                            <div class="col-md-7">
                              <input type="password" id="password" name='password' value="" maxlength='20' class="form-control" > 
                            </div>
                        </div>
                        <div class="form-group hide" >
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="red col-md-8" id='error_message'></div>
                        </div>
                        <div class='form-group'>
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-8">
                                <?php echo Lang::get('text.register_tips')?> &nbsp; <a href="<?php echo asset('register');?>" target='_blank'><?php echo Lang::get('text.go_register')?></a>
                            </div>
                        </div>
                        <input type="hidden" name="_token" id='_token' value="<?php echo csrf_token(); ?>">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id='relogin_form_submit_btn' onclick="login();"><?php echo Lang::get('text.login')?></button> &nbsp;
                    <button class="btn btn-default" data-dismiss="modal"  onclick="hideLogin();"><?php echo Lang::get('text.close')?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录表单结束 -->
    <!-- modal -->
    <div aria-hidden="true" aria-labelledby="_confirm_dialogLabel" role="dialog" tabindex="-1" class="modal fade" id="_confirm_dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id='_confirm_btn'><?php echo Lang::get('text.ensure');?></button>
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default"><?php echo Lang::get('text.cancel');?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <?php echo HTML::script('assets/plugins/jquery-1.10.2.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery-migrate-1.2.1.min.js');?>
    <?php echo HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
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
            jQuery('.popovers').popover({
                html: true
            });
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
    @yield('script')
    
    <script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F338c853439464c19e18a201f0a7f895c' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"让您畅享旅游的服务，环球之旅，悦行开启！现在，快来悦行网体验吧！","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"left","bdTop":"250"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</body>

<!-- END BODY -->
</html>