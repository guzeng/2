@extends('home.layout')

@section('content')
<div class='container m-t-50 m-b-50'  id="form_wizard_1">
    <form action="<?php echo asset('order/update')?>" method='post' class="form-horizontal" id="order_form">
        <div class="form-wizard">
            <div class="form-body">
                <ul class="nav nav-pills nav-justified steps">
                    <li>
                        <a href="#tab1" data-toggle="tab" class="step">
                        <span class="number">1</span>
                        <span class="desc"><i class="fa fa-check"></i> <?php echo Lang::get('text.basic_info')?></span>   
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" class="step">
                        <span class="number">2</span>
                        <span class="desc"><i class="fa fa-check"></i> <?php echo Lang::get('text.mileage')?></span>   
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab" class="step">
                        <span class="number">3</span>
                        <span class="desc"><i class="fa fa-check"></i> <?php echo Lang::get('text.confirm')?></span>   
                        </a> 
                    </li>
                </ul>
                <div id="bar" class="progress progress-striped" role="progressbar" style="height:2px;">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <div class="tab-content">
                    <div class="alert alert-danger display-none">
                        <button class="close" data-dismiss="alert"></button>
                        <?php echo Lang::get('msg.submit_error');?>
                    </div>
                    <div class="alert alert-success display-none">
                        <!--
                        <button class="close" data-dismiss="alert"></button>
                        Your form validation is successful!
                        -->
                    </div>
                    <div class="tab-pane active" id="tab1">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.flight_num')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" maxLength='6' name="flight_num" id='flight_num'/>
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
                                <input type="text" id="time" name='time' readonly class="form-control form_datetime" CustomFormat="yyyy-MM-dd - HH:mm" data-link-field="time" Format="Custom" value="<?php echo isset($stime)?$stime:'';?>" >
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
                            <?php if(Auth::check()):?>
                            <div class='col-md-5 m-t-5'>
                                <a href="#using_address" data-toggle="modal" class="link">
                                    <?php echo Lang::get('text.from_address');?>
                                </a>
                            </div>
                            <?php endif;?>
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
                            <div class='col-md-5 text-warning'>
                                <?php echo Lang::get('text.price_tips_1');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.special_luggage_num')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="special_luggage_num" id='special_luggage_num'/>
                            </div>
                            <div class='col-md-5 m-t-5 text-warning'>
                                <?php echo Lang::get('text.price_tips_2');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shipper')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="shipper" id='shipper' value="<?php echo Auth::check() ? Auth::user()->name : ''?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shiper_gender')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" data-title="<?php echo Lang::get('text.male')?>" <?php if(Auth::guest() || (Auth::check() && Auth::user()->gender=='male')):?>checked='checked'<?php endif;?> value="male" name="gender" style='margin-left:0px;'> &nbsp;
                                        <?php echo Lang::get('text.male')?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" data-title="<?php echo Lang::get('text.female')?>" <?php if(Auth::check() && Auth::user()->gender=='female'):?>checked='checked'<?endif;?> value="famale" name="gender" style='margin-left:0px;'> &nbsp;
                                        <?php echo Lang::get('text.female')?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.mobile')?><span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id='phone' value="<?php echo Auth::check() ? Auth::user()->username : ''?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="m-b-20">
                            <strong>共<span id='order_distance'></span>公里，共计<span id='order_money'></span>元</strong>
                        </div>
                        <div class='row m-b-30'>
                            <div class='col-md-9'>
                                <div id="l-map"></div>
                            </div>
                            <div class='col-md-3'>
                                <div  id="r-result" ></div>
                            </div>
                        </div>
                        <div class='row'>
                                <label class="control-label col-md-2"><?php echo Lang::get('text.remarks')?> </label>
                                <div class="col-md-9">
                                    <textarea rows="3" class="form-control" name='info' id='info' maxLength='200'></textarea>
                                </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.flight_num')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="flight_num"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_type')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="type"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_time')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="time"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.ship_city')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="city_id"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.address')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="address"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.airport')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="airport_id"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.normal_luggage_num')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="normal_luggage_num"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.special_luggage_num')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="special_luggage_num"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shipper')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="shipper"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.shiper_gender')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="gender"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.mobile')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="phone"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.distance')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="order_distance"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.money')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="order_money"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo Lang::get('text.remarks')?>:</label>
                            <div class="col-md-4">
                                <p class="form-control-static" data-display="info"></p>
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
                            <i class="m-icon-swapleft"></i> <?php echo Lang::get('text.back')?> 
                            </a>
                            <a href="javascript:;" class="btn blue button-next">
                            <?php echo Lang::get('text.continue')?> <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                            <a href="javascript:;" class="btn green button-submit">
                            <?php echo Lang::get('text.submit')?> <i class="m-icon-swapright m-icon-white"></i>
                            </a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
        <input type='hidden' name='distance' id='distance' value=''>
    </form>
</div>

<?php if(Auth::check()):?>
<div id="using_address" class="modal fade" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?php echo Lang::get('text.address_using')?></h4>
            </div>
            <div class="modal-body">
                <?php if(!empty($addressList)):?>
                <?php foreach($addressList as $k => $item):?>
                    <p onclick="select_address(this)" class='hand'>
                        <span class='shipper'><?php echo $item->shipper;?></span> &nbsp; 
                        <span class='phone'><?php echo $item->phone;?></span> &nbsp; 
                        <span class='city' data="<?php echo $item->city->id;?>"><?php echo $item->city->name;?></span> &nbsp; 
                        <span class='address'><?php echo $item->address;?></span>
                    </p>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
@stop
@section('script')
    <?php echo HTML::style('assets/plugins/uniform/css/uniform.default.css');?>
    <?php echo HTML::style('assets/css/plugins.css');?>
    <?php echo HTML::style('assets/css/style-metronic.css');?>
    <?php echo HTML::style('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css');?>
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
    <?php echo HTML::script('assets/plugins/uniform/jquery.uniform.min.js');?>
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

            var test = $("input[type=radio]:not(.toggle, .star)");
            if (test.size() > 0) {
                test.each(function () {
                });
            }
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