<?php
/**
 * Sidebar setup for footer full
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php //if ( is_active_sidebar( 'footerleft' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">
		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">
			<div class="row">
				<div class="col">
					<?php dynamic_sidebar( 'footerleft' ); ?>
				</div>
				<div class="col">
					<?php dynamic_sidebar( 'footermiddle' ); ?>
				</div>
				<div class="col">
					<?php dynamic_sidebar( 'footerright' ); ?>
				</div>
			</div>
		</div>
	</div><!-- #wrapper-footer-full -->

	<?php
//endif;
