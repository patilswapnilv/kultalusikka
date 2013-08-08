<?php

/* Add license key menu item under Appeareance. */
add_action( 'admin_menu', 'kultalusikka_theme_license_menu' );

/* Register option for the license. */
add_action( 'admin_init', 'kultalusikka_theme_register_option' );

/* Activate the license. */
add_action( 'admin_init', 'kultalusikka_theme_activate_license' );

/* Deactivate the license. */
add_action( 'admin_init', 'kultalusikka_theme_deactivate_license' );


/**
 * Add license key menu item under Appeareance.
 *
 * @since 0.1.0
 */
function kultalusikka_theme_license_menu() {

	add_theme_page( __( 'Theme License', 'kultalusikka' ), __( 'Theme License', 'kultalusikka' ), 'manage_options', 'kultalusikka-license', 'kultalusikka_theme_license_page' );
	
}

/**
 * Setting page for license key.
 *
 * @since 0.1.0
 */
function kultalusikka_theme_license_page() {
	$license 	= get_option( 'kultalusikka_theme_license_key' );
	$status 	= get_option( 'kultalusikka_theme_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e( 'Theme License Options', 'kultalusikka' ); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields( 'kultalusikka_theme_license' ); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e( 'License Key', 'kultalusikka' ); ?>
						</th>
						<td>
							<input id="kultalusikka_theme_license_key" name="kultalusikka_theme_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
							<label class="description" for="kultalusikka_theme_license_key"><?php _e( 'Enter your license key for receiving automatic upgrades', 'kultalusikka' ); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e( 'Activate License', 'kultalusikka' ); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e( 'Active', 'kultalusikka' ); ?></span>
									<?php wp_nonce_field( 'kultalusikka_nonce', 'kultalusikka_nonce' ); ?>
									<input type="submit" class="button-secondary" name="kultalusikka_theme_license_deactivate" value="<?php esc_attr_e( 'Deactivate License', 'kultalusikka' ); ?>"/>
								<?php } else {
									wp_nonce_field( 'kultalusikka_nonce', 'kultalusikka_nonce' ); ?>
									<input type="submit" class="button-secondary" name="kultalusikka_theme_license_activate" value="<?php esc_attr_e( 'Activate License', 'kultalusikka' ); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}

function kultalusikka_theme_register_option() {
	// creates our settings in the options table
	register_setting( 'kultalusikka_theme_license', 'kultalusikka_theme_license_key', 'kultalusikka_theme_sanitize_license' );
}

/**
 * Gets rid of the local license status option when adding a new one.
 * @since 0.1.0
 */

function kultalusikka_theme_sanitize_license( $new ) {

	$old = get_option( 'kultalusikka_theme_license_key' );
	
	if( $old && $old != $new ) {
		delete_option( 'kultalusikka_theme_license_key_status' ); // new license has been entered, so must reactivate
	}
	
	return $new;
}

/**
 * Activate the license.
 *
 * @since 0.1.0
 */
function kultalusikka_theme_activate_license() {

	if( isset( $_POST['kultalusikka_theme_license_activate'] ) ) { 
	 	if( ! check_admin_referer( 'kultalusikka_nonce', 'kultalusikka_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( 'kultalusikka_theme_license_key' ) );
				
		$api_params = array( 
			'edd_action' => 'activate_license', 
			'license'    => $license, 
			'item_name'  => urlencode( KULTALUSIKKA_SL_THEME_NAME ) 
		);
		
		$response = wp_remote_get( add_query_arg( $api_params, KULTALUSIKKA_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'kultalusikka_theme_license_key_status', $license_data->license );

	}
}

/**
 * Deactivate the license. This will decrease the site count.
 *
 * @since 0.1.0
 */

function kultalusikka_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['kultalusikka_theme_license_deactivate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'kultalusikka_nonce', 'kultalusikka_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'kultalusikka_theme_license_key' ) );
			

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( KULTALUSIKKA_SL_THEME_NAME ) // the name of our product in EDD
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, KULTALUSIKKA_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'kultalusikka_theme_license_key_status' );

	}
}


/***********************************************
* Illustrates how to check if a license is valid
***********************************************/

function kultalusikka_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( 'kultalusikka_theme_license_key' ) );
		
	$api_params = array( 
		'edd_action' => 'check_license', 
		'license' => $license, 
		'item_name' => urlencode( KULTALUSIKKA_SL_THEME_NAME ) 
	);
	
	$response = wp_remote_get( add_query_arg( $api_params, KULTALUSIKKA_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}

?>