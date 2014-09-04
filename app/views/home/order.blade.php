@extends('home.layout')

@section('content')
<div class='container m-t-50 m-b-50'  id="form_wizard_1">
    <form action="#" class="form-horizontal" id="submit_form">
        <div class="form-wizard">
            <div class="form-body">
                <ul class="nav nav-pills nav-justified steps">
                    <li>
                        <a href="#tab1" data-toggle="tab" class="step">
                        <span class="number">1</span>
                        <span class="desc"><i class="fa fa-check"></i> 基本信息</span>   
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" class="step">
                        <span class="number">2</span>
                        <span class="desc"><i class="fa fa-check"></i> 路线</span>   
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab" class="step">
                        <span class="number">3</span>
                        <span class="desc"><i class="fa fa-check"></i> 确认提交</span>   
                        </a> 
                    </li>
                </ul>
                <div id="bar" class="progress progress-striped" role="progressbar">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <div class="tab-content">
                    <div class="alert alert-danger display-none">
                        <button class="close" data-dismiss="alert"></button>
                        You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-none">
                        <button class="close" data-dismiss="alert"></button>
                        Your form validation is successful!
                    </div>
                    <div class="tab-pane active" id="tab1">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.flight_num')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="flight_num" id='flight_num'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_type')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="type" id="type" class="form-control">
                                    <?php foreach($allType as $key => $v):?>
                                    <option <?if(isset($type) && $type==$key):?>selected<?endif;?> value="<?php echo $key?>"><?php echo $v;?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_time')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="stime" name='stime' readonly class="form-control form_datetime" CustomFormat="yyyy-MM-dd - HH:mm" data-link-field="time" Format="Custom" value="<?php echo isset($stime)?$stime:'';?>" >
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_city')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value='0'><?php echo Lang::get('text.please_choose');?></option>
                                    <?php foreach($allCity as $key => $v):?>
                                    <option <?if(isset($city_id) && $city_id==$v->id):?>selected<?endif;?> value="<?php echo $v->id?>"><?php echo $v->name;?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.address')?><span class="required">*</span></label>
                            <div class='col-md-4'>
                                <input type="text" class="form-control" name="address" id='address'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.airport')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="airport_id" id="airport_id" class="form-control">
                                    <?php foreach($allAirport as $key => $v):?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->name;?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.normal_luggage_num')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="normal_luggage_num" id='normal_luggage_num'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.special_luggage_num')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="special_luggage_num" id='special_luggage_num'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shipper')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="shipper" id='shipper'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shiper_gender')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios25">
                                            <span class="checked"><input type="radio" checked="checked" value="option1" id="optionsRadios25" name="gender"></span>
                                        </div> <?php echo Lang::get('text.male')?>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios26">
                                            <span><input type="radio"  value="option2" id="optionsRadios26" name="gender"></span>
                                        </div> <?php echo Lang::get('text.female')?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.mobile')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id='phone'/>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="m-b-20">
                            <strong>共<span id='order_distance'></span>公里，共计<span id='order_money'></span></strong>
                        </div>
                        <div class='row'>
                            <div class='col-md-9'>
                                <div id="l-map"></div>
                            </div>
                            <div class='col-md-3'>
                                <div  id="r-result" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <h3 class="block">Confirm your account</h3>
                        <h4 class="form-section">Account</h4>
                        <div class="form-group">
                            <label class="control-label col-md-3">Username:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="username"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="email"></p>
                            </div>
                        </div>
                        <h4 class="form-section">Profile</h4>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fullname:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="fullname"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gender:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="gender"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="phone"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="address"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">City/Town:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="city"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Country:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="country"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="remarks"></p>
                            </div>
                        </div>
                        <h4 class="form-section">Billing</h4>
                        <div class="form-group">
                            <label class="control-label col-md-3">Card Holder Name:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="card_name"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Card Number:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="card_number"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">CVC:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="card_cvc"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Expiration:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="card_expiry_date"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Payment Options:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="payment"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="javascript:;" class="btn default button-previous">
                            <i class="m-icon-swapleft"></i> Back 
                            </a>
                            <a href="javascript:;" class="btn blue button-next">
                            Continue <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                            <a href="javascript:;" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                            </a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
        <input type='hidden' name='distance' id='distance' value=''>
        <input type="hidden" name="time" id='time' value="<?php echo $time;?>" />
    </form>
</div>
@stop
@section('script')
    <?php echo HTML::style('assets/plugins/uniform/css/uniform.default.css');?>
    <?php echo HTML::style('assets/css/plugins.css');?>
    <?php echo HTML::style('assets/css/style-metronic.css');?>
    <?php echo HTML::style('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css');?>
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script('assets/plugins/jquery-validation/jquery.validate.js');?>
    <?php echo HTML::script('assets/plugins/jquery-validation/additional-methods.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery-validation/messages_'.App::getLocale().'.js');?>
    <?php echo HTML::script('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js');?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script('assets/plugins/select2/select2.min.js');?>
    <?php echo HTML::script('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>
    <?php if(App::getLocale()=='zh'):?>
    <?php echo HTML::script('assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js');?>
    <?php endif;?>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=neYBiVeGaumZAuQT31SRk0RU"></script>
    <?php echo HTML::script('assets/scripts/app.js');?>
    <?php echo HTML::script('assets/scripts/form-wizard.js');?>

    <?php echo HTML::script('assets/scripts/map.js');?>

    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           //App.init();
            FormWizard.init();
            $('.form_datetime').datetimepicker({
                <?php if(App::getLocale()=='zh'):?>language:  'zh-CN',<?php endif;?>
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
        });
// 百度地图API功能
//var map = new BMap.Map("l-map");            // 创建Map实例
//map.centerAndZoom("珠海", 13); //new BMap.Point(116.404, 39.915)
    </script>
    <!-- END JAVASCRIPTS -->   
    <script type="text/javascript">
        msg.validate_again = "<?php echo Lang::get('text.valiate_again')?>";
        msg.incorrect_mobile = "<?php echo Lang::get('validation.mobile')?>";
    </script>
@stop