<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/includes
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Quotations_Manager_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $quotations_manager The string used to uniquely identify this plugin.
	 */
	protected $quotations_manager;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'QUOTATIONS_MANAGER_VERSION' ) ) {
			$this->version = QUOTATIONS_MANAGER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->quotations_manager = 'quotations-manager';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_redirects_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Quotations_Manager_Loader. Orchestrates the hooks of the plugin.
	 * - Quotations_Manager_i18n. Defines internationalization functionality.
	 * - Quotations_Manager_Admin. Defines all hooks for the admin area.
	 * - Quotations_Manager_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-quotations-manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-quotations-manager-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-quotations-manager-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-quotations-manager-public.php';

		/**
		 * La classe che gestisce tutte le opzioni area admin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-quotations-manager-admin-settings.php';

		/**
		 * La classe che gestisce tutti i redirect.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-quotations-manager-redirects.php';

		/**
		 * La classe che gestisce il CPT "service" lato admin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-quotations-manager-admin-service.php';

		/**
		 * La classe che gestisce il CPT "service" lato public.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-quotations-manager-public-service.php';

		/**
		 * La classe che gestisce il CPT "quotation" lato admin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-quotations-manager-admin-quotation.php';

		/**
		 * La classe che gestisce il CPT "quotation" lato public.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-quotations-manager-public-quotation.php';

		/**
		 * La classe che gestisce le AJAX API.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-quotations-manager-admin-ajax.php';

		$this->loader = new Quotations_Manager_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Quotations_Manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Quotations_Manager_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Quotations_Manager_Admin( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'quoma_admin_notices' );
		$this->loader->add_action( 'init', $plugin_admin, 'quoma_create_servizi' );
		$this->loader->add_action( 'init', $plugin_admin, 'quoma_create_miei_preventivi' );
		$this->loader->add_action( 'init', $plugin_admin, 'quoma_create_accesso_negato' );

		$plugin_admin_settings = new Quotations_Manager_Admin_Settings( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'admin_menu', $plugin_admin_settings, 'quoma_main_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin_settings, 'quoma_register_settings' );

		$plugin_admin_service = new Quotations_Manager_Admin_Service( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin_service, 'quoma_create_post_type_services' );
		$this->loader->add_action( 'init', $plugin_admin_service, 'quoma_create_services_taxonomies' );
		$this->loader->add_action( 'save_post_service', $plugin_admin_service, 'quoma_meta_box_service_save' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin_service, 'enqueue_scripts' );

		$plugin_admin_quotation = new Quotations_Manager_Admin_Quotation( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin_quotation, 'quoma_create_post_type_quotations' );

		$plugin_admin_ajax = new Quotations_Manager_Admin_Ajax( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'wp_ajax_quoma_create_quotation', $plugin_admin_ajax, 'quoma_create_quotation' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Quotations_Manager_Public( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$plugin_public_service = new Quotations_Manager_Public_Service( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public_service, 'enqueue_scripts' );
		$this->loader->add_filter( 'single_template', $plugin_public_service, 'quoma_template_service' );

		$plugin_public_quotation = new Quotations_Manager_Public_Quotation( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_filter( 'single_template', $plugin_public_quotation, 'quoma_template_quotation' );
		$this->loader->add_filter( 'page_template', $plugin_public_quotation, 'quoma_template_quotations' );

	}

	/**
	 * Registra tutti gli hook riguardanti la gestione dei redirects.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_redirects_hooks() {

		$plugin_redirects = new Quotations_Manager_Redirects( $this->get_quotations_manager(), $this->get_version() );

		$this->loader->add_action( 'template_redirect', $plugin_redirects, 'quoma_custom_redirect_miei_preventivi' );
		$this->loader->add_filter( 'login_redirect', $plugin_redirects, 'quoma_login_redirect', 10, 3 );
		$this->loader->add_action( 'wp_logout', $plugin_redirects, 'quoma_logout_redirect' );
		$this->loader->add_action( 'admin_init', $plugin_redirects, 'quoma_subscriber_redirect' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_quotations_manager() {
		return $this->quotations_manager;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Quotations_Manager_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

}
