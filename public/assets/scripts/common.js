var timeoutSuccess, timeoutError;
msg.dataTableLang = {
                    "sLengthMenu": msg.lang=='zh' ? "每页显示 _MENU_ " : "Show _MENU_ entries",  
                    "sZeroRecords": msg.lang=='zh' ? "未查询到任何相关数据" : "No matching records found",  
                    "sInfo": msg.lang=='zh' ? "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录" : "Showing _START_ to _END_ of _TOTAL_ entries",  
                    "sInfoFiltered": msg.lang=='zh' ? "（从 _MAX_ 条记录中搜索）" : " ( filtered from _MAX_ total entries )",  
                    "sProcessing": "<i class='fa fa-coffee'></i>&nbsp; " + (msg.lang=='zh' ? "加载中..." : "Loading..."),  
                    "sSearch": msg.lang=='zh' ? "搜索 : " : "Search:",
                    "sInfoEmpty": msg.lang=='zh' ? "当前显示 0 至 0， 共 0 项" : "Showing 0 to 0 of 0 entries",
                    "oPaginate":  msg.lang=='zh' ? {"sFirst":"第一页","sPrevious":"上一页 ","sNext":"下一页 ","sLast":"末页 "} : {"sFirst": "First","sPrevious": "Previous","sNext": "Next","sLast": "Last"}
                };
msg.all = msg.lang=='zh' ? "全部" : 'All';
function showSuccess(message)
{
    closeAlert();
    if(typeof(message)=='undefined' || message=='')
    {
        var message = msg.success;
    }
    var html = "<div class='alert alert-success alert-dismissable show-alert' data-dismiss='alert' aria-hidden='true' id='success' style='*width:300px;'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>&times;</button>"
             + "<i class='glyphicon glyphicon-ok-sign'></i> <strong>"+message+"</strong>"
             + "</div>";
    $('body').append(html);
    var w = parseInt($('#success').width())+60;
    $('#success').css('margin-left',(0-w/2)+'px');
    clearTimeout(timeoutSuccess);
    timeoutSuccess = setTimeout(function(){$('#success').remove();}, 5000 ); 
}

function showError(message)
{
    closeAlert();
    if(typeof(message)=='undefined' || message=='')
    {
        var message = msg.error;
    }
    var html = "<div class='alert alert-danger alert-dismissable show-alert' id='error' data-dismiss='alert' aria-hidden='true' style='*width:300px;'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>&times;</button>"
             + "<i class='glyphicon glyphicon-minus-sign'></i> <strong>"+message+"</strong>"
             + "</div>";
    $('body').append(html);
    var w = parseInt($('#error').width())+60;
    $('#error').css('margin-left',(0-w/2)+'px');
    clearTimeout(timeoutError);
    timeoutError = setTimeout(function(){$('#error').remove();}, 30000 ); 
}

function loading()
{
    closeAlert();
    var html = "<div class='alert alert-info alert-dismissable show-alert' id='loading' data-dismiss='alert' aria-hidden='true' style='width:200px; margin-left: -100px;'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>&times;</button>"
             + "<i class='glyphicon glyphicon-time'></i> <strong>"+msg.loading+"</strong>"
             + "</div>";
    $('body').append(html);
}

/**
 * closeAlert
 * 关闭提示
 * 
 */ 
function closeAlert(callback){
    $('.show-alert').remove();
    if(typeof(callback)!='undefined' && callback!='' && callback!='undefined')
    {
        callback();
        //$('.modal-backdrop').fadeOut('slow',function(){$(this).remove()});
    }
}
//------------------------------------------------------------------------

function reload()
{
    window.location.reload();
}
//------------------------------------------------------------------------

function goback()
{
    history.go(-1);
}
/**
 * confirm_course
 * 
 * 确认
 * @param int 
 * @2013/3/21
 * @author zeng.gu
 */
function confirmDialog(title,msg,callback,param)
{
    if(typeof(title)=='undefined' || title=='' || title==null || typeof(msg)=='undefined' || msg=='' || msg==null)
    {
        return false;
    }
    if(typeof(title)!='undefined')
    {
        $('#_confirm_dialog').find('.modal-title').html(title);
    }
   
    $('#_confirm_dialog').find('.modal-body').html(msg);
    var str = '';
    if(typeof(param)!='undefined')
    {
        str = param;  
    }
    $('#_confirm_dialog').find('#_confirm_btn').unbind('click');
    $('#_confirm_dialog').find('#_confirm_btn').on('click',function(){
        callback(str);
        $('#_confirm_dialog').modal('hide');
    })
    $('#_confirm_dialog').modal();
    closeAlert();
}
//------------------------------------------------------------------------

