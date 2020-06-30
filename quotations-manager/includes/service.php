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
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			echo '<div style="text-align: center">';
			the_title( '<h1>', '</h1>' );
			the_content();
			$extras_list = get_post_meta( get_the_ID(), '_extras_list', true );
			echo '<h3>Servizi extra disponibili</h3>';
			foreach ( $extras_list as $key => $extra ) {
				if ( ! empty( $extra['name'] ) ) {
					echo '<h5>' . $extra['name'] . '</h5>';
					echo '<p>' . $extra['description'] . '</p>';
					echo '<p>Prezzo servizio extra: ' . $extra['price'] . ' Euro</p>';
					echo '<hr>';
				}
			}
		}
	}

	if ( current_user_can( 'subscriber' ) ) {
		echo '<a id="quotation-new" href="#">Richiedi un preventivo</a>';
	} else {
		echo '<a href="' . wp_login_url() . '">Effetua il login per richiedere un preventivo</a>';
	}
	echo '</div>';
	?>

	<div style="margin-top: 20px; text-align: center;"><a id="click" href="#" style="margin-top: 20px;">Click</a></div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
