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
                                    <td><?php echo $order->city ? (App::getLocale()=='zh'?$order->city->name:$order->city->name_en) : '';?> <?php echo isset($order->area)?(App::getLocale()=='zh'?$order->area->name:$order->area->name_en):''?></td>
                                    <td class='b'><?php echo Lang::get('text.airport')?></td>
                                    <td><?php echo $order->airport ? (App::getLocale()=='zh'?$order->airport->name:$order->airport->name_en) : '';?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.one_num')?></td>
                                    <td><?php echo $order->one_num;?></td>
                                    <td class='b'><?php echo Lang::get('text.two_num')?></td>
                                    <td><?php echo $order->two_num;?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.special_num')?></td>
                                    <td><?php echo $order->special_num;?></td>
                                    <td class='b'><?php echo Lang::get('text.distance')?></td>
                                    <td><?php echo $order->distance;?></td>
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
                                    <td class='b'><?php echo Lang::get('text.create_date')?></td>
                                    <td><?php echo date('Y-m-d H:i:s',gmt_to_local($order->create_time));?></td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.status')?></td>
                                    <td id='status' colspan='3'><?php echo Order::getStatus($order->status)?></td>
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
                                    <td>&nbsp;
                                        <?php echo $order->pay_type>0 ? Lang::get('text.pay_type_'.Order::payType($order->pay_type)) : ($order->status != 3?"<a href='".asset('order/pay/'.$order->code)."' target='_blank'>".Lang::get('text.unpaid')."</a>":Lang::get('text.unpaid'));?>
                                        <?php if($order->pay_type>0 && $order->bank != ''):?>(<?php echo Lang::get('text.'.$order->bank)?>)<?php endif;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='b'><?php echo Lang::get('text.pay_code')?></td>
                                    <td>&nbsp;<?php echo $order->pay_code;?></td>
                                    <td class='b'><?php echo Lang::get('text.pay_time');?></td>
                                    <td colspan='3'><?php echo $order->notify_time;?></td>
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