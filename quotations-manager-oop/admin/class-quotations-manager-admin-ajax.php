<?php

/**
 * La classe che gestisce le AJAX API.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * La classe che gestisce le AJAX API.
 *
 * Definisce il nome del plugin, la versione e tutte le funzioni necessarie.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Admin_Ajax {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $quotations_manager The ID of this plugin.
	 */
	private $quotations_manager;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $quotations_manager The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $quotations_manager, $version ) {

		$this->quotations_manager = $quotations_manager;
		$this->version            = $version;

	}

	/**
	 * API quoma_create_quotation
	 */
	public function quoma_create_quotation() {
		// Controllo nonce
		if ( ! empty( $_POST['quoma_service_nonce'] ) && ! wp_verify_nonce( $_POST['quoma_service_nonce'], 'quoma_service_form_save' ) ) {
			die ( 'Bloccata richiesta dall\'esterno!!' );
		}

		// Recupero dati e controllo
		if ( ! empty( $_POST['service_id'] ) || ! empty ( $_POST['extras_selected'] ) ) {
			$service_id      = $_POST['service_id'];
			$extras_selected = $_POST['extras_selected'];
		} else {
			die( 'Dati non trasmessi correttamente.' );
		}
		$user_id     = get_current_user_ID();
		$price_total = get_post_meta( $service_id, '_price_list', true );
		$extras_list = get_post_meta( $service_id, '_extras_list', true );

		// Recupero informazioni relative ai servizi extra selezionati
		$extras_final = array();
		foreach ( $extras_list as $alpha => $extra ) {
			foreach ( $extras_selected as $beta => $slug ) {
				if ( $slug === $extra['slug'] ) {
					$extras_final[] = $extra;
				}
			}
		}

		// Calcolo del prezzo totale del preventivo
		foreach ( $extras_final as $key => $extra ) {
			$price_total += $extra['price'];
		}

		// Creazione di un nuovo preventivo
		$quotation    = array(
			'post_title'   => 'Preventivo numero X',
			'post_content' => 'Contenuto del preventivo.',
			'post_status'  => 'draft',
			'post_author'  => $user_id,
			'post_type'    => 'quotation',
			'meta_input'   => array(
				'_user_id'         => $user_id,
				'_service_id'      => $service_id,
				'_price_total'     => $price_total,
				'_extras_selected' => $extras_final,
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

		// Invio email di notifica all'amministratore
		$admin_email = get_bloginfo( 'admin_email' );
		$subject     = 'Creato preventivo numero ' . $quotation_id;
		$message     = 'L\'utente ' . get_userdata( $user_id )->user_login . ' ha creato un nuovo preventivo per un totale di ' . get_post_meta( $quotation_id, '_price_total', true ) . ' Euro.';
		wp_mail( $admin_email, $subject, $message );

		// Risposta della API
		wp_redirect( get_permalink( $quotation_id ) );
		wp_die();
	}

}
