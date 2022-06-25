<?php
function eventpress_contact_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Portfolio Section Panel
	=========================================*/
		$wp_customize->add_section(
			'contact_form_setting', array(
				'title' => esc_html__( 'Contact Section', 'eventpress' ),
				'panel' => 'eventpress_frontpage_sections',
				'priority' => apply_filters( 'eventpress_section_priority', 45, 'eventpress_contact' ),
			)
		);
		
	if ( class_exists( 'Eventpress_Customizer_Toggle_Control' ) ) {	
	$wp_customize->add_setting( 
		'contact_form_setting' , 
			array(
			'default' => esc_html__( '1', 'eventpress' ),
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
		) 
	);
	
	$wp_customize->add_control( new Eventpress_Customizer_Toggle_Control( $wp_customize, 
	'contact_form_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'eventpress' ),
			'section'     => 'contact_form_setting',
			'settings'    => 'contact_form_setting',
			'type'        => 'ios', // light, ios, flat
		) 
	));
	}
	// Portfolio Header Section // 
	
	
	// Portfolio Title // 
	$wp_customize->add_setting(
    	'cont_form_title',
    	array(
	        'default'			=> __('Send Wishes','eventpress'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_html',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'cont_form_title',
		array(
		    'label'   => __('Title','eventpress'),
		    'section' => 'contact_form_setting',
			'settings'   	 => 'cont_form_title',
			'type'           => 'text',
		)  
	);
	// Service Description // 
	$wp_customize->add_setting(
    	'cont_form_description',
    	array(
	        'default'			=> __('Lorem Ipsum is simply dummy text of the printing and typesetting industry','eventpress'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_text',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'cont_form_description',
		array(
		    'label'   => __('Description','eventpress'),
		    'section' => 'contact_form_setting',
			'settings'   	 => 'cont_form_description',
			'type'           => 'textarea',
		)  
	);
	
	$wp_customize->add_setting(
    	'contactss_form_shortcode',
    	array(
			'capability'     	=> 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 
		'contactss_form_shortcode',
		array(
		    'label'   => __('Contact Form Shortcode','eventpress'),
		    'section' => 'contact_form_setting',
			'settings'=> 'contactss_form_shortcode',
			'type' => 'textarea',
			'description'    => __('', 'eventpress' ),
			'priority' => 25,
		)  
	);

}

add_action( 'customize_register', 'eventpress_contact_setting' );

function eventpress_home_portfolio_section_partials( $wp_customize ){

// contact_form_setting
	$wp_customize->selective_refresh->add_partial(
		'contact_form_setting', array(
			'selector' => '.contact-section',
			'container_inclusive' => true,
			'render_callback' => 'contact_form_setting',
			'fallback_refresh' => true,
		)
	);
	
	//title
	$wp_customize->selective_refresh->add_partial( 'cont_form_title', array(
		'selector'            => '.contact-section .section-title h2',
		'settings'            => 'cont_form_title',
		'render_callback'  => 'cont_form_title_render_callback',
	
	) );
	// description
	$wp_customize->selective_refresh->add_partial( 'cont_form_description', array(
		'selector'            => '.contact-section .section-title p',
		'settings'            => 'cont_form_description',
		'render_callback'  => 'cont_form_description_render_callback',
	
	) );
	// description
	$wp_customize->selective_refresh->add_partial( 'contactss_form_shortcode', array(
		'selector'            => '.contact-section .contact-form',
		'settings'            => 'contactss_form_shortcode',
		'render_callback'  => 'contactss_form_shortcode_render_callback',
	
	) );
	}

add_action( 'customize_register', 'eventpress_home_portfolio_section_partials' );

// cont_form_title
function cont_form_title_render_callback() {
	return get_theme_mod( 'cont_form_title' );
}
// cont_form_description
function cont_form_description_render_callback() {
	return get_theme_mod( 'cont_form_description' );
}
// cont_form_description
function contactss_form_shortcode_render_callback() {
	return get_theme_mod( 'contactss_form_shortcode' );
}