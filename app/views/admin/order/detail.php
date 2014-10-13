<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><?php echo $order->code?></h4>
        </div>
        <div class="modal-body">
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
                            <td id='status' colspan='3'><?php echo $order->status=='1' ? Lang::get('text.processed') : Lang::get('text.unprocessed');?></td>
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
                            <td>&nbsp;<?php echo $order->pay_type>0 ? Lang::get('text.pay_type_'.Order::payType($order->pay_type)):'';//$order->pay_type=='1' ? Lang::get('text.alipay') : ($order->pay_type=='2' ? Lang::get('text.unionPay') : '');?></td>
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
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo Lang::get('text.close')?></button>
            <?php if($order->status == '0'):?>
            <button class="btn btn-primary" id='change_btn' type="button" onclick="changeStatus('<?php echo $order->id?>')"><?php echo Lang::get('text.processed');?></button>
            <button class="btn btn-danger" id='del_btn' type="button" onclick="doDelete('<?php echo asset('admin/order/delete/'.$order->id);?>')" ><?php echo Lang::get('text.delete');?></button>
            <?php endif;?>
        </div>
    </div><!-- /.modal-content -->
</div>
