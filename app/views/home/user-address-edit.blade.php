@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 m-h-500">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-2 col-sm-3 blog-sidebar">
                    <?php echo $left?>
                </div>
                <!-- END RIGHT SIDEBAR -->       
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-10 col-sm-9 blog-posts">
                    <h3 class='m-b-20'><?php echo Lang::get('text.address_using');?></h3>
                    <hr>
                        <form class="form-horizontal form-row-seperated" id='address-form' action="<?php echo asset('user/address-update')?>" method='post'>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.shipper')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="text" class="form-control" name='shipper' maxLength='50' placeholder="" value="<?php echo isset($address)?$address->shipper:'';?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.ship_city')?><span class="required">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <select name="city_id" id="city_id" class="form-control">
                                            <?php foreach($allCity as $key => $v):?>
                                            <option <?if(isset($address) && $address->city_id==$v->id):?>selected<?endif;?> value="<?php echo $v->id?>"><?php echo $v->name;?></option>
                                            <?endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.address')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="text" class="form-control" name='address' maxLength='200' placeholder="" value="<?php echo isset($address)?$address->address:'';?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3"><?php echo Lang::get('text.mobile')?> <span class="require">*</span></label>
                                    <div class="col-md-5 col-sm-8">
                                        <input type="text" class="form-control" name='phone' maxLength='20' placeholder="" value="<?php echo isset($address)?$address->phone:'';?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-md-offset-2 col-lg-offset-2 col-sm-8 col-md-8 col-lg-8 ">
                                        <div class="checkbox-inline">
                                            <label>
                                                <input type="checkbox" name='is_default' id='is_default' value='1' <?php if(isset($address)&&$address->is_default=='1'):?>checked='checked'<?php endif;?> > <?php echo Lang::get('text.default_address')?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
                                            <button class="btn green btn-lg" type="button" onclick="doSubmit('address-form',this)"><?php echo Lang::get('text.submit')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type='hidden' name='id' value="<?php echo isset($address)?$address->id:'';?>" >
                            <input type='hidden' name='_token' value="<?php echo csrf_token(); ?>" >
                        </form>
                </div>
                <!-- END LEFT SIDEBAR -->
     
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@stop

@section('script')
    <?php echo HTML::script('assets/plugins/jquery.form.js');?>
@stop