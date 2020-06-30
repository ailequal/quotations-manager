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
	// Inizio loop
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			echo '<div style="text-align: center">';
			the_title( '<h1>', '</h1>' );
			the_content();

			// Controllo se l'utente e' loggato come 'subscriber'
			if ( current_user_can( 'subscriber' ) ) {
				echo '<div id="quoma-request-quotation"><hr><a href="#">Richiedi un preventivo</a><hr></div>';
			} else {
				echo '<hr><a href="' . wp_login_url() . '">Effetua il login per richiedere un preventivo</a><hr>';
			}

			// Durante il loop stampiamo i servizi extra di ogni servizio
			echo '<div id="quoma-extras-list" style="display:none;">';
			$extras_list = get_post_meta( get_the_ID(), '_extras_list', true );
			echo '<h3>Servizi extra disponibili</h3>';
			foreach ( $extras_list as $key => $extra ) {
				if ( ! empty( $extra['name'] ) ) {
					echo '<input class="' . $extra['slug'] . '" type="checkbox" name="' . $extra['slug'] . '" value="' . $extra['slug'] . '">';
					echo '<label style="font-size:22px; font-weight:bold;" for="' . $extra['slug'] . '">' . $extra['name'] . '</label><br>';
					echo '<p>' . $extra['description'] . '<br>';
					echo 'Prezzo servizio extra: <span style="color:red;">' . $extra['price'] . ' Euro</span></p>';
					echo '<hr>';
				}
			}
			echo '<a href="#">Invia preventivo</a>';
			echo '</div>';
		}
	}
	echo '</div>';
	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