/**
 *  change_height
 *  
 *  弹出窗口后，修改高度以适应不同浏览器大小
 *  @param string url
 *  @2013/4/1
 *  @author zeng.gu
 */
function changeHeight(id)
{
    var h = parseInt($(window).height());  
    $('#'+id).find('.modal-body').css('max-height',(h-160)+'px');
    var modal_h = $('#'+id).height();
    $('#'+id).css('top',parseInt((h-modal_h)/2-10)); 
}
//------------------------------------------------------------------------

/**
 * show log in popup
 * 重新登录
 * 
 * @author zeng.gu
 * @2013/08
 */
function showLogin(data)
{
    $('#_login_form').modal({backdrop: 'static'});
    $('#_relogin_form').find('#password_f').val('');
    $('#_relogin_form').find('#error_message').find('span.help-block').html('');
    if($('#_relogin_form').find('#username').val()!='')
    {
        $('#_relogin_form').find('#password_f').focus();
    }
    else
    {
        $('#_relogin_form').find('#username').focus();    
    }
    if($('#_relogin_form').find('#login_captcha').length>0)
    {
        refreshValidateKey();
        $('#_relogin_form').find('input[name=validate_key]').val('');
    }
    $('#_login_form').find('#relogin_form_submit_btn').attr('disabled',false).show();
    $('#_login_form').find('#_login_form_loading').remove();
    if(typeof(data.token)!='undefined')
    {
        $('#_login_form').find('#_token').val(data.token);
    }
}
//------------------------------------------------------------------------

/**
 * hide log in popup
 * 重新登录
 * 
 * @author zeng.gu
 * @2013/08
 */
function hideLogin()
{
    $('#_login_form').modal('hide');
}
//------------------------------------------------------------------------

function login()
{
    if($('#_relogin_form').find('#username').val()=='')
    {
        return false;
    }
    if($('#_relogin_form').find('#password').val()=='')
    {
        return false;
    }
    $('#_relogin_form').ajaxSubmit({
        'dataType':'json',
        success:function(json){
            $('#relogin_form_submit_btn').show();
            $('#_login_form_loading').remove();
            if(json.code == '1000')
            {
                showSuccess(json.msg);
                hideLogin();                
            }
            else
            {
                $('#error_message').html("<span class='help-block'>"+json.msg+"</span>");
                $('#error_message').addClass('has-error').show();
                $('#error_message').parent().show();
                $('#_relogin_form').find('input[name=password]').val('').focus();    
            }
        },
        beforeSubmit:function(){
            $('#_login_form').find('#relogin_form_submit_btn').before("<img id='_login_form_loading' src='"+msg.base_url+"assets/img/input-spinner.gif' height='16'>");
            $('#relogin_form_submit_btn').hide();
            $('#error_message').find('span.help-block').html('');
            $('#error_message').removeClass('has-error').hide();
        }
    })
}
//------------------------------------------------------------------------

function refreshValidateKey()
{
    document.getElementById('login_captcha').src=msg.base_url+'validation-code?t='+Math.random();
}
//------------------------------------------------------------------------
/**
 * placeholder
 * placeholder for IE         
 * 
 * @author zeng.gu
 * @2013/4/9
 */
function place_holder()
{
    $.support.placeholder = false;
    if ("placeholder" in document.createElement("input")) $.support.placeholder = true;
    if (!$.support.placeholder) {
        var active = document.activeElement;
        $(":text, textarea").on("focus", function () {
            if ($(this).attr("placeholder") != "" && $(this).val() == $(this).attr("placeholder") && $(this).hasClass("placeholder")==true) {
                $(this).val("");
            }
            $(this).removeClass('placeholder');
        }).on("blur", function () {
            if (typeof($(this).attr("placeholder")) != "undefined" && $(this).val() == "" ) {
                $(this).val($(this).attr("placeholder")).addClass('placeholder');
            }
            else if($(this).attr("placeholder") != $(this).val())
            {
                $(this).removeClass('placeholder');
            }
        });
        $(":text, textarea").blur();
        $(active).focus();
        $("form").submit(function () {
            $(this).find(".placeholder").each(function () {
                if($(this).val()==$(this).attr('placeholder')){
                    $(this).val("");
                } 
            });
        });
    }
}
//---------------------------------------------------------------------------------

