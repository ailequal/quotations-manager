<?php

/**
 * La classe che gestisce il CPT "service" lato public.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * La classe che gestisce il CPT "service" lato public.
 *
 * Definisce il nome del plugin, la versione e tutte le funzioni necessarie.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Public_Service {

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
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quotations_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quotations_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( is_singular( 'service' ) ) {
			wp_enqueue_script( 'quotations-manager-public-service', plugin_dir_url( __FILE__ ) . 'js/quotations-manager-public-service.js', array( 'jquery' ), $this->version, true );
		}

	}

	/**
	 * Template personalizzato per un singolo servizio.
	 *
	 * @param object $template Il modello che viene caricato di default.
	 *
	 * @return string Il modello da caricare personalizzato per la visualizzazione della pagina richiesta.
	 */
	public function quoma_template_service( $template ) {
		if ( get_post_type() == 'service' ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/quotations-manager-public-service.php';

		}

		return $template;
	}

}
