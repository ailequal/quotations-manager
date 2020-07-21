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
class Quotations_Manager_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->quotations_manager, plugin_dir_url( __FILE__ ) . 'css/quotations-manager-admin.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( $this->quotations_manager, plugin_dir_url( __FILE__ ) . 'js/quotations-manager-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Messaggio di notifica di creazione delle pagine all'attivazione del plugin.
	 */
	public function quoma_admin_notices() {

		if ( get_transient( 'quoma_admin_notices_transient' ) ) {
			?>
			<div class="notice notice-info is-dismissible">
				<p><?php _e( 'Quotations Manager ha generato le seguenti pagine: "Accesso negato", "I miei preventivi" e "Servizi".', 'quotations-manager' ); ?></p>
			</div>
			<?php
			delete_transient( 'quoma_admin_notices_transient' );
		}

	}

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

}
