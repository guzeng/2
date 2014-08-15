@extends('admin.layout')
@section('content')

<!-- 内容开始 -->
<div class='page-content'>
    <form class="form-horizontal validation" method="post" action="<?php echo asset('admin/setting/update')?>" id='system_edit' role="form" onsubmit="return false;">
    	<div class="row">
    		<div class="col-md-12">
    			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
    			<h3 class="page-title">
    				<?php echo Lang::get('text.system_manage');?>
    			</h3>
    			<ul class="page-breadcrumb breadcrumb">
    				<li>
                        <i class="fa fa-home"></i>
                        <a href='<?php echo asset('admin/index')?>'><?php echo Lang::get('text.dashboard')?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
    				<li>
    					<?php echo Lang::get('text.system_manage');?>
    					<i class="fa fa-angle-right"></i>
    				</li>
    				<li><?php echo Lang::get('text.system_setting');?></li>
                    <li class="btn-group">
                        <button class="btn btn-link" onclick="goback()"><i class="fa fa-reply"></i> <?php echo Lang::get('text.back')?></button>
                    </li>
    			</ul>
    			<!-- END PAGE TITLE & BREADCRUMB-->
    		</div>
    	</div>
    	<div class="row">
    			<input type='hidden' id='logo_pic_path' name='logo_pic_path' value="">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    			<div class="col-md-12">
    				<!-- BEGIN SAMPLE FORM PORTLET-->   
    				<div class="portlet box blue ">
    					<div class="portlet-title">
    						<div class="caption">
    							<i class="fa fa-list"></i><?php echo Lang::get('text.company_message');?>
    						</div>
    						<div class="tools">
    							<a href="" class="collapse"></a>
    						</div>
    					</div>
    					<div class="portlet-body form">
    						<div class="form-body">
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.website_name');?></label>
    								<div class="col-md-7">
    									<input type="text" id="website_name" name="website_name" value="<?php echo  isset($data['website_name']) ? $data['website_name'] : '';?>" class="form-control" maxlength="100">
                                        <span class="help-block" for='website_name'></span>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.website_title')?></label>
    								<div class="col-md-7">
    									<input type="text" id="website_title" name="website_title" value="<?php echo  isset($data['website_title']) ? $data['website_title'] : '';?>"  class="form-control"  maxlength="100">
                                        <span class="help-block" for='website_title'></span>
    								</div>
    							</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.website_keyword')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="website_keyword" name="website_keyword" value="<?php echo  isset($data['website_keyword']) ? $data['website_keyword'] : '';?>"  class="form-control"  maxlength="100">
                                        <span class="help-block" for='website_keyword'></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.website_description')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="website_description" name="website_description" value="<?php echo  isset($data['website_description']) ? $data['website_description'] : '';?>"  class="form-control"  maxlength="100">
                                        <span class="help-block" for='website_description'></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.copy_right')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="copyright" name="copyright" value="<?php echo  isset($data['copyright']) ? $data['copyright'] : '';?>"  class="form-control"  maxlength="100">
                                        <span class="help-block" for='copyright'></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.icp')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="icp" name="icp" value="<?php echo  isset($data['icp']) ? $data['icp'] : '';?>"  class="form-control"  maxlength="100">
                                        <span class="help-block" for='icp'></span>
                                    </div>
                                </div>
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.logo')?></label>
    								<div class="col-md-7"> 
                                        <img src="<?php echo file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'logo.png') ? asset('uploads/logo.png') : asset('assets/img/logo.png')?>" alt="logo" class="img-responsive logo"  id='logo_setting_pic' />
                  
                                        <div class='clearfix'></div>
    									<div class="margin-t-5 float-left">
											<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
											<div class="row fileupload-buttonbar">
												<div class="col-lg-7" style="margin-top:10px;">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn blue fileinput-button">
													<i class="fa fa-plus"></i>
													<span><?php echo Lang::get('text.upload')?></span>
													<input id="system_edit_upload" type="file" name="files[]" multiple="">
													</span>
												</div>
											</div>
    									</div>
    									<div class='clearfix'></div>
                                        <div class="progress progress-striped active hide" id="upload-loading">
                                            <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                        <p class="help-block"><?php echo Lang::get('text.logo1')?>,<?php echo Lang::get('text.logo2')?>,<?php echo Lang::get('text.logo3')?></p>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div><!-- END SAMPLE FORM PORTLET-->
    			</div><!-- end col -->
    			<div class="col-md-12">
    				<!-- BEGIN SAMPLE FORM PORTLET-->   
    				<div class="portlet box blue ">
    					<div class="portlet-title">
    						<div class="caption">
    							<i class="fa fa-list"></i><?php echo Lang::get('text.contact_us');?>
    						</div>
    						<div class="tools">
    							<a href="" class="collapse"></a>
    						</div>
    					</div>
    					<div class="portlet-body form">
    						<div class="form-body">
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.hotline')?></label>
    								<div class="col-md-7">
    									<input type="text" id="hotline" name="hotline" value="<?php echo  isset($data['hotline']) ? $data['hotline'] : '';?>" class="form-control" maxlength="100">
                                        <span class="help-block" for='hotline'></span>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.contact_phone')?></label>
    								<div class="col-md-7">
    									<input type="text" id="phone" name="phone" value="<?php echo  isset($data['phone']) ? $data['phone'] : '';?>" class="form-control" maxlength="100">
                                        <span class="help-block" for='phone'></span>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-md-3 control-label"><?php echo Lang::get('text.contact_email')?></label>
    								<div class="col-md-7">
                                        <div class="input-icon">
                                            <i class="fa fa-envelope"></i>
        									<input type="email" id="email" name="email" value="<?php echo  isset($data['email']) ? $data['email'] : '';?>" class="form-control" maxlength="100">
                                        </div>
                                        <span class="help-block" for='email'></span>
    								</div>
    							</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.address')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="address" name="address" value="<?php echo  isset($data['address']) ? $data['address'] : '';?>" class="form-control" maxlength="200">
                                        <span class="help-block" for='address'></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo Lang::get('text.post')?></label>
                                    <div class="col-md-7">
                                        <input type="text" id="post" name="post" value="<?php echo  isset($data['post']) ? $data['post'] : '';?>" class="form-control" maxlength="20">
                                        <span class="help-block" for='post'></span>
                                    </div>
                                </div>
    						</div>
    					</div>
    				</div><!-- END SAMPLE FORM PORTLET-->
    			</div><!-- end col -->
    	</div><!-- end row -->
    	<div class="row">
            <div class="col-md-12">
                <div class="form-actions">
                    <div class="text-center">
                        <button id="system_submit" type="button" class="btn green btn-lg"><?php echo Lang::get('text.save');?></button> &nbsp; 
                        <button id="cancle" class="btn default btn-lg" type="button" onclick="goback()"><?php echo Lang::get('text.cancel')?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><!-- end page content -->
