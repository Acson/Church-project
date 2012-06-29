<?php
$box1_cat = of_get_option('news_box_1');
$box2_cat = of_get_option('news_box_2');
$box3_cat = of_get_option('news_box_3');
$box4_cat = of_get_option('news_box_4');
$box5_cat = of_get_option('news_box_5');
$box6_cat = of_get_option('news_box_6');
$box7_cat = of_get_option('news_box_7');
$box8_cat = of_get_option('news_box_8');
$box9_cat = of_get_option('news_box_9');
$box10_cat = of_get_option('news_box_10');

$boxes_count = of_get_option('news_boxes_count');
if($boxes_count == 1) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
}

if($boxes_count == 2) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
}

if($boxes_count == 3) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
}

if($boxes_count == 4) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
}

if($boxes_count == 5) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
}

if($boxes_count == 6) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
    echo mom_gn_news_box($box6_cat);
    echo news_box6_banner();
}

if($boxes_count == 7) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
    echo mom_gn_news_box($box6_cat);
    echo news_box6_banner();
    echo mom_gn_news_box($box7_cat);
    echo news_box7_banner();
}

if($boxes_count == 8) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
    echo mom_gn_news_box($box6_cat);
    echo news_box6_banner();
    echo mom_gn_news_box($box7_cat);
    echo news_box7_banner();
    echo mom_gn_news_box($box8_cat);
    echo news_box8_banner();
}

if($boxes_count == 9) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
    echo mom_gn_news_box($box6_cat);
    echo news_box6_banner();
    echo mom_gn_news_box($box7_cat);
    echo news_box7_banner();
    echo mom_gn_news_box($box8_cat);
    echo news_box8_banner();
    echo mom_gn_news_box($box9_cat);
    echo news_box9_banner();
}

if($boxes_count == 10) {
    echo mom_gn_news_box($box1_cat);
    echo news_box1_banner();
    echo mom_gn_news_box($box2_cat);
    echo news_box2_banner();
    echo mom_gn_news_box($box3_cat);
    echo news_box3_banner();
    echo mom_gn_news_box($box4_cat);
    echo news_box4_banner();
    echo mom_gn_news_box($box5_cat);
    echo news_box5_banner();
    echo mom_gn_news_box($box6_cat);
    echo news_box6_banner();
    echo mom_gn_news_box($box7_cat);
    echo news_box7_banner();
    echo mom_gn_news_box($box8_cat);
    echo news_box8_banner();
    echo mom_gn_news_box($box9_cat);
    echo news_box9_banner();
    echo mom_gn_news_box($box10_cat);
    echo news_box10_banner();
}
?>