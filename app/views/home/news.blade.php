@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo asset('')?>">
                    <?php echo Lang::get('text.homepage')?>
                </a>
            </li>
            <li>
                <?php $c=''; if($category):?>
                <?php switch ($category) {
                    case '1':
                        $c='grude';
                        break;
                    case '2':
                        $c='faq';
                        break;
                    case '3':
                        $c='index';
                        break;
                }?>
                <a href="<?php echo asset('news/'.$c)?>">
                    <?php echo News::category($category);?>
                </a>
                <?php endif;?>
            </li>
        </ul>
        <div class='clearfix'></div>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12 col-ie7">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts col-ie7">
                    <?php if(!empty($news_list)){foreach($news_list as $item):?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h3><a target="_blank" href="<?php echo asset('news/view/'.$item->id)?>"><?php echo stripslashes($item->title)?></a></h3>
                            <ul class="blog-info">
                                <li><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',gmt_to_local($item->open_time))?></li>
                            </ul>
                            <div><?php echo trim(htmlspecialchars(utf8_strcut(strip_tags($item->content),200)))?></div>
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
                <div class="col-md-3 col-sm-3 blog-sidebar col-ie7">
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
