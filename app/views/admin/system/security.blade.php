@extends('admin.layout')
@section('content')

<!-- 内容开始 -->
<div class='page-content'>
    	<div class="row">
    		<div class="col-md-12">
    			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
    			<h3 class="page-title">
    				<?php echo Lang::get('text.contact_us');?>
    			</h3>
    			<ul class="page-breadcrumb breadcrumb">
    				<li>
                        <i class="fa fa-home"></i>
                        <a href='<?php echo asset('admin/index')?>'><?php echo Lang::get('text.dashboard')?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
    				<li>
    					<?php echo Lang::get('text.security_setting');?>
    				</li>
                    <li class="btn-group">
                        <button class="btn btn-link" onclick="goback()"><i class="fa fa-reply"></i> <?php echo Lang::get('text.back')?></button>
                    </li>
    			</ul>
    			<!-- END PAGE TITLE & BREADCRUMB-->
    		</div>
    	</div>
        <div class='row'>
            <div class='col-md-12'>
                <div class="note hide" id='cnote'>
                    <h4 class="block"><?php echo isset($success)?$success:'';?></h4>
                </div>
            </div>
        </div>
        
        <form class="form-horizontal form-row-seperated" id='security-form' action="<?php echo asset('admin/setting/password-update')?>" method='post'>
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd1')?> <span class="require">*</span></label>
                    <div class="col-md-5 col-sm-8">
                        <input type="password" class="form-control" name='old' placeholder="" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd2')?> <span class="require">*</span></label>
                    <div class="col-md-5 col-sm-8">
                        <input type="password" class="form-control" name='password' placeholder="<?php echo Lang::get('msg.new_pwd_limit')?>" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.pwd3')?> <span class="require">*</span></label>
                    <div class="col-md-5 col-sm-8">
                        <input type="password" class="form-control" name='password_confirmation' placeholder="" value="">
                    </div>
                </div>
            </div>
            <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
                            <button class="btn green btn-lg" type="button" onclick="resetpwd(this)"><?php echo Lang::get('text.submit')?></button>
                        </div>
                    </div>
                </div>
            </div>
            <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
        </form>

</div><!-- end page content -->
<!-- 内容结束 -->

@stop
@section('script')
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
    <script type="text/javascript">
    function resetpwd(obj)
    {
        $('#cnote').hide();
        doSubmit('security-form',obj,afterreset);
    }

    function afterreset(data)
    {
        $('#cnote').find('h4').html(data.msg);
        if(data.code == '1000')
        {
            $('#cnote').removeClass('note-danger').addClass('note-success').show();
        }
        else
        {
            $('#cnote').removeClass('note-success').addClass('note-danger').show();
        }
    }
    </script>
@stop