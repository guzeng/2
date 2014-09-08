@extends('home.layout')

@section('content')
<div class='container m-t-50 m-b-50'>
    <div class='row'>
        <div class="col-md-12 col-sm-12">
            <h1><?php echo Lang::get('text.register')?></h1>
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
                                    <span class="input-group-btn" style="vertical-align:top;">
                                        <button type="button" class="btn blue" onclick="validateKey('username',this)"><?php echo Lang::get('text.click_to_get_validate_key')?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-md-4 col-sm-4 control-label" for="password"><?php echo Lang::get('text.password')?> <span class="require">*</span></label>
                                <div class="col-lg-8 col-lg-8 col-sm-8">
                                    <input type="password" name='password' id="password" class="form-control" placeholder="<?php echo Lang::get('msg.new_pwd_limit')?>">
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
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-8 col-md-8 col-lg-8 ">
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" name='accept' id='accept' value='1'> <a href="asset('agreement')" class='link' target='_blank'><?php echo Lang::get('text.accept_agreement')?></a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                            <button class="btn btn-primary" onclick="doSubmit('register-form',this)" type="button"><?php echo Lang::get('text.register')?></button>
                            <a class="btn btn-default" type="button" href="<?php echo asset('login')?>"><?php echo Lang::get('text.cancel')?></a>
                        </div>

                        <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
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
@stop
@section('script')
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
    <?php echo HTML::script('assets/plugins/jquery-validation/jquery.validate.js');?>
    <?php echo HTML::script('assets/plugins/jquery-validation/additional-methods.min.js');?>
    <?php echo HTML::script('assets/plugins/jquery-validation/messages_'.App::getLocale().'.js');?>
    <script type="text/javascript">
        msg.validate_again = "<?php echo Lang::get('text.valiate_again')?>";
        msg.incorrect_mobile = "<?php echo Lang::get('validation.mobile')?>";
        $(function(){
            $('#register-form').validate({
                doNotHideMessage: false, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    username: {
                        required: true,
                        mobile:true
                    },
                    validate_code: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength:6
                    },
                    password_confirmation: {
                        required:true,
                        equalTo:password
                    },
                    name:{
                        required:true
                    },
                    gender:{
                        required:true
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        
                            //.addClass('valid') // mark the current input as valid and display OK icon
                        label.closest('.form-group').removeClass('has-error');//.addClass('has-success');  set success class to the control group
                        label.remove();
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });
        })
    </script>
@stop