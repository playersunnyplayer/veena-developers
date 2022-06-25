<?php
// Customizer tabs
function evento_eventpress_customize_register( $wp_customize ) {
	if ( class_exists( 'Evento_Customize_Control_Tabs' ) ) {
		// Booknow Tabs
		$wp_customize->add_setting(
			'eventpress_book_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_book_tabs', array(
					'section' => 'header_booknow',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'booknow_setting',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Book Now', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'header_btn_icon',
								'header_btn_lbl',
								'header_btn_link',
							),
						),
					),
				)
			)
		);
		
		// Blog Tabs
		$wp_customize->add_setting(
			'eventpress_blog_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_blog_tabs', array(
					'section' => 'blog_setting',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_blog',
								
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Header', 'eventpress' ),
							'icon' => 'header',
							'controls' => array(
								'blog_title',
								'blog_description',
							),
						),
						'second' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'info',
							'controls' => array(
								'blog_display_num',
							),
						),
					),
				)
			)
		);
		
		
		// Footer Top Tabs
		$wp_customize->add_setting(
			'eventpress_footer_top_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_footer_top_tabs', array(
					'section' => 'footer_top',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Settings', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_foo_top',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'footer_logo_setting',
								'foot_regards_text',
							),
						),
					),
				)
			)
		);
		
		// Footer Address Tabs
		$wp_customize->add_setting(
			'eventpress_footer_address_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_footer_address_tabs', array(
					'section' => 'footer_info_settings',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Settings', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'footer_info_setting',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'footer_info_contents',
							),
						),
					),
				)
			)
		);
		
		// Footer Copyrght Tabs
		$wp_customize->add_setting(
			'eventpress_copyrights_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_copyrights_tabs', array(
					'section' => 'footer_copyright',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Settings', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_copyright',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'copyright_content',
								'footer_background_setting',
							),
						),	
					),
				)
			)
		);
		
		// Footer Payment Tabs
		$wp_customize->add_setting(
			'eventpress_copyright_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_copyright_tabs', array(
					'section' => 'footer_icon',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Settings', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_payment',
								
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'footer_Payment_icon',
							),
						),	
					),
				)
			)
		);
		
		// Slider Tabs
		$wp_customize->add_setting(
			'eventpress_slider_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_slider_tabs', array(
					'section' => 'slider_setting',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_slider',
							),
						),
						'Content' => array(
							'nicename' => esc_html__( 'Default', 'eventpress' ),
							'icon' => 'table',
							'controls' => array(
								'slider',
								'eventpress_slider_upgrade_to_pro',
								'slider_align',
								'slider_opacity',
							),
						),
					),
					
				)
			)
		);
		
		// Contact Tabs
		$wp_customize->add_setting(
			'eventpress_form_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_form_tabs', array(
					'section' => 'contact_form_setting',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'contact_form_setting',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Header', 'eventpress' ),
							'icon' => 'header',
							'controls' => array(
								'cont_form_title',
								'cont_form_description',
							),
						),
						'second' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'info',
							'controls' => array(
								'contactss_form_shortcode',
							),
						),
					),
				)
			)
		);
		
		// Wedding Tabs
		$wp_customize->add_setting(
			'eventpress_wedding_section_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_wedding_section_tabs', array(
					'section' => 'wedding_event_setting',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_wedding_section',
								'wedding_background_setting',
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Title', 'eventpress' ),
							'icon' => 'info',
							'controls' => array(
								'wedding_section_title',
								'wedding_section_description',
							),
						),
						'second' => array(
							'nicename' => esc_html__( 'Organizer', 'eventpress' ),
							'icon' => 'history',
							'controls' => array(
								'organizer_content',
								'eventpress_org_upgrade_to_pro',
							),
						),	
					),
				)
			)
		);
		
		// Countdown Tabs
		$wp_customize->add_setting(
			'eventpress_funfact_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Evento_Customize_Control_Tabs(
				$wp_customize, 'eventpress_funfact_tabs', array(
					'section' => 'Funfact_setting',
					'tabs' => array(
						'general' => array(
							'nicename' => esc_html__( 'Setting', 'eventpress' ),
							'icon' => 'cogs',
							'controls' => array(
								'hide_show_funfact',
								
							),
						),
						'first' => array(
							'nicename' => esc_html__( 'Title', 'eventpress' ),
							'icon' => 'header',
							'controls' => array(
								'funfact_section_title',
								'funfact_section_description',
								
							),
						),
						'second' => array(
							'nicename' => esc_html__( 'Content', 'eventpress' ),
							'icon' => 'info',
							'controls' => array(
								'funfact_countdown_date',
								'funfact_countdown_time',
							),
						),
						'third' => array(
							'nicename' => esc_html__( 'BG', 'eventpress' ),
							'icon' => 'history',
							'controls' => array(
								'funfact_background_setting',
								'funfact_background_position',
							),
						),
					),
				)
			)
		);
	}
}
add_action( 'customize_register', 'evento_eventpress_customize_register' );
?>