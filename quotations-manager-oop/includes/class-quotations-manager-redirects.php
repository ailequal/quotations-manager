<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Redirects {

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
	 * Controllo accesso "miei-preventivi", accessibile solo per utenti "subscriber" loggati.
	 */
	public function quoma_custom_redirect_miei_preventivi() {
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

	/**
	 * Gestione del redirect quando si esegue il login
	 *
	 * @param string $url URL per il redirect.
	 * @param string $request URL da dove arriva l'utente.
	 * @param object $user L'utente che manda la richiesta.
	 *
	 * @return bool|false|string|void|WP_Error URL per il redirect finale.
	 */
	public function quoma_login_redirect( $url, $request, $user ) {
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

	/**
	 * Gestione del redirect quando si esegue il logout
	 */
	public function quoma_logout_redirect() {
		wp_redirect( home_url() );
		exit();
	}

	/**
	 * Gestione del redirect quando "subscriber" prova ad accedere a "/wp-admin"
	 */
	public function quoma_subscriber_redirect() {
		if ( is_user_logged_in() ) {
			$user = wp_get_current_user();
			if ( $user->has_cap( 'subscriber' ) ) {
				if ( ! defined( 'DOING_AJAX' ) ) {
					wp_redirect( home_url() );
				}
			}
		}
	}

}
