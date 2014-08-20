$(function(){
    if($('#datalist').length > 0)
    {
        initOrderList();
    }

    $('#reload-list').on('click', function(){
        initOrderList();
    });

});

function changeStatus(id)
{
    if(typeof(id)=='undefined')
    {
        return false;
    }
    $.ajax({
        url: msg.base_url+'admin/order/change-status/'+id,
        dataType:'json',
        success:function(json){
            closeAlert();
            if(json.code=='1000')
            {
                $('#change_btn').remove();
                $('#del_btn').remove();
                $('#'+json.id+'_del_btn').remove();
                $('#status').html(json.status);
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

function initOrderList() 
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
        "sAjaxSource": msg.base_url+"admin/order/datalist",
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
                'aTargets': [6,8,11]
            },
            {
                "aTargets": [ 3,4,5,6,7,8],
                 "sClass": "hidden-xs",
            },
            {
                "aTargets": [ 9,10,11 ],
                 "sClass": "hidden-xs hidden-sm",
            },
            {
                "aTargets": [ 1 ],
                "mRender":function(data,type,full){
                    return  "<a class='' href='javascript:;' onclick=\"load_modal('"+ msg.base_url +"admin/order/detail/"+ full[0] +"')\" >"
                                + data
                                + "</a>";
                } 
            },
            {
                "aTargets": [ 11 ],
                "mRender":function(data,type,full){
                    if(data=='true')
                    {
                        return  "<a id='"+full[0]+"_del_btn' class='btn btn-xs red' href='javascript:;' onclick=\"doDelete('"+ msg.base_url +"admin/order/delete/"+ full[0] +"')\" title='"+ lang.delete +"'>"
                                + "<i class='fa fa-times'></i>"
                                + "</a>";
                    }
                    return '';
                } 
            }
        ],
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
            $(nRow).attr('id',aData[0]);
        } 
    });
    initDataTableAction('datalist',uTable);
}