<?php

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ithi_tags_widgets' );

// Register widget
function ithi_tags_widgets() {
	register_widget( 'ithi_tags_widget' );
}

// Widget class
class ithi_tags_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ithi_tags_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'ithi_tags_widget',
		'description' => __('A widget that displays tags as a list.', 'framework')
	);

	// Widget control settings
	$control_ops = array (
		'id_base' => 'ithi_tags_widget'
	);
	// Create the widget
	$this->WP_Widget( 'ithi_tags_widget', __('Custom tags', 'framework'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

		?>
		
		<?php
			echo ('<ul>');	
			$tags = get_tags();
			foreach ($tags as $tag){
					$tag_link = get_tag_link($tag->term_id);			
					$html .= "<li><a href='{$tag_link}'>";
					$html .= "{$tag->name}</a></li>";
			echo $html;
			$html ="";		
			}
			echo ('</ul>');	

		?>
		<?php	
	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
	'title' => 'Tags',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<?php
	}

}
?>