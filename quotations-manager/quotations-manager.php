<?php
/**
 * Plugin Name: Quotations Manager
 * Plugin URI: http://wordpress.org/plugins/quotations-manager/
 * Description: Un plugin per WordPress per gestire la creazione e modifica di servizi, comprese l'aggiunta di eventuali opzioni extra.
 * Author: ailequal
 * Version: 0.0.1
 * Author URI: https://github.com/ailequal
 */


// Il codice e' attualmente scritto in maniera procedurale, ma sara' successivamente riscritto in OOP con "wppb.me" come boilerplate.
// Il plugin utilizza in tutti i file e funzioni il prefisso "quoma".


/**
 * Il codice che si avvia all'attivazione del plugin.
 */
function quoma_install() {
	global $wp_version;
	if ( version_compare( $wp_version, '5.4.2', '<' ) ) {
		wp_die( 'Questo plugin richiede la versione di WordPress 5.4.2 o superiore.' );
	}
	set_transient( 'quoma_admin_notices_transient', true, 5 );
}

register_activation_hook( __FILE__, 'quoma_install' );


/**
 * Messaggio di notifica di creazione delle pagine all'attivazione del plugin.
 */
function quoma_admin_notices() {
	if ( get_transient( 'quoma_admin_notices_transient' ) ) {
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php _e( 'Quotations Manager ha generato le seguenti pagine: "Accesso negato", "I miei preventivi" e "Servizi".', 'quotations-manager' ); ?></p>
		</div>
		<?php
		delete_transient( 'quoma_admin_notices_transient' );
	}
}

add_action( 'admin_notices', 'quoma_admin_notices' );


/**
 * Tutti i file necessari per il funzionamente del plugin.
 */
// Opzioni del plugin.
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-options.php' );

// Creazione delle pagine
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-pages.php' );

// Gestione redirect
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-redirects.php' );

// Creazione e gestione del CPT "service"
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-cpt-service.php' );

// Creazione e gestione del CPT "quotation"
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-cpt-quotation.php' );

// AJAX API
include( plugin_dir_path( __FILE__ ) . 'includes/quoma-ajax.php' );


/**
 * Il codice che si avvia alla disattivazione del plugin.
 */
function prowp_deactivate() {
	// Azioni da definire
}

register_deactivation_hook( __FILE__, 'prowp_deactivate()' );
