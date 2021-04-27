<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

$social_url_repeater = get_theme_mod('social_url_repeater' );
/*This returns a json so we have to decode it*/
$social_url_repeater_decoded = json_decode($social_url_repeater);

?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">
	<div id="social-wrapper">
		<div class="container">
			<div id="social-bar" class="row align-items-center">
				<div class="col-sm-auto social-bar-elements">
					<span id="social-bar-title"><?php echo get_theme_mod( 'social_bar_text_content', '' ); ?></span>
				</div>
				<div class="col social-bar-elements">
					<ul class="list-inline">
						<?php
						foreach($social_url_repeater_decoded as $repeater_item){
							$social_repeater = json_decode(html_entity_decode($repeater_item->social_repeater));
							foreach($social_repeater as $social_repeater_item){
								echo "<li class=\"list-inline-item\"><a href='" . $social_repeater_item->link . "'><i class='fa " . $social_repeater_item->icon ." fa-2x'></i></a></li>";
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!-- wrapper end -->

<?php get_template_part( 'sidebar-templates/sidebar', 'footercolumn' ); ?>

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
