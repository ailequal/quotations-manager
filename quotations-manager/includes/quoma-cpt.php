<?php
/*
 * Creazione CPT
*/

// Creazione del CPT "service"
add_action( 'init', 'quoma_create_post_type_services' );
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
		'capability_type'      => 'page',
		'has_archive'          => true,
		'hierarchical'         => true,
		'menu_position'        => null,
		'supports'             => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
//			'custom-fields',
			'page-attributes',
			'revisions'
		),
		'taxonomies'           => array( 'category', 'post_tag' ),
		'register_meta_box_cb' => 'quoma_meta_box_service',
	);
	register_post_type( 'service', $args );
}

// Creazione della meta box per "service"
function quoma_meta_box_service() {
	add_meta_box( 'quoma-service', 'Servizi Extra', 'quoma_meta_box_service_content', 'service', 'normal', 'default' );
}

function quoma_meta_box_service_content() {
	?>
	<div><h2>Lista dei servizi extra applicabili</h2></div>
	<?php
}