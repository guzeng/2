@extends('home.layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class="col-md-12 col-sm-12">
            <h1>注册</h1>
            <div class="content-form-page">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                    <form role="form" class="form-horizontal" id='register-form' method='post' action="<?php echo asset('register/verify')?>" >
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="username">手机号 <span class="require">*</span></label>
                            <div class="col-lg-8 col-lg-8 col-sm-8">
                                <input type="text" id="username" name='username' class="form-control" maxlength='20'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="code">验证码 <span class="require">*</span></label>
                            <div class="col-lg-8 col-lg-8 col-sm-8">
                                <input type="text" id="code" name='code' class="form-control" maxLength='6'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="code"> </label>
                            <div class="col-lg-8 col-lg-8 col-sm-8">
                                <a>点击获取验证码</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="password">密码 <span class="require">*</span></label>
                                <div class="col-lg-8 col-lg-8 col-sm-8">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name='password' id="password" class="form-control">
                                </div>
                            </div>
                        <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="password_confirmation">确认密码 <span class="require">*</span></label>
                        <div class="col-lg-8 col-lg-8 col-sm-8">
                          <input type="password" id="password_confirmation" name='password_confirmation' class="form-control">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="name">真实姓名 <span class="require">*</span></label>
                        <div class="col-lg-8 col-lg-8 col-sm-8">
                          <input type="text" id="name" name='name' class="form-control" maxLength='50'>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 col-md-4 col-sm-4 control-label">性别</label>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <label class="radio-inline">
                                  <input type="radio" name="gender" id="male" value="male"> 男
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="gender" id="female" value="female"> 女
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                            <button class="btn btn-primary" onclick="doSubmit('register-form',this)" type="button">开始注册</button>
                            <button class="btn btn-default" type="button">取消</button>
                        </div>

                        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
                        <input type='hidden' name='accept' value="1" >
                  </form>
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2>已有账户？</h2>
                    <p></p>
                    <button class="btn btn-primary" type="button">登录</button>
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