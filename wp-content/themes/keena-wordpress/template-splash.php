<?php
/*
	Template Name: Splash Page
	Template Post Type: post, page
*/

$cookie_name = "visitedSplash";
$cookie_value = "true";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

get_header();
the_post();
binarym_block_builder();
get_footer();