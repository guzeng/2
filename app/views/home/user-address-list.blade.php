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
                    <h3 class='m-b-20'><?php echo Lang::get('text.address_using');?></h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::get('text.shipper');?></th>
                                    <th><?php echo Lang::get('text.address');?></th>
                                    <th><?php echo Lang::get('text.mobile');?></th>
                                    <th><?php echo Lang::get('text.operate');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($address)):?>
                                <?php foreach($address as $k => $item):?>
                                <tr id="<?php echo $item->id?>">
                                    <td><?php echo $item->shipper;?></td>
                                    <td><?php echo $item->address;?></td>
                                    <td><?php echo $item->phone;?></td>
                                    <td>
                                        <a href="<?php echo asset('user/address-edit/'.$item->id)?>" class='btn blue btn-xs'>
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href='javascript:void(0)' onclick="doDelete('<?php echo asset('user/address-delete/'.$item->id)?>')" class='btn red btn-xs'>
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class='text-right'>
                        <?php echo $address->links(); ?>
                    </div>
                    <div class='text-right'>
                        <a href="<?php echo asset('user/address-edit')?>" class='btn blue'><?php echo Lang::get('text.add_address')?></a>
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