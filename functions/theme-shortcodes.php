<?php

/*-----------------------------------------------------------------------------------*/
/*	Caption shortcode
/*-----------------------------------------------------------------------------------*/

function image_caption( $atts, $content = null ) {
   return '<div class="caption">' . do_shortcode($content) . '</div>';
}

add_shortcode('caption', 'image_caption');

/*-----------------------------------------------------------------------------------*/
/*	Serif & sans shortcode
/*-----------------------------------------------------------------------------------*/

function sans( $atts, $content = null ) {
   return '<p class="sans">' . do_shortcode($content) . '</p>';
}

add_shortcode('sans', 'sans');

function serif( $atts, $content = null ) {
   return '<p class="serif">' . do_shortcode($content) . '</p>';
}

add_shortcode('serif', 'serif');

function narrow( $atts, $content = null ) {
   return '<span class="narrow">' . do_shortcode($content) . '</span>';
}

add_shortcode('narrow', 'narrow');

function wide( $atts, $content = null ) {
   return '<span class="wide">' . do_shortcode($content) . '</span>';
}

add_shortcode('wide', 'wide');

function run( $atts, $content = null ) {
   return '<span class="run-in">' . do_shortcode($content) . '</span>';
}

add_shortcode('run', 'run');

?>