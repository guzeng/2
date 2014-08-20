@extends('admin.layout')
@section('content')

<!-- 内容开始 -->
<div class='page-content'>
    	<div class="row">
    		<div class="col-md-12">
    			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
    			<h3 class="page-title">
    				<?php echo Lang::get('text.aboutus');?>
    			</h3>
    			<ul class="page-breadcrumb breadcrumb">
    				<li>
                        <i class="fa fa-home"></i>
                        <a href='<?php echo asset('admin/index')?>'><?php echo Lang::get('text.dashboard')?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
    				<li>
    					<?php echo Lang::get('text.about_manage');?>
    					<i class="fa fa-angle-right"></i>
    				</li>
    				<li><?php echo Lang::get('text.aboutus');?></li>
                    <li class="btn-group">
                        <button class="btn btn-link" onclick="goback()"><i class="fa fa-reply"></i> <?php echo Lang::get('text.back')?></button>
                    </li>
    			</ul>
    			<!-- END PAGE TITLE & BREADCRUMB-->
    		</div>
    	</div>
        <div class='row'>
            <div class='col-md-12'>
                <?php if(isset($success)):?>
                <div class="note note-success">
                    <h4 class="block"><?php echo isset($success)?$success:'';?></h4>
                </div>
                <?php endif;?>
                <?php if(isset($error)):?>
                <div class="note note-danger">
                    <h4 class="block"><?php echo isset($error) ? $error : '';?></h4>
                </div>
                <?php endif;?>
            </div>
        </div>
        
    <form class="form-horizontal validation" method="post" action="<?php echo asset('admin/about/update')?>" id='_edit' role="form">
    	<div class="row">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type='hidden' name='type' value='aboutus'>
            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12'>
    			<div class="form-body">
    				<div class="form-group">
    					<div class="col-md-12 ">
                            <p><strong>中文版</strong></p>
    						<textarea id="content1" style="visibility:hidden;"><?=isset($value)?htmlspecialchars($value):'' ?></textarea>
                            <textarea id="content" name="content" style="display:none;"></textarea>
    					</div>
    				</div>
    			</div>
            </div>
            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12'>
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-12 ">
                            <p><strong>English</strong></p>
                            <textarea id="content2" style="visibility:hidden;"><?=isset($value_en)?htmlspecialchars($value_en):'' ?></textarea>
                            <textarea id="content_en" name="content_en" style="display:none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    	<div class="row">
            <div class="col-md-12 ">
                <div class="text-center">
                    <button id="_submit" type="submit" class="btn green btn-lg"><?php echo Lang::get('text.save');?></button> &nbsp; 
                    <button id="cancle" class="btn default btn-lg" type="button" onclick="goback()"><?php echo Lang::get('text.cancel')?></button>
                </div>
            </div>
        </div>
    </form>
</div><!-- end page content -->
<!-- 内容结束 -->

@stop

@section('script')

<!-- validation -->
<script src="<?php echo asset('assets/plugins/jquery.form.js');?>" type="text/javascript"></script>
<script src="<?php echo asset('assets/plugins/jquery-validation/jquery.validate.js');?>" type="text/javascript"></script>
<script src="<?php echo asset('assets/plugins/jquery-validation/messages_'.App::getLocale().'.js');?>" type="text/javascript"></script>
<!-- end validation -->
<!-- END:File Upload Plugin JS files-->

<link rel="stylesheet" href="<?php echo asset('assets/plugins/kindeditor-4.1.7/themes/default/default.css')?>" />
<script charset="utf-8" src="<?php echo asset('assets/plugins/kindeditor-4.1.7/kindeditor-min.js')?>"></script>
<script charset="utf-8" src="<?php echo asset('assets/plugins/kindeditor-4.1.7/lang/zh_CN.js')?>"></script>

<script type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
            editor = K.create('textarea[id="content1"]', {
                    resizeType : 1,
                    width:'100%',
                    height:500,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : "<?php echo asset('upload-img')?>",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', '|', 'image', 'link','unlink','|','fullscreen','about']
            });
            editor2 = K.create('textarea[id="content2"]', {
                    resizeType : 1,
                    width:'100%',
                    height:500,
                    allowPreviewEmoticons : false,
                    allowImageUpload : true,
                    uploadJson : "<?php echo asset('upload-img')?>",
                    items : [
                            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                            'insertunorderedlist', '|', 'image', 'link','unlink','|','fullscreen','about']
            });
    });
    $(function(){
        $('#_submit').on('click',function(){
            $('#content').text(editor.html());
            $('#content_en').text(editor2.html());
        })
    })
</script>
@stop