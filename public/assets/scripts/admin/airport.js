var aTable;
$(function(){

    if($('#datalist').length > 0)
    {
        initAirportList();
    }

    $('#reload-list').on('click', function(){
        if(aTable){
            aTable.fnDraw(true);
        }
    });

});

function initAirportList() 
{    
    if (!jQuery().dataTable) {
        return;
    }
    // begin first table
    aTable = $('#datalist').dataTable({
        "sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, msg.all] // change per page values here
        ],
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": msg.base_url+"admin/airport/datalist",
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
                'aTargets': [3],
                "sClass": "hidden-xs",
            },
            {
                "aTargets": [ 3 ],
                "mRender":function(data,type,full){
                    return "<a id='"+full[0]+"_edit_btn' class='btn btn-xs blue' href='"+msg.base_url+"admin/airport/edit/"+full[0]+"' title='"+ lang.edit +"'>"
                            + "<i class='fa fa-pencil'></i>"
                            + "</a> "
                            + "<a id='"+full[0]+"_del_btn' class='btn btn-xs red' href='javascript:;' onclick=\"doDelete('"+ msg.base_url +"admin/airport/delete/"+ full[0] +"')\" title='"+ lang.delete +"'>"
                            + "<i class='fa fa-times'></i>"
                            + "</a>";
                } 
            }
        ],
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
            $(nRow).attr('id',aData[0]);
        } 
    });
    initDataTableAction('datalist',aTable);
}