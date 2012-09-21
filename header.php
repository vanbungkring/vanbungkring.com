<!DOCTYPE html>

<!-- BEGIN HTML -->
<html <?php language_attributes(); ?>>
	
	<!-- BEGIN HEAD -->
	<head>

<!-- Meta tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Title -->
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!-- Scripts & IE covers -->

<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
<script src="js/libs/modernizr-2.0.6.min.js"></script>
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
	
<!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="js/libs/selectivizr-min.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Theme Hook -->
<?php wp_head(); ?>
</head>
<!-- END HEAD -->
<?php $options = get_option('blog_theme_options'); ?>
<body <?php body_class($options['body_background']); ?>>	 

<!-- START .container_16 -->
<div class="container_16">
	<?php if ($options['sidebar_align'] == 'left' || $options['sidebar_align'] == '' ) : ?>
	<!-- START .grid_4 -->
	<?php get_sidebar(); ?>
	<!-- END .grid_4 -->
	<?php endif; ?>
	<!-- START .grid_12 -->
	<div class="grid_12 clearfix">
		
		<!-- START .main-nav -->
		<nav class="main-nav clearfix">
		<ul id="menu-main-menu" class="menu">
		<?php wp_nav_menu(array('show_home' => 1, 'theme_location' => 'primary', 'items_wrap' => '%3$s', )); ?>
		</ul>
		</nav>
		<!-- END .main-nav -->

	