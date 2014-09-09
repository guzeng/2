<!-- CATEGORIES START -->
<?php
    $action = Route::currentRouteAction();
    $a = explode('@', $action);
    $_action_name = $a[1];
    $a2 = explode('_', $a[0]);
    $_controller_name = isset($a2[1]) ? $a2[1] : $a2[0];
?>
<ul class="nav sidebar-categories margin-bottom-40">
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getGrude'):?>active<?endif;?>"><a href="<?php echo asset('user/profile')?>"><?php echo Lang::get('text.profile')?></a></li>
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getFaq'):?>active<?endif;?>"><a href="<?php echo asset('user/address')?>"><?php echo Lang::get('text.address_using')?></a></li>
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getIndex'):?>active<?endif;?>"><a href="<?php echo asset('user/order')?>"><?php echo Lang::get('text.order_manage')?></a></li>
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getIndex'):?>active<?endif;?>"><a href="<?php echo asset('user/security')?>"><?php echo Lang::get('text.security_setting')?></a></li>
</ul>
<!-- CATEGORIES END -->

