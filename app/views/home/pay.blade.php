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
                                            <img class='' src="<?php echo asset('assets/img/unionpay.jpg')?>" >
                                        </label>
                                        <div id='banks' class='hide'>
                                            <div class="m-b-20">
                                                <label class="radio-inline" style='margin-left:10px;'>
                                                    <input type="radio" name="bank_name" value="ICBCB2C" checked class='bankinput'> 
                                                    <span class='bank ICBC' title='<?php echo Lang::get('text.ICBC')?>'></span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="ABC" class='bankinput'>
                                                    <span class='bank ABC' title='<?php echo Lang::get('text.ABC')?>'></span> 
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CCB" class='bankinput'>
                                                    <span class='bank CCB' title='<?php echo Lang::get('text.CCB')?>'></span>  
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="BOCB2C"  class='bankinput'>
                                                    <span class='bank BOCB2C' title='<?php echo Lang::get('text.BOCB2C')?>'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CMB"  class='bankinput'> 
                                                    <span class='bank CMB' title='<?php echo Lang::get('text.CMB')?>'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="POSTGC"  class='bankinput'>
                                                    <span class='bank POSTGC' title='<?php echo Lang::get('text.POSTGC')?>'></span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="COMM-DEBIT" class='bankinput'>
                                                    <span class='bank COMM-DEBIT' title='<?php echo Lang::get('text.COMM-DEBIT')?>'></span> 
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="GDB"  class='bankinput'>
                                                    <span class='bank GDB' title='<?php echo Lang::get('text.GDB')?>'></span>  
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CMBC" class='bankinput'>
                                                    <span class='bank CMBC' title='<?php echo Lang::get('text.CMBC')?>'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CITIC" class='bankinput'>
                                                    <span class='bank CITIC' title='<?php echo Lang::get('text.CITIC')?>'></span>    
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SPABANK"  class='bankinput'>
                                                    <span class='bank SPABANK' title='<?php echo Lang::get('text.SPABANK')?>'></span>     
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CEB-DEBIT"  class='bankinput'>
                                                    <span class='bank CEB-DEBIT' title='<?php echo Lang::get('text.CEB-DEBIT')?>'></span>      
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SHBANK" class='bankinput'>
                                                    <span class='bank SHBANK' title='<?php echo Lang::get('text.SHBANK')?>'></span>       
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SPDB" class='bankinput'>
                                                    <span class='bank SPDB' title='<?php echo Lang::get('text.SPDB')?>'></span>        
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="BJBANK"  class='bankinput'>
                                                    <span class='bank BJBANK' title='<?php echo Lang::get('text.BJBANK')?>'></span>         
                                                </label>
                                            </div>
                                        </div>
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
@section('script')
<script type="text/javascript">
$(function(){
    $('input[name=pay_type]').click(function(){
        if($(this).val()==2){$('#banks').show();}else{$('#banks').hide();}
    })
})
</script>
@stop

