@extends('admin.layout')

@section('content')
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB--> 
                <h3 class="page-title">
                    <?php echo Lang::get('text.city_manage');?>
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
                        <?php echo Lang::get('text.city_manage');?>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet purple box">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-group"></i><?php echo Lang::get('text.all_city');?></div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id='dept_list_view'>
                            <?php echo $datalist;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE -->
@stop

@section('script')
    <script type="text/javascript">
        lang = {
            'save'                  : "<?php echo Lang::get('text.save');?>",
            'cancel'                : "<?php echo Lang::get('text.cancel');?>",
            'name_limit' : "<?php echo Lang::get('text.20_limit');?>",
            'please_choose'         : "<?php echo Lang::get('text.please_choose');?>",
            'parent_dept'           : "<?php echo Lang::get('text.up_level_city');?>",
            'child_dept'            : "<?php echo Lang::get('text.lower_level_city');?>"
        }
    </script>
    <script src="<?php echo asset('assets/scripts/admin/city.js');?>" type="text/javascript"></script>
@stop