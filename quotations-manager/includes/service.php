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
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<div style="text-align: center">
				<h1><?php the_title(); ?></h1>
				<p><?php the_content(); ?></p>
				<?php $extras_list = get_post_meta( get_the_ID(), '_extras_list', true );
				echo '<h3>Servizi extra disponibili</h3>';
				foreach ( $extras_list as $key => $extra ) {
					if ( ! empty( $extra['name'] ) ) {
						echo $extra['name'];
						echo '<br>';
						echo $extra['description'];
						echo '<br>';
						echo $extra['price'];
						echo '<hr>';
					}
				} ?>
			</div>
		<?php endwhile;
	endif ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>