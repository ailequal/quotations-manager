<?php
/**
 * Il template custom per un singolo preventivo
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quotations Manager
 * @since Quotations Manager 0.0.1
 */


get_header();
?>

<main id="site-content" role="main">

	<?php
	// Controllo se l'utente e' loggato come 'subscriber'
	if ( current_user_can( 'subscriber' ) ) {
		$user             = wp_get_current_user();
		$user_name        = esc_html( $user->user_login );
		$quotation_author = get_the_author_meta( 'display_name', $post->post_author );
		// Controllo che l'utente loggato corrisponda all'autore del preventivo
		if ( $quotation_author === $user_name ) {
			// Recupero dati del preventivo
			$quoma_quotation_service_id      = get_post_meta( get_the_ID(), '_service_id', true );
			$quoma_quotation_service_name    = get_the_title( esc_attr( $quoma_quotation_service_id ) );
			$quoma_quotation_price_list      = get_post_meta( $quoma_quotation_service_id, '_price_list', true );
			$quoma_quotation_price_total     = get_post_meta( get_the_ID(), '_price_total', true );
			$quoma_quotation_extras_selected = get_post_meta( get_the_ID(), '_extras_selected', true );

			// Visualizzare il suo preventivo
			echo '<div style="text-align: center">';
			the_title( '<h1>', '</h1>' );
			echo '<h2>Tipologia di servizio:</h2>';
			echo '<h3>' . $quoma_quotation_service_name . '</h3>';
			echo '<h2>Servizi extra selezionati:</h2>';
			if ( ! empty( $quoma_quotation_extras_selected ) ) {
				foreach ( $quoma_quotation_extras_selected as $key => $extra ) {
					echo '<h3>' . $extra['name'] . ' (' . $extra['price'] . ' Euro)</h3>';
				}
			} else {
				echo '<h3>Nessun servizio extra selezionato</h3>';
			}
			echo '<h2>Prezzo totale: ' . $quoma_quotation_price_total . ' Euro</h2>';
			echo '</div>';
		}
	} else {
		// Non visualizzare niente
		echo '<h2 style="text-align: center;">Tu non dovresti essere qui.</h2>';
	}
	?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
