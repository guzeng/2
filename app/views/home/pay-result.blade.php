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
                    <div class="row m-t-50">          
                        <div class="col-md-12 p-l-30 p-r-30">
                            <h2 class='text-center'>
                                <?php if($msg=='success'):?>
                                <?php echo Lang::get('msg.pay_success');?>
                                <?php else:?>
                                <?php echo Lang::get('msg.pay_failed')?>
                                <?php endif;?>
                            </h2>
                        </div>
                    </div>
                    <hr>
                    <div class="row">          
                        <div class="col-md-12 p-l-30 p-r-30 text-center">
                            <a href="<?php echo asset('user/order')?>"><?php echo Lang::get('text.my_order');?></a> &nbsp; <a href="<?php echo asset('order')?>"><?php echo Lang::get('text.next_order');?></a>
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