<!-- 内容结束 -->

@stop

@section('script')
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo asset('assets/plugins/fancybox/source/jquery.fancybox.css');?>" rel="stylesheet" />
<link href="<?php echo asset('assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css');?>" rel="stylesheet" />
<!-- END PAGE LEVEL STYLES -->

<!-- validation -->
<script src="<?php echo asset('assets/plugins/jquery.form.js');?>" type="text/javascript"></script>
<script src="<?php echo asset('assets/plugins/jquery-validation/jquery.validate.js');?>" type="text/javascript"></script>
<script src="<?php echo asset('assets/plugins/jquery-validation/messages_'.App::getLocale().'.js');?>" type="text/javascript"></script>
<!-- end validation -->

<!-- BEGIN:File Upload Plugin JS files-->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <p class="size">{%=o.formatFileSize(file.size)%}</p>
                {% if (!o.files.error) { %}
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                {% } %}
            </td>
            <td>
                {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                    <button class="btn blue start">
                        <i class="fa fa-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn red cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn red delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="fa fa-trash-o"></i>
                        <span>Delete</span>
                    </button>
                {% } else { %}
                    <button class="btn yellow cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js');?>" type="text/javascript"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js');?>" type="text/javascript"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/vendor/load-image.min.js');?>" type="text/javascript"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js');?>" type="text/javascript"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js');?>" type="text/javascript"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload.js');?>" type="text/javascript"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js');?>" type="text/javascript"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js');?>" type="text/javascript"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js');?>" type="text/javascript"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js');?>" type="text/javascript"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js');?>" type="text/javascript"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js');?>" type="text/javascript"></script>
<!-- The main application script -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?php echo asset('assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js');?>" type="text/javascript"></script>
<![endif]-->
<!-- END:File Upload Plugin JS files-->
<script src="<?php echo asset('assets/scripts/admin/setting.js')?>"></script> 
@stop