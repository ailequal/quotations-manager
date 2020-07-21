<?php
/**
 * Opzioni del plugin.
 */


/**
 * Creazione dela pagina di menu principale del plugin.
 */
function quoma_main_menu() {
	add_menu_page(
		'Quotations Manager',
		'Quotations Manager',
		'manage_options',
		'quoma_main_menu',
		'quoma_main_menu_page',
		plugins_url( 'quotations-manager/images/quotations-manager.svg' ),
		30
	);
}

add_action( 'admin_menu', 'quoma_main_menu' );


/**
 * Salvataggio delle opzioni del plugin
 */
function quoma_register_settings() {
	register_setting(
		'quoma-settings-group',
		'quoma_options',
		'quoma_sanitize_options'
	);
}

add_action( 'admin_init', 'quoma_register_settings' );


/**
 * @param $input array Array delle opzioni selezionate.
 *
 * @return mixed Restituisci array di opzioni sanificate.
 */
function quoma_sanitize_options( $input ) {
	$input['option_label'] = sanitize_text_field( $input['option_label'] );

	return $input;
}


// Crea una etichetta di default se vuota
if ( ! get_option( 'quoma_options' ) || empty( get_option( 'quoma_options' )['option_label'] ) ) {
	$quoma_options_arr = array(
		'option_label' => 'Etichetta personalizzata'
	);
	update_option( 'quoma_options', $quoma_options_arr );
}


/**
 * Pagina delle opzioni
 */
function quoma_main_menu_page() {
	?>
	<div class="wrap">
		<h2>Quotations Manager</h2>
		<h3>Opzioni</h3>
		<form method="post" action="options.php">
			<?php settings_fields( 'quoma-settings-group' ); ?>
			<?php $quoma_options = get_option( 'quoma_options' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Etichetta personalizzata per il CPT "Servizi"</th>
					<td><input type="text" name="quoma_options[option_label]"
							   value="<?php echo esc_attr( $quoma_options['option_label'] ); ?>"/></td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="Salva"/>
			</p>
		</form>
	</div>
	<?php
}
