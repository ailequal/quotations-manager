<?php
/**
 * Il template custom per un singolo preventivo
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quotations Manager
 * @since Quotations Manager 0.0.1
 */

// Variabili per la visualizzazione
$user                            = wp_get_current_user();
$user_name                       = esc_html( $user->user_login );
$quotation_author                = get_the_author_meta( 'display_name', $post->post_author );
$quoma_quotation_service_id      = get_post_meta( get_the_ID(), '_service_id', true );
$quoma_quotation_service_name    = get_the_title( esc_attr( $quoma_quotation_service_id ) );
$quoma_quotation_price_list      = get_post_meta( $quoma_quotation_service_id, '_price_list', true );
$quoma_quotation_price_total     = get_post_meta( get_the_ID(), '_price_total', true );
$quoma_quotation_extras_selected = get_post_meta( get_the_ID(), '_extras_selected', true );

get_header();
?>

<main id="site-content" role="main">

	<?php if ( current_user_can( 'subscriber' ) ) : ?>
		<?php if ( $quotation_author === $user_name ) : ?>
			<div style="text-align: center">
				<h1><?php echo get_the_title() ?></h1>
				<h2>Tipologia di servizio:</h2>
				<h3><?php echo $quoma_quotation_service_name ?></h3>
				<h2>Servizi extra selezionati:</h2>
				<?php if ( ! empty( $quoma_quotation_extras_selected ) ) : ?>
					<?php foreach ( $quoma_quotation_extras_selected as $key => $extra ) : ?>
						<h3><?php echo $extra['name'] ?> (<?php echo $extra['price'] ?> Euro)</h3>
					<?php endforeach ?>
				<?php else : ?>
					<h3>Nessun servizio extra selezionato</h3>
				<?php endif ?>
				<h2>Prezzo totale: <?php echo $quoma_quotation_price_total ?> Euro</h2>
			</div>
		<?php endif ?>
	<?php else : ?>
		<h2 style="text-align: center;">Tu non dovresti essere qui.</h2>
	<?php endif ?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
