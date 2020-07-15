<?php
/**
 * Creazione e gestione del CPT "service".
 */


/**
 * Creazione del CPT "service".
 */
function quoma_create_post_type_services() {
	$labels = array(
		'name'                  => _x( 'Servizi', 'Post type general name', 'quotations-manager' ),
		'singular_name'         => _x( 'Servizio', 'Post type singular name', 'quotations-manager' ),
		'menu_name'             => _x( 'Servizi', 'Admin Menu text', 'quotations-manager' ),
		'name_admin_bar'        => _x( 'Servizio', 'Add New on Toolbar', 'quotations-manager' ),
		'add_new'               => __( 'Nuovo servizio', 'quotations-manager' ),
		'add_new_item'          => __( 'Aggiungi nuovo servizio', 'quotations-manager' ),
		'new_item'              => __( 'Nuovo servizio', 'quotations-manager' ),
		'edit_item'             => __( 'Modifica servizio', 'quotations-manager' ),
		'view_item'             => __( 'Visualizza servizio', 'quotations-manager' ),
		'all_items'             => __( 'Tutti i servizi', 'quotations-manager' ),
		'search_items'          => __( 'Cerca i servizi', 'quotations-manager' ),
		'parent_item_colon'     => __( 'Servizio genitore:', 'quotations-manager' ),
		'not_found'             => __( 'Nessun servizio trovato.', 'quotations-manager' ),
		'not_found_in_trash'    => __( 'Nessun servizio trovato nel cestino.', 'quotations-manager' ),
		'featured_image'        => _x( 'Immagine in evidenza del servizio', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
		'set_featured_image'    => _x( 'Imposta immagine in evidenza del servizio', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
		'remove_featured_image' => _x( 'Rimuovi immagine in evidenza del servizio', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
		'use_featured_image'    => _x( 'Usa come immagine in evidenza', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'quotations-manager' ),
		'archives'              => _x( 'Archivio servizi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'quotations-manager' ),
		'insert_into_item'      => _x( 'Inserisci nel servizio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'quotations-manager' ),
		'uploaded_to_this_item' => _x( 'Caricato con questo servizio', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'quotations-manager' ),
		'filter_items_list'     => _x( 'Filtra lista di servizi', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'quotations-manager' ),
		'items_list_navigation' => _x( 'Lista di navigazione dei servizi', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'quotations-manager' ),
		'items_list'            => _x( 'Lista dei servizi', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'quotations-manager' ),
	);
	$args   = array(
		'labels'               => $labels,
		'public'               => true,
		'publicly_queryable'   => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_rest'         => true,
		'query_var'            => true,
		'rewrite'              => array( 'slug' => 'servizio' ),
		'capability_type'      => 'post',
		'has_archive'          => true,
		'hierarchical'         => true,
		'menu_position'        => null,
		'supports'             => array(
			'title',
			'author',
			'thumbnail',
			'revisions'
		),
		'taxonomies'           => array( 'category', 'post_tag' ),
		'register_meta_box_cb' => 'quoma_meta_box_service',
	);
	register_post_type( 'service', $args );
}

add_action( 'init', 'quoma_create_post_type_services' );


/**
 * Creazione della meta box per "service".
 */
function quoma_meta_box_service() {
	add_meta_box( 'quoma-service', 'Dettagli servizio', 'quoma_meta_box_service_content', 'service', 'normal', 'default' );
}


/**
 * Funzione di callback per add_meta_box().
 *
 * @param object $service L'oggetto servizio appena creato.
 */
function quoma_meta_box_service_content( $service ) {
	// Creazione dei post meta necessari
	add_post_meta( $service->ID, '_name', '', true );
	add_post_meta( $service->ID, '_description', '', true );
	add_post_meta( $service->ID, '_days_for_delivery', '', true );
	add_post_meta( $service->ID, '_price_list', '', true );
	add_post_meta( $service->ID, '_extras_list', '', true );

	// Salvataggio valore post meta nella rispettiva variabile
	$quoma_service_name              = get_post_meta( $service->ID, '_name', true );
	$quoma_service_description       = get_post_meta( $service->ID, '_description', true );
	$quoma_service_days_for_delivery = get_post_meta( $service->ID, '_days_for_delivery', true );
	$quoma_service_price_list        = get_post_meta( $service->ID, '_price_list', true );
	$quoma_service_extras_list       = get_post_meta( $service->ID, '_extras_list', true );

	// Form per informazioni basilari
	wp_nonce_field( plugin_basename( __FILE__ ), 'quoma_meta_box_service_nonce' );
	echo '<h2 style="font-weight: bold;">Informazioni basilari</h2>';
	echo '<p>Nome: <input type="text" name="_name" value="' . esc_attr( $quoma_service_name ) . '" /></p>';
	echo '<p>Descrizione: <input type="text" name="_description" value="' . esc_attr( $quoma_service_description ) . '" /></p>';
	echo '<p>Giorni per la consegna: <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" name="_days_for_delivery" value="' . esc_attr( $quoma_service_days_for_delivery ) . '" /></p>';
	echo '<p>Prezzo di partenza: <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" name="_price_list" value="' . esc_attr( $quoma_service_price_list ) . '" /></p>';

	// Form per i servizi extra
	if ( empty( $quoma_service_extras_list ) ) {
		// Se stai creando un nuovo servizio
		for ( $i = 0; $i < 5; $i ++ ) {
			echo '<h2 style="font-weight: bold;">Servizio extra ' . ( $i + 1 ) . '</h2>';
			echo '<p>Nome: <input type="text" name="_extra_' . ( $i + 1 ) . '_name" value="" /></p>';
			echo '<p>Descrizione: <input type="text" name="_extra_' . ( $i + 1 ) . '_description" value="" /></p>';
			echo '<p>Prezzo: <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" name="_extra_' . ( $i + 1 ) . '_price" value="" /></p>';
		}
	} else {
		// Se stai aggiornando un servizio esistente
		for ( $i = 0; $i < 5; $i ++ ) {
			echo '<h2 style="font-weight: bold;">Servizio extra ' . ( $i + 1 ) . '</h2>';
			echo '<p>Nome: <input type="text" name="_extra_' . ( $i + 1 ) . '_name" value="' . esc_attr( $quoma_service_extras_list[ $i ]['name'] ) . '" /></p>';
			echo '<p>Descrizione: <input type="text" name="_extra_' . ( $i + 1 ) . '_description" value="' . esc_attr( $quoma_service_extras_list[ $i ]['description'] ) . '" /></p>';
			echo '<p>Prezzo: <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" name="_extra_' . ( $i + 1 ) . '_price" value="' . esc_attr( $quoma_service_extras_list[ $i ]['price'] ) . '" /></p>';
		}
	}
}


/**
 * Salvataggio dei post meta aggiornati.
 *
 * @param int $service_id L'ID del servizio aggiornato.
 */
function quoma_meta_box_service_save( $service_id ) {
	if ( ! empty( $_POST['_name'] ) ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		wp_verify_nonce( plugin_basename( __FILE__ ), 'quoma_meta_box_service_nonce' );

		// Salvataggio informazioni basilari
		update_post_meta( $service_id, '_name', sanitize_text_field( $_POST['_name'] ) );
		update_post_meta( $service_id, '_description', sanitize_text_field( $_POST['_description'] ) );
		update_post_meta( $service_id, '_days_for_delivery', sanitize_text_field( $_POST['_days_for_delivery'] ) );
		update_post_meta( $service_id, '_price_list', sanitize_text_field( $_POST['_price_list'] ) );

		// Salvataggio servizi extra
		$extras_list = array();
		for ( $i = 1; $i <= 5; $i ++ ) {
			$actual_service = '_extra_' . $i;
			if ( ! empty( $_POST[ $actual_service . '_name' ] ) && ! empty( $_POST[ $actual_service . '_description' ] ) && ! empty( $_POST[ $actual_service . '_price' ] ) ) {
				// Salva il servizio extra
				$extras_list[] = array(
					'name'        => $_POST[ $actual_service . '_name' ],
					'description' => $_POST[ $actual_service . '_description' ],
					'price'       => $_POST[ $actual_service . '_price' ],
					'slug'        => strtolower( str_replace( ' ', '_', $_POST[ $actual_service . '_name' ] ) ),
				);
			} else {
				// Inserisci un servizio extra vuoto
				$extras_list[] = array(
					'name'        => '',
					'description' => '',
					'price'       => '',
					'slug'        => '',
				);
			}
		}

		update_post_meta( $service_id, '_extras_list', $extras_list );
	}
}

add_action( 'save_post_service', 'quoma_meta_box_service_save' );


/**
 * Template personalizzato per un singolo servizio.
 *
 * @param object $template Il modello che viene caricato di default.
 *
 * @return string Il modello da caricare personalizzato per la visualizzazione della pagina richiesta.
 */
function quoma_template_service( $template ) {
	if ( get_post_type() == 'service' ) {
		return plugin_dir_path( __FILE__ ) . 'service.php';
	}

	return $template;
}

add_filter( 'single_template', 'quoma_template_service' );


/**
 * Codice JavaScript per i servizi.
 */
function quoma_enqueue_script_service() {
	if ( is_singular( 'service' ) ) {
		wp_enqueue_script( 'service.js', plugins_url( '../js/service.js', __FILE__ ), array( 'jquery' ), false, true );
		wp_localize_script( 'service.js', 'service', array(
				'ajax_url'        => admin_url( 'admin-ajax.php' ),
				'nonce'           => wp_create_nonce( 'ajax-nonce' ),
				'service_id'      => get_the_ID(),
				'miei_preventivi' => get_permalink( get_page_by_path( 'miei-preventivi' ) ),
			)
		);
	}
}

add_action( 'wp_enqueue_scripts', 'quoma_enqueue_script_service' );
