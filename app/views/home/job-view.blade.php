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
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts">
                    <h3 class='m-b-20'><?php echo stripslashes($job->title);?></h3>
                    <div class='m-b-20'>
                        <div class='row m-b-10'>
                            <div class='col-md-6'>
                                <strong><?php echo Lang::get('text.require_number')?></strong> : <?php echo $job->number?>
                            </div>
                            <div class='col-md-6'>
                                <strong><?php echo Lang::get('text.location')?></strong> : <?php echo $job->location;?>
                            </div>
                        </div>
                        <div class='row m-b-10'>
                            <div class='col-md-6'>
                                <strong><?php echo Lang::get('text.department')?></strong> : <?php echo $job->department;?>
                            </div>
                            <div class='col-md-6'>
                                <strong><?php echo Lang::get('text.deadline')?></strong> : <?php echo date('d/m/Y',$job->date);?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class='m-b-10'><strong><?php echo Lang::get('text.job_desc')?></strong></div>
                        <div class='m-b-20'><?php echo $job->description?></div>
                        <div class='m-b-10'><strong><?php echo Lang::get('text.job_require')?></strong></div>
                        <div><?php echo $job->requirement?></div>
                    </div>
                    <ul class="blog-info">
                        <li><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',gmt_to_local($job->create_time))?></li>
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
