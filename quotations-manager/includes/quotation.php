<?php
/**
 * Il template custom per 'miei-preventivi'
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
		$user      = wp_get_current_user();
		$user_id   = esc_html( $user->ID );
		$user_name = esc_html( $user->user_login );

		// Visualizzare tutti i suoi preventivi
		echo '<div style="text-align: center">';
		echo '<h1>I miei preventivi</h1>';
		echo '<h5>Lista di tutti i preventivi richiesti da <span style="color:red;">' . $user_name . '</span>.</h5>';

		// Inizio custom loop
		$args  = array(
			'author'    => $user_id,
			'post_type' => 'quotation',
			'order'     => 'DESC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$service_id         = get_post_meta( get_the_ID(), '_service_id', true );
				$service_name       = get_post( $service_id )->post_title;
				$service_price_list = get_post_meta( $service_id, '_price_list', true );
				$extras_selected    = get_post_meta( get_the_ID(), '_extras_selected', true );
				$price_total        = get_post_meta( get_the_ID(), '_price_total', true );
				the_title( '<h3 style="color:blue;">', '</h3>' );
				echo '<h4>Servizio selezionato: <span style="color:red;">' . $service_name . '</span>.</h4>';
				echo '<h5>Prezzo base di <span style="color:red;">' . $service_price_list . ' Euro</span>.</h5>';
				if ( ! empty( $extras_selected ) ) {
					echo '<h4>Servizi extra selezionati: </h4>';
					foreach ( $extras_selected as $key => $extra ) {
						echo '<h6>' . $extra['name'] . '</h6>';
						echo '<p>' . $extra['description'] . ' Prezzo: ';
						echo '<span style="color:red;">' . $extra['price'] . ' Euro</span></p>';
					}
				} else {
					echo '<h4>Nessun servizio extra selezionato.</h4>';
				}
				echo '<h3>Prezzo totale del preventivo: <span style="color:red;">' . $price_total . ' Euro</span>.</h3><hr>';
				wp_reset_postdata();
			}
		} else {
			echo '<h6>Non hai ancora richiesto nessun preventivo.</h6>';
		}
		echo '</div>';
	} else {
		// Non visualizzare niente
		echo '<h2>Tu non dovresti essere qui.</h2>';
	}
	?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
