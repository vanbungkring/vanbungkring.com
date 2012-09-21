	<?php $options = get_option('blog_theme_options');?>
	<footer class="clearfix <?php echo $options['sidebar_align']; ?>">
		<p class="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> &middot; <?php _e('Powered by', 'framework') ?> <a href="http://wordpress.org/">WordPress</a><br />
		 <?php echo $options['footer_text']; ?></p>
		 </p>
	</footer>
		</div>
	<!-- END .grid_12 -->
	<?php if ($options['sidebar_align'] == 'right') : ?>
	<!-- START .grid_4 -->
	<?php get_sidebar(); ?>
	<!-- END .grid_4 -->
	<?php endif; ?>
</div>
<!-- END .container_16 -->

<!-- Theme Hook -->
<?php wp_footer(); ?>

</body>
</html>
