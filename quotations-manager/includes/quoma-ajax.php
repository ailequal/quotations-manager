<?php
/*
 * AJAX API
*/

// API quoma_create_quotation
add_action( 'wp_ajax_quoma_create_quotation', 'quoma_create_quotation' );
function quoma_create_quotation() {
	// Controllo nonce
	if ( ! empty( $_POST['nonce'] ) && ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
		die ( 'Bloccata richiesta dall\'esterno!!' );
	}

	// Recupero dati e controllo
	if ( ! empty( $_POST['service_id'] ) || ! empty ( $_POST['extras_selected'] ) ) {
		$service_id      = $_POST['service_id'];
		$extras_selected = json_decode( stripslashes( $_POST['extras_selected'] ), true );
	} else {
		die( 'Dati non trasmessi correttamente.' );
	}
	$user_id     = get_current_user_ID();
	$price_total = get_post_meta( $service_id, '_price_list', true );

	// Calcolo del prezzo totale del preventivo
	foreach ( $extras_selected as $key => $extra ) {
		$price_total += $extra['price'];
	}

	// Creazione di un nuovo preventivo
	$quotation    = array(
		'post_title'   => 'Preventivo numero X',
		'post_content' => 'Contenuto del preventivo.',
		'post_status'  => 'draft',
		'post_author'  => get_current_user_id(),
		'post_type'    => 'quotation',
		'meta_input'   => array(
			'_user_id'         => $user_id,
			'_service_id'      => $service_id,
			'_price_total'     => $price_total,
			'_extras_selected' => $extras_selected,
		),
	);
	$quotation_id = wp_insert_post( $quotation );

	// Aggiornate informazioni preventivo con il suo ID
	$quotation = array(
		'ID'          => $quotation_id,
		'post_title'  => 'Preventivo numero ' . $quotation_id,
		'post_status' => 'publish',
	);
	wp_update_post( $quotation );

	// Risposta della API
	$response = json_encode( 'Preventivo creato correttamente.' );
	echo $response;
	wp_die();
}
