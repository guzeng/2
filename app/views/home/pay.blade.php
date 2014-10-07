@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <div class="content-page">
                    <!-- BEGIN LEFT SIDEBAR -->  
                    <div class="row">          
                        <div class="col-md-12 p-l-30 p-r-30">
                            <h2><?php echo Lang::get('text.pay_for_order');?></h2>
                            <div class='note m-t-30'>
                                <p><?php echo Lang::get('text.order_code') ?> : <?php echo $order->code?></p>
                                <p><?php echo Lang::get('text.money');?> : <?php echo round($order->money,2)?></p>
                                <p><?php echo Lang::get('text.order_time');?> : <?php echo date('Y-m-d H:i:s', gmt_to_local($order->create_time))?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">    
                        <div class="col-md-12 p-l-30 p-r-30">
                            <p><?php echo Lang::get('text.pay_tip1');?></p>
                            <p><?php echo Lang::get('text.pay_tip2');?></p>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-md-12 p-l-30 p-r-30">
                            <form action="<?php echo asset('pay')?>" method='post'>
                            <div class="form-group m-b-20">
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class='m-b-20'>
                                            <input type="radio" checked="" value="1" id="pay_type_alipay" name="pay_type"> &nbsp;
                                            <img class='' src="<?php echo asset('assets/img/alipay.jpg')?>" >
                                        </label>
                                        <label class='m-b-20'>
                                            <input type="radio" value="2" id="pay_type_bank" name="pay_type"> &nbsp;
                                            <img class='' src="" >
                                        </label>
                                        <label>
                                            <input type="radio"  value="3" id="pay_type_cash" name="pay_type"> &nbsp;
                                            <img class='' src="<?php echo asset('assets/img/cash.jpg')?>" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"> &nbsp; &nbsp; &nbsp;
                                    <button class='btn btn-primary' type='submit'><?php echo Lang::get('text.confirm')?></button>
                                </div>
                            </div>
                            <input type='hidden' name='orderid' value="<?php echo $order->id?>">
                            </form>
                        </div>
                    </div>
                    <!-- END LEFT SIDEBAR -->
                </div>
            </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@stop
