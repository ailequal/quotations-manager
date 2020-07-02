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
		echo '<h5>Lista di tutti i preventivi richiesti da ' . $user_name . '.</h5>';

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
//				var_dump( $query );
				the_title( '<h3>', '</h3>' );
				the_content();
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

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
