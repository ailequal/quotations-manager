<?php
/**
 * Creazione pagine
 */


/**
 * Creazione della pagina "servizi"
 */
function quoma_create_servizi() {
	// Se la pagina "miei-preventivi" non esiste, creala
	if ( get_page_by_path( 'servizi' ) === null ) {
		$args = array(
			'post_title'   => 'Servizi',
			'post_name'    => 'servizi',
			'post_content' => 'Tutti i servizi disponibili.',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_type'    => 'page'
		);
		wp_insert_post( $args );
	}
}

add_action( 'init', 'quoma_create_servizi' );


/**
 * Creazione della pagina "miei-preventivi"
 */
function quoma_create_miei_preventivi() {
	// Se la pagina "miei-preventivi" non esiste, creala
	if ( get_page_by_path( 'miei-preventivi' ) === null ) {
		$args = array(
			'post_title'   => 'I miei preventivi',
			'post_name'    => 'miei-preventivi',
			'post_content' => 'Lista di tutti i preventivi richiesti.',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_type'    => 'page'
		);
		wp_insert_post( $args );
	}
}

add_action( 'init', 'quoma_create_miei_preventivi' );


/**
 * Creazione della pagina "accesso-negato"
 */
function quoma_create_accesso_negato() {
	// Se la pagina "accesso-negato" non esiste, creala
	if ( get_page_by_path( 'accesso-negato' ) === null ) {
		$args = array(
			'post_title'   => 'Accesso negato',
			'post_name'    => 'accesso-negato',
			'post_content' => 'Accesso negato, effettuare il login per visuallizare la pagina personale.',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_type'    => 'page'
		);
		wp_insert_post( $args );
	}
}

add_action( 'init', 'quoma_create_accesso_negato' );
