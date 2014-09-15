var nTable;
$(function(){

    if($('#datalist').length > 0)
    {
        initNewsList();
    }

    $('#reload-list').on('click', function(){
        if(nTable){
            nTable.fnDraw(true);
        }
    });


    if($('#news_update').length>0)
    {
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[id="con"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', '|', 'image', 'link','unlink','|','fullscreen','about']
            });
            editor2 = K.create('textarea[id="con_en"]', {
                    resizeType : 1,
                    width:'100%',
                    height:400,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : msg.base_url+"upload-img",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', '|', 'image', 'link','unlink','|','fullscreen','about']
            });
        });
        //提交表单
        $("#news_edit_btn").on('click',function(){
            $('#content').text(editor.html());
            $('#content_en').text(editor2.html());
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
        url: msg.base_url+'admin/news/change-status/'+id,
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

function initNewsList() 
{    
    if (!jQuery().dataTable) {
        return;
    }
    // begin first table
    nTable = $('#datalist').dataTable({
        "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, msg.all] // change per page values here
        ],
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": msg.base_url+"admin/news/datalist/"+$('#cid').val(),
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
                "aTargets": [ 3,4],
                "sClass": "hidden-xs",
            },
            {
                "aTargets": [ 3 ],
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
                "aTargets": [ 4 ],
                "mRender":function(data,type,full){
                    return "<a id='"+full[0]+"_edit_btn' class='btn btn-xs blue' href='"+msg.base_url+"admin/news/edit/"+full[0]+"' title='"+ lang.edit +"'>"
                            + "<i class='fa fa-pencil'></i>"
                            + "</a> "
                            + "<a id='"+full[0]+"_del_btn' class='btn btn-xs red' href='javascript:;' onclick=\"doDelete('"+ msg.base_url +"admin/news/delete/"+ full[0] +"')\" title='"+ lang.delete +"'>"
                            + "<i class='fa fa-times'></i>"
                            + "</a>";
                } 
            }
        ],
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
            $(nRow).attr('id',aData[0]);
        } 
    });
    initDataTableAction('datalist',nTable);
}