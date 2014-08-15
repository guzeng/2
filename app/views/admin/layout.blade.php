<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?php echo Lang::get('text.LMS')?> - <?php echo Cache::get('company_name')?></title>
    <!--[if lt IE 8]>
        <script type="text/javascript">
            window.location.href="<?php echo route('brower')?>";
        </script>
    <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="zeng.gu" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->          
    <link href="<?php echo asset('assets/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES --> 
    <link href="<?php echo asset('assets/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/style-metronic.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/style.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/style-responsive.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/themes/light.css');?>" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo asset('assets/css/custom.css');?>" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript">
        var msg = {
            'success':"<?php echo Lang::get('msg.success');?>",
            'failed':"<?php echo Lang::get('msg.failed');?>",
            'loading':"<?php echo Lang::get('msg.loading');?>...",
            'error':"<?php echo Lang::get('msg.error')?>",
            'delete_confirm':"<?php echo Lang::get('msg.delete_confirm');?>",
            'sure_to_delete':"<?php echo Lang::get('msg.sure_to_delete');?>",
            'minutes':"<?php echo Lang::get('text.minutes');?>",
            'second':"<?php echo Lang::get('text.second');?>",
            'submit_error':"<?php echo Lang::get('msg.submit_error');?>",
            'check_now':"<?php echo Lang::get('msg.check_now');?>",
            'nothing_changed':"<?php echo Lang::get('msg.nothing_changed');?>",
            'completed':"<?php echo Lang::get('msg.completed');?>",
            'no_data':"<?php echo Lang::get('text.no_result')?>",
            'base_url' : "<?php echo asset('');?>",
            'lang' : "<?php echo App::getLocale();?>",
            'search':"<?php echo Lang::get('text.search')?>",
            'upload_invalid_filesize' : "<?php echo Lang::get('msg.upload_invalid_filesize')?>",
            'theme_tips':"<?php echo Lang::get('msg.theme_tips')?>"
        };
    </script>
    <script src="<?php echo asset('assets/plugins/jquery-1.10.2.min.js');?>" type="text/javascript"></script>
    <?if( App::getLocale() == "en"):?>
        <style type="text/css">
        body{
            margin: 0;
            padding: 0;
            background-color:#fafafa;
            font-family:"Segoe UI",Verdana,Arial,sans-serif;
        }
        button,input{font-family:"Segoe UI",Verdana,Arial,sans-serif;}
        h1, h2, h3, h4, h5, h6 {
          font-family: "Segoe UI",Verdana,Arial,sans-serif;
        }
        .page-title {
          font-family: "Segoe UI",Verdana,Arial,sans-serif;;
        }
        .icon-btn div {
          font-family: "Segoe UI",Verdana,Arial,sans-serif;;
        }
        .icon-btn .badge {
          font-family: "Segoe UI",Verdana,Arial,sans-serif;;
        }
        .dropdown-menu.tasks .task .percent {
          font-family: "Segoe UI",Verdana,Arial,sans-serif;;
        }
        </style>
    <?endif;?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed ">
    <!-- BEGIN HEADER -->   
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN LOGO -->  
            <a class="navbar-brand" href="<?php echo asset('admin/index')?>">
            <img src="<?php echo asset('assets/img/logo.png')?>" alt="logo" class="img-responsive" />
            </a>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="<?php echo asset('');?>assets/img/menu-toggler.png" alt="" />
            </a> 
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">
                <li id="header_theme_bar" class="dropdown">
                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu hold-on-click extended">
                        <li>
                            <div class="theme-panel "> 
                                <div class="theme-options">
                                    <div class="theme-option theme-colors clearfix">
                                        <span><?php echo Lang::get('text.theme_color')?></span>
                                        <ul>
                                            <li class="color-black " data-style="default"></li>
                                            <li class="color-blue" data-style="blue"></li>
                                            <li class="color-brown" data-style="brown"></li>
                                            <li class="color-purple" data-style="purple"></li>
                                            <li class="color-grey" data-style="grey"></li>
                                            <li class="color-white current " data-style="light"></li>
                                        </ul>
                                    </div>
                                    <div class="theme-option">
                                        <span><?php echo Lang::get('text.theme_layout')?></span>
                                        <select class="layout-option form-control input-small">
                                            <option value="fluid" selected="selected"><?php echo Lang::get('text.theme_fluid')?></option>
                                            <option value="boxed"><?php echo Lang::get('text.theme_boxed')?></option>
                                        </select>
                                    </div>
                                    <div class="theme-option">
                                        <span><?php echo Lang::get('text.theme_header')?></span>
                                        <select class="header-option form-control input-small">
                                            <option value="fixed" selected="selected"><?php echo Lang::get('text.theme_fixed')?></option>
                                            <option value="default"><?php echo Lang::get('text.theme_default')?></option>
                                        </select>
                                    </div>
                                    <div class="theme-option">
                                        <span><?php echo Lang::get('text.theme_sidebar')?></span>
                                        <select class="sidebar-option form-control input-small">
                                            <option value="fixed"><?php echo Lang::get('text.theme_fixed')?></option>
                                            <option value="default" selected="selected"><?php echo Lang::get('text.theme_default')?></option>
                                        </select>
                                    </div>
                                    <div class="theme-option">
                                        <span><?php echo Lang::get('text.theme_footer')?></span>
                                        <select class="footer-option form-control input-small">
                                            <option value="fixed" selected="selected"><?php echo Lang::get('text.theme_fixed')?></option>
                                            <option value="default"><?php echo Lang::get('text.theme_default')?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" src="<?php echo User::avatar(Auth::user()->id,'small')?>" height='28'/>
                    <span class="username"><?php echo Auth::user()->username;?></span> 
                    <?if(Session::has('role') && !is_array(Session::get('role'))):?>
                        <span class="role">(<?php echo Role::find(Session::get('role'))->name;?>)</span> 
                    <?endif;?>
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo asset('home/index')?>"><i class="fa fa-hand-o-right"></i> <?php echo Lang::get('text.login_to_front')?></a></li>
                        <li>
                            <?if( get_language() == "zh"):?>
                              <a href="<?php echo asset('change-lang/en');?>"><i class="fa fa-stack-exchange"></i> English</a>
                            <?else:?>
                              <a href="<?php echo asset('change-lang/zh');?>"><i class="fa fa-stack-exchange"></i> 中文版</a>
                            <?endif;?>
                        </li>
                        <li class="divider"></li>
                        <?php $user_roles = User::allRoles(Auth::user()->id);?>
                        <?if(count($user_roles)> 1):?>
                            <?foreach($user_roles as $key => $item):?>
                                <li><a href="<?php echo asset('changerole/'.$item)?>" ><i class="fa fa-user"></i> <?php echo Role::find($item)->name;?></a></li>
                            <?endforeach;?>
                            <li class="divider"></li>
                        <?endif;?>
                        
                        <li><a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-move"></i> <?php echo Lang::get('text.full_screen')?></a></li>
                        <li><a href="<?php echo asset('logout');?>"><i class="fa fa-power-off"></i> <?php echo Lang::get('text.exit');?></a></li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix"></div>
 
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
                <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->        
            <ul class="page-sidebar-menu">
                <li>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler hidden-phone m-b-10"></div>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <?php
                    $action = Route::currentRouteAction();
                    $a = explode('@', $action);
                    $_action_name = $a[1];
                    $a2 = explode('_', $a[0]);
                    $_controller_name = isset($a2[1]) ? $a2[1] : $a2[0];
                ?>
                <?if(User::hasPermission('Admin','IndexController','getIndex')):?>
                    <li class="<?if($_controller_name=='IndexController'):?>active<?endif;?> ">
                        <a href="<?php echo asset('admin/index');?>">
                            <i class="fa fa-home"></i> 
                            <span class="title"><?php echo Lang::get('text.dashboard')?></span>
                        </a>
                    </li>
                <?endif;?>
                <?if(User::hasPermission('Admin','CourseController','getIndex') || User::hasPermission('Admin','CategoryController','getIndex')):?>
                    <li class="<?if(in_array($_controller_name, array('CourseController','CategoryController'))):?>open active<?endif;?>">
                        <a href="<?php echo asset('admin/course');?>">
                            <i class="fa fa-book"></i> 
                            <span class="title"><?php echo Lang::get('text.course_manage')?></span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <?if(User::hasPermission('Admin','CourseController','getIndex')):?>
                                <li class="<?if($_controller_name=='CourseController'):?>active<?endif;?>">
                                    <a href="<?php echo asset('admin/course');?>"><?php echo Lang::get('text.allcourse');?></a>
                                </li>
                            <?endif;?>
                            <?if(User::hasPermission('Admin','CategoryController','getIndex')):?>
                                <li class="<?if($_controller_name=='CategoryController'):?>active<?endif;?>">
                                    <a href="<?php echo asset('admin/category');?>"><?php echo Lang::get('text.course_category');?></a>
                                </li>
                            <?endif;?>
                        </ul>
                    </li>
                <?endif;?>
                <?if(User::hasPermission('Admin','ExamController','getIndex')):?>
                    <li class="<?if($_controller_name=='ExamController'):?>open active<?endif;?>">
                        <a href="<?php echo asset('').'admin/exam';?>">
                            <i class="fa fa-file-text"></i> 
                            <span class="title"><?php echo Lang::get('text.comprehensive_exam_manage');?></span>
                        </a>
                    </li>
                <?endif;?>
                <?if(User::hasPermission('Admin','UserController','getIndex') || User::hasPermission('Admin','DepartmentController','getIndex') || 
                        User::hasPermission('Admin','PostController','getIndex')):?>
                    <li class="<?if(in_array($_controller_name, array('UserController','DepartmentController','PostController'))):?>open active<?endif;?>">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i> 
                            <span class="title"><?php echo Lang::get('text.user_manage');?></span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <?if(User::hasPermission('Admin','UserController','getIndex')):?>
                                <li class="<?if($_controller_name=='UserController'):?>active<?endif;?>">
                                    <a href="<?php echo asset('admin/user');?>"><?php echo Lang::get('text.all_user');?></a>
                                </li>
                            <?endif;?>
                            <?if(User::hasPermission('Admin','DepartmentController','getIndex')):?>
                                <li class="<?if($_controller_name=='DepartmentController'):?>active<?endif;?>">
                                    <a href="<?php echo asset('admin/dept');?>"><?php echo Lang::get('text.dept_manage');?></a>
                                </li>
                            <?endif;?>
                            <?if(User::hasPermission('Admin','PostController','getIndex')):?>
                                <li class="<?if($_controller_name=='PostController'):?>active<?endif;?>">
                                    <a href="<?php echo asset('admin/post');?>"><?php echo Lang::get('text.post_manage')?></a>
                                </li>
                            <?endif;?>
                        </ul>
                    </li>
                <?endif;?>

                <?if(User::hasPermission('Admin','QueryController','getUser')):?>
                <li class="<?if(in_array($_controller_name, array('QueryController'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-bar-chart-o"></i> 
                    <span class="title"><?php echo Lang::get('text.query_statistics');?></span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?if($_controller_name=='QueryController' && $_action_name=='getUser'):?>active<?endif;?>">
                            <a href="<?php echo asset('admin/query/user');?>"><?php echo Lang::get('text.query_user_studying');?></a>
                        </li>
                        <li class="<?if($_controller_name=='QueryController' && $_action_name=='getCourse'):?>active<?endif;?>">
                            <a href="<?php echo asset('admin/query/course');?>"><?php echo Lang::get('text.query_course_studying');?></a>
                        </li>
                        <li class="<?if($_controller_name=='QueryController' && $_action_name=='getExam'):?>active<?endif;?>">
                            <a href="<?php echo asset('admin/query/exam');?>"><?php echo Lang::get('text.query_comprehensive_exam');?></a>
                        </li>
                    </ul>
                </li>
                <?endif;?>
                
                <?if(User::hasPermission('Admin','SystemController','getIndex') || User::hasPermission('Admin','NewsController','getIndex') || 
                        User::hasPermission('Admin','SkinController','getIndex') || User::hasPermission('Admin','QuestionnaireController','getIndex') || 
                        User::hasPermission('Admin','RoleController','getIndex') || User::hasPermission('Admin','LogController','getIndex')):?>
                <li class="<?if(in_array($_controller_name, array('SystemController','NewsController','SkinController','QuestionnaireController','RoleController','LogController'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cog"></i> 
                    <span class="title"><?php echo Lang::get('text.system_manage');?></span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <?if(User::hasPermission('Admin','SystemController','getIndex')):?>
                            <li class="<?if($_controller_name=='SystemController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/system');?>"><?php echo Lang::get('text.system_setting');?></a>
                            </li>
                        <?endif;?>
                        <?if(User::hasPermission('Admin','NewsController','getIndex')):?>
                            <li class="<?if($_controller_name=='NewsController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/news')?>"><?php echo Lang::get('text.announcement_settings')?></a>
                            </li>
                        <?endif;?>
                        <?if(User::hasPermission('Admin','SkinController','getIndex')):?>
                            <li class="<?if($_controller_name=='SkinController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/skin');?>"><?php echo Lang::get('text.skin_settings');?></a>
                            </li>
                        <?endif;?>
                        <?if(User::hasPermission('Admin','QuestionnaireController','getIndex')):?>
                            <li class="<?if($_controller_name=='QuestionnaireController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/questionnaire')?>"><?php echo Lang::get('text.questionnaire_settings')?></a>
                            </li>
                        <?endif;?>
                        <?if(User::hasPermission('Admin','RoleController','getIndex')):?>
                            <li class="<?if($_controller_name=='RoleController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/role')?>"><?php echo Lang::get('text.role_settings');?></a>
                            </li>
                        <?endif;?>
                        <?if(User::hasPermission('Admin','LogController','getIndex')):?>
                            <li class="<?if($_controller_name=='LogController'):?>active<?endif;?>">
                                <a href="<?php echo asset('admin/log');?>"><?php echo Lang::get('text.admin-log');?></a>
                            </li>
                        <?endif;?>
                    </ul>
                </li>
                <?endif;?>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
	    @yield('content')
    </div>
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
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            <?php echo Cache::get('company_name')?>  &nbsp; &nbsp; &copy; IASPEC
        </div>
        <div class="footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- 登录表单 -->
    <div id='_login_form' class='modal fade' aria-hidden="false" aria-labelledby="_login_form" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo Lang::get('msg.login_outtime')?></h4>
                </div>
                <div class="modal-body form">
                    <form class="form-horizontal" role='form' method="post" action="<?php echo asset('verify')?>" id='_relogin_form'>
                        <div class='form-body'>
                            <div class="form-group" >
                                <label class="control-label col-md-3"><?php echo Lang::get('text.username')?></label>
                                <div class="col-md-9">
                                    <input type="text" id="username" class='form-control' name='username' value="<?php echo isset($_COOKIE['lms_username'])? substr(base64_decode($_COOKIE['lms_username']),0,-3):''?>"  maxlength='20' class="span3" >
                                    <span class='help-block'></span>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label  class="control-label col-md-3"><?php echo Lang::get('text.password')?></label>
                                <div class="col-md-9">
                                    <input type="password" id="password_f" name='password_f' value="" maxlength='20' class="form-control" > 
                                    <span class='help-block'></span>
                                </div>
                            </div>
                            <?if(Cache::get('login_captcha') == 1):?>
                                <div class="form-group" >
                                    <label  class="control-label col-md-3"><?php echo Lang::get('text.validate_key')?>:</label>
                                    <div class="col-md-9">
                                        <div class='input-group'>
                                            <input id="validate_key" class="form-control" name="validate_key" type="text" />
                                            <span class='input-group-addon' style='background:none;'>
                                                <img style="cursor:pointer;" title="<?php echo Lang::get('text.validate_refresh')?>" id="login_captcha" border='0' src=""  onclick="refreshValidateKey()"/>  
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if(Cache::get('auto_login') > 0):?>
                                <div class="form-group" >
                                    <label  class="control-label col-md-3">&nbsp;</label>
                                    <div class="col-md-9">
                                        <div class="checkbox-list">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="auto_login" value="auto_login"> <?php echo Lang::get('text.auto_login')?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                            <div class="form-group hide"  id='error_message'>
                                <label  class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-9">
                                    <span class='help-block'></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" id='_token' value="">
                    </form>
                    <div class='clearfix'></div>
                </div>
                <div class="modal-footer">
                    <button class="btn green" id='relogin_form_submit_btn' onclick="javascript:login();"><?php echo Lang::get('text.login')?></button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo Lang::get('text.close')?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录表单结束 -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->   
    <!--[if lt IE 9]>
    <script src="<?php echo asset('assets/plugins/respond.min.js');?>"></script>
    <script src="<?php echo asset('assets/plugins/excanvas.min.js');?>"></script> 
    <![endif]-->   
    <!--[if lt IE 8]>
    <link href="<?php echo asset('assets/css/bootstrap-ie7.css');?>" rel="stylesheet">
    <![endif]--> 
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?php echo asset('assets/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js');?>" type="text/javascript" ></script>
    <script src="<?php echo asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/jquery.cookie.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>

    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo asset('assets/scripts/app.js');?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    <script src="<?php echo asset('assets/scripts/common.js');?>" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {    
           App.init(); // initlayout and core plugins
        });
    </script>
    @yield('script')
    
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>