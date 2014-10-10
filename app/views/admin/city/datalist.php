<script type="text/javascript">
    $(function(){
        tree = <?php echo json_encode($tree);?>;
    });
</script>
<table class="table table-hover table-dotted table-full-width">
    <tbody> 
        <?php if(isset($tree) && !empty($tree)): ?>
            <?php foreach($tree as $item):?>
                <tr id="add_new_childNode_<?php echo $item['id'] ?>" parent="<?php echo $item['parent_id']?>" deep="<?php echo $item['deep']?>">
                    <td>
                        <div class='name_condition' id='<?php echo $item['id'] ?>_name_condition' style="cursor:default;margin-left:<?php echo $item['deep']*50?>px">
                        <?php if($item['hasChild']):?>
                            <img style="max-width:none;" src='<?php echo asset('assets/img/minus.png');?>' class='fold-icon'>
                        <?php else:?>
                            <i class="dot"></i>&nbsp;
                        <?php endif;?>
                            <span id='<?php echo $item['id'] ?>_name'><?php echo stripslashes($item['name']);?></span> 
                            <span id='<?php echo $item['id'] ?>_name_en'><?php echo stripslashes($item['name_en']);?></span>
                        </div>
                    </td>
                    <td class="hidden-xs text-right">
                            <button id='<?php echo $item['id'] ?>-popover' data-placement='left' class="btn btn-xs yellow pop" title="<?php echo Lang::get('text.add_city');?>" 
                                
                                    data-content="<div class='panel panel-default'>
                                            <div class='panel-heading'><?php echo Lang::get('text.name');?></div>
                                            <div class='panel-body' style='padding:10px;'>
                                            <div class='input-append'>
                                            <label class='' style='padding-left: 0px;'>
                                                <?php echo Lang::get('text.zh')?>:<input name='child_name' class='form-control' id='<?php echo $item['id'] ?>_child_name' maxlength='20' type='text' style='padding:0px'>
                                            </label>
                                            <label class='' style='padding-left: 0px;'>
                                                <?php echo Lang::get('text.en')?>:<input name='child_name_en' class='form-control' id='<?php echo $item['id'] ?>_child_name_en' maxlength='20' type='text' style='padding:0px'>
                                            </label>
                                            <button d_type='child' d_id='<?php echo $item['id'] ?>' onclick='addDeptName(this)' class='btn blue node_add' type='button'><?php echo Lang::get('text.save');?></button>
                                            </div>
                                            </div>
                                            </div>"
                                ><i class="fa fa-plus"></i>
                            </button>
                            <a class="btn btn-xs blue btn-editable" href="javascript:;" onclick="showEditName('<?php echo $item['parent_id'];?>','<?php echo $item['id'];?>')" title="<?php echo Lang::get('text.edit');?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs red btn-removable" href="javascript:;" onclick="confirmDialog(msg.delete_confirm, msg.sure_to_delete, deleteDept, '<?php echo asset('admin/city/delete/'.$item['id']);?>')" title="<?php echo Lang::get('text.delete');?>">
                                <i class="fa fa-times"></i>
                            </a>
                    </td>
                </tr>
            <?php endforeach;?>
            <tr id="add_new_node">
                <td colspan='2'>
                    <a class="btn" style="padding-left: 0px;" href='javascript:void(0)' onclick="appendRootNode()">
                        <i class="fa fa-plus"></i>
                        <?php echo Lang::get('text.add_city');?>
                    </a>
                </td>
            </tr>
        <?php else:?>
            <tr id="add_new_node"><td>
                <?php echo Lang::get('msg.no_data');?>
            </td>
        </tr>
        <?php endif?>
    </tbody>
</table>