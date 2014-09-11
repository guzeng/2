@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 m-h-500">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-2 col-sm-3 blog-sidebar">
                    <?php echo $left?>
                </div>
                <!-- END RIGHT SIDEBAR -->       
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-10 col-sm-9 blog-posts">
                    <h3 class='m-b-20'><?php echo Lang::get('text.my_order');?></h3>
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo Lang::get('text.order_detail');?></div>
                        <div class="panel-body">
                            <table class='table table-striped table-bordered table-hover dataTable'>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.order_code')?></td>
                                    <td><?php echo $order->code?></td>
                                    <td class='b'><?php echo Lang::get('text.flight_num')?></td>
                                    <td><?php echo $order->flight_num?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.ship_type')?></td>
                                    <td><?php echo Order::getType($order->type);// == '1' ? Lang::get('text.to_destination') : Lang::get('text.to_airport')?></td>
                                    <td class='b'><?php echo Lang::get('text.ship_time')?></td>
                                    <td><?php echo date('Y-m-d H:i:s',gmt_to_local($order->time));?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.ship_city')?></td>
                                    <td><?php echo $order->city ? $order->city->name : '';?></td>
                                    <td class='b'><?php echo Lang::get('text.airport')?></td>
                                    <td><?php echo $order->airport ? $order->airport->name : '';?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.normal_luggage_num')?></td>
                                    <td><?php echo $order->normal_luggage_num;?></td>
                                    <td class='b'><?php echo Lang::get('text.special_luggage_num')?></td>
                                    <td><?php echo $order->special_luggage_num;?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.shipper')?></td>
                                    <td><?php echo $order->shipper;?></td>
                                    <td class='b'><?php echo Lang::get('text.gender')?></td>
                                    <td><?php echo Lang::get('text.'.$order->gender);?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.mobile')?></td>
                                    <td><?php echo $order->phone;?></td>
                                    <td class='b'><?php echo Lang::get('text.distance')?></td>
                                    <td><?php echo $order->distance;?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.create_date')?></td>
                                    <td><?php echo date('Y-m-d H:i:s',gmt_to_local($order->create_time));?></td>
                                    <td class='b'><?php echo Lang::get('text.status')?></td>
                                    <td id='status'><?php echo $order->status=='1' ? Lang::get('text.processed') : Lang::get('text.unprocessed');?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.ship_note')?></td>
                                    <td colspan='3'><?php echo $order->info?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo Lang::get('text.payment');?></div>
                        <div class="panel-body">
                            <table class='table table-striped table-bordered table-hover dataTable'>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.money')?></td>
                                    <td><?php echo $order->money;?></td>
                                    <td class='b'><?php echo Lang::get('text.pay_type')?></td>
                                    <td>&nbsp;<?php echo $order->pay_type=='1' ? Lang::get('text.alipay') : ($order->pay_type=='2' ? Lang::get('text.unionPay') : '');?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.pay');?></td>
                                    <td><?php echo $order->pay=='1' ? Lang::get('text.paid') : Lang::get('text.unpaid');?></td>
                                    <td class='b'><?php echo Lang::get('text.pay_code')?></td>
                                    <td>&nbsp;<?php echo $order->pay_code;?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.pay_time');?></td>
                                    <td colspan='3'><?php echo $order->pay_time>0 ? date('Y-m-d H:i:s',$order->pay_time) : '';?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END LEFT SIDEBAR -->
     
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@stop

@section('script')
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
@stop