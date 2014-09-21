<!-- CATEGORIES START -->
<?php
    $action = Route::currentRouteAction();
    $a = explode('@', $action);
    $_action_name = $a[1];
    $a2 = explode('_', $a[0]);
    $_controller_name = isset($a2[1]) ? $a2[1] : $a2[0];
?>
<ul class="nav sidebar-categories margin-bottom-40">
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getGrude'):?>active<?endif;?>"><a href="<?php echo asset('news/grude')?>"><?php echo News::category(1)?> (<?php echo $grude_count;?>)</a></li>
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getFaq'):?>active<?endif;?>"><a href="<?php echo asset('news/faq')?>"><?php echo News::category(2)?> (<?php echo $faq_count;?>)</a></li>
    <li class="<?php if($_controller_name=='NewsController' && $_action_name=='getIndex'):?>active<?endif;?>"><a href="<?php echo asset('news')?>"><?php echo News::category(3)?> (<?php echo $news_count;?>)</a></li>
</ul>
<!-- CATEGORIES END -->

<!-- BEGIN RECENT NEWS -->                            
<h3><?php echo Lang::get('text.recent')?></h3>
<div class="recent-news margin-bottom-10">
    <?php if(!empty($recent)):?>
        <?php foreach ($recent as $k => $r):?>
            <div class=" margin-bottom-10" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                <a href='<?php echo asset('news/view/'.$r->id)?>'><?php echo App::getLocale()=='zh'?stripslashes($r->title):stripslashes($r->title_en)?></a>
            </div>
        <?php endforeach;?>
    <?endif;?>
</div>
<!-- END RECENT NEWS -->