<?php get_header(); ?>
		
<!-- START #content -->
<div id="content" class="clearfix" role="main">
	
	<!-- START LOOP -->	
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post() ?>
						
	<!-- START ARTICLE -->
	<article <?php post_class('entry clearfix'); ?>>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		
		<div class="entry-content clearfix">					
			<?php the_content(false); ?>
		</div>				
	<ul class="entry-meta">
            <li class="entry-author">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
            </li>
            <li class="entry-date"><?php the_time('jS F Y'); ?></li>
            <li class="entry-categories"><?php the_category(', '); ?></li>
            <li class="entry-comments">
            <?php comments_popup_link('No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post'); ?>
            </li>
        </ul>
	</article>	
	<!-- END ARTICLE -->
			
	<?php endwhile; ?>
	
						
</div>
<!-- END #content -->

	<?php blog_pagination(); ?>	
												
	<?php endif ?>
	<!-- END LOOP -->

<?php get_footer(); ?>
