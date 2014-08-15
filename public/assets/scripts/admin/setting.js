$(function(){
    //上传
    $('#system_edit_upload').fileupload({
        dataType: "json",
        autoUpload: true,
        url: msg.base_url+'uploadHandler',
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        maxFileSize: 1024000,
        maxNumberOfFiles : 1,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        start: function (e) {
            $('#system_edit_upload').attr('disabled', true);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#upload-loading').show();
            $('#upload-loading').find('div.progress-bar').width(progress + '%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').css({'width':'auto','height':'auto','clip':'auto'}).html(progress + '%');
        },
        fail: function (e, data) {
            $('#system_edit_upload').attr('disabled', false);
            showError(data.errorThrown);
            $('#upload-loading').hide();
            $('#upload-loading').find('div.progress-bar').width('0%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
        },
        done: function (e, data) {
            //给隐藏值赋值
            var url = data['result']['files'][0]['thumbnailUrl'];
            $('#logo_setting_pic').attr('src',url+"?"+Math.random());
            $('#logo_pic_path').val(data['result']['files'][0]['name']);
            data.context.text('');
            $('#system_edit_upload').attr('disabled', false);
            $('#upload-loading').hide();
            $('#upload-loading').find('div.progress-bar').width('0%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
        } 
    });
    //表单验证
    var rules = {
                    smtp_port:{number:true,min:0}
                }
    formValidate('system_edit',rules);

    //提交表单
    $("#system_submit").on('click',function(){
        //调用验证
        if($('#system_edit').valid() === false)
        {
            showError();
            return false;
        }
        doSubmit('system_edit','system_submit');
    });
    
    //清空错误显示的内容
    $('.form_error').html('');
    $('.input-error').removeClass('input-error');
    
    $('#system_edit').find('input,textarea').on('focus',function(){
        $(this).removeClass('input-error');
        $(this).parent().find('span.form_error').html('');
    })
    
})