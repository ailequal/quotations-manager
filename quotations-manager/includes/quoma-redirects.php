<?php
/**
 * Gestione redirect
 */


/**
 * Controllo accesso "miei-preventivi", accessibile solo per utenti "subscriber" loggati
 */
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

add_action( 'template_redirect', 'quoma_custom_redirect_miei_preventivi' );


/**
 * Gestione del redirect quando si esegue il login
 *
 * @param string $url URL per il redirect.
 * @param string $request URL da dove arriva l'utente.
 * @param object $user L'utente che manda la richiesta.
 *
 * @return bool|false|string|void|WP_Error URL per il redirect finale.
 */
function quoma_login_redirect( $url, $request, $user ) {
	if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if ( $user->has_cap( 'administrator' ) ) {
			$url = admin_url();
		} else if ( $user->has_cap( 'subscriber' ) ) {
			if ( strpos( $url, '/servizio/' ) === false ) {
				$url = get_permalink( get_page_by_path( 'miei-preventivi' ) );
			}
		} else {
			$url = home_url();
		}
	}

	return $url;
}

add_filter( 'login_redirect', 'quoma_login_redirect', 10, 3 );


/**
 * Gestione del redirect quando si esegue il logout
 */
function quoma_logout_redirect() {
	wp_redirect( home_url() );
	exit();
}

add_action( 'wp_logout', 'quoma_logout_redirect' );


/**
 * Gestione del redirect quando "subscriber" prova ad accedere a "/wp-admin"
 */
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

add_action( 'admin_init', 'quoma_subscriber_redirect' );
