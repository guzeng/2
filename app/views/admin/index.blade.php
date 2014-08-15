@extends('admin.layout')

@section('content')
	<!-- BEGIN PAGE -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					<?php echo Lang::get('text.dashboard')?>
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<?php echo Lang::get('text.dashboard')?> 
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!--[if lt IE 9]>
		<div class="row">
			<div class="col-md-12">
				<div class="note note-danger p-r-15">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
					<h4 class="block"><?php echo Lang::get('msg.brower_tips')?></h4>
					<div class='text-center' >
                        <ul class="nav nav-pills">
                            <li><a href="http://windows.microsoft.com/zh-cn/internet-explorer/download-ie" target='_blank'><img src='<?php echo asset("assets/img/brower/ie.png")?>' height='100px'></a></li>
                            <li><a href="http://www.firefox.com.cn/download" target='_blank'><img src='<?php echo asset("assets/img/brower/firefox.png")?>' height='100px'></a></li>
                            <li><a href="http://www.google.cn/intl/zh-CN/chrome/browser" target='_blank'><img src='<?php echo asset("assets/img/brower/chrome.png")?>' height='100px'></a></li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
		<![endif]-->

		<!-- BEGIN DASHBOARD STATS -->
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="more" href="<?php echo asset('admin/user');?>">
					<div class="dashboard-stat green zoom p-20">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $user_count;?></div>
							<div class="desc"><?php echo Lang::get('text.users');?></div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="more" href="<?php echo asset('admin/order');?>">
					<div class="dashboard-stat purple zoom p-20">
						<div class="visual">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $order_count;?></div>
							<div class="desc"><?php echo Lang::get('text.exams');?></div>
						</div>
					</div>
				</a>                 
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="more" href="<?php echo asset('admin/news');?>">
					<div class="dashboard-stat yellow zoom p-20">
						<div class="visual">
							<i class="fa fa-bullhorn"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $news_count;?></div>
							<div class="desc"><?php echo Lang::get('text.system_notice');?></div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<!-- END DASHBOARD STATS -->
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet solid bordered light-grey">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-bar-chart-o"></i><?php echo Lang::get('text.system_use_info');?></div>
						
					</div>
					<div class="portlet-body">
						<div id="site_statistics_loading">
							<img src="<?php echo asset('assets/img/loading.gif')?>" alt="loading"/>
						</div>
						<div id="site_statistics_content" class="display-none">
							<div id="site_statistics" class="chart"></div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div>
	</div>
	<!-- END PAGE -->
@stop
@section('script')
	<script type="text/javascript">
		msg.login_count = "<?php echo Lang::get('text.login_amount')?>";
		msg.avi_time = "<?php echo Lang::get('text.avi_user_per_time')?>";
		var visitors = [];
		var x_date = [];
		var date = [];
		var avi_time = [];
		var i = 1;
		<?if(!empty($days)):?>
		<?php $i=1;?>
		<?foreach($days as $key => $value):?>
            visitors.push([<?php echo $i;?>,parseInt("<?php echo $value['visitors']?>")]);
            avi_time.push([<?php echo $i;?>,parseInt("<?php echo $value['visitors']>0 ? round($value['avi_time']/$value['visitors'],1) : 0?>")]);
            date.push([<?php echo $i;?>,"<?php echo date('d/m/Y',strtotime($key))?>"]);

            <?if($i==1):?>
            	x_date.push([<?php echo $i;?>,"<?php echo date('d/m/Y',strtotime($key))?>"]);
            <?elseif(($i+1)%2==0):?>
            	x_date.push([<?php echo $i;?>,"<?php echo date('d/m',strtotime($key))?>"]);
            <?else:?>
            	x_date.push([<?php echo $i;?>,""]);
            <?endif;?>
            <?php $i++;?>
        <?endforeach;?>
        <?endif;?>
	</script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo asset('assets/plugins/flot/jquery.flot.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/flot/jquery.flot.resize.js');?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="<?php echo asset('assets/scripts/index.js');?>" type="text/javascript"></script>      
    <script>
        jQuery(document).ready(function() {
           Index.initCharts(); // init index page's custom scripts
        });
    </script>
@stop