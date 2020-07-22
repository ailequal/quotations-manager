<?php

/**
 * La classe che gestisce il CPT "quotation" lato public.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * La classe che gestisce il CPT "quotation" lato public.
 *
 * Definisce il nome del plugin, la versione e tutte le funzioni necessarie.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Public_Quotation {

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
	 * Template personalizzato per un singolo preventivo.
	 *
	 * @param object $template Il modello che viene caricato di default.
	 *
	 * @return string Il modello da caricare personalizzato per la visualizzazione della pagina richiesta.
	 */
	function quoma_template_quotation( $template ) {
		if ( get_post_type() == 'quotation' ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/quotations-manager-public-quotation.php';

		}

		return $template;
	}

	/**
	 * Template personalizzato per la pagina 'miei-preventivi'
	 *
	 * @param object $template Il modello che viene caricato di default.
	 *
	 * @return string Il modello da caricare personalizzato per la visualizzazione della pagina richiesta.
	 */
	function quoma_template_quotations( $template ) {
		if ( is_page( 'miei-preventivi' ) ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/quotations-manager-public-quotations.php';

		}

		return $template;
	}

}
