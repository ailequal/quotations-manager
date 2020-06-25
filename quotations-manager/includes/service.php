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
				<?php $extras_list = get_post_meta( get_the_ID() );
				var_dump( $extras_list ); ?>
			</div>
		<?php endwhile;
	endif ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