/**
 * isExistOption
 * select中是否存在某值
 * @author zeng.gu
 * @2013/4/12
 */
function isExistOption(id,value) {
    var isExist = false;
    var count = $('#'+id).find('option').length;
    for(var i=0;i<count;i++)
    {
        if($('#'+id).get(0).options[i].value == value)
        {
            isExist = true;
            break;
        }
    }
    return isExist;
}
//------------------------------------------------------------------------

//处理键盘事件 禁止后退键（Backspace）密码或单行、多行文本框除外
function banBackSpace(e){
    var ev = e || window.event;//获取event对象
    var obj = ev.target || ev.srcElement;//获取事件源
    var t = obj.type || obj.getAttribute('type');//获取事件源类型
    //获取作为判断条件的事件类型
    var vReadOnly = obj.readOnly;
    var vDisabled = obj.disabled;
    //处理undefined值情况
    vReadOnly = (vReadOnly == undefined) ? false : vReadOnly;
    vDisabled = (vDisabled == undefined) ? true : vDisabled;
    //当敲Backspace键时，事件源类型为密码或单行、多行文本的，
    //并且readOnly属性为true或disabled属性为true的，则退格键失效
    var flag1= ev.keyCode == 8 && (t=="password" || t=="text" || t=="textarea")&& (vReadOnly==true || vDisabled==true);
    //当敲Backspace键时，事件源类型非密码或单行、多行文本的，则退格键失效
    var flag2= ev.keyCode == 8 && t != "password" && t != "text" && t != "textarea" ;
    //判断
    if(flag2 || flag1)return false;
}
//------------------------------------------------------------------------

