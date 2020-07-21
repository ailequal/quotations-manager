<?php

/**
 * La grafica del pannello delle opzioni.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
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
