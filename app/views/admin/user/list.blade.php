@extends('admin.layout')

@section('content')
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
                <h3 class="page-title">
                    <?php echo Lang::get('text.user_manage');?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.user_manage');?>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green" id='user-list'>
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-list"></i><?php echo Lang::get('text.all_user');?></div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class='btn green' id='reload-list'><i class='fa fa-refresh'></i></a>
                                <a class="btn green" href="#" data-toggle="dropdown">
                                    <?php echo Lang::get('text.show/hide');?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div id="datalist_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                    <label class="checkbox"><input type="checkbox" checked data-column="0">ID</label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="1"><?php echo Lang::get('text.mobile');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="2"><?php echo Lang::get('text.user_name');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="3"><?php echo Lang::get('text.gender');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="4"><?php echo Lang::get('text.register_time');?></label>
                                    <label class="checkbox"><input type="checkbox" checked data-column="5"><?php echo Lang::get('text.active');?></label>
                                    <!--<label class="checkbox"><input type="checkbox" checked data-column="6"><?php echo Lang::get('text.operate');?></label>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="datalist">
                            <thead>
                                <tr>
                                    <th class=''>ID</th>
                                    <th><?php echo Lang::get('text.mobile');?></th>
                                    <th><?php echo Lang::get('text.user_name');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.gender');?></th>
                                    <th class="hidden-xs "><?php echo Lang::get('text.register_time');?></th>
                                    <th class="hidden-xs "><?php echo Lang::get('text.active');?></th>
                                    <!--<th class="hidden-xs"><?php echo Lang::get('text.operate');?></th>-->
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
            'confirm'           : "<?php echo Lang::get('text.confirm');?>",
            'cancel'            : "<?php echo Lang::get('text.cancel');?>",
            'edit'            : "<?php echo Lang::get('text.edit');?>",
            'delete'            : "<?php echo Lang::get('text.delete');?>"
        };
    </script>
    <script src="<?php echo asset('assets/scripts/admin/user.js');?>" type="text/javascript"></script>
@stop