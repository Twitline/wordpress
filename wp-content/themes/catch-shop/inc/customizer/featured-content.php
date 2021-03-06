<?php
/**
 * Featured Content options
 *
 * @package Catch_Shop
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Catch Shop Theme, go %1$shere%2$s', 'catch-shop' ),
                '<a href="javascript:wp.customize.section( \'catch_shop_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_shop_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'catch-shop' ),
			'panel' => 'catch_shop_theme_options',
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	// Add note to ECT Featured Content Section
    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'active_callback'   => 'catch_shop_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'catch-shop' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_shop_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'active_callback'   => 'catch_shop_is_ect_featured_content_active',
			'choices'           => catch_shop_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-shop' ),
			'section'           => 'catch_shop_featured_content',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_featured_content_tagline',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_featured_content_active',
			'label'             => esc_html__( 'Tagline', 'catch-shop' ),
			'section'           => 'catch_shop_featured_content',
			'type'              => 'text',
		)
	);

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'active_callback'   => 'catch_shop_is_featured_content_active',
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-shop' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_shop_featured_content',
            'type'              => 'description',
        )
    );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'catch_shop_sanitize_number_range',
			'active_callback'   => 'catch_shop_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No of items is changed', 'catch-shop' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-shop' ),
			'section'           => 'catch_shop_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'catch_shop_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_shop_register_option( $wp_customize, array(
				'name'              => 'catch_shop_featured_content_cpt_' . $i,
				'sanitize_callback' => 'catch_shop_sanitize_post',
				'active_callback'   => 'catch_shop_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'catch-shop' ) . ' ' . $i ,
				'section'           => 'catch_shop_featured_content',
				'type'              => 'select',
                'choices'           => catch_shop_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().

	catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_text',
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_content_active',
            'label'             => esc_html__( 'Button Text', 'catch-shop' ),
            'section'           => 'catch_shop_featured_content',
            'type'              => 'text',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_link',
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'catch_shop_is_featured_content_active',
            'label'             => esc_html__( 'Button Link', 'catch-shop' ),
            'section'           => 'catch_shop_featured_content',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_content_target',
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'active_callback'   => 'catch_shop_is_featured_content_active',
            'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-shop' ),
            'section'           => 'catch_shop_featured_content',
            'custom_control'    => 'Catch_Shop_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'catch_shop_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_shop_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since 1.0
	*/
	function catch_shop_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_shop_featured_content_option' )->value();

		return catch_shop_check_section( $enable );
	}
endif;

if ( ! function_exists( 'catch_shop_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since 1.0.0
    */
    function catch_shop_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'catch_shop_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since 1.0.0
    */
    function catch_shop_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
