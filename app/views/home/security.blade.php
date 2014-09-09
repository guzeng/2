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
                    <h3 class='m-b-20'><?php echo Lang::get('text.security_setting');?></h3>
                    <hr>
                        <form class="form-horizontal form-row-seperated" id='security-form' action="<?php echo asset('user/password-update')?>" method='post'>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd1')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="password" class="form-control" name='old' placeholder="" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd2')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="password" class="form-control" name='password' placeholder="<?php echo Lang::get('msg.new_pwd_limit')?>" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd3')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="password" class="form-control" name='password_confirmation' placeholder="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
                                            <button class="btn green btn-lg" type="button" onclick="doSubmit('security-form',this)"><?php echo Lang::get('text.submit')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
                        </form>
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