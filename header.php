<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">
		<nav id="main-nav-wrapper" class="navbar navbar-expand-lg" aria-labelledby="main-nav-label">
			<div id="main-nav">
				<div id="logo-wrapper" class="nav-items">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
				</div>
				<div id="nav-wrapper" class="nav-items">
					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
							array(
									'theme_location'  => 'primary',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarNavDropdown',
									'menu_class'      => 'navbar-nav ml-auto',
									'fallback_cb'     => '',
									'menu_id'         => 'main-menu',
									'depth'           => 2,
									'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
							)
					);
					?>
				</div>
			</div>
			<div id="contact-wrapper" class="nav-items">
				<span id="main-navigation-tel-number"><i class="fa fa-phone"></i> <?php echo get_theme_mod( 'main_nav_tel_content', '' ); ?></span>
				<a id="main-menu-right-button" href="<?php echo get_permalink(get_theme_mod( 'main_nav_contact_button_url', '' )) ?>">
					<?php echo get_theme_mod( 'main_nav_contact_button_content', '' ); ?>
				</a>
			</div>
		</nav><!-- .site-navigation -->
	</div><!-- #wrapper-navbar end -->
