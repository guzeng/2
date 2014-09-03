@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo Lang::get('text.add_job');?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.aboutus');?>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li><?php echo Lang::get('text.joinus');?></li>
                    <li class='btn-group'>
                        <button class='btn btn-link' type='button' onclick="goback()"><i class='fa fa-reply'></i> <?php echo Lang::get('text.back')?></button>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- BEGIN FORM-->
        <form class="form-horizontal" id="news_update" method="post" action="<?php echo asset('admin/job/update');?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.position');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" maxLength='50' name="title" id="title" value="<?php echo isset($item) ? stripslashes($item->title) : '';?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.require_number');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" maxLength='11' name="number" id="number" value="<?php echo isset($item) ? stripslashes($item->number) : '';?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::get('text.location');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" maxLength='30' name="location" id="location" value="<?php echo isset($item) ? stripslashes($item->location) : '';?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::get('text.department');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" maxLength='30' name="department" id="department" value="<?php echo isset($item) ? stripslashes($item->department) : '';?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::get('text.deadline');?></label>
                            <div id="datetimepicker" class="col-md-6 col-sm-9 col-xs-12 input-group">
                                <input type="text" class="form-control" maxLength='10' name="date" id="deadline" value="<?php echo isset($item) ? date('Y-m-d',gmt_to_local($item->date)) : '';?>">
                                <div class="input-group-addon"><i class='fa fa-calendar'></i></div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::get('text.job_desc');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <textarea id="desc" style="visibility:hidden;"><?=isset($item)?htmlspecialchars($item->description):'' ?></textarea>
                                <textarea id="description" name="description" style="display:none;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::get('text.job_require');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <textarea id="requ" style="visibility:hidden;"><?=isset($item)?htmlspecialchars($item->requirement):'' ?></textarea>
                                <textarea id="requirement" name="requirement" style="display:none;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-9 col-xs-12 checkbox-list">
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
        </form>
        <!-- END FORM-->
    </div>
@stop

@section('script')



    <script src="<?php echo asset('assets/plugins/jquery.form.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/jquery-validation/jquery.validate.js');?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/plugins/jquery-validation/messages_'.App::getLocale().'.js');?>" type="text/javascript"></script>

    <link rel="stylesheet" href="<?php echo asset('assets/plugins/kindeditor-4.1.7/themes/default/default.css')?>" />
    <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/kindeditor-min.js');?>" type="text/javascript"></script>
    <?php if(App::getLocale()=='zh'):?>
        <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/lang/zh_CN.js');?>" type="text/javascript"></script>
    <?php else:?>
        <script src="<?php echo asset('assets/plugins/kindeditor-4.1.7/lang/en.js');?>" type="text/javascript"></script>
    <?php endif;?>

    <link rel="stylesheet" type="text/css" media="all" href="<?php echo asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')?>"/>
    <script type="text/javascript" src="<?php echo asset('assets/plugins/daterangepicker/moment.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
    
    <script src="<?php echo asset('assets/scripts/admin/job.js');?>" type="text/javascript"></script>
@stop