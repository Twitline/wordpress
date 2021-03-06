<?php
/**
 * Header Media Options
 *
 * @package Catch_Shop
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'catch-shop' );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-shop' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-shop' ),
				'disable'                => esc_html__( 'Disabled', 'catch-shop' ),
			),
			'label'             => esc_html__( 'Enable on', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'catch_shop_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_text_alignment',
			'default'           => 'text-align-right',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'catch-shop' ),
				'text-align-right'  => esc_html__( 'Right', 'catch-shop' ),
				'text-align-left'   => esc_html__( 'Left', 'catch-shop' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_content_alignment',
			'default'           => 'content-align-left',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'catch-shop' ),
				'content-align-right'  => esc_html__( 'Right', 'catch-shop' ),
				'content-align-left'   => esc_html__( 'Left', 'catch-shop' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'catch-shop' ),
			'section'           => 'header_image',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'active_callback'   => 'catch_shop_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-shop' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-shop' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_title',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Title', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_sub_title',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Sub Title', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'catch-shop' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_url',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'catch-shop' ),
			'section'           => 'header_image',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'catch-shop' ),
			'section'           => 'header_image',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_url_target',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-shop' ),
			'section'           => 'header_image',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_shop_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'catch_shop_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since 1.0
	*/
	function catch_shop_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'catch_shop_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
