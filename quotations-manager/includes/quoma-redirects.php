<?php
/*
 * Gestione redirect
 */

// Controllo accesso "miei-preventivi", accessibile solo per utenti "subscriber" loggati
add_action( 'template_redirect', 'quoma_custom_redirect_miei_preventivi' );
function quoma_custom_redirect_miei_preventivi() {
	if ( is_page( 'miei-preventivi' ) ) {
		if ( is_user_logged_in() ) {
			$user = wp_get_current_user();
			if ( $user->has_cap( 'subscriber' ) ) {
				// Visualizza la pagina "miei-preventivi"
			} else {
				wp_redirect( get_permalink( get_page_by_path( 'accesso-negato' ) ) );
				die;
			}
		} else {
			wp_redirect( get_permalink( get_page_by_path( 'accesso-negato' ) ) );
			die;
		}
	}
}

// Gestione del redirect quando si esegue il login
add_filter( 'login_redirect', 'quoma_login_redirect', 10, 3 );
function quoma_login_redirect( $url, $request, $user ) {
	if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if ( $user->has_cap( 'administrator' ) ) {
			$url = admin_url();
		} else if ( $user->has_cap( 'subscriber' ) ) {
			$url = get_permalink( get_page_by_path( 'miei-preventivi' ) );
		} else {
			$url = home_url();
		}
	}

	return $url;
}

// Gestione del redirect quando si esegue il logout
add_action( 'wp_logout', 'quoma_logout_redirect' );
function quoma_logout_redirect() {
	wp_redirect( home_url() );
	exit();
}

// Gestione del redirect quando "subscriber" prova ad accedere a "/wp-admin"
add_action( 'admin_init', 'quoma_subscriber_redirect' );
function quoma_subscriber_redirect() {
	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		if ( $user->has_cap( 'subscriber' ) ) {
			if ( ! defined( 'DOING_AJAX' ) ) {
				wp_redirect( home_url() );
			}
		}
	}
}

// Eseguire il redirect da "servizio" a "servizi"
add_action( 'template_redirect', 'quoma_custom_redirect_servizio' );
function quoma_custom_redirect_servizio() {
	if ( is_post_type_archive( 'service' ) ) {
		wp_redirect( get_permalink( get_page_by_path( 'servizi' ) ) );
		die;
	}
}
