<?php
/*
 * Creazione CPT
*/

// Creazione del custom post type "service"
add_action( 'init', 'quoma_create_post_type_services' );
function quoma_create_post_type_services() {
	$labels = array(
		'name'                  => _x( 'Servizi', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Servizio', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Servizi', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Servizio', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Nuovo servizio', 'textdomain' ),
		'add_new_item'          => __( 'Aggiungi nuovo servizio', 'textdomain' ),
		'new_item'              => __( 'Nuovo servizio', 'textdomain' ),
		'edit_item'             => __( 'Modifica servizio', 'textdomain' ),
		'view_item'             => __( 'Visualizza servizio', 'textdomain' ),
		'all_items'             => __( 'Tutti i servizi', 'textdomain' ),
		'search_items'          => __( 'Cerca i servizi', 'textdomain' ),
		'parent_item_colon'     => __( 'Servizio genitore:', 'textdomain' ),
		'not_found'             => __( 'Nessun servizio trovato.', 'textdomain' ),
		'not_found_in_trash'    => __( 'Nessun servizio trovato nel cestino.', 'textdomain' ),
		'featured_image'        => _x( 'Immagine in evidenza del servizio', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Imposta immagine in evidenza del servizio', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Rimuovi immagine in evidenza del servizio', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Usa come immagine in evidenza', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Archivio servizi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Inserisci nel servizio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Caricato con questo servizio', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filtra lista di servizi', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Lista di navigazione dei servizi', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Lista dei servizi', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'servizio' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'page-attributes',
			'revisions'
		),
		'taxonomies'         => array( 'category', 'post_tag' ),
//		'register_meta_box_cb' =>
	);
	register_post_type( 'service', $args );
}
