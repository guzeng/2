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
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts">
                    <h3><?php echo App::getLocale()=='zh'?stripslashes($news->title):stripslashes($news->title_en);?></h3>
                    <div><?php echo App::getLocale()=='zh'?$news->content:$news->content_en; ?></div><!--htmlspecialchars(-->
                    <ul class="blog-info">
                        <li><i class="fa fa-user"></i><?php echo $news->view?></li>
                        <li><i class="fa fa-calendar"></i> <?php echo $news->open_time>0 ? date('d/m/Y',gmt_to_local($news->open_time)) : date('d/m/Y',gmt_to_local($news->create_time))?></li>
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
