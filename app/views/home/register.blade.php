@extends('home.layout')

@section('content')
<div class='container m-t-50 m-b-50'>
    <div class='row'>
        <div class="col-md-12 col-sm-12">
            <h1><?php echo Lang::get('text.register')?></h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                    <form role="form" class="form-horizontal" id='register-form' method='post' action="<?php echo asset('register/verify')?>" >
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="username"><?php echo Lang::get('text.mobile');?> <span class="require">*</span></label>
                            <div class="col-lg-8 col-lg-8 col-sm-8">
                                <input type="text" id="username" name='username' class="form-control" maxlength='20'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="validate_code"><?php echo Lang::get('text.validate_key')?> <span class="require">*</span></label>
                            <div class="col-lg-8 col-lg-8 col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="validate_code" name='validate_code' class="form-control" maxLength='6' placeholder="<?php echo Lang::get('text.valiate_key_in_mobile')?>">
                                    <span class="input-group-addon"><a href='javascript:void(0)' onclick="validateKey('username',this)"><?php echo Lang::get('text.click_to_get_validate_key')?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="password"><?php echo Lang::get('text.password')?> <span class="require">*</span></label>
                                <div class="col-lg-8 col-lg-8 col-sm-8">
                                    <input type="password" name='password' id="password" class="form-control">
                                </div>
                            </div>
                        <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="password_confirmation"><?php echo Lang::get('text.pwd5')?> <span class="require">*</span></label>
                        <div class="col-lg-8 col-lg-8 col-sm-8">
                          <input type="password" id="password_confirmation" name='password_confirmation' class="form-control">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="name"><?php echo Lang::get('text.user_name')?> <span class="require">*</span></label>
                        <div class="col-lg-8 col-lg-8 col-sm-8">
                          <input type="text" id="name" name='name' class="form-control" maxLength='50'>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 col-md-4 col-sm-4 control-label"><?php echo Lang::get('text.gender')?></label>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <label class="radio-inline">
                                  <input type="radio" name="gender" id="male" value="male" checked> <?php echo Lang::get('text.male')?>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="gender" id="female" value="female"> <?php echo Lang::get('text.female')?>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                            <button class="btn btn-primary" onclick="doSubmit('register-form',this)" type="button"><?php echo Lang::get('text.register')?></button>
                            <button class="btn btn-default" type="button"><?php echo Lang::get('text.cancel')?></button>
                        </div>

                        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
                        <input type='hidden' name='accept' value="1" >
                  </form>
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><?php echo Lang::get('text.has_account');?></h2>
                    <p></p>
                    <button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo asset('login');?>';"><?php echo Lang::get('text.login')?></button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
    <script type="text/javascript">
        msg.validate_again = "<?php echo Lang::get('text.valiate_again')?>";
        msg.incorrect_mobile = "<?php echo Lang::get('validation.mobile')?>";
    </script>
@stop