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
                    <h3 class='m-b-20'><?php echo Lang::get('text.profile');?></h3>
                    <hr>
                        <form class="form-horizontal form-row-seperated" id='profile-form' action="<?php echo asset('user/profile-update')?>" method='post'>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2  col-sm-3"><?php echo Lang::get('text.mobile')?></label>
                                    <div class="col-md-5 col-sm-8">
                                        <span class="form-control"><?php echo Auth::user()->username;?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.user_name')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="text" class="form-control" name='name' placeholder="" value="<?php echo Auth::user()->name;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.gender')?></label>
                                    <div class="col-md-5 col-sm-8">
                                            <label class="radio-inline">
                                                <input type="radio" <?php if(Auth::user()->gender=='male'):?>checked="checked"<?php endif;?> value="male" name="gender"> <?php echo Lang::get('text.male')?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" <?php if(Auth::user()->gender=='female'):?>checked="checked"<?php endif;?> value="female" name="gender"> <?php echo Lang::get('text.female')?>
                                            </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.email')?></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="text" class="form-control" name='email' placeholder="" value="<?php echo Auth::user()->email;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.register_time')?></label>
                                    <div class="col-md-5 col-sm-8">
                                        <span class="form-control"><?php echo date('Y-m-d H:i:s', gmt_to_local(Auth::user()->create_time))?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.login_count')?></label>
                                    <div class="col-md-5 col-sm-8">
                                        <span class="form-control"><?php echo Auth::user()->login_num?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
                                            <button class="btn green btn-lg" type="button" onclick="doSubmit('profile-form',this)"><?php echo Lang::get('text.submit')?></button>
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