$(function(){

    if($('#datalist').length > 0)
    {
        initJobList();
    }

    $('#reload-list').on('click', function(){
        initJobList();
    });


    if($('#news_update').length>0)
    {   

        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[id="requ"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', 'lineheight','|', 'image', 'link','unlink','|','fullscreen','preview','about']
            });
            editor3 = K.create('textarea[id="requ_en"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', 'lineheight','|', 'image', 'link','unlink','|','fullscreen','preview','about']
            });
            editor2 = K.create('textarea[id="desc"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', 'lineheight','|', 'image', 'link','unlink','|','fullscreen','preview','about']
            });
            editor4 = K.create('textarea[id="desc_en"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', 'lineheight','|', 'image', 'link','unlink','|','fullscreen','preview','about']
            });
        });
        $('#deadline').datepicker({
              format: 'yyyy-mm-dd',
                weekStart: 1,
                autoclose: true,
                todayBtn: 'linked',
                language: (msg.lang=='zh')?'zh-CN':'en'
        });
        
        //提交表单
        $("#news_edit_btn").on('click',function(){
            $('#description').text(editor2.html());
            $('#description_en').text(editor4.html());
            $('#requirement').text(editor.html());
            $('#requirement_en').text(editor3.html());
            doSubmit('news_update','news_edit_btn');
        });
    }
});

function changeStatus(id)
{
    if(typeof(id)=='undefined')
    {
        return false;
    }
    $.ajax({
        url: msg.base_url+'admin/job/change-status/'+id,
        dataType:'json',
        success:function(json){
            closeAlert();
            if(json.code=='1000')
            {
                if(json.status=='1')
                {
                  $('#'+id+'_active_btn').attr('class', "btn btn-xs green").html("<i class='fa fa-check'></i>");
                }else
                {
                  $('#'+id+'_active_btn').attr('class', "btn btn-xs red").html("<i class='fa fa-ban'></i>");
                }
                showSuccess();
            }
            else if(json.code == '1002')
            {
                showLogin(json);
            }
            else
            {
                showError(json.msg);
            }
        },
        beforeSend:function(){
            loading();
        },
        error:function(err){
            showError();
        }
    })
}

function initJobList() 
{    
    if (!jQuery().dataTable) {
        return;
    }
    // begin first table
    var uTable = $('#datalist').dataTable({
        "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, msg.all] // change per page values here
        ],
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": msg.base_url+"admin/job/datalist",
        // set the initial value
        "iDisplayLength": 10,
        "sPaginationType": "bootstrap",
        "bDestroy":true,
        "oLanguage": msg.dataTableLang,
        "aaSorting": [[0,'desc']], //排序功能
        "bSortClasses":false,
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [4,7]
            },
            {
                "aTargets": [ 3,4,5,6,7],
                 "sClass": "hidden-xs",
            },
            {
                "aTargets": [ 1 ],
                "mRender":function(data,type,full){
                    return  "<a class='' href='javascript:;' onclick=\"load_modal('"+ msg.base_url +"admin/job/detail/"+ full[0] +"')\" >"
                                + data
                                + "</a>";
                }
            },
            {
                "aTargets": [ 6 ],
                "mRender":function(data,type,full){
                    if(data == '1')
                    {
                        return "<a id='"+full[0]+"_active_btn' class='btn btn-xs green' href='javascript:;' onclick=\"changeStatus('"+full[0]+"')\">"
                            + "<i class='fa fa-check'></i>"
                            + "</a> ";
                    }
                    else
                    {
                        return "<a id='"+full[0]+"_active_btn' class='btn btn-xs red' href='javascript:;' onclick=\"changeStatus('"+full[0]+"')\">"
                            + "<i class='fa fa-ban'></i>"
                            + "</a> ";
                    }
                } 
            },
            {
                "aTargets": [ 7 ],
                "mRender":function(data,type,full){
                    return "<a id='"+full[0]+"_edit_btn' class='btn btn-xs blue' href='"+msg.base_url+"admin/job/edit/"+full[0]+"' title='"+ lang.edit +"'>"
                            + "<i class='fa fa-pencil'></i>"
                            + "</a> "
                            + "<a id='"+full[0]+"_del_btn' class='btn btn-xs red' href='javascript:;' onclick=\"doDelete('"+ msg.base_url +"admin/job/delete/"+ full[0] +"')\" title='"+ lang.delete +"'>"
                            + "<i class='fa fa-times'></i>"
                            + "</a>";
                } 
            }
        ],
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
            $(nRow).attr('id',aData[0]);
        } 
    });
    initDataTableAction('datalist',uTable);
}