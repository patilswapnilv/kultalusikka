<?php
/*
 * Theme Settings
 * 
 * @package Kultalusikka
 * @subpackage Template
 * @since 0.1.0
 */

/* Theme setting page setup. */
add_action( 'admin_menu', 'kultalusikka_theme_admin_setup' );

/* Theme activate license. */
add_action( 'admin_init', 'kultalusikka_theme_activate_license' );

/* Theme deactivate license. */
add_action( 'admin_init', 'kultalusikka_theme_deactivate_license' );

function kultalusikka_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name. */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'kultalusikka_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'kultalusikka_theme_validate_settings' );

}

/* Adds custom meta boxes to the theme settings page. */
function kultalusikka_theme_settings_meta_boxes() {

	/* Add a custom meta box for license key. */
	add_meta_box(
		'kultalusikka-theme-meta-box-license-key',    // Name/ID
		__( 'Theme License Key', 'kultalusikka' ),    // Label
		'kultalusikka_theme_meta_box_license_key',    // Callback function
		'appearance_page_theme-settings',             // Page to load on, leave as is
		'normal',                                     // Which meta box holder?
		'high'                                        // High/low within the meta box holder
	);

	/* Add a custom meta box for customize. */
	add_meta_box(
		'kultalusikka-theme-meta-box-customomize',    // Name/ID
		__( 'Customize', 'kultalusikka' ),            // Label
		'kultalusikka_theme_meta_box_customize',      // Callback function
		'appearance_page_theme-settings',             // Page to load on, leave as is
		'normal',                                     // Which meta box holder?
		'high'                                        // High/low within the meta box holder
	);

	/* Add a custom meta box for logo. */
	add_meta_box(
		'kultalusikka-theme-meta-box-logo',           // Name/ID
		__( 'Logo Upload', 'kultalusikka' ),          // Label
		'kultalusikka_theme_meta_box_logo',           // Callback function
		'appearance_page_theme-settings',             // Page to load on, leave as is
		'normal',                                     // Which meta box holder?
		'high'                                        // High/low within the meta box holder
	);
	
	/* Add a custom meta box for background. */
	add_meta_box(
		'kultalusikka-theme-meta-box-background',     // Name/ID
		__( 'Background', 'kultalusikka' ),           // Label
		'kultalusikka_theme_meta_box_background',     // Callback function
		'appearance_page_theme-settings',             // Page to load on, leave as is
		'normal',                                     // Which meta box holder?
		'high'                                        // High/low within the meta box holder
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the license key meta box. */
function kultalusikka_theme_meta_box_license_key() { 

	$kultalusikka_license = hybrid_get_setting( 'kultalusikka_license_key' );
	$kultalusikka_status = get_option( 'kultalusikka_license_key_status' ); // Save status in different option.
	
	?>

	<table class="form-table">

		<!-- License key -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'kultalusikka_license_key' ); ?>"><?php _e( 'License key:', 'kultalusikka' ); ?></label>
			</th>
			<td>
				<p><input class="widefat" type="text" id="<?php echo hybrid_settings_field_id( 'kultalusikka_license_key' ); ?>" name="<?php echo hybrid_settings_field_name( 'kultalusikka_license_key' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'kultalusikka_license_key' ) ); ?>" /></p>
				<p><?php _e( 'Enter your license key here.', 'kultalusikka' ); ?></p>
			</td>
		</tr>
		
		<?php if( false !== $kultalusikka_license ) { ?>
		<tr>	
			<th scope="row" valign="top">
				<label for="<?php echo hybrid_settings_field_id( 'kultalusikka_activate_license' ); ?>"><?php _e( 'Activate License:', 'kultalusikka' ); ?></label>
			</th>
			<td>
			<?php if( $kultalusikka_status !== false && $kultalusikka_status == 'valid' ) { ?>
				<span style="color:green;"><?php _e( 'Active', 'kultalusikka' ); ?></span>
				<?php wp_nonce_field( 'kultalusikka_license_nonce', 'kultalusikka_license_nonce' ); ?>
				<input type="submit" class="button-secondary" name="kultalusikka_theme_license_deactivate" value="<?php esc_attr_e( 'Deactivate License', 'kultalusikka' ); ?>" />
				<?php } else {
					wp_nonce_field( 'kultalusikka_license_nonce', 'kultalusikka_license_nonce' ); ?>
					<input type="submit" class="button-secondary" name="kultalusikka_theme_license_activate" value="<?php esc_attr_e( 'Activate License', 'kultalusikka' ); ?>" />
					
				<?php } ?>
			</td>
		</tr>
		<?php } ?>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the customize meta box. */
function kultalusikka_theme_meta_box_customize() { ?>

	<table class="form-table">

		<!-- Customize -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'kultalusikka_customize' ); ?>"><?php _e( 'Customize:', 'kultalusikka' ); ?></label>
			</th>
			<td>
				<p><?php printf( __( 'Want to set Global layout and set other features? <a href="%s">Go to Appearance &gt;&gt; Customize</a>. ', 'kultalusikka' ), admin_url( 'customize.php' ) ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the logo meta box. */
function kultalusikka_theme_meta_box_logo() { ?>

	<table class="form-table">

		<!-- Logo -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'kultalusikka_custom_logo' ); ?>"><?php _e( 'Custom logo:', 'kultalusikka' ); ?></label>
			</th>
			<td>
				<p><?php printf( __( 'Want to replace or remove default logo? <a href="%s">Go to Appearance &gt;&gt; Header</a>. ', 'kultalusikka' ), admin_url( 'themes.php?page=custom-header' ) ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the background meta box. */
function kultalusikka_theme_meta_box_background() { ?>

	<table class="form-table">

		<!-- Background -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'kultalusikka_custom_background' ); ?>"><?php _e( 'Custom background:', 'kultalusikka' ); ?></label>
			</th>
			<td>
				<p><?php printf( __( 'Want to replace or remove default background? <a href="%s">Go to Appearance &gt;&gt; Background</a>. ', 'kultalusikka' ), admin_url( 'themes.php?page=custom-background' ) ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}	

/* Validate theme settings. */
function kultalusikka_theme_validate_settings( $input ) {

	$input['kultalusikka_license_key'] = wp_filter_nohtml_kses( $input['kultalusikka_license_key'] );
	
	/* If new license has been entered, license status must reactivate. */
	$old = hybrid_get_setting( 'kultalusikka_license_key' );
	if( $old && $old != $input['kultalusikka_license_key'] ) {
		delete_option( 'kultalusikka_license_key_status' );
	}

    /* Return the array of theme settings. */
    return $input;
	
}

/* Activate theme license. */
function kultalusikka_theme_activate_license() {

	if( isset( $_POST['kultalusikka_theme_license_activate'] ) ) { 
	 	if( ! check_admin_referer( 'kultalusikka_license_nonce', 'kultalusikka_license_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( hybrid_get_setting( 'kultalusikka_license_key' ) );
				
		$api_params = array( 
			'edd_action' => 'activate_license', 
			'license' => $license, 
			'item_name' => urlencode( KULTALUSIKKA_SL_THEME_NAME ) 
		);
		
		$response = wp_remote_get( add_query_arg( $api_params, KULTALUSIKKA_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'kultalusikka_license_key_status', $license_data->license );

	}
}

/* Deactivate theme license. */
function kultalusikka_theme_deactivate_license() {

	if( isset( $_POST['kultalusikka_theme_license_deactivate'] ) ) { 
	 	if( ! check_admin_referer( 'kultalusikka_license_nonce', 'kultalusikka_license_nonce' ) ) 	
			return; // get out if we didn't click the Deactivate button

		global $wp_version;

		$license = trim( hybrid_get_setting( 'kultalusikka_license_key' ) );
				
		$api_params = array( 
			'edd_action' => 'deactivate_license', 
			'license' => $license, 
			'item_name' => urlencode( KULTALUSIKKA_SL_THEME_NAME ) 
		);
		
		$response = wp_remote_get( add_query_arg( $api_params, KULTALUSIKKA_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		/* $license_data->license will be either "deactivated" or "failed". */
		if( $license_data->license == 'deactivated' )
			delete_option( 'kultalusikka_license_key_status' );

	}
}

?>