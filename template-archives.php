<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
		
		<!-- START #content -->
		<div id="content" class="clearfix" role="main">
			
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post() ?>
			<div class="page clearfix">
				
				<h1><?php the_title(); ?></h1>
				<div class="page-title-separator"></div>				
						
						
			<!-- START article -->					
				<?php the_content(); ?>
			<!-- END article -->
				<!--BEGIN .archive-lists -->
                            <div class="archive-lists">
                                
                                <h4><?php _e('Last 30 Posts', 'framework') ?></h4>
                                
                                <ul>
                                <?php $archive_30 = get_posts('numberposts=30');
                                foreach($archive_30 as $post) : ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                                <?php endforeach; ?>
                                </ul>
                                
                                <h4><?php _e('Archives by Month:', 'framework') ?></h4>
                                
                                <ul>
                                    <?php wp_get_archives('type=monthly'); ?>
                                </ul>
                    
                                <h4><?php _e('Archives by Subject:', 'framework') ?></h4>
                                
                                <ul>
                                    <?php wp_list_categories( 'title_li=' ); ?>
                                </ul>
                            
                            </div>
                <!--END .archive-lists -->			
			</div>
			<?php endwhile; ?>
			
			<?php else : ?>
	
			<article class="nothing">
				<h2>Nothing Found</h2>
				<p>Sorry, bot this is not here...</p>
				<p><a href="<?php echo home_url(); ?>">Homepage</a></p>
			</article>				
		
		<?php endif; ?>
										
		</div>
		<!-- END #content -->
	
	<?php get_footer(); ?>
