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
                <a href="<?php echo asset('job')?>">
                    <?php echo Lang::get('text.joinus')?>
                </a>
            </li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12 col-ie7">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts col-ie7">
                    <?php if(!empty($job_list)){foreach($job_list as $item):?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h3><a target="_blank" href="<?php echo asset('job/view/'.$item->id)?>"><?php echo stripslashes($item->title)?></a></h3>
                            <ul class="blog-info">
                                <li><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',gmt_to_local($item->create_time))?></li>
                            </ul>
                            <div class='m-b-10'>
                                <?php echo Lang::get('text.require_number')?> : <?php echo $item->number?>
                                <?php if($item->location):?>&nbsp; / &nbsp; <?php echo Lang::get('text.location')?> : <?php echo $item->location;?> &nbsp;<?php endif;?>
                                <?php if($item->department):?>&nbsp; / &nbsp; <?php echo Lang::get('text.department')?> : <?php echo $item->department;?> &nbsp;<?php endif;?>
                                <?php if($item->date > 0):?>&nbsp; / &nbsp; <?php echo Lang::get('text.deadline')?> : <?php echo date('d/m/Y',$item->date);?><?php endif;?>
                            </div>
                            <div ><?php echo htmlspecialchars(utf8_strcut(strip_tags($item->requirement),180))?>...</div>
                            <a class="more" target="_blank" href="<?php echo asset('job/view/'.$item->id)?>"><?php echo Lang::get('text.more')?> <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <hr class="blog-post-sep">
                    <?php endforeach;}?>
                    <!-- paginition start -->
                    <div class="margin-bottom-0">
                        <?php echo isset($job_list)?$job_list->links():'';?>
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
