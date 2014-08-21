@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo Lang::get('text.add_airport');?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.system_manage');?>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li><?php echo Lang::get('text.add_airport');?></li>
                    <li class='btn-group'>
                        <button class='btn btn-link' type='button' onclick="goback()"><i class='fa fa-reply'></i> <?php echo Lang::get('text.back')?></button>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- BEGIN FORM-->
        <form class="form-horizontal" id="airport_update" method="post" action="<?php echo asset('admin/airport/update');?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.name');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" maxLength='30' name="name" id="name" value="<?php echo isset($item) ? stripslashes($item->name) : '';?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="re">* </span><?php echo Lang::get('text.city');?></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control" name='city_id'>
                                    <option value='0'><?php echo Lang::get('text.please_choose');?></option>
                                    <?php if(!empty($citys)){foreach($citys as $key => $c){?>
                                    <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
                                    <?php }}?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9 col-sm-9  col-sm-offset-3 col-xs-12">
                            <button class="btn btn-lg green" type="button" id="airport_edit_btn" onclick="doSubmit('airport_update','airport_edit_btn')"><?php echo Lang::get('text.submit');?></button>&nbsp;
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
    
    <script src="<?php echo asset('assets/scripts/admin/airport.js');?>" type="text/javascript"></script>
@stop