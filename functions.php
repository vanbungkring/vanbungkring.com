<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Exclude pages from search
/*-----------------------------------------------------------------------------------*/

function ithi_exclude_pages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','ithi_exclude_pages');

/*-----------------------------------------------------------------------------------*/
/*	Defines main navigation
/*-----------------------------------------------------------------------------------*/
function register_my_menus() {
  register_nav_menus(
    array('primary' => ( 'To display menu properly please select "Main menu" from list below.' ))
  );
}
add_action( 'init', 'register_my_menus' );
/*-----------------------------------------------------------------------------------*/
/*	This funnction add home button to main navigation
/*-----------------------------------------------------------------------------------*/

add_filter( 'wp_nav_menu_items', 'add_home_link', 10, 2 );
function add_home_link($items, $args) {
 
        if (is_front_page())
            $class = 'class="current-menu-item"';
        else
            $class = '';
 
        $homeMenuItem =
                '<li ' . $class . '>' .
                $args->before .
                '<a href="' . home_url( '/' ) . '" title="Beranda">' .
                $args->link_before . 'Beranda' . $args->link_after .
                '</a>' .
                $args->after .
                '</li>';
 
        $items = $homeMenuItem . $items;
 
    return $items;
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination of blog
/*-----------------------------------------------------------------------------------*/

function blog_pagination($pages = '', $range = 5)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<nav id='pagination' class='clearfix'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a  href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a  href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active-number'><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>  &rsaquo;  </a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a  href='".get_pagenum_link($pages)."'>  &raquo;  </a></li>";
         echo "</ul></nav>\n";
     }
}

/*-----------------------------------------------------------------------------------*/
/*	Function that take out paragraph tag from around img tag in WordPress
/*-----------------------------------------------------------------------------------*/

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function filter_ptags($content){
   return str_replace('<p></p>', '', $content);
}

add_filter('the_content', 'filter_ptags');

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<h5 class="aside-title">',
		'after_title' => '</h5>
			<div class="sidebar-separator"></div>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<h5 class="aside-title">',
		'after_title' => '</h5>
			<div class="sidebar-separator"></div>',
	));
}

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain ('framework');

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/

// Add the Custom Tags Widget
include("functions/custom-tags.php");

// Add the Custom Logo Widget
include("functions/custom-logo.php");

//Add the Widget 96x96 ad
include("functions/widget-ad96.php");

//Add the Widget 180x96 ad
include("functions/widget-ad180.php");

//Add latest tweets widget
include("functions/widget-tweets.php");

//Add shortcodes
include("functions/theme-shortcodes.php");

//Add theme support
add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 620;

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function styling_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
    
   				<li <?php comment_class('comment clearfix'); ?> id="comment-<?php comment_ID() ?>">
					<div class="comment-author-meta clearfix">
						<?php echo get_avatar($comment,$size='48'); ?>
						<div class="comment-author">
						<?php printf(__('%s', 'framework'), get_comment_author_link()) ?>
   						<?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)','framework') ?></span><?php } ?>
						</div>						
						<div class="comment-date"><?php printf(__('%1$s at %2$s', 'framework'), get_comment_date('Y/m/d'),  get_comment_time('G:i')) ?></div>
						<?php edit_comment_link(__('(Edit)', 'framework'),'  ','') ?>
					</div>
					<div class="comment-text clearfix"><?php comment_text() ?></div>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php if ($comment->comment_approved == '0') : ?>
         				<small class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></small>
        			  	<br />
        			  	
      				<?php endif; ?>
				</li>
<?php
}


// Load up our awesome theme options
require_once ( get_stylesheet_directory() . '/theme-options.php' );

//ADD analytis to theme hook
function blog_analytics() { 
$options = get_option('blog_theme_options');
echo $options['analytics']; 
}
add_action('wp_footer', 'blog_analytics');

?>