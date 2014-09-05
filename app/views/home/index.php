<!DOCTYPE HTML>
<html>
	<head>
		<title>Home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo HTML::style('assets/plugins/bootstrap/css/bootstrap.css');?>
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
   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> 
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
		</script>
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
	</head>
	<body>
		<!--start-container-->
		<div class="bg">
			<div class="container">
				<div class='header' id='header'>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4 contact-no">
							400-0000-000
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4 logo">
							<a href="#"><img src="<?php echo asset('assets/img/logo-l.png')?>" ></a>
						</div>
						<div class="contact-order col-md-4 col-sm-4 col-xs-4 text-right">
							<?php if(Auth::guest()):?>
							<a href="<?php echo asset('login')?>">登录</a> | <a href="<?php echo asset('register')?>">注册</a>
							<?php else:?>
							Welcome，<?php echo Auth::user()->name;?> | <a href="<?php echo asset('login/out')?>"><?php echo Lang::get('text.exit')?></a>
							<?php endif;?>
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
					<div class="col-md-6 about-left">
						<p><strong>悦行网</strong>，为旅客提供行李托运服务。</p>
						<p>我们按照旅客的要求，将行李在指定的时间从始发地托运至机场或从机场到目的地。</p>
						<p>我们与各机场、酒店、度假村及旅游胜地保持着良好的合作关系。</p>
						<p>在上海，我们实现浦东、虹桥机场与市内任何地点间的轻松对接。为您的出行提供完整的行李托运解决方案，让繁重的行李不再成为旅途的负担。</p>
						<p>旅途有我，更轻松！</p>
						<p>目前，悦行网服务已经覆盖整个上海，更多城市陆续开启......</p>
					</div>
					<div class="col-md-6 about-right">
						<div class="panel panel-primary">
					      	<div class="panel-heading">快速预订</div>
					      	<div class="panel-body">
								<form class="form-horizontal" role="form" method='get' action="<?php echo asset('order')?>">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-3 control-label">托运城市</label>
										<div class="col-md-9">
			                                <select name="city_id" id="city_id" class="form-control">
			                                    <option><?php echo Lang::get('text.please_choose');?></option>
			                                    <?php foreach($allCity as $key => $v):?>
			                                    <option value="<?php echo $v->id?>"><?php echo $v->name;?></option>
			                                    <?endforeach;?>
			                                </select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-md-3 control-label">托运类型</label>
										<div class="col-md-9">
			                                <select name="type" id="type" class="form-control">
			                                    <?php foreach($allType as $key => $v):?>
			                                    <option value="<?php echo $key?>"><?php echo $v;?></option>
			                                    <?endforeach;?>
			                                </select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-md-3 control-label">托运日期</label>
										<div class="col-md-9">
											<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-primary">开始预订</button>
										</div>
									</div>
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
					托运流程
				</div>
				<div class="gallery-grids">
					<div class="gallery-grids-row1">
						<div class="col-md-8 gallery-grid1 text-center">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="<?php echo asset('assets/img/home/liucheng.jpg')?>" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<button>开始预订</button>
									</h2>
								</div>
							</a>
						</div>
						<div class='col-md-4 gallery-right'>
							<div class='m-b-10'>
								<div class='pull-left'>1.</div>
								<div class='content'>点击“开始预订”，填写您的托运信息或者通过电话向我们的客服人员下订单。</div>
							</div>
							<div class='m-b-10'>
								<div class='pull-left'>2.</div>
								<div class='content'>如果您的行李是要从机场运至目的地，航班落地后，我们的工作人员将第一时间与您联系，我们将到达机场大厅接收您的行李，填写托运单。</div>
							</div>
							<div class='m-b-10'>
								<div class='pull-left'>3.</div>
								<div class='content'>如果您的行李是要从酒店、公司或者住宅等运至机场，请在您的航班起飞前尽可能早的跟我们联系托运（提前5小时），我们将在航班起飞前1.5小时将您的行李运至机场，您领取行李。</div>
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
						<div class="col-md-6 consulation-left">
							<div class='text-center m-b-10'><img src="<?php echo asset('assets/img/home/1.jpg')?>" height='200'></div>
							<h4>一些关于托运的重要信息</h4>
							<p><strong>托运至酒店：</strong>上午8点前到达的航班，我们将在中午运送行李至酒店前台，请告知您下榻的酒店。</p>
							<p><strong>托运至住宅：</strong>上午8点前或晚上11点后抵达的航班，订单将在中午时开始运送。如果您选择签名接收，我们将在您电话通知交付时间后开始托运并交付，若联系不上您，交付将被延后。</p>
							<p><strong>商务托运：</strong>上午8点或晚上11点后抵达的航班，订单将在中午托运。如果可以，请在下订单时，填写清楚您的企业名称、交付时间、联系人电话和其他特殊要求。</p>
						</div>
						<div class="col-md-6 consulation-right">
							<div class='text-center m-b-10'><img src="<?php echo asset('assets/img/home/2.jpg')?>" height='200'></div>
							<h4>优质的服务</h4>
							<p>当您选择我们之后，请放心您的行李，如果您有问题或需要帮助,您可以随时联系我们，行李网将竭诚为您服务。</p>
							<p>进入我们的常见问题版面去了解一些常见的问题和解决方法。</p>
							<p>有任何疑问，欢迎通过客服电话4000-000-000联系我们！</p>
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
					  				<?php echo $value->title?>
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
					  				<?php echo $value->title?>
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
				<a href="#" class='logo'> LOGO </a>
				<p class="copy-right">Copyright &copy; 2014.Company name All rights reserved.</p>
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
					   		$('#header').find('.top-nav').find('a').css({'padding-left':'40px','padding-right':'40px','font-size':'18px'});
					   	}
					}
					window.onload=function(){   
					  	adjust();  
					} 
					window.onresize = function(){   
					  	adjust();  
					}  
				});
			</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
			</div>
		</div>
		<!----//End-footer---->
		<!-----//End-container---->

</body>
</html>