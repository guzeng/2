<!-- CATEGORIES START -->
<ul class="nav sidebar-categories margin-bottom-40">
    <li><a href="<?php echo asset('news/grude')?>"><?php echo News::category(1)?> (<?php echo $grude_count;?>)</a></li>
    <li><a href="<?php echo asset('news/faq')?>"><?php echo News::category(2)?> (<?php echo $faq_count;?>)</a></li>
    <li><a href="<?php echo asset('news')?>"><?php echo News::category(3)?> (<?php echo $news_count;?>)</a></li>
</ul>
<!-- CATEGORIES END -->

<!-- BEGIN RECENT NEWS -->                            
<h3><?php echo Lang::get('text.recent')?></h3>
<div class="recent-news margin-bottom-10">
    <?php if(!empty($recent)):?>
        <?php foreach ($recent as $k => $r):?>
            <div class=" margin-bottom-10" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                <a href='<?php echo asset('news/view/'.$r->id)?>'><?php echo $r->title?></a>
            </div>
        <?php endforeach;?>
    <?endif;?>
</div>
<!-- END RECENT NEWS -->