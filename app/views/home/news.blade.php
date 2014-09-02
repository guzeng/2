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
                    <?php if(!empty($news_list)){foreach($news_list as $item):?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h2><a target="_blank" href="<?php echo asset('news/view/'.$item->id)?>"><?php echo $item->title?></a></h2>
                            <ul class="blog-info">
                                <li><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',gmt_to_local($item->open_time))?></li>
                            </ul>
                            <div><?php echo htmlspecialchars(utf8_strcut(strip_tags($item->content),200))?></div>
                            <a class="more" target="_blank" href="<?php echo asset('news/view/'.$item->id)?>"><?php echo Lang::get('text.more')?> <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <hr class="blog-post-sep">
                    <?php endforeach;}?>
                    <!-- paginition start -->
                    <div class="margin-bottom-0">
                        <?php echo isset($news_list)?$news_list->links():'';?>
                    </div>
                    <!-- paginition end -->            
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