function isJson(obj){
    var isjson = typeof(obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length;    
    return isjson;
}
//------------------------------------------------------------------------

function enterSumbit(){  
      var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
     if (event.keyCode == 13){  
        $('.submit-btn').click();  
     }  
}
//------------------------------------------------------------------------

/**
 * submit
 *
 */
function doSubmit(formID,btn, callback)
{
    if(typeof(formID) == 'undefined' || formID == '')
    {
        return false;
    }
    $('#'+formID).find("input[type=text]").each(function () {
        if($(this).val()==$(this).attr('placeholder')){
            $(this).val("");
        } 
    });
    $('#'+formID).ajaxSubmit({
        dataType:'json',
        async:false,
        beforeSubmit:function(){
            loading();
            if(typeof(btn)!='undefined')
            {
                $(btn).attr('disabled',true);
            }
            $('#'+formID).find('button').attr('disabled',true);
            $('#'+formID).find('div.form-group').removeClass('has-error');
            $('#'+formID).find('div.form-group').find('span.help-block').not('.fix').html('');
        },
        success:function(data){
            closeAlert();
            $('#'+formID).find('button').attr('disabled',false);
            if(typeof(btn)!='undefined')
            {
                $(btn).attr('disabled',false);
            }
            if(typeof(data.code)!='undefined' && data.code == '1002')
            {
                showLogin(data);
            }
            else if(data.code=='1000')
            {
                if(typeof(callback) == 'function')
                {
                    callback();
                }
                else
                {
                    showSuccess(data.msg);
                    if(typeof(data.url)!='undefined')
                    {
                        window.location.href = data.url;
                    }
                }
            }
            else
            {
                showError(data.msg);
                if(typeof(data.error)!='undefined')
                {
                    $.each(data.error,function(key,item){
                        if(item != '') 
                        {
                            var tips = "";
                            for (var i = 0; i < item.length; i++) {
                                tips = tips + item[i];
                            }
                            if($('input[name='+key+']').length > 0)
                            {
                                if($('input[name='+key+']').closest('.form-group').find('span.help-block[for='+key+']').length > 0)
                                {
                                    $('input[name='+key+']').closest('.form-group').find('span.help-block[for='+key+']').html(item);
                                }
                                else
                                {
                                    if(key=='accept')
                                    {
                                        $('input[name='+key+']').parent().append("<span class='help-block' for='"+key+"'>"+item+"</span>");
                                    }
                                    else
                                    {
                                        $('input[name='+key+']').after("<span class='help-block' for='"+key+"'>"+item+"</span>");
                                    }
                                    
                                }
                                $('input[name='+key+']').closest('.form-group').addClass('has-error').show();
                            }
                        }
                    })                      
                }
            }
        },
        error:function(){
            if(typeof(btn)!='undefined')
            {
                $(btn).attr('disabled',false);
            }
            $('#'+formID).find('button').attr('disabled',false);
            showError();
        }
    })
}
//------------------------------------------------------------------------

function doDelete(uri)
{
    confirmDialog(msg.delete_confirm, msg.sure_to_delete, Delete, uri);
}
/**
 * delete
 * @param varchar url
 * @param function callback (if need)
 */
function Delete(uri)
{
    var uri = uri.toString().replace(/\"/g,'');
    if(typeof(uri)!='undefined' && uri!='' && uri != null)
    {
        $.ajax({
            url:uri,
            type:'get',
            success:function(data){
                if(data.code == '1000')
                {
                    unload_modal();
                    showSuccess(data.msg);
                    if(typeof(data.data.id) != 'undefined')
                    {
                        $('#'+data.data.id).remove();
                    }
                }
                else
                {
                    showError(data.msg);
                }
            },
            beforeSend:function(){
                loading();
            },
            error:function()
            {
                showError();
            }
        })
    }
}
//------------------------------------------------------------------------

function hide_tree_list(compare, current)
{
    if(typeof(current) != 'undefined' && typeof(compare)!='undefined' && $(current).length>0)
    {
        var compare_deep = $(compare).attr('deep');
        var current_deep = $(current).attr('deep');
        if(parseInt(compare_deep) < parseInt(current_deep))
        {
            if(typeof($(compare).attr('show_child'))=='undefined' || $(compare).attr('show_child')=='true')
            {
                var parent_id = $(current).attr('parent');
                if($('#'+parent_id).css('display')!='none' && (typeof($('#'+parent_id).attr('show_child'))=='undefined' || $('#'+parent_id).attr('show_child')=='true'))
                {
                    current.show();
                    //图标处理
                    $(current).find('img.fold-icon').attr('src',msg.base_url+'assets/img/minus.png');
                }
                else
                {
                    current.hide();
                    //图标处理
                    $(current).find('img.fold-icon').attr('src',msg.base_url+'assets/img/plus.png');
                }
            }
            else
            {
                current.hide();
            }
            hide_tree_list(compare,$(current).next());
        }
    }
}
//------------------------------------------------------------------------

/**
 * Advanced table init
 * @param tableID  table's id attribute
 */
//var oTable;
function initTableAdvanced(tableID, orderBy, sort, hideCol) 
{
    var sorting=[];
    if(typeof(orderBy)!='undefined')
    {
        if(typeof(sort)=='undefined')
        {
            var sort = 'asc';
        }
        sorting = [[orderBy, sort]];
    }
    var aTarget = [];
    if(typeof(hideCol)!='undefined')
    {
        $.each(hideCol.split(','), function(k,item){
            aTarget.push(parseInt(item));
        })
    }
    var oTable = $('#'+tableID).dataTable({  
        "aoColumnDefs": [
            { "bVisible": false, "aTargets": aTarget }
        ],
        "aaSorting": sorting,
        "aLengthMenu": [
            [10, 5, 10, 15, 20, -1],
            ['', 5, 10, 15, 20, msg.all] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 10,
        "bDestroy" :true,
        "fnInitComplete": function() {
            this.fnAdjustColumnSizing(true);
        },
        "oLanguage": msg.dataTableLang
    });

    initDataTableAction(tableID,oTable);
}

function initDataTableAction(tableID,table)
{
    jQuery('#'+tableID+'_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
    jQuery('#'+tableID+'_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
    jQuery('#'+tableID+'_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
    $('#'+tableID+'_column_toggler input[type="checkbox"]').off().on('change',function(){
        /* Get the DataTables object again - this is not a recreation, just a get of the object */
        var iCol = parseInt($(this).attr("data-column"));
        if($(this).parent().hasClass('checked')){
            bVis = false;
            $(this).parent().removeClass('checked');
        }
        else
        {
            bVis = true;
            $(this).parent().addClass('checked');
        }
        table.fnSetColumnVis(iCol, bVis);
    });
}

/**
 * ajax请求
 * @param url       
 * @param data      
 * @param btnId     提交按钮Id
 * @param callback  回调函数
 * @param type      请求类型，默认post
 */
function ajaxRequest(url,data,btnId,callback,type){
    if(typeof(type)!='undefined' && type!='' && type!='undefined')
    {
        type = type;
    }
    else
    {
        type ="post";
    }
    $.ajax({
        url:msg.base_url+url,
        data:data,
        type:type,
        dataType:'json',
        success:function(json){ 
            closeAlert();
            $('#'+btnId).attr('disabled',false);
            if(typeof(json.code)!='undefined' && json.code == '1002')
            {
                showLogin(json);
            }
            else if(json.code=='1000')
            {
                if(typeof(json.msg)!='undefined')
                {
                    showSuccess(json.msg);
                }
                
                if(typeof(callback)!='undefined' && callback!='' && callback!='undefined')
                {
                    callback(json);
                }
            }
            else
            {
                if(typeof(json.msg)!='undefined')
                {
                    showError(json.msg);
                }
                if(typeof(json.error)!='undefined')
                {
                    $.each(json.error,function(key,item){
                        if(item != '') 
                        {
                            var tips = "";
                            for (var i = 0; i < item.length; i++) {
                                tips = tips + item[i];
                            }
                            if($('input[name='+key+']').length > 0)
                            {
                                if($('input[name='+key+']').closest('.form-group').find('span.help-block[for='+key+']').length > 0)
                                {
                                    $('input[name='+key+']').closest('.form-group').find('span.help-block[for='+key+']').html(item);
                                }
                                else
                                {
                                    $('input[name='+key+']').after("<span class='help-block' for='"+key+"'>"+item+"</span>");
                                }
                                $('input[name='+key+']').closest('.form-group').addClass('has-error').show();
                            }
                        }
                    })                      
                }
            }
        },
        beforeSend:function(){
            loading();
            $('#'+btnId).attr('disabled',true);
        },
        error:function(){
            showError();
            $('#'+btnId).attr('disabled',false);
        }
    });
}

/**
 * 验证form表单
 * @param formId    表单Id
 * @param rules     验证规则
 */
function formValidate(formId,rules){
    $('#'+formId).validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: rules,
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.parent(".input-group").size() > 0) {
                error.insertAfter(element.parent(".input-group"));
            } else if (element.attr("data-error-container")) { 
                error.appendTo(element.attr("data-error-container"));
            } else if (element.parents('.radio-list').size() > 0) { 
                error.appendTo(element.parents('.radio-list').attr("data-error-container"));
            } else if (element.parents('.radio-inline').size() > 0) { 
                error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
            } else if (element.parents('.checkbox-list').size() > 0) {
                error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
            } else if (element.parents('.checkbox-inline').size() > 0) { 
                error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
            } else {
                error.insertAfter(element); // for other inputs, just perform default behavior
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit              
            showError(msg.error);
        },

        highlight: function (element) { // hightlight error inputs
            $(element).focus();
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        
        success: function (label) {
            label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
    });
}

function loadPage(target, url, callback)
{
    if(typeof(target)!='undefined' && typeof(url)!='undefined' && target != '' && url != '')
    {
        $.ajax({
            url:url,
            dataType:'json',
            type:'get',
            success:function(json){
                closeAlert();
                if(typeof(json.code)!='undefined' && json.code == '1002')
                {
                    showLogin(json);
                }
                else if(json.code=='1000')
                {
                    $('#'+target).html(json.data);
                    adjustFooter();
                }
                else if(typeof(json.msg)!='undefined')
                {
                    showError(json.msg);
                }
                place_holder();
                if(typeof(callback)=='function')
                {
                    callback();
                }
                if(url.indexOf('admin')<0)    //后台不需要animal
                {
                    $("html,body").animate({scrollTop:$("#"+target).offset().top-85},1000);
                }
            },
            error:function(){
                showError(msg.error);
            },
            beforeSend:function(){
                loading();
            }
        })
    }
}

/**
 * adjustFooter
 * 调整底部文件
 */
function adjustFooter()
{
    //var b_h = parseInt($('body').height());
    //var h = parseInt($(window).height());
    
}

function load_modal(url,type)
{
    if(typeof(url)=='undefined' || url=='' ||  url==null)
    {
        return false;
    }
    $.ajax({
        url:url,
        type:'get',
        dataType:'json',
        success:function(json){
            closeAlert();
            if(json.code=='1000')
            {
                var size = (typeof(type)!='undefined' && type=='big') ? 'data-target=".bs-example-modal-lg"' : '';
                var html = "<div id='_load_modal' class='modal' tabindex='-1' role='dialog' "+size+" aria-labelledby='myModalLabel' aria-hidden='false'>"+json.data+"<div class='clearfix'></div></div>";
                if($('#_load_modal').length > 0)
                {
                    $('#_load_modal').remove();
                }
                $('body').append(html);
                $('#_load_modal').find('button[aria-hidden=true]').on('click',function(){
                    unload_modal();
                })
                $('#_load_modal').modal();
            }
            else if(json.code=='1002')
            {
                showLogin(json);
            }
            else
            {
                if(typeof(json.msg)!='undefined')
                {
                    showError(json.msg);
                }
                else
                {
                    showError(msg.error);
                }
            }
            
        },
        beforeSend:function(){
            loading();
        },
        error:function(err){
            showError(msg.error);
        }
    })
}

function unload_modal(id)
{
    if(typeof(id)=='undefined')
    {
        id = '_load_modal';
    }
    //$('#_load_modal').fadeOut('slow',function(){$(this).remove()});
    $('#'+id).modal('hide');
    $('#'+id).on('hidden.bs.modal', function (e) {
        $(this).remove();
    })
    closeAlert();
}



//时间戳转换成日期
function timeTodate(data_time)
{
    var timestr = new Date(parseInt(data_time) * 1000);
    var year = timestr.getFullYear();
    var month = parseInt(timestr.getMonth())+1;
        month = month<9?"0"+month:month;
    var date = parseInt(timestr.getDate());
        date = date<9?"0"+date:date;

    return year+"-"+month+"-"+date;
}

//时间戳转换成日期时间
function timeTodatetime(data_time)
{
    var timestr = new Date(parseInt(data_time) * 1000);
    var year = timestr.getFullYear();
    var month = parseInt(timestr.getMonth())+1;
        month = month<9?"0"+month:month;
    var date = parseInt(timestr.getDate());
        date = date<9?"0"+date:date;
    var hours = parseInt(timestr.getHours());
        hours = hours<9?"0"+hours:hours;
    var minutes = parseInt(timestr.getMinutes());
        minutes = minutes<9?"0"+minutes:minutes;
    var seconds = parseInt(timestr.getSeconds());
        seconds = seconds<9?"0"+seconds:seconds;

    return year+"-"+month+"-"+date+"   "+hours+":"+minutes+":"+seconds;
}

function asset(url)
{
    return msg.base_url+url;
}

function validateKey(t,obj)
{
    if(typeof(obj)!='undefined' && typeof(t)!='undefined')
    {
        var regx=/^1[34578][0-9]{9}$/;
        var tel = $('#'+t).val();
        if(tel.match(regx)!=null)
        {
            var p = $(obj).parent();
            $.ajax({
                url:msg.base_url+'validate-key',
                type:'post',
                dataType:'json',
                data:{'mobile':tel},
                success:function(json)
                {
                    if(json.code=='1000')
                    {
                        var html = msg.validate_again.replace("%s","&nbsp; <span id='validate_key_timeout' style='margin-top:7px;'>60</span> ");
                        p.html(html);//.css('padding-top','7px');
                        var s = setInterval(function(){
                            var t = $('#validate_key_timeout').html();
                            if(t=='1')
                            {
                                clearInterval(s);
                                p.html(obj).css('padding-top','0px');
                            }
                            else
                            {
                                $('#validate_key_timeout').html(parseInt(t)-1);
                            }
                        },1000);
                    }
                    else
                    {
                        if(typeof(json.msg)!='undefined')
                        {
                            if($('#'+t).next('span[for='+t+']').length > 0)
                            {
                                $('#'+t).next('span[for='+t+']').html(json.msg);
                            }
                            else
                            {
                                $('#'+t).after("<span for='username' class='help-block'>"+json.msg+"</span>");
                                $('#'+t).parents('.form-group').addClass('has-error');
                            }
                        }
                        else
                        {
                            showError();
                        }
                        p.html(obj);
                    }
                },
                error:function()
                {
                    showError();
                },
                beforeSend:function()
                {
                    $('#'+t).next('span[for='+t+']').remove();
                    $('#'+t).parents('.form-group').removeClass('has-error');
                    var input = $(obj).parent().parent().find('input[type=text]');
                    input.val('');
                    input.parents('.form-group').removeClass('has-error');
                    $(obj).parent().parent().find('span[for='+input.attr('name')+']').remove();
                    p.html("&nbsp; <img src='"+msg.base_url+"assets/img/loading.gif'> ");
                }
            })            
        }
        else
        {
            if($('#'+t).next('span[for='+t+']').length > 0)
            {
                $('#'+t).next('span[for='+t+']').html(msg.incorrect_mobile);
            }
            else
            {
                $('#'+t).after("<span for='username' class='help-block'>"+ msg.incorrect_mobile+"</span>");
                $('#'+t).parents('.form-group').addClass('has-error');
            }            
        }
    }
}