<!-- CATEGORIES START -->
<?php
    $action = Route::currentRouteAction();
    $a = explode('@', $action);
    $_action_name = $a[1];
    $a2 = explode('_', $a[0]);
    $_controller_name = isset($a2[1]) ? $a2[1] : $a2[0];
?>
<ul class="nav sidebar-categories margin-bottom-40">
    <li class="<?php if($_controller_name=='AboutController' && $_action_name=='getIndex'):?>active<?endif;?>"><a href="<?php echo asset('about')?>"><?php echo Lang::get('text.aboutus')?></a></li>
    <li class="<?php if($_controller_name=='AboutController' && $_action_name=='getContact'):?>active<?endif;?>"><a href="<?php echo asset('about/contact')?>"><?php echo Lang::get('text.contact_us')?></a></li>
    <li class="<?php if($_controller_name=='JobController'):?>active<?endif;?>"><a href="<?php echo asset('job')?>"><?php echo Lang::get('text.join_us')?> (<?php echo $job_count;?>)</a></li>
</ul>
<!-- CATEGORIES END -->
