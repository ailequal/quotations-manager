<?php
/**
 * Il template custom per 'miei-preventivi'
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quotations Manager
 * @since Quotations Manager 0.0.1
 */

// Variabili per la visualizzazione
$user      = wp_get_current_user();
$user_id   = esc_html( $user->ID );
$user_name = esc_html( $user->user_login );
$args      = array(
	'author'    => $user_id,
	'post_type' => 'quotation',
	'order'     => 'DESC',
);

get_header();
?>

<main id="site-content" role="main">

	<?php if ( current_user_can( 'subscriber' ) ) : ?>
		<div style="text-align: center">
			<h1>I miei preventivi</h1>
			<h5>Lista di tutti i preventivi richiesti da <span style="color:red;"><?php echo $user_name ?></span>.</h5>
			<?php $query = new WP_Query( $args ); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post() ?>
				<?php
				$service_id         = get_post_meta( get_the_ID(), '_service_id', true );
				$service_name       = get_post( $service_id )->post_title;
				$service_price_list = get_post_meta( $service_id, '_price_list', true );
				$extras_selected    = get_post_meta( get_the_ID(), '_extras_selected', true );
				$price_total        = get_post_meta( get_the_ID(), '_price_total', true );
				?>
				<a href="<?php echo get_the_permalink() ?>"><h3><?php echo get_the_title() ?></h3></a>
				<h4>Servizio selezionato: <span style="color:red;"><?php echo $service_name ?></span>.</h4>
				<h5>Prezzo base di <span style="color:red;"><?php echo $service_price_list ?> Euro</span>.</h5>
				<?php if ( ! empty( $extras_selected ) ) : ?>
					<h4>Servizi extra selezionati: </h4>
					<?php foreach ( $extras_selected as $key => $extra ) : ?>
						<h6><?php echo $extra['name'] ?></h6>
						<p><?php echo $extra['description'] ?>. Prezzo: <span
								style="color:red;"><?php echo $extra['price'] ?> Euro</span></p>
					<?php endforeach ?>
				<?php else : ?>
					<h4>Nessun servizio extra selezionato.</h4>
				<?php endif ?>
				<h3>Prezzo totale del preventivo:
					<span style="color:#ff0000;"><?php echo $price_total ?> Euro</span>.</h3>
				<hr>
				<?php wp_reset_postdata() ?>
			<?php endwhile ?>
				<h6>Non hai ancora richiesto nessun preventivo.</h6>
			<?php endif ?>
			<h2>Tu non dovresti essere qui.</h2>
		</div>
	<?php endif ?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
