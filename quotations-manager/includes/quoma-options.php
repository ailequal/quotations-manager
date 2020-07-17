<?php
/**
 * Pagina delle opzioni del plugin lato amministratore.
 */


/**
 * Salvataggio della etichetta personalizzate per i servizi.
 */
//if ( ! get_option( 'quoma_options' ) ) {
//	$quoma_options_arr = array(
//		'quoma_service_custom_label' => 'Etichetta personalizzata.'
//	);
//
//	add_option( 'quoma_options', $quoma_options_arr );
//}

//$quoma_options_arr = array(
//	'quoma_service_custom_label' => 'OH WOW!!'
//);
//update_option( 'quoma_options', $quoma_options_arr );


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
		null
	);

	function quoma_register_settings() {
		register_setting(
			'quoma-settings-group',
			'quoma_options',
			'quoma_sanitize_options'
		);
	}

	function quoma_sanitize_options( $input ) {
		$input['option_label'] = sanitize_text_field( $input['option_label'] );

		return $input;
	}

	add_action( 'admin_init', 'quoma_register_settings' );

	function quoma_main_menu_page() {
		?>
		<div class="wrap">
			<h2>Quotations Manager Options</h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'quoma-settings-group' ); ?>
				<?php $quoma_options = get_option( 'quoma_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Etichetta personalizzata</th>
						<td><input type="text" name="quoma_options[option_label]"
								   value="<?php echo esc_attr( $quoma_options['option_label'] ); ?>"/></td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="Save Changes"/>
				</p>
			</form>
		</div>
		<?php
	}
}

add_action( 'admin_menu', 'quoma_main_menu' );
