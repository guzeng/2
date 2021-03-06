@extends('admin.layout')

@section('content')
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
                <h3 class="page-title">
                    <?php echo Lang::get('text.order');?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.order_manage');?>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green" id='user-list'>
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-list"></i><?php echo Lang::get('text.all_order');?></div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class='btn green' id='reload-list'><i class='fa fa-refresh'></i></a>
                                <a target="_blank" title="<?php echo Lang::get('text.export')?>" href="<?php echo asset('admin/order/export'.(isset($type)?'/'.$type:''))?>" class="btn green">
                                    <i class="fa fa-table"></i>
                                </a>
                                <a class="btn green" href="#" data-toggle="dropdown">
                                    <?php echo Lang::get('text.show/hide');?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div id="datalist_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                    <label class="checkbox"><input type="checkbox" checked data-column="0">ID</label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="1"><?php echo Lang::get('text.order_code');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="2"><?php echo Lang::get('text.user_name');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="3"><?php echo Lang::get('text.flight_num');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="4"><?php echo Lang::get('text.ship_type');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="5"><?php echo Lang::get('text.ship_time');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="6"><?php echo Lang::get('text.ship_city');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="7"><?php echo Lang::get('text.airport');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="8"><?php echo Lang::get('text.shipper');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="9"><?php echo Lang::get('text.status');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="10"><?php echo Lang::get('text.create_date');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="11"><?php echo Lang::get('text.operate');?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="datalist">
                            <thead>
                                <tr>
                                    <th class=''>ID</th>
                                    <th><?php echo Lang::get('text.order_code');?></th>
                                    <th><?php echo Lang::get('text.user_name');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.flight_num');?></th>
                                    <th class="hidden-xs "><?php echo Lang::get('text.ship_type');?></th>
                                    <th class="hidden-xs "><?php echo Lang::get('text.ship_time');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.ship_city');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.airport');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.shipper');?></th>
                                    <th class="hidden-xs hidden-sm"><?php echo Lang::get('text.status');?></th>
                                    <th class="hidden-xs hidden-sm"><?php echo Lang::get('text.create_date');?></th>
                                    <th class="hidden-xs hidden-sm"><?php echo Lang::get('text.operate');?></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE -->
@stop

@section('script')    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <script src="<?php echo asset('assets/plugins/jquery.blockui.min.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/plugins/select2/select2_metro.css')?>" />
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/data-tables/DT_bootstrap.css')?>" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="<?php echo asset('assets/plugins/select2/select2.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('assets/plugins/data-tables/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('assets/plugins/data-tables/DT_bootstrap.js')?>"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script type="text/javascript">
        var lang = {
            'confirm'           : '<?php echo Lang::get('text.confirm');?>',
            'cancel'            : '<?php echo Lang::get('text.cancel');?>',
            'delete'            : "<?php echo Lang::get('text.delete');?>"
        };
    </script>
    <?php if(isset($type) && $type=='cancel'):?>
        <script src="<?php echo asset('assets/scripts/admin/order_cancel.js');?>" type="text/javascript"></script>
    <?php else:?>
        <script src="<?php echo asset('assets/scripts/admin/order.js');?>" type="text/javascript"></script>
    <?php endif;?>
@stop