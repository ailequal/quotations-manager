<?php
/**
 * Il template custom per i CPT service
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
	echo '<form method="post" action="' . admin_url( 'admin-ajax.php' ) . '">';
	// Inizio loop
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			echo '<div style="text-align: center">';
			the_title( '<h1>', '</h1>' );
			$price_list = get_post_meta( get_the_ID(), '_price_list', true );
			echo '<h3>Prezzo di base: ' . $price_list . ' Euro.</h3>';
			the_content();

			// Controllo se l'utente e' loggato come 'subscriber'
			if ( current_user_can( 'subscriber' ) ) {
				echo '<div id="quoma-request-quotation"><hr><a href="#">Richiedi un preventivo</a><hr></div>';
			} else {
				echo '<hr><a href="' . wp_login_url( $_SERVER['REQUEST_URI'] ) . '">Effetua il login per richiedere un preventivo</a><hr>';
			}

			// Durante il loop stampiamo i servizi extra di ogni servizio
			echo '<div id="quoma-extras-list" style="display:none;">';
			$extras_list = get_post_meta( get_the_ID(), '_extras_list', true );
			echo '<h3>Servizi extra disponibili</h3>';
			foreach ( $extras_list as $key => $extra ) {
				if ( ! empty( $extra['name'] ) ) {
					echo '<div class="quoma-extra">';
					echo '<input class="' . $extra['slug'] . '" type="checkbox" name="extras_selected[]" value="' . $extra['slug'] . '">';
					echo '<label style="font-size:22px; font-weight:bold;" for="extras_selected[]">' . $extra['name'] . '</label><br>';
					echo '<div><p>' . $extra['description'] . '</p><br>';
					echo 'Prezzo servizio extra: <span style="color:red;">' . $extra['price'] . '</span></div>';
					echo '</div><hr>';
				}
			}
			echo '<input type="hidden" name="action" value="quoma_create_quotation"/>';
			echo '<input type="hidden" name="service_id" value="' . get_the_ID() . '"/>';
			wp_nonce_field( 'quoma_service_form_save', 'quoma_service_nonce' );
			echo '<input type="submit" name="submit" value="Invia preventivo">';
			echo '</div>';
		}
	}
	echo '</div></form>';
	?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
