<?php
function news_ticker() {
    ?>
    <?php
        
if(of_get_option('ticker_on') != false ) { ?>
<div class="inner">
    <div class="box_outer nt_bd">
    <div class="ticker_widget">
	<div class="news_ticker">
	    <div class="right_arrow"></div>
	<ul id="ticker01">
            <?php
            $ticker_display = of_get_option('ticker_display'); 
            $ticker_count = of_get_option('ticker_posts'); 
            $ticker_cat = of_get_option('ticker_category'); 
	    $ticker_custom  = of_get_option('ticker_custom');          
            ?>
        <?php if ($ticker_display == 'custom') { ?>
	<?php
	$ticker_custom = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li><span>&raquo;</span>"),trim($ticker_custom,"\n\r")).'</li>';
	echo $ticker_custom;
	?>
	<?php } else { ?>
         <?php if ($ticker_display == 'latest') { ?>
        <?php query_posts(array('showposts' => $ticker_count )); ?>
        <?php } elseif ($ticker_display == 'category') { ?>
        <?php query_posts(array('showposts' => $ticker_count, 'cat' => $ticker_cat )); ?>
        <?php } ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<li><span>&raquo;</span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
	<?php  else:  ?>
	<!-- Else in here -->
        <?php  endif; ?>
        <?php wp_reset_query(); ?>
	<?php } ?>
	</ul>
	</div><!--News Ticker-->
    </div> <!--End Widget-->
    </div> <!--box outer-->

</div> <!--End Inner-->
<?php } ?>
<?php } ?>