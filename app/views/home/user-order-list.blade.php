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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::get('text.order_code');?></th>
                                    <th><?php echo Lang::get('text.shipper');?></th>
                                    <th><?php echo Lang::get('text.ship_time');?></th>
                                    <th><?php echo Lang::get('text.money');?></th>
                                    <th><?php echo Lang::get('text.pay_type');?></th>
                                    <th><?php echo Lang::get('text.status');?></th>
                                    <th><?php echo Lang::get('text.operate');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($orders)):?>
                                <?php foreach($orders as $k => $item):?>
                                <tr>
                                    <td><a href="<?php echo asset('user/order-view/'.$item->id)?>"><?php echo $item->code;?></a></td>
                                    <td><?php echo $item->shipper;?></td>
                                    <td><?php echo date('Y-m-d H:i',gmt_to_local($item->time))?></td>
                                    <td><?php echo $item->money;?></td>
                                    <td><?php echo $item->pay_type>0?Lang::get('text.pay_type_'.Order::payType($item->pay_type)):Lang::get('text.unpaid')?></td>
                                    <td><?php echo $item->status=='1'?Lang::get('text.processed'):Lang::get('text.unprocessed');?></td>
                                    <td><?php if($item->complete==0):?><a href='<?php echo asset('order/pay/'.$item->code)?>' class='btn yellow btn-xs' target='_blank'><?php echo Lang::get('text.pay');?></a><?php endif;?></td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class='text-right'>
                        <?php echo $orders->links(); ?>
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