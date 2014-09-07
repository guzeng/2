@extends('home.layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class="col-md-12 col-sm-12">
            <h1><?php echo Lang::get('text.login')?></h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                    <form id='login-form' role="form" class="form-horizontal form-without-legend" method='post' action="<?php echo asset('login/verify');?>">
                        <div class="form-group">
                          <label class="col-lg-4 control-label" for="username"><?php echo Lang::get('text.mobile')?> <span class="require">*</span></label>
                          <div class="col-lg-8">
                            <input type="text" id="username" name='username' class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-4 control-label" for="password"><?php echo Lang::get('text.password')?> <span class="require">*</span></label>
                          <div class="col-lg-8">
                            <input id="password" name='password' type='password' class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-8 col-md-offset-4 padding-left-0">
                            <a href="<?php echo asset('forget-password')?>"><?php echo Lang::get('text.forget_password')?></a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                            <button class="btn btn-primary" type="button" onclick="doSubmit('login-form',this)"><?php echo Lang::get('text.login')?></button>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-10 padding-right-30">
                            <hr>
                            
                          </div>
                        </div>
                        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 pull-right">
                  <div class="form-info">
                    <h2>如果您还不是会员，请注册</h2>
                    <p></p>
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo asset('register');?>';" type="button">注册</button>
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
        function login_success()
        {

        }
    </script>
@stop