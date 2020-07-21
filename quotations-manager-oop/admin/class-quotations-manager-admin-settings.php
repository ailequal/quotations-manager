<?php

/**
 * La classe che gestisce tutte le opzioni area admin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * La classe che gestisce tutte le opzioni area admin.
 *
 * Definisce il nome del plugin, la versione e tutte le funzioni necessarie.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Admin_Settings {

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

		$this->quoma_default_label();

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
	 * Crea una etichetta di default se vuota nelle opzioni.
	 */
	public function quoma_default_label() {

		if ( ! get_option( 'quoma_options' ) || empty( get_option( 'quoma_options' )['option_label'] ) ) {
			$quoma_options_arr = array(
				'option_label' => 'Etichetta personalizzata'
			);
			update_option( 'quoma_options', $quoma_options_arr );
		}

	}

	/**
	 * Creazione dela pagina di menu principale del plugin.
	 */
	public function quoma_main_menu() {

		add_menu_page(
			'Quotations Manager',
			'Quotations Manager',
			'manage_options',
			'quoma_main_menu',
			array( $this, 'quoma_main_menu_page' ),
			plugins_url( 'quotations-manager/admin/img/logo.svg' ),
			30
		);

	}

	/**
	 * Salvataggio delle opzioni del plugin
	 */
	public function quoma_register_settings() {

		register_setting(
			'quoma-settings-group',
			'quoma_options',
			array( $this, 'quoma_sanitize_options' )
		);

	}

	/**
	 * @param $input array Array delle opzioni selezionate.
	 *
	 * @return mixed Restituisci array di opzioni sanificate.
	 */
	public function quoma_sanitize_options( $input ) {

		$input['option_label'] = sanitize_text_field( $input['option_label'] );

		return $input;

	}

	/**
	 * Pagina delle opzioni
	 */
	public function quoma_main_menu_page() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/quotations-manager-admin-settings.php';

	}

}
