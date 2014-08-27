<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><?php echo $item->title?></h4>
        </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.user_name')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->name;?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.mobile')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->username?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.gender')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->gender;?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.register_time')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->create_time>0 ? date('Y-m-d H:i:s',gmt_to_local($item->create_time)) : '--';?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.active')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->active=='1' ? Lang::get('text.enable') : Lang::get('text.lock')?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo Lang::get('text.login_count')?>:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $item->login_num;?></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo Lang::get('text.last_login')?>:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"><?php echo $item->last_login>0 ? date('Y-m-d H:i:s',gmt_to_local($item->last_login)) : '--';?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo Lang::get('text.close')?></button>
        </div>
    </div><!-- /.modal-content -->
</div>
