$(function(){
    $('#dept_list_view').on('click','.name_condition',function(){
        removeNodes();
        if(typeof($(this).parent().parent().attr('show_child'))=='undefined' || $(this).parent().parent().attr('show_child')=='true')
        {
            $(this).parent().parent().attr('show_child','false');
            $(this).find('img.fold-icon').attr('src',msg.base_url+'assets/img/plus.png');
        }
        else
        {
            $(this).parent().parent().attr('show_child','true');
            $(this).find('img.fold-icon').attr('src',msg.base_url+'assets/img/minus.png');
        }
        hide_tree_list($(this).parent().parent(),$(this).parent().parent().next());
    })
    showPop();
})

function showPop()
{
    $('.pop').popover({html:true}).on('show.bs.popover', function () {
        $('.pop[show=true]').removeAttr('show').popover('hide');
        $('div.popover').css('z-index','0');
        $(this).attr('show','true');
        $(this).parent().find('div.popover').css('z-index','1000');
    });
}

function deleteDept(uri)
{
    var uri = uri.toString().replace(/\"/g,'');

    $.ajax({
        url:uri,
        type:'get',
        dataType:'json',
        success:function(json){
            closeAlert();
            if(json.code=='1000')
            {
                showSuccess();
            }
            else if(json.code=='1002')
            {
                showLogin(json);
            }
            else
            {
                showError(json.msg);
            }
            if(typeof(json.data) != 'undefined')
            {
                $('#dept_list_view').html(json.data);
                showPop();
            }
        },
        beforeSend:function(){
            loading();
        },
        error:function(err){
        	showError();
        }

    });
}

function removeNodes(){
    $(".tr_node").remove();
}

function appendRootNode()
{
    removeNodes();
    var select = '';
    if(tree != '')
    {
        select += "<label class='radio-inline' style='padding-left: 0px;'><select id='0_parent_span' class='form-control' style='width:200px;'>";
        select += "<option value='0'>"+lang.please_choose+"</option>";
        $.each(tree,function(key,item)
        {
           var width_str = ''
            if(item.deep>0)//计算要多少空格
            {
               width_str = new Array( item.deep + 1).join("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+'|-'; 
            }
            select += "<option value='"+item.id+"' >"+width_str+item.name+"</option>";
        })
        select += "</select></label>";
    }
    var tr_html = "<tr class='tr_node'><td colspan='2'>"+
                    "<div style='margin-bottom:0'>"+select+
                        "<label class='radio-inline' style='padding-left: 0px;'><input name='name' class='form-control' id='0_name_input' maxlength='20' type='text'></label>"+
                        "<label class='radio-inline' style='padding-left: 0px;'><input name='name_en' class='form-control' id='0_name_en_input' maxlength='20' type='text'></label>"+
                        "<button id='node_add' onclick=\"updateDept(0)\" class='btn blue' type='button'>"+lang.save+"</button>"+
                        "<button id='node_cancle' onclick='removeNodes()' class='btn btn-default' type='button'>"+lang.cancel+"</button>"+
                    "</div>"+
                "</td></tr>";

    $("#add_new_node").before(tr_html);
    $("input[id='node_dept_val']").focus();
    place_holder();
}

function addDeptName(obj)
{
    var type = $(obj).attr('d_type');
    var id = $(obj).attr('d_id');
    if(typeof(type)=='undefined' || type=='' || typeof(id)=='undefined' || id=='')
    {
        return false;
    }
    var dept_name = $('#'+id+'_'+type+'_name').val();
    var name_en = $('#'+id+'_'+type+'_name_en').val();
    if(dept_name == ''){
        return false;
    }else if(dept_name.length > 20){
        showError(lang.name_limit);
        return false;
    }
    var data = {'name':dept_name,'name_en':name_en,'type':type,'id':id};
    $.ajax({
        url:msg.base_url+'admin/city/add-child',
        data:data,
        dataType:'json',
        type:'post',
        beforeSend:function(){
            $('.node_add').attr('disabled',true);
            $('#'+id+'_'+type+'_name').parent().parent().find("span.help-block").remove();
            loading();
        },
        success:function(json){
            closeAlert();
            $('.node_add').attr('disabled',false);
            if(json.code=='1000')
            {
                showSuccess();
                $('#dept_list_view').html(json.data);
                showPop();
            }
            else if(json.code=='1002')
            {
                showLogin(json);
            }
            else
            {
                if(typeof(json.error)!='undefined')
                {
                    if(json.error.name != '')
                    {
                        $('#'+id+'_'+type+'_name').parent().append("<span class='help-block re'>"+json.error.name+"<span>");
                    }
                    if(json.error.name_en != '')
                    {
                        $('#'+id+'_'+type+'_name_en').parent().append("<span class='help-block re'>"+json.error.name_en+"<span>");   
                    }
                }
                showError(json.msg);
            }
        },
        error:function(err){
            closeAlert();
            $('.node_add').attr('disabled',false);
        	showError();
        }
    })
}

function showEditName(parent_id,id)
{
    if($('#'+id+'_edit_span').length == 0)
    {
        tr_html="<span id='"+id+"_edit_span'>";
        if(tree != '')
        {
            tr_html += "<label class='radio-inline' style='padding-left: 0px;'>"+lang.parent_dept+"</label>";
            tr_html += "<label class='radio-inline' style='padding-left: 0px;'><select id='"+id+"_parent_span' class='form-control' style='width:200px;'>";
            tr_html += "<option value='0'>"+lang.please_choose+"</option>";
            var selected = '';
            $.each(tree,function(key,item){
                var width_str = ''
                if(item.id == parent_id)
                {
                    selected = 'selected';
                }
                else
                {
                    selected = '';
                }
                if(item.deep>0)//计算要多少空格
                {
                   width_str = new Array( item.deep + 1).join("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+'|-'; 
                }
                tr_html += "<option value='"+item.id+"' "+selected+">"+width_str+item.name+"</option>";
            })
            tr_html += "</select></label>";
        }
        tr_html += "<label class='radio-inline' style='padding-left: 0px;'>"+
                    "<input name='name' class='form-control' maxlength='30' id='"+id+"_name_input' type='text' value='"+$('#'+id+'_name').html()+"'>"+
                    "</label>"+
                    "<label class='radio-inline' style='padding-left: 0px;'>"+
                    "<input name='name_en' class='form-control' maxlength='30' id='"+id+"_name_en_input' type='text' value='"+$('#'+id+'_name_en').html()+"'>"+
                    "</label>"+
                    "<button onclick=\"updateDept('"+id+"')\" class='btn blue node_edit' type='button'>"+lang.save+"</button>"+
                    "<button onclick=\"cancelEdit('"+id+"')\" class='btn btn-default' type='button'>"+lang.cancel+"</button></span>";
        $('#'+id+'_name').hide().after(tr_html);
        $('#'+id+'_name_en').hide();
        $('#'+id+'_edit_span').find('input').focus();
    }
    else
    {
        cancelEdit(id);
    }

    return false;
}

function updateDept(id)
{
    if(typeof(id)=='undefined')
    {
        return false;
    }
    var name = $('#'+id+'_name_input').val();
    var name_en = $('#'+id+'_name_en_input').val();
    var parent_id = $('#'+id+'_parent_span').val();
    if(name == '')
    {
        return false;
    }
    var data = {'name':name, 'name_en':name_en, 'parent_id':parent_id, 'id':id};
    $.ajax({
        url:msg.base_url+'admin/city/update',
        data:data,
        dataType:'json',
        type:'post',
        beforeSend:function(){
            $('.node_edit').attr('disabled',true);
            $('#'+id+'_edit_span').find("span.help-block").remove();
            loading();
        },
        success:function(json){
            closeAlert();
            $('.node_edit').attr('disabled',false);
            if(json.code=='1000')
            {
                showSuccess();
                $('#dept_list_view').html(json.data);
                showPop();
            }
            else if(json.code=='1002')
            {
                showLogin(json);
            }
            else
            {
                if(typeof(json.error)!='undefined')
                {
                    if(json.error.name != '')
                    {
                        $('#'+id+'_name_input').parent().parent().append("<span class='help-block re m-l-15'>"+json.error.name+"</span>");
                    }
                    if(json.error.name_en != '')
                    {
                        $('#'+id+'_name_en_input').parent().parent().append("<span class='help-block re m-l-15'>"+json.error.name_en+"</span>");
                    }
                }
                showError(json.msg);
            }
        },
        error:function(err){
            $('.node_edit').attr('disabled',false);
            showError();
        }
    })
}

function cancelEdit(id)
{
    $('#'+id+'_edit_span').remove();
    $('#'+id+'_name').show();
    $('#'+id+'_name_en').show();
}