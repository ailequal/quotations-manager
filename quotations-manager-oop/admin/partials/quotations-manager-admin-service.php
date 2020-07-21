<?php

/**
 * La grafica di un singolo servizio.
 *
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/admin/partials
 */

// Variabili per la visualizzazione
$price_list  = get_post_meta( get_the_ID(), '_price_list', true );
$extras_list = get_post_meta( get_the_ID(), '_extras_list', true );

get_header();
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<main id="site-content" role="main">
	<form action="post" action="<?php admin_url( 'admin-ajax.php' ) ?>" style="text-align: center;">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1><?php echo get_the_title() ?></h1>
			<h3>Prezzo di base: <?php echo $price_list ?> Euro.</h3>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>

		<?php if ( current_user_can( 'subscriber' ) ) : ?>
			<div id="quoma-request-quotation">
				<hr>
				<a href="#">Richiedi un preventivo</a>
				<hr>
			</div>
		<?php else : ?>
			<hr>
			<a href="<?php wp_login_url( $_SERVER['REQUEST_URI'] ) ?>">Effetua il login per richiedere un preventivo</a>
			<hr>
		<?php endif ?>

		<div id="quoma-extras-list" style="display:none;">
			<h3>Servizi extra disponibili</h3>
			<?php foreach ( $extras_list as $key => $extra ) : ?>
				<?php if ( ! empty( $extra['name'] ) ) : ?>
					<div class="quoma-extra">
						<input class="<?php echo $extra['slug'] ?>" type="checkbox" name="extras_selected[]"
							   value="<?php echo $extra['slug'] ?>">
						<label style="font-size:22px; font-weight:bold;"
							   for="extras_selected[]"><?php echo $extra['name'] ?></label><br>
						<div><p><?php echo $extra['description'] ?></p><br>Prezzo servizio extra: <span
								style="color:red;"><?php echo $extra['price'] ?></span></div>
					</div>
					<hr>
				<?php endif ?>
			<?php endforeach; ?>

			<input type="hidden" name="action" value="quoma_create_quotation"/>
			<input type="hidden" name="service_id" value="<?php echo get_the_ID() ?>"/>
			<?php wp_nonce_field( 'quoma_service_form_save', 'quoma_service_nonce' ) ?>
			<input type="submit" name="submit" value="Invia preventivo">
		</div>

	</form>
</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
