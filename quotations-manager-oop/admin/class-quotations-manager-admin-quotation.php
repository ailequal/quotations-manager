<?php

/**
 * La classe che gestisce il CPT "quotation" lato admin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 */

/**
 * La classe che gestisce il CPT "quotation" lato admin.
 *
 * Definisce il nome del plugin, la versione e tutte le funzioni necessarie.
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Admin_Quotation {

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
	 * Creazione del CPT "quotation"
	 */
	public function quoma_create_post_type_quotations() {
		$labels = array(
			'name'                  => _x( 'Preventivi', 'Post type general name', 'quotations-manager' ),
			'singular_name'         => _x( 'Preventivo', 'Post type singular name', 'quotations-manager' ),
			'menu_name'             => _x( 'Preventivi', 'Admin Menu text', 'quotations-manager' ),
			'name_admin_bar'        => _x( 'Preventivo', 'Add New on Toolbar', 'quotations-manager' ),
			'add_new'               => __( 'Nuovo preventivo', 'quotations-manager' ),
			'add_new_item'          => __( 'Aggiungi nuovo preventivo', 'quotations-manager' ),
			'new_item'              => __( 'Nuovo preventivo', 'quotations-manager' ),
			'edit_item'             => __( 'Modifica preventivo', 'quotations-manager' ),
			'view_item'             => __( 'Visualizza preventivo', 'quotations-manager' ),
			'all_items'             => __( 'Tutti i preventivi', 'quotations-manager' ),
			'search_items'          => __( 'Cerca i preventivi', 'quotations-manager' ),
			'parent_item_colon'     => __( 'Preventivo genitore:', 'quotations-manager' ),
			'not_found'             => __( 'Nessun preventivo trovato.', 'quotations-manager' ),
			'not_found_in_trash'    => __( 'Nessun preventivo trovato nel cestino.', 'quotations-manager' ),
			'featured_image'        => _x( 'Immagine in evidenza del preventivo', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
			'set_featured_image'    => _x( 'Imposta immagine in evidenza del preventivo', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
			'remove_featured_image' => _x( 'Rimuovi immagine in evidenza del preventivo', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
			'use_featured_image'    => _x( 'Usa come immagine in evidenza', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
			'archives'              => _x( 'Archivio preventivi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'quotations-manager' ),
			'insert_into_item'      => _x( 'Inserisci nel preventivo', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'quotations-manager' ),
			'uploaded_to_this_item' => _x( 'Caricato con questo preventivo', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'quotations-manager' ),
			'filter_items_list'     => _x( 'Filtra lista di preventivi', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'quotations-manager' ),
			'items_list_navigation' => _x( 'Lista di navigazione dei preventivi', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'quotations-manager' ),
			'items_list'            => _x( 'Lista dei preventivi', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'quotations-manager' ),
		);
		$args   = array(
			'labels'               => $labels,
			'public'               => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_rest'         => true,
			'query_var'            => true,
			'exclude_from_search'  => true,
			'capability_type'      => 'post',
			'has_archive'          => false,
			'hierarchical'         => true,
			'menu_position'        => null,
			'supports'             => array(
				'title',
				'author',
			),
			'register_meta_box_cb' => array( $this, 'quoma_meta_box_quotation' ),
		);
		register_post_type( 'quotation', $args );
	}

	/**
	 * Creazione della meta box per "quotation"
	 */
	public function quoma_meta_box_quotation() {
		add_meta_box(
			'quoma-quotation',
			'Informazioni preventivo',
			array( $this, 'quoma_meta_box_quotation_content' ),
			'quotation',
			'normal',
			'default' );
	}

	/**
	 * Funzione di callback per add_meta_box()
	 *
	 * @param object $quotation L'oggetto preventivo appena creato.
	 */
	public function quoma_meta_box_quotation_content( $quotation ) {
		// Creazione dei post meta necessari
		// '_user_id' --> Utente che ha creato il servizio (lo salvi come autore CPT)
		add_post_meta( $quotation->ID, '_service_id', '', true );
		add_post_meta( $quotation->ID, '_price_total', '', true );
		add_post_meta( $quotation->ID, '_extras_selected', '', true );

		// Salvataggio valore post meta nella rispettiva variabile
		$quoma_quotation_service_id      = get_post_meta( $quotation->ID, '_service_id', true );
		$quoma_quotation_price_list      = get_post_meta( $quoma_quotation_service_id, '_price_list', true );
		$quoma_quotation_price_total     = get_post_meta( $quotation->ID, '_price_total', true );
		$quoma_quotation_extras_selected = get_post_meta( $quotation->ID, '_extras_selected', true );

		// Visualizzazione dei dati del singolo preventivo
		echo '<h3>Tipologia di servizio:</h3>';
		echo '<h4>' . get_the_title( esc_attr( $quoma_quotation_service_id ) ) . ' (' . $quoma_quotation_price_list . ' Euro)</h4>';
		if ( ! empty( $quoma_quotation_extras_selected ) ) {
			echo '<h3>Servizi extra selezionati:</h3>';
			foreach ( $quoma_quotation_extras_selected as $key => $extra ) {
				echo '<h4>' . esc_attr( $extra['name'] ) . ' (' . $extra['price'] . ' Euro)<h4>';
			}
		} else {
			echo '<h3>Nessun servizio extra selezionato</h3>';
		}
		echo '<h3>Prezzo totale: ' . esc_attr( $quoma_quotation_price_total ) . ' Euro' . '</h3>';
	}

}
