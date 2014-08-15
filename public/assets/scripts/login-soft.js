
var Login = function () {

	var handleLogin = function() {
		$('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    //required: true
                },
                pwd: {
                    //required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                username: {
                    required: "Username is required."
                },
                pwd: {
                    required: "Password is required."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                fsubmit();
            }
	    });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit();
                }
                return false;
            }
        });

        var fsubmit = function(){
        	$('.login-form').ajaxSubmit({
        		'dataType':'json',
		        success:function(json){
		            $('#submit_btn').show();
		            $('#_login_form_loading').remove();
		            if(typeof(json.code) != 'undefined' && json.code == '1000')
		            {
		                window.location.href = json.url;
		            }
		            else
		            {
		                $('.login-form').find('.alert-danger').find('span').html(json.message);
		                $('.login-form').find('.alert-danger').show();
		            }
		        },
		        beforeSubmit:function(){
		            $('.login-form').find('#submit_btn').after("<img id='_login_form_loading' src='"+msg.base_url+"assets/img/input-spinner.gif' height='16'>");
		            $('#submit_btn').hide();
		            $('.login-form').find('span.help-block').remove();
		            $('.login-form').find('.alert-danger').find('span').html('');
		            $('.login-form').find('.alert-danger').hide();
		        },
        		error:function(){
        			console.log('error ');
        		}
        	});
        	return false;
        }
	}

	var handleForgetPassword = function () {
		$('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });

	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();
            handleForgetPassword();
	       
	       	$.backstretch([
		        asset("assets/img/bg/1.jpg"),
		        asset("assets/img/bg/2.jpg"),
		        asset("assets/img/bg/3.jpg"),
		        asset("assets/img/bg/4.jpg")
		        ], {
		          fade: 1000,
		          duration: 8000
		    });
        }

    };

}();