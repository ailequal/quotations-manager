<?php
/*
Plugin Name: Quotations Manager
Plugin URI: http://wordpress.org/plugins/quotations-manager/
Description: Un plugin per WordPress per gestire la creazione e modifica di servizi, comprese l'aggiunta di eventuali opzioni extra.
Author: ailequal
Version: 0.0.1
Author URI: https://github.com/ailequal
*/


/*
 * Il codice e' attualmente scritto in maniera procedurale, ma sara' successivamente rivisto in OOP
 * Il plugin utilizza in tutti i file e funzioni il prefisso "quoma"
 */


/*
 * register_activation_hook()
 */

register_activation_hook( __FILE__, 'quoma_install' );
function quoma_install() {
	global $wp_version;
	if ( version_compare( $wp_version, '5.4.2', '<' ) ) {
		wp_die( 'This plugin requires WordPress version 5.4.2 or higher.' );
	}
}


/*
 * include
 */

// Creazione delle pagine
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-pages.php' );

// Gestione redirect
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-redirects.php' );

// Creazione CPT
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-cpt.php' );

// Gestione menu
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-menu.php' );


/*
 * register_deactivation_hook()
 */

register_deactivation_hook( __FILE__, 'prowp_deactivate()' );
function prowp_deactivate() {
	// azioni da definire
}
