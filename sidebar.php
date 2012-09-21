	<?php $options = get_option('blog_theme_options');?>
<aside class="grid_4 <?php echo $options['sidebar_align']; ?>" >

		<?php if (!is_page()) : ?>            
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>            
           			
        <?php else : ?>
            			
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>            
		<?php endif; ?> 
</aside>
