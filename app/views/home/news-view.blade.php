@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Blog</a></li>
            <li class="active">Blog Page</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts">
                    <h2><?php echo $news->title;?></h2>
                    <div><?php echo $news->content?></div><!--htmlspecialchars(-->
                    <ul class="blog-info">
                        <li><i class="fa fa-user"></i><?php echo $news->view?></li>
                        <li><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',gmt_to_local($news->open_time))?></li>
                    </ul>
                </div>
                <!-- END LEFT SIDEBAR -->

                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-3 col-sm-3 blog-sidebar">
                    <?php echo $right?>
                </div>
                <!-- END RIGHT SIDEBAR -->            
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@stop
