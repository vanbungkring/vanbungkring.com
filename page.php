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
			<?php comments_template(); ?>
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
