@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo News::category(isset($item)?$item->category_id:$cid);?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.user_grude');?>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li><?php echo News::category(isset($item)?$item->category_id:$cid);?></li>
                    <li class='btn-group'>
                        <button class='btn btn-link' type='button' onclick="goback()"><i class='fa fa-reply'></i> <?php echo Lang::get('text.back')?></button>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- BEGIN FORM-->
        <form class="form-horizontal" id="news_update" method="post" action="<?php echo asset('admin/news/update');?>">
            <div class='row'>
                <!-- chinese version start -->
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->   
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i> <?php echo Lang::get('text.zh')?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href=""></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.title');?></label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" maxLength='100' name="title" id="title" value="<?php echo isset($item) ? stripslashes($item->title) : '';?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo Lang::get('text.content');?></label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <textarea id="con" style="visibility:hidden;"><?=isset($item)?$item->content:'' ?></textarea>
                                        <textarea id="content" name="content" style="display:none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- chinese version end -->
                <!-- english version start -->
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->   
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i> <?php echo Lang::get('text.en')?>
                            </div>
                            <div class="tools">
                                <a class="collapse" href=""></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.title');?></label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" maxLength='200' name="title_en" id="title_en" value="<?php echo isset($item) ? stripslashes($item->title_en) : '';?>">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo Lang::get('text.content');?></label>
                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                        <textarea id="con_en" style="visibility:hidden;"><?=isset($item)?$item->content_en:'' ?></textarea>
                                        <textarea id="content_en" name="content_en" style="display:none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- english version end -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9 col-sm-9  col-sm-offset-3 col-xs-12 checkbox-list">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="status" value="1" <?php if(!isset($item->status) || (isset($item->status) && $item->status==1)):?>checked='checked'<?php endif;?> >
                                    <?php echo Lang::get('text.enable');?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9 col-sm-9  col-sm-offset-3 col-xs-12">
                            <button class="btn btn-lg green" type="button" id="news_edit_btn"><?php echo Lang::get('text.submit');?></button>&nbsp;
                            <button class="btn btn-lg default" type="button" onclick="goback();"><?php echo Lang::get('text.cancel');?></button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo isset($item)?$item->id:'';?>">
            <input type="hidden" name="cid" value="<?php echo isset($item)?$item->category_id:$cid;?>">
        </form>
        <!-- END FORM-->
    </div>
@stop

@section('script')



    <script src="<?php echo asset('assets/plugins/jquery.form.js');?>" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/kindeditor-4.1.7/themes/default/default.css')?>" />
    <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/kindeditor-min.js');?>" type="text/javascript"></script>
    <?php if(App::getLocale()=='zh'):?>
        <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/lang/zh_CN.js');?>" type="text/javascript"></script>
    <?php else:?>
        <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/lang/en.js');?>" type="text/javascript"></script>
    <?php endif;?>

    <script src="<?php echo asset('assets/scripts/admin/news.js');?>" type="text/javascript"></script>
@stop