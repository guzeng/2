@extends('home.layout')

@section('content')
<div class="main">
    <div class="container m-h-500">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo asset('')?>">
                    <?php echo Lang::get('text.homepage')?>
                </a>
            </li>
            <li>
                <?php if($cat == 'about'):?>
                    <a href="<?php echo asset('about')?>">
                        <?php echo Lang::get('text.aboutus')?>
                    </a>
                <?php elseif($cat == 'contact'):?>
                    <a href="<?php echo asset('about/contact')?>">
                        <?php echo Lang::get('text.contact_us')?>
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
                    <div><?php echo App::getLocale()=='zh' ? $item->value : $item->value_en?></div>
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
