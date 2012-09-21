<?php

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ithi_logo_widget' );

// Register widget
function ithi_logo_widget() {
	register_widget( 'ithi_logo_widget' );
}

// Widget class
class ithi_logo_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ithi_logo_widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'logo-widget',
		'description' => __('Widget that display custom logo and phrase below.', 'framework')
	);

	// Widget control settings
	$control_ops = array (
		'id_base' => 'ithi_logo_widget'
	);
	// Create the widget
	$this->WP_Widget( 'ithi_logo_widget', __('Custom logo', 'framework'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$phrase =  $instance['phrase'];
	$logo_link = $instance['logo_link'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;
		?>
		<?php
		echo "<a href='" . home_url( '/' ) . "'><img src='". $logo_link . "' /></a>";			
		echo "<p class='phrase'>" . $phrase . "</p>";
		
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
	$instance['phrase'] = $new_instance['phrase'];
	$instance['logo_link'] = $new_instance['logo_link'];
	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
	'phrase' => 'Simplicity is key<br />Personal Blog WordPress Theme',
	'logo_link' => get_template_directory_uri()."/images/logo.png",
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Link: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'logo_link' ); ?>"><?php _e('Link to logo:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'logo_link' ); ?>" name="<?php echo $this->get_field_name( 'logo_link' ); ?>" value="<?php echo $instance['logo_link']; ?>" />
	</p>

	<!-- Widget Phrase: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'phrase' ); ?>"><?php _e('Phrase:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'phrase' ); ?>" name="<?php echo $this->get_field_name( 'phrase' ); ?>" value="<?php echo $instance['phrase']; ?>" />
	</p>
			
	<?php
	}

}
?>