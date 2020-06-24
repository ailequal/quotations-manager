<?php
/*
 * Gestione menu
 */

// Menu principale di "quotations-manager"
add_action( 'admin_menu', 'quoma_create_menu' );
function quoma_create_menu() {
	add_menu_page(
		'Quotations Manager',
		'Quotations Manager',
		'manage_options',
		'quotations-manager/includes/quoma-admin.php',
		'',
		plugins_url( 'quotations-manager/images/quotations-manager.svg' ),
		null
	);
}
