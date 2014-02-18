<?php
/**  --- --- --- --- --- --- --- --- --- --- --- ---
 *  Private Site
 **  --- --- --- --- --- --- --- --- --- --- ---  
 */

add_action('wp', 'private_site');

function private_site() {
	$isLoginPage = strpos($_SERVER['REQUEST_URI'], "wp-login.php") !== false;
	$isPhoneApp = strpos($_SERVER['REQUEST_URI'], "xmlrpc.php") !== false;
	
	if( !is_user_logged_in() && !is_admin() && !$isLoginPage && !$isPhoneApp ) {
		
		$shareKey = get_post_meta( get_the_ID(), 'key', true );
	
		if( $_GET['key'] && is_single && $_GET['key'] == $shareKey ) {
			return;
		} else {
			$location = get_login_redirect_url( get_bloginfo( 'url') . $_SERVER['REQUEST_URI'] );
			header( 'Location: ' . $location );
			exit();
		}
	}
}

// Returns the login URL with a redirect link.

function get_login_redirect_url( $url = '' ) {
	
	$url = esc_url_raw( $url );
	if ( empty( $url ) ) return false;

	// setup query args
	$query_args = array(
//		'action'      => 'bpnoaccess',
//		'auth'        => 1,
		'redirect_to' => urlencode( $url )
	);
	return add_query_arg( $query_args, apply_filters( 'ass_login_url', wp_login_url() )	);
}

?>