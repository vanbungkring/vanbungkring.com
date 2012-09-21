<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'blog_options', 'blog_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
*/
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'blogtheme' ), __( 'Theme Options', 'blogtheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */

$sidebar_alignment = array(
	'left' => array(
		'value' => 'left',
		'label' => __( 'Sidebar left', 'blogtheme' )
	),
	'right' => array(
		'value' => 'right',
		'label' => __( 'Sidebar right', 'blogtheme' )
	)
);

$body_background = array(
	'bg-one' => array(
		'value' => 'bg-one',
		'label' => __('Light, delicate noise', 'blogtheme')
	),
	'bg-two' => array(
		'value' => 'bg-two',
		'label' => __('Darker, delicate noise', 'blogtheme')
	),
	'bg-three' => array(
		'value' => 'bg-three',
		'label' => __('Light, texture - small bones', 'blogtheme')
	),
	'bg-four' => array(
		'value' => 'bg-four',
		'label' => __('Light, texture - crossing', 'blogtheme')
	),
	'bg-five' => array(
		'value' => 'bg-five',
		'label' => __('Light, texture - notebook', 'blogtheme')
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $sidebar_alignment, $body_background;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'blogtheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'blogtheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'blog_options' ); ?>
			<?php $options = get_option( 'blog_theme_options' ); ?>

			<table class="form-table">

				<?php
				
				/**
				 * A blog of radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Background:', 'blogtheme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'blogtheme' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $body_background as $option ) {
								$radio_setting = $options['body_background'];

								if ( '' != $radio_setting ) {
									if ( $options['body_background'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="blog_theme_options[body_background]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?><br /></label>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>
				
				<?php
				
				/**
				 * A blog of radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Location of sidebar:', 'blogtheme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'blogtheme' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $sidebar_alignment as $option ) {
								$radio_setting = $options['sidebar_align'];

								if ( '' != $radio_setting ) {
									if ( $options['sidebar_align'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="blog_theme_options[sidebar_align]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>
				<?php
				/**
				 * A blog textarea option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'blogtheme' ); ?></th>
					<td>
						<textarea id="blog_theme_options[analytics]" class="large-text" cols="25" rows="5" name="blog_theme_options[analytics]"><?php echo esc_textarea( $options['analytics'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Write here Your own footer text.', 'blogtheme' ); ?></th>
					<td>
						<textarea id="blog_theme_options[footer_text]" class="large-text" cols="25" rows="5" name="blog_theme_options[footer_text]"><?php echo esc_textarea( $options['footer_text'] ); ?></textarea>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'blogtheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $sidebar_alignment, $body_background;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['sidebar_align'] ) )
		$input['sidebar_align'] = null;
	if ( ! array_key_exists( $input['sidebar_align'], $sidebar_alignment ) )
		$input['sidebar_align'] = null;

// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['body_background'] ) )
		$input['body_background'] = null;
	if ( ! array_key_exists( $input['body_background'], $body_background ) )
		$input['body_background'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/