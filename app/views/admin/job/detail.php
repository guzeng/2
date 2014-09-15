<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><?php echo $item->title?></h4>
        </div>
        <div class="modal-body">
                    <table class='table table-striped table-bordered table-hover dataTable'>
                        <tr>
                            <td class='b'><?php echo Lang::get('text.position')?></td>
                            <td><?php echo App::getLocale()=='zh'?$item->title:$item->title_en?></td>
                            <td class='b'><?php echo Lang::get('text.require_number')?></td>
                            <td><?php echo $item->number?></td>
                        </tr>
                        <tr>
                            <td class='b'><?php echo Lang::get('text.location')?></td>
                            <td><?php echo App::getLocale()=='zh'?$item->location:$item->location_en?></td>
                            <td class='b'><?php echo Lang::get('text.department')?></td>
                            <td><?php echo App::getLocale()=='zh'?$item->department:$item->department_en;?></td>
                        </tr>
                        <tr>
                            <td class='b'><?php echo Lang::get('text.deadline')?></td>
                            <td><?php echo date('Y-m-d',gmt_to_local($item->date));?></td>
                            <td class='b'><?php echo Lang::get('text.status')?></td>
                            <td><?php echo $item->status=='1' ? Lang::get('text.enable') : Lang::get('text.close');?></td>
                        </tr>
                        <tr>
                            <td class='b'><?php echo Lang::get('text.job_desc')?></td>
                            <td colspan='3'><?php echo App::getLocale()=='zh'?stripslashes($item->description):stripslashes($item->description_en) ;?></td>
                        </tr>
                        <tr>
                            <td class='b'><?php echo Lang::get('text.job_require')?></td>
                            <td colspan='3'><?php echo App::getLocale()=='zh'?stripslashes($item->requirement):stripslashes($item->requirement_en);?></td>
                        </tr>
                    </table>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo Lang::get('text.close')?></button>
            <button class="btn btn-danger" id='del_btn' type="button" onclick="doDelete('<?php echo asset('admin/job/delete/'.$item->id);?>')" ><?php echo Lang::get('text.delete');?></button>
        </div>
    </div><!-- /.modal-content -->
</div>
