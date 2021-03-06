@extends('admin.layout')

@section('content')
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
                <h3 class="page-title">
                    <?php echo Lang::get('text.airport_manage');?>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo asset('admin/index');?>"><?php echo Lang::get('text.homepage');?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.system_manage');?>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo Lang::get('text.airport_manage');?>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green" id='airport-list'>
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-list"></i><?php echo Lang::get('text.all');?></div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn green" href="<?php echo asset('admin/airport/edit');?>"><i class="fa fa-plus"></i> <?php echo Lang::get('text.now_add');?></a>
                                <a class='btn green' id='reload-list'><i class='fa fa-refresh'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="datalist">
                            <thead>
                                <tr>
                                    <th class=''>ID</th>
                                    <th><?php echo Lang::get('text.name');?></th>
                                    <th><?php echo Lang::get('text.city');?></th>
                                    <th class="hidden-xs"><?php echo Lang::get('text.operate');?></th>
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
    <script src="<?php echo asset('assets/scripts/admin/airport.js');?>" type="text/javascript"></script>
@stop