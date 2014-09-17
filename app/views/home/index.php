<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo Cache::get('website_title')?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?php echo Cache::get('website_keyword')?>" />
		<meta name="description" content="<?php echo Cache::get('website_description')?>" />
		<?php echo HTML::style('assets/plugins/bootstrap/css/bootstrap.css');?>
	    <!--[if lt IE 8]>
	    <?php echo HTML::style('assets/css/bootstrap-ie7.css');?>
	    <![endif]--> 
		<?php echo HTML::script('assets/plugins/jquery.min.js');?>
		 <!-- start-smoth-scrolling-->
		<?php echo HTML::script('assets/scripts/home/move-top.js');?>
		<?php echo HTML::script('assets/scripts/home/easing.js');?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<!-- start-smoth-scrolling-->
		 <!-- Custom Theme files -->
		<?php echo HTML::style('assets/css/theme-style.css');?>
		<?php echo HTML::style('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css');?>
   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> 
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
		</script>

	    <!--[if lt IE 9]>
	        <script src="<?php echo asset('assets/plugins/respond.min.js');?>"></script>
	        <script src="<?php echo asset('assets/plugins/excanvas.min.js');?>"></script> 
	    <![endif]-->
		<!--//webfonts-->
		<!--start-top-nav-script-->
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>
		<!--//End-top-nav-script-->

		<?php echo HTML::script('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>
		<?php if(App::getLocale()=='zh'):?>
		<?php echo HTML::script('assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js');?>
		<?php endif;?>
    	<link rel="shortcut icon" href="favicon.ico">
	</head>
	<body>
		<!--start-container-->
		<div class="bg">
			<div class="container">
				<div class='header' id='header'>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4 contact-no col-ie7">
							<?php echo Cache::get('hotline')?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4 logo col-ie7">
							<a href="#"><img src="<?php echo asset('assets/img/logo-l.png')?>" ></a>
						</div>
						<div class="contact-order col-md-4 col-sm-4 col-xs-4 text-right col-ie7">
							<?php if(Auth::guest()):?>
							<a href="<?php echo asset('login')?>">登录</a> | <a href="<?php echo asset('register')?>">注册</a>
							<?php else:?>
							<a href="<?php echo asset('user/profile')?>" style='font-size:16px;'><?php echo Auth::user()->name;?></a> | <a href="<?php echo asset('login/out')?>" style='font-size:16px;'><?php echo Lang::get('text.exit')?></a>
							<?php endif;?>
							|  
                            <?if( App::getLocale() == "zh"):?>
                            	<span class='c-l'>中文版</span> 
                              	<a href="<?php echo asset('change-lang/en');?>" class='c-l'><i class="fa fa-stack-exchange"></i> English</a>
                            <?else:?>
                              	<a href="<?php echo asset('change-lang/zh');?>" class='c-l'><i class="fa fa-stack-exchange"></i> 中文版</a> 
                              	<span class='c-l'>English</span>
                            <?endif;?>
						</div>
					</div>
						<!--start-top-nav-->
					<nav class="top-nav">
						<ul class="">
							<li class="active"><a href="#home" class="scroll"><?php echo Lang::get('text.homepage')?></a></li>
							<li class="page-scroll"><a href="#about" class="scroll"><?php echo Lang::get('text.online_order')?></a></li>
							<li class="page-scroll"><a href="#gal" class="scroll"><?php echo Lang::get('text.ship_process')?></a></li>
							<li class="page-scroll"><a href="#con" class="scroll"><?php echo Lang::get('text.user_instructions')?></a></li>
							<li class="page-scroll"><a href="#test" class="scroll"><?php echo Lang::get('text.FAQ')?></a></li>
							<li class="page-scroll"><a href="#contact" class="scroll"><?php echo Lang::get('text.news')?></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!---start-about-->
		<div id="about" class="about">
			<div class="container">
				<div class='row'>
					<div class="col-md-6 about-left col-ie7" style="font-size:16px;line-height:35px;">
						<p>说走就走的旅行再也不是高富帅和土豪的专利了，全新的旅游增值服务--行李运送服务，悦行网为您呈现！</p>
						<p>无论是出行前的大箱小包、或是回程时的手信礼物，只需预约悦行网行李运送服务，专业的服务为您解决。</p>
						<p>环球之旅，悦行开启！</p>
					</div>
					<div class="col-md-6 about-right col-ie7">
						<div class="panel panel-primary">
					      	<div class="panel-heading">快速预订</div>
					      	<div class="panel-body">
								<form class="form-horizontal" role="form" method='get' action="<?php echo asset('order')?>">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-3 control-label">运送城市</label>
										<div class="col-md-7">
			                                <select name="city_id" id="city_id" class="form-control">
			                                    <option><?php echo Lang::get('text.please_choose');?></option>
			                                    <?php foreach($allCity as $key => $v):?>
			                                    <option value="<?php echo $v->id?>"><?php echo $v->name;?></option>
			                                    <?endforeach;?>
			                                </select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-md-3 control-label">运送类型</label>
										<div class="col-md-7 ">
			                                <select name="type" id="type" class="form-control">
			                                    <?php foreach($allType as $key => $v):?>
			                                    <option value="<?php echo $key?>"><?php echo $v;?></option>
			                                    <?endforeach;?>
			                                </select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-md-3 control-label">运送日期</label>
										<div class="col-md-7">
											<input type="text" id="inputEmail3" class="form-control form_datetime" CustomFormat="yyyy/MM/dd - HH:mm" Format="Custom" data-link-field="time_input">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-offset-3 col-md-7 ">
											<button type="submit" class="btn btn-primary">开始预订</button>
										</div>
									</div>
									<input type="hidden" id="time_input" name='time' value="" />
								</form>
					      	</div>
					    </div>
					</div>
				</div>
			</div>
		</div>

		<!--start-gallery-->
		<div id="gal" class="gallery">
			<div class="container">
				<div class="head title">
					运送流程
				</div>
				<div class="gallery-grids">
					<div class="gallery-grids-row1">
						<div class="col-md-8 col-sm-12 gallery-grid1 text-center col-ie7">
							<a href="<?php echo asset('order')?>" class="b-link-stripe b-animate-go  thickbox">
								<img class=" img-responsive" src="<?php echo asset('assets/img/home/liucheng.jpg')?>" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left b-delay03 ">
										<button>开始预订</button>
									</h2>
								</div>
							</a>
						</div>
						<div class='col-md-4 col-sm-12 gallery-right col-ie7'>
							<div class='con'>
								<div class='m-b-10'>
									<div class='pull-left'>1.</div>
									<div class='content'>在网上自助下单，点击“开始预订”后填写您的相关信息，或者通过电话向网站客服人员下单。</div>
								</div>
								<div class='m-b-10'>
									<div class='pull-left'>2.</div>
									<div class='content'>如果您的行李是从机场运送至目的地，航班落地后，我们的配送员将第一时间联系您，并在机场到达厅接收您的行李，填写托运单据。</div>
								</div>
								<div class='m-b-10'>
									<div class='pull-left'>3.</div>
									<div class='content'>如果您的行李是从住宅、酒店、或者商业大厦等地点运送至机场，请在您的航班起飞前至少6小时下单，我们的配送员将上门收取行李，并在航班起飞前1.5小时将您的行李运送至机场，以便您领取。</div>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
		<!--End-gallery-->
		<!--start-consulation-->
		<div id="con" class="consulation">
			<div class="container">
				<div class="head title">
					<?php echo Lang::get('text.user_instructions')?>
				</div>
				<div class="consulation-grids">
					<div class='row'>
						<!--[if lt IE 8]>
						<div class="col-md-12 consulation-left col-ie7" style='border-right:0px;'>
						<![endif]--> 
						<!--[if gt IE 7]>
						<div class="col-md-6 consulation-left">
						<![endif]--> 
						<!--[if !IE]><!-->
						<div class="col-md-6 consulation-left ">
						<!--><![endif]--> 

								<div class='text-center m-b-10'><img class='img-responsive' src="<?php echo asset('assets/img/home/1.jpg')?>" style='height:300px'></div>
								<h4>悦行网行李运送注意事项：</h4>
								<p><strong>1. </strong>上午8点前到达的航班，如无特殊要求，订单将在当天中午开始运送，如目的地为酒店，行李将送至酒店前台；如目的地为商业大厦或住宅小区，行李均送至正门。若联系不上您，交付将被延后。</p>
								<p><strong>2. </strong>晚上6点后到达的航班，如无特殊要求，订单将在隔天上午时开始运送。如目的地为酒店，行李将送至酒店前台；如目的地为商业大厦或住宅小区，行李均送至正门。若联系不上您，交付将被延后。</p>
							
						</div>
						<!--[if lt IE 8]>
						<div class="col-md-12 consulation-right col-ie7">
						<![endif]--> 
						<!--[if gt IE 7]>
						<div class="col-md-6 consulation-right">
						<![endif]--> 
						<!--[if !IE]><!-->
						<div class="col-md-6 consulation-right ">
						<!--><![endif]--> 
						
							
								<div class='text-center m-b-10'><img class='img-responsive' src="<?php echo asset('assets/img/home/2.jpg')?>" style='height:300px'></div>
								<h4>优质的服务</h4>
								<p>选择悦行网，请放心把您的行李交给我们，如果您有问题或需要帮助，欢迎拨打客服热线4000-XXX-XXX联系我们！</p>
								<p>悦行网将竭诚为您服务。进入新手指南或者常见问题版面去了解更多！</p>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--//End-consulation-->
		<!--start-testmonials-->
		<div id="test" class="testmonials">
			<div class="container">
				<div class="head ">
					<div class='pull-right' style="margin-top:10px;margin-right:20px">
						<a href="<?php echo asset('news/faq')?>"><?php echo Lang::get('text.more');?></a>
					</div>
					<div class='title'><?php echo Lang::get('text.FAQ')?></div>
				</div>
				<!--start-testmonials-grids-->
				<div class="testmonials-grids text-left">
					<ul class="list-group">
						<?php if(!empty($faq_list)):?>
						<?php foreach ($faq_list as $key => $value):?>
					  		<li class="list-group-item">
					  			<a href='<?php echo asset('news/view/'.$value->id);?>' target='_blank'>
					  				<?php echo stripslashes($value->title)?>
					  			</a>
					  		</li>
					  	<?php endforeach;?>
					  	<?php endif;?>
					</ul>

				</div>
				<!--//End-testmonials-grids-->
			</div>
		</div>
		<!--//End-testmonials-->
		<!--start-contact-->
		<div id="contact" class="contact">
			<div class="container">
				<div class="head ">
					<div class='pull-right' style="margin-top:10px;margin-right:20px">
						<a href="<?php echo asset('news')?>"><?php echo Lang::get('text.more');?></a>
					</div>
					<div class='title'><?php echo Lang::get('text.news')?></div>
				</div>
				<div class="contact-grids">
					<ul class="list-group">
						<?php if(!empty($news_list)):?>
						<?php foreach ($news_list as $key => $value):?>
					  		<li class="list-group-item">
					  			<a href='<?php echo asset('news/view/'.$value->id);?>' target='_blank'>
					  				<?php echo stripslashes($value->title)?>
					  			</a>
					  		</li>
					  	<?php endforeach;?>
					  	<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
		<!--//End-contact-->
		<!--start-footer-->
		<div class="footer text-center">
			<div class="container">
				<a href="#" class='logo'> 
					<img src="<?php echo file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'logo.png') ? asset('uploads/logo.png') : asset('assets/img/logo.png')?>" class='logoPic' >
				</a>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
			</div>
		</div>
		<div style="background-color:#313030; padding:20px; font-size:14px;">
			<div class="container">
				<div class="row">
		            <div class="col-md-12 col-sm-12 pre-footer-col text-center" style='color:#FFFFFF;'>
		                <ul class="list-inline" >
		                    <li><a href="<?php echo asset('about')?>" style='color:#FFFFFF;'><?php echo Lang::get('text.aboutus')?></a></li>
		                    <li> | </li>
		                    <li><a href="<?php echo asset('about/contact')?>" style='color:#FFFFFF;'><?php echo Lang::get('text.contact_us')?></a></li>
		                    <li> | </li>
		                    <li><a href="<?php echo asset('job')?>" style='color:#FFFFFF;'><?php echo Lang::get('text.joinus')?></a></li>
		                    <li> | </li>
		                    <a href="<?php echo asset('news/grude')?>" style='color:#FFFFFF;'><?php echo News::category(1)?></a>
		                    <li> | </li>
		                    <a href="<?php echo asset('news/faq')?>" style='color:#FFFFFF;'><?php echo News::category(2)?></a>
		                </ul>
		            </div>
					<div class="col-md-12 col-sm-12 pre-footer-col text-center" style='color:#FFFFFF;'>
						<?php echo Cache::get('copyright')?> &nbsp; &nbsp; <a href="http://www.miitbeian.gov.cn" style='color:#FFFFFF;' target='_blank'><?php echo Cache::get('icp');?></a>
					</div>
				</div>
			</div>
		</div>
				<script type="text/javascript">
				$(document).ready(function() {	
					$().UItoTop({ easingType: 'easeOutQuart' });
					function adjust(){ 
					   	var w  = document.body.clientWidth;
					   	var h = parseInt(w)*750/1332;
					   	document.getElementById('header').style.height = (h>750 ? 750 : h) +'px';
					   	if(w < 970)
					   	{
					   		var p = w*40/1170;
					   		var f = w*18/1170;
					   		if(f<12)
					   		{
					   			f=12;
					   		}
					   		$('#header').find('.top-nav').find('a').css({'padding-left':p+'px','padding-right':p+'px','font-size':f+'px'});
					   	}
					   	else
					   	{
					   		$('#header').find('.top-nav').find('a').css({'padding-left':'30px','padding-right':'30px','font-size':'18px'});
					   	}
					}
					window.onload=function(){   
					  	adjust();  
					} 
					window.onresize = function(){   
					  	adjust();  
					}
					$('.form_datetime').datetimepicker({
				        <?php if(App::getLocale()=='zh'):?>language:  'zh-CN',<?php endif;?>
				        weekStart: 1,
				        todayBtn:  1,
						autoclose: 1,
						todayHighlight: 1,
						startView: 2,
						forceParse: 0,
				        showMeridian: 1
				    });
				});
				</script>
		<!----//End-footer---->
		<!-----//End-container---->

</body>
</html>