<?php
/**
 * UnderStrap Theme Customizer
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'understrap_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'understrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'understrap' ),
				'priority'    => apply_filters( 'understrap_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		/*function understrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}*/

		/**
		 * DropDown page sanitization function
		 * @param $page_id
		 * @param $setting
		 * @return int|mixed
		 */
		function themeslug_sanitize_dropdown_pages( $page_id, $setting ) {
			// Ensure $input is an absolute integer.
			$page_id = absint( $page_id );

			// If $page_id is an ID of a published page, return it; otherwise, return the default.
			return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
		}

		/*$wp_customize->add_setting(
			'understrap_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type',
				array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => apply_filters( 'understrap_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'understrap' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 20 ),
				)
			)
		);*/

		/**
		 * T??l??phone dans le Header
		 */
		$wp_customize->add_setting(
			'main_nav_tel_content',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'main_nav_tel_content',
				array(
					'label'             => esc_html__( 'N?? de tel nav principale', 'understrap' ),
					'description'       => esc_html__(
						'N?? de t??l??phone ?? afficher ?? droite du menu principal.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'main_nav_tel_content',
					'type'              => 'text',
					'priority'          => apply_filters( 'main_nav_tel_content_priority', 10 ),
				)
			)
		);

		/**
		 * Libell?? du bouton contact du header
		 */
		$wp_customize->add_setting(
			'main_nav_contact_button_content',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'main_nav_contact_button_content',
				array(
					'label'             => esc_html__( 'Libell?? du bouton contact', 'understrap' ),
					'description'       => esc_html__(
						'Texte ?? afficher dans le bouton ?? droite du menu.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'main_nav_contact_button_content',
					'type'              => 'text',
					'priority'          => apply_filters( 'main_nav_contact_button_content_priority', 20 ),
				)
			)
		);

		/**
		 * Page du bouton contact du header
		 */
		$wp_customize->add_setting(
			'main_nav_contact_button_url',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'themeslug_sanitize_dropdown_pages',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'main_nav_contact_button_url',
			array(
				'label' => __( 'Custom Dropdown Pages', 'understrap' ),
				'type' => 'dropdown-pages',
				'section' => 'understrap_theme_layout_options',
				'description'       => __(
					'page publi??e vers laquelle rediriger l\'utilisateur au clic sur le bouton.',
					'understrap'
				),
				'priority' => apply_filters( 'main_nav_contact_button_url_priority', 30 ),
			)
		);

		/**
		 * Libell?? de la barre sociale
		 */
		$wp_customize->add_setting(
			'social_bar_text_content',
			array(
				'default'           => 'Suivez-nous sur les r??seaux sociaux',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'social_bar_text_content',
				array(
					'label'             => esc_html__( 'Libell?? de la barre sociale', 'understrap' ),
					'description'       => esc_html__(
						'Texte ?? afficher avant les ic??nes sociales.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'social_bar_text_content',
					'type'              => 'text',
					'priority'          => apply_filters( 'social_bar_text_content', 40 ),
				)
			)
		);

		/**
		 * rep??teur d'url pour la barre sociale
		 */
		$wp_customize->add_setting( 'social_url_repeater', array(
			'sanitize_callback' => 'customizer_repeater_sanitize'
		));
		$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'social_url_repeater', array(
			'label'   => esc_html__('Liens sociaux','customizer-repeater'),
			'section' => 'understrap_theme_layout_options',
			'priority' => 50,
			'customizer_repeater_image_control' => false,
			'customizer_repeater_icon_control' => false,
			'customizer_repeater_title_control' => false,
			'customizer_repeater_subtitle_control' => false,
			'customizer_repeater_text_control' => false,
			'customizer_repeater_link_control' => false,
			'customizer_repeater_shortcode_control' => false,
			'customizer_repeater_repeater_control' => true
		) ) );
	}
} // End of if function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script(
			'understrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
