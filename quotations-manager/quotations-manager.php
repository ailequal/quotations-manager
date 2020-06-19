<?php
/*
Plugin Name: Quotations Manager
Plugin URI: http://wordpress.org/plugins/quotations-manager/
Description: Un plugin per WordPress per gestire la creazione e modifica di servizi, comprese l'aggiunta di eventuali opzioni extra.
Author: ailequal
Version: 0.0.1
Author URI: https://github.com/ailequal
*/

// Il plugin utilizza in tutti i file il prefisso "quoma" prima delle sue specifiche funzioni

// Creazione della pagina "miei-preventivi"
add_action('init', 'quoma_create_miei_preventivi');
// Se la pagina "miei-preventivi" non esiste, creala
function quoma_create_miei_preventivi() {
	if (get_page_by_path('miei-preventivi') === null) {
		$miei_preventivi = array(
			'post_title'    => 'I miei preventivi',
			'post_name'     => 'miei-preventivi',
			'post_content'  => 'Lista dei preventivi generati da $nome_utente:',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page'
		);
		wp_insert_post($miei_preventivi);
	}
}

// Controllo accesso "miei-preventivi" solo per utenti "subscriber" loggati
// code here

// Gestione del redirect quando si esegue il login
add_filter('login_redirect', 'quoma_login_redirect', 10, 3 );
function quoma_login_redirect( $url, $request, $user ){
	if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if( $user->has_cap( 'administrator' ) ) {
			$url = admin_url();
		} else if( $user->has_cap( 'subscriber' ) ) {
			$url = get_permalink( get_page_by_path( 'miei-preventivi' ) );
		} else {
			$url = home_url();
		}
	}
	return $url;
}

// Gestione del redirect quando si esegue il logout
add_action('wp_logout','quoma_logout_redirect');
function quoma_logout_redirect() {
	wp_redirect( home_url() );
	exit();
}

// Gestione del redirect quando "subscriber" prova ad accedere a "/wp-admin"
add_action( 'admin_init', 'quoma_subscriber_redirect' );
function quoma_subscriber_redirect() {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		if ($user->has_cap('subscriber')) {
			wp_redirect( home_url() );
		}
	}
}
