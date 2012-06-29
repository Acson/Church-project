<style type="text/css">
body {
<?php $body_bg = of_get_option('body_bg', false );
if ($body_bg != 'false') { ?>
<?php if ($body_bg['image']) { ?>
background-image:url('<?php echo $body_bg['image']; ?>');
<?php } ?>
<?php if ($body_bg['color']) { ?>
<?php if ($body_bg['image']) { ?>
background-color:<?php echo $body_bg['color']; ?>;
<?php } else { ?>
background:<?php echo $body_bg['color']; ?>;
<?php } ?>
<?php } ?>
<?php if ($body_bg['repeat']) { ?>
background-repeat:<?php echo $body_bg['repeat']; ?>;
<?php } ?>
<?php if ($body_bg['attachment']) { ?>
background-attachment: <?php echo $body_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
<?php $body_typo = of_get_option('body_typo', false );
if ($body_typo != 'false') { ?>
<?php if ($body_typo['color']) { ?>
color:<?php echo $body_typo['color']; ?>;
<?php } ?>
<?php if ($body_typo['size']) { ?>
font-size:<?php echo $body_typo['size']; ?>;
<?php } ?>
<?php if ($body_typo['face']) { ?>
font-family:<?php echo $body_typo['face']; ?>;
<?php } ?>
<?php if ($body_typo['style']) { ?>
font-weight: <?php echo $body_typo['style']; ?>;
<?php } ?>
<?php } ?>
}
<?php if (of_get_option('links_color')!= false) { ?>
a:link, a:visited, a:active, a:focus, .cat_article_content .article_read_more:hover, a.nb_recent_more:hover, .tweet_list li a, .news_box ul.more_news li span {
color:<?php echo of_get_option('links_color'); ?>;
}
<?php } ?>
<?php if (of_get_option('links_color_h')!= false) { ?>
a:hover, .cat_article_content .article_read_more, a.nb_recent_more, .tweet_list li a:hover, .news_box .recent_news_content span a:hover, .article_meta a:hover {
color:<?php echo of_get_option('links_color_h'); ?>;
}
<?php } ?>

.single_article_content h1 {
<?php $h1_typo = of_get_option('h1_typo', false );
if ($h1_typo != 'false') { ?>
<?php if ($h1_typo['color']) { ?>
color:<?php echo $h1_typo['color']; ?>;
<?php } ?>
<?php if ($h1_typo['size']) { ?>
font-size:<?php echo $h1_typo['size']; ?>;
<?php } ?>
<?php if ($h1_typo['face']) { ?>
font-family:<?php echo $h1_typo['face']; ?>;
<?php } ?>
<?php if ($h1_typo['style']) { ?>
font-weight: <?php echo $h1_typo['style']; ?>;
<?php } ?>
<?php } ?>
}

.single_article_content h2 {
<?php $h2_typo = of_get_option('h2_typo', false );
if ($h2_typo != 'false') { ?>
<?php if ($h2_typo['color']) { ?>
color:<?php echo $h2_typo['color']; ?>;
<?php } ?>
<?php if ($h2_typo['size']) { ?>
font-size:<?php echo $h2_typo['size']; ?>;
<?php } ?>
<?php if ($h2_typo['face']) { ?>
font-family:<?php echo $h2_typo['face']; ?>;
<?php } ?>
<?php if ($h2_typo['style']) { ?>
font-weight: <?php echo $h2_typo['style']; ?>;
<?php } ?>
<?php } ?>
}

.single_article_content h3 {
<?php $h3_typo = of_get_option('h3_typo', false );
if ($h3_typo != 'false') { ?>
<?php if ($h3_typo['color']) { ?>
color:<?php echo $h3_typo['color']; ?>;
<?php } ?>
<?php if ($h3_typo['size']) { ?>
font-size:<?php echo $h3_typo['size']; ?>;
<?php } ?>
<?php if ($h3_typo['face']) { ?>
font-family:<?php echo $h3_typo['face']; ?>;
<?php } ?>
<?php if ($h3_typo['style']) { ?>
font-weight: <?php echo $h3_typo['style']; ?>;
<?php } ?>
<?php } ?>
}

.single_article_content h4 {
<?php $h4_typo = of_get_option('h4_typo', false );
if ($h4_typo != 'false') { ?>
<?php if ($h4_typo['color']) { ?>
color:<?php echo $h4_typo['color']; ?>;
<?php } ?>
<?php if ($h4_typo['size']) { ?>
font-size:<?php echo $h4_typo['size']; ?>;
<?php } ?>
<?php if ($h4_typo['face']) { ?>
font-family:<?php echo $h4_typo['face']; ?>;
<?php } ?>
<?php if ($h4_typo['style']) { ?>
font-weight: <?php echo $h4_typo['style']; ?>;
<?php } ?>
<?php } ?>
}

.single_article_content h5 {
<?php $h5_typo = of_get_option('h5_typo', false );
if ($h5_typo != 'false') { ?>
<?php if ($h5_typo['color']) { ?>
color:<?php echo $h5_typo['color']; ?>;
<?php } ?>
<?php if ($h5_typo['size']) { ?>
font-size:<?php echo $h5_typo['size']; ?>;
<?php } ?>
<?php if ($h5_typo['face']) { ?>
font-family:<?php echo $h5_typo['face']; ?>;
<?php } ?>
<?php if ($h5_typo['style']) { ?>
font-weight: <?php echo $h5_typo['style']; ?>;
<?php } ?>
<?php } ?>
}

.single_article_content h6 {
<?php $h6_typo = of_get_option('h6_typo', false );
if ($h6_typo != 'false') { ?>
<?php if ($h6_typo['color']) { ?>
color:<?php echo $h6_typo['color']; ?>;
<?php } ?>
<?php if ($h6_typo['size']) { ?>
font-size:<?php echo $h6_typo['size']; ?>;
<?php } ?>
<?php if ($h6_typo['face']) { ?>
font-family:<?php echo $h6_typo['face']; ?>;
<?php } ?>
<?php if ($h6_typo['style']) { ?>
font-weight: <?php echo $h6_typo['style']; ?>;
<?php } ?>
<?php } ?>
}
/*#header .logo {
    margin-top:<?php //echo of_get_option('logo_margin_top'); ?>px;
}
*/
/*******************************************************************
 *      Colors Start Here 
 *****************************************************************/
/*    Topbar & bottombar     */
.top_bar, .top_bar ul.top_nav li ul, .bottom_bar {
<?php $topbar_bg = of_get_option('topbar_bg', false );
if ($topbar_bg != 'false') { ?>
<?php if ($topbar_bg['image']) { ?>
background-image:url('<?php echo $topbar_bg['image']; ?>');
box-shadow: 0 0px 0px 0 #3C4048 inset;
<?php } ?>
<?php if ($topbar_bg['color']) { ?>
background-color:<?php echo $topbar_bg['color']; ?>;
box-shadow: 0 0px 0px 0 #3C4048 inset;
<?php } ?>
<?php if ($topbar_bg['repeat']) { ?>
background-repeat:<?php echo $topbar_bg['repeat']; ?>;
<?php } ?>
<?php if ($topbar_bg['attachment']) { ?>
background-attachment: <?php echo $topbar_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
}
<?php if (of_get_option('topnav_tx')!= false) { ?>
.top_bar ul.top_nav li a, .bottom_bar a, .bottom_bar p.copyrights {
color:<?php echo of_get_option('topnav_tx'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_tx_h')!= false) { ?>
.top_bar ul.top_nav li a:hover {
color:<?php echo of_get_option('topnav_tx_h'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_dd_bc')!= false) { ?>
.top_bar ul.top_nav li ul, .top_bar ul.top_nav li ul li {
border-color:<?php echo of_get_option('topnav_dd_bc'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_sb_bg')!= false) { ?>
.top_bar .search_box {
background:<?php echo of_get_option('topnav_sb_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_sb_bd')!= false) { ?>
.top_bar .search_box, .top_bar .search_box .sf {
border-color:<?php echo of_get_option('topnav_sb_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_sb_tx')!= false) { ?>
.top_bar .search_box .sf {
color:<?php echo of_get_option('topnav_sb_tx'); ?>;
}
<?php } ?>
<?php if (of_get_option('topnav_sb_ico')!= false) { ?>
.top_bar .search_box .sb {
    background-image: url("<?php echo of_get_option('topnav_sb_ico'); ?>");
}
<?php } ?>
/*  Header  */
#header {
<?php $header_bg = of_get_option('header_bg', false );
if ($header_bg != 'false') { ?>
<?php if ($header_bg['image']) { ?>
background-image:url('<?php echo $header_bg['image']; ?>');
<?php } ?>
<?php if ($header_bg['color']) { ?>
background-color:<?php echo $header_bg['color']; ?>;
<?php } ?>
<?php if ($header_bg['repeat']) { ?>
background-repeat:<?php echo $header_bg['repeat']; ?>;
<?php } ?>
<?php if ($header_bg['attachment']) { ?>
background-attachment: <?php echo $header_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
}
<?php if (of_get_option('topnav_bd_bt')!= false) { ?>
#header .top_line {
background:<?php echo of_get_option('topnav_bd_bt'); ?>;
}
<?php } ?>
/*      Navigation      */
<?php if (of_get_option('navi_bg_bt')!= false) { ?>
#navigation {
    background:<?php echo of_get_option('navi_bg_bt'); ?>;
}
<?php } ?>
#navigation .nav_wrap {
<?php $navi_bg = of_get_option('navi_bg', false );
if ($navi_bg != 'false') { ?>
<?php if ($navi_bg['image']) { ?>
background-image:url('<?php echo $navi_bg['image']; ?>');
<?php } ?>
<?php if ($navi_bg['color']) { ?>
<?php if ($navi_bg['image']) { ?>
background-color:<?php echo $navi_bg['color']; ?>;
<?php } else { ?>
background:<?php echo $navi_bg['color']; ?>;
<?php } ?>
<?php } ?>
<?php if ($navi_bg['repeat']) { ?>
background-repeat:<?php echo $navi_bg['repeat']; ?>;
<?php } ?>
<?php if ($navi_bg['attachment']) { ?>
background-attachment: <?php echo $navi_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
}
<?php if (of_get_option('navi_bd')!= false) { ?>
#navigation ul.nav > li, #navigation ul.nav > li:first-child {
border-color:<?php echo of_get_option('navi_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('navi_links')!= false) { ?>
#navigation ul.nav > li a {
color:<?php echo of_get_option('navi_links'); ?>;
}
<?php } ?>
<?php if (of_get_option('navi_links_h')!= false) { ?>
#navigation ul.nav li:hover > a, #navigation ul.nav > li.current-menu-item > a, #navigation ul.nav > li.current-menu-ancestor > a, #navigation ul.nav li.home:hover > a, #navigation ul.nav > li.home.current-menu-item > a, #navigation ul.nav > li.home.current-menu-ancestor > a {
color:<?php echo of_get_option('navi_links_h'); ?>;
}
<?php } ?>
<?php if (of_get_option('navi_links_h_bg')!= false) { ?>
#navigation ul.nav li:hover > a, #navigation ul.nav > li.current-menu-item > a, #navigation ul.nav > li.current-menu-ancestor > a, #navigation ul.nav li.home:hover > a, #navigation ul.nav > li.home.current-menu-item > a, #navigation ul.nav > li.home.current-menu-ancestor > a,  #navigation ul.nav li ul li {
background-color:<?php echo of_get_option('navi_links_h_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('navi_links_dd')!= false) { ?>
#navigation ul.nav li ul li a {
color:<?php echo of_get_option('navi_links_dd'); ?>;
}
<?php } ?>
#navigation ul.nav li ul li a:hover {
color:<?php echo of_get_option('navi_links_dd_h'); ?>;
<?php $navi_bg = of_get_option('navi_bg', false );
if ($navi_bg != 'false') { ?>
<?php if ($navi_bg['image']) { ?>
background-image:url('<?php echo $navi_bg['image']; ?>');
<?php } ?>
<?php if ($navi_bg['color']) { ?>
background-color:<?php echo $navi_bg['color']; ?>;
<?php } ?>
<?php if ($navi_bg['repeat']) { ?>
background-repeat:<?php echo $navi_bg['repeat']; ?>;
<?php } ?>
<?php if ($navi_bg['attachment']) { ?>
background-attachment: <?php echo $navi_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
}
<?php if (of_get_option('navi_links_dd_bd')!= false) { ?>
#navigation ul.nav li ul li {
border-color:<?php echo of_get_option('navi_links_dd_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('navi_bt_bd')!= false) { ?>
#navigation, #navigation ul.nav li ul li {
border-color:<?php echo of_get_option('navi_bt_bd'); ?>;
}
<?php } elseif (of_get_option('topnav_bd_bt')!= false) { ?>
#navigation {
border-color:<?php echo of_get_option('topnav_bd_bt'); ?>;
}
<?php } ?>
/*     Feature      */
<?php if (of_get_option('feature_bg')!= false) { ?>
.Feature_news {
background:<?php echo of_get_option('feature_bg'); ?>;
}
<?php } elseif(of_get_option('widgets_bg')!= false) { ?>
.Feature_news {
background:<?php echo of_get_option('widgets_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('feature_bd')!= false) { ?>
.Feature_news, ul.slider_nav, ul.slider_nav li.activeSlide a img, #feature_outer {
border-color:<?php echo of_get_option('feature_bd'); ?>;
}
<?php } elseif (of_get_option('widgets_bd')!= false) { ?>
.Feature_news, ul.slider_nav, ul.slider_nav li.activeSlide a img, #feature_outer {
border-color:<?php echo of_get_option('widgets_bd'); ?>;
}
<?php } ?>
/*     Widgets  */
.sidebar .widget, .lates_video_news, .news_box, .cat_article, .ticker_widget {
<?php if (of_get_option('widgets_bg')!= false) { ?>
background:<?php echo of_get_option('widgets_bg'); ?>;
<?php } ?>
<?php if (of_get_option('widgets_bd')!= false) { ?>
border-color:<?php echo of_get_option('widgets_bd'); ?>;
<?php } ?>
}
<?php if (of_get_option('widgets_bd')!= false) { ?>
.sidebar .widget .widget_content, .sidebar .widget ul li, .latest_vids_wrap, .lates_video_item, .sidebar .mom_posts_images div a, .sidebar .flickr_badge_wrapper div a, .sidebar .widget ul.blog_posts_widget li img, .news_box, .cat_article_img, .box_outer, .left_ul ul.more_news, .cat_title {
border-color:<?php echo of_get_option('widgets_bd'); ?>;
}
<?php } ?>
.sidebar .widget .widget_title, .lates_video_news .widget_title {
<?php if (of_get_option('widgets_t_bg')!= false) { ?>
background:<?php echo of_get_option('widgets_t_bg'); ?>;
<?php } ?>
<?php if (of_get_option('widgets_t_tx')!= false) { ?>
color:<?php echo of_get_option('widgets_t_tx'); ?>;
<?php } ?>
}
/*  NewsBox */
<?php if (of_get_option('widgets_bd')!= false) { ?>
.news_box .news_box_heading, .news_box .recent_news_img,.news_box .news_box_right, .container, .single_article_content img:not(.wp-smiley),  .slideshow_control, .cat_article_title, .nb2_next2_news li, .sidebar .widget .wid_border  {
border-color:<?php echo of_get_option('widgets_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('nb_t_tx')!= false) { ?>
.news_box .news_box_heading h2, .news_box .news_box_heading h2 a, .cat_article_title a, .cat_article_title {
color:<?php echo of_get_option('nb_t_tx'); ?>; 
}
<?php } ?>

<?php if (of_get_option('nb_t_bg')!= false) { ?>
.news_box .news_box_heading, .news_box .news_box_right, .news_box .news_box_heading h2, .cat_article_title, .nb2_next2_news li {
background:<?php echo of_get_option('nb_t_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('nb_dots')!= false) { ?>
.dots, .news_box .news_box_heading .nb_dots, .brdr3 {
background-image:url('<?php echo of_get_option('nb_dots'); ?>');
}
<?php } ?>
<?php if (of_get_option('article_meta')!= false) { ?>
.article_meta , .news_box .recent_news_content span, .news_box .recent_news_content span a{
color:<?php echo of_get_option('article_meta'); ?>;
}
<?php } ?>
<?php if (of_get_option('article_meta_bd')!= false) { ?>
.article_meta {
border-color:<?php echo of_get_option('article_meta_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('share_bg')!= false) { ?>
.cat_article_share, .single_share {
background-color:<?php echo of_get_option('share_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('share_bd')!= false) { ?>
.cat_article_share, .single_share {
border-color:<?php echo of_get_option('share_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('comment_bg')!= false) { ?>
.commentlist li .comment_wrapper, .author_box, .related_box {
background-color:<?php echo of_get_option('comment_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('comment_bd')!= false) { ?>
.commentlist li .comment_wrapper, .author_box, .author_box .avatar, .author_box .author_info, .user_avatar, .user_avatar img, a.comment-reply-link, .related_box, .related_box ul li.related_item .related_image img {
border-color:<?php echo of_get_option('comment_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_bg')!= false) { ?>
#footer {
background-color:<?php echo of_get_option('footer_bg'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_bd')!= false) { ?>
#footer, .footer_wrap {
border-color:<?php echo of_get_option('footer_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_bd')!= false) { ?>
.foot_border {
background-color:<?php echo of_get_option('footer_bd'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_w_t')!= false) { ?>
#footer .widget .widget_title {
color:<?php echo of_get_option('footer_w_t'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_tx')!= false) { ?>
.footer_wrap, #footer a:link, #footer a:visited, #footer a:active, #footer a:focus  {
color:<?php echo of_get_option('footer_tx'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_tx_h')!= false) { ?>
#footer a:hover  {
color:<?php echo of_get_option('footer_tx_h'); ?>;
}
<?php } ?>
<?php if (of_get_option('cat_t_tx')!= false) { ?>
.cat_title {
color:<?php echo of_get_option('cat_t_tx'); ?>;
}
<?php } ?>
<?php if (of_get_option('footer_social_icon')!= false) { ?>
.bottom_bar ul.social_icons li a {
    background:url(<?php echo of_get_option('footer_social_icon'); ?>) no-repeat;
}
<?php } ?>
/* News Ticker */
<?php if (of_get_option('nt_bd')!= false) { ?>
.nt_bd {
border-color:<?php echo of_get_option('nt_bd'); ?>;
}
<?php } ?>
.ticker_widget {
<?php if (of_get_option('nt_bg')!= false) { ?>
background-color:<?php echo of_get_option('nt_bg'); ?>;
<?php } ?>
<?php if (of_get_option('nt_bd')!= false) { ?>
border-color:<?php echo of_get_option('nt_bd'); ?>;
<?php } ?>
}
<?php if (of_get_option('nt_arrow')!= false) { ?>
.ticker_widget .right_arrow {
        background:url(<?php echo of_get_option('nt_arrow'); ?>) no-repeat;
}
<?php } ?>
ul#ticker01 li a {
<?php $nt_font = of_get_option('nt_font', false );
if ($nt_font != 'false') { ?>
<?php if ($nt_font['color']) { ?>
color:<?php echo $nt_font['color']; ?>;
<?php } ?>
<?php if ($nt_font['size']) { ?>
font-size:<?php echo $nt_font['size']; ?>;
<?php } ?>
<?php if ($nt_font['face']) { ?>
font-family:<?php echo $nt_font['face']; ?>;
<?php } ?>
<?php if ($nt_font['style']) { ?>
font-weight: <?php echo $nt_font['style']; ?>;
<?php } ?>
<?php } ?>
}
<?php if (of_get_option('nt_text_h')!= false) { ?>
ul#ticker01 li a:hover {
    color:<?php echo of_get_option('nt_text_h'); ?>;
}
<?php } ?>

<?php if (of_get_option('nt_da')!= false) { ?>
ul#ticker01 li span {
    color:<?php echo of_get_option('nt_da'); ?>;
}
<?php } ?>
/* News Ticker */
<?php if ( is_page_template('fixed-home.php') ) { ?>
.fixed {
width:1012px;
margin:0 auto;
-webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
margin-bottom:20px;
background:#fff;
}
#full_bg {
position:fixed;
left:0;
top:0;
z-index:-1;
min-width:100%;
min-height:100%;
}
<?php } else { ?>
<?php if(of_get_option('theme_layout') == 'fixed') { ?>
.fixed {
width:1012px;
margin:0 auto;
-webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
margin-bottom:20px;
background:#fff;
}
#full_bg {
position:fixed;
left:0;
top:0;
z-index:-1;
min-width:100%;
min-height:100%;
}
<?php } ?>
<?php } ?>
<?php if(of_get_option('ar_ani_icons') == false) { ?>
.nb_video_icon, .nb_slide_icon, .nb_article_icon, .ca_video_icon, .ca_slide_icon, .ca_article_icon, span.video_icon, span.slide_icon, .feature_video_icon, .feature_slide_icon, .feature_article_icon {
    display:none;
}
.fixed {
<?php $fixed_in_bg = of_get_option('fixed_in_bg', false );
if ($fixed_in_bg != 'false') { ?>
<?php if ($fixed_in_bg['image']) { ?>
background-image:url('<?php echo $fixed_in_bg['image']; ?>');
<?php } ?>
<?php if ($fixed_in_bg['color']) { ?>
<?php if ($fixed_in_bg['image']) { ?>
background-color:<?php echo $fixed_in_bg['color']; ?>;
<?php } else { ?>
background:<?php echo $fixed_in_bg['color']; ?>;
<?php } ?>
<?php } ?>
<?php if ($fixed_in_bg['repeat']) { ?>
background-repeat:<?php echo $fixed_in_bg['repeat']; ?>;
<?php } ?>
<?php if ($fixed_in_bg['attachment']) { ?>
background-attachment: <?php echo $fixed_in_bg['attachment']; ?>;
<?php } ?> 
<?php } ?>
}

<?php } ?>

<?php if(of_get_option('theme_skin') == 'dark') { ?>
<?php if(is_rtl()) { ?>
.ticker_widget .right_arrow {
   background:url(<?php echo get_stylesheet_directory_uri(); ?>/images/dark/right_arrow_rtl.png) no-repeat;
}
<?php } ?>
<?php if(of_get_option('theme_layout') == 'fixed') { ?>
    .fixed {
        background:#1f1f1f;
    }
<?php } ?>
<?php } ?>

<?php if (of_get_option('post_full') != false || get_post_meta($post->ID, 'mom_full_width', true) ) { ?>
.single_article_content img {
    max-width: 936px;
}
.add_comment textarea {
    width: 914px;
}
<?php } ?>
<?php if (of_get_option('share_twitter') == false && of_get_option('share_gplus') == false && of_get_option('share_facebook') == false ) { ?>
.cat_article_share {
    display:none;
}
<?php } ?>

<?php echo of_get_option('c_css'); ?>
</style>