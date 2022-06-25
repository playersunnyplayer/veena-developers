<?php
function eventpress_countdown_setting( $wp_customize ) {

$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	funfact Section Panel
	=========================================*/
		$wp_customize->add_section(
			'Funfact_setting', array(
				'title' => esc_html__( 'Countdown Section', 'eventpress' ),
				'panel' => 'eventpress_frontpage_sections',
				'priority' => apply_filters( 'eventpress_section_priority', 30, 'eventpress_Funfact' ),
			)
		);
	/*=========================================
	Countdown Settings Section
	=========================================*/
	// Countdown Hide/ Show Setting // 
	if ( class_exists( 'Eventpress_Customizer_Toggle_Control' ) ) {
		$wp_customize->add_setting( 
			'hide_show_funfact' , 
				array(
				'default' => esc_html__( '1', 'eventpress' ),
				'capability' => 'edit_theme_options',
				'transport'         => $selective_refresh,
			) 
		);
		
		$wp_customize->add_control( new Eventpress_Customizer_Toggle_Control( $wp_customize, 
		'hide_show_funfact', 
			array(
				'label'	      => esc_html__( 'Hide / Show Section', 'eventpress' ),
				'section'     => 'Funfact_setting',
				'settings'    => 'hide_show_funfact',
				'type'        => 'ios', // light, ios, flat
			) 
		));
	}	
	
	// about Title // 
	$wp_customize->add_setting(
    	'funfact_section_title',
    	array(
	        'default'			=> __('We Are Waiting For','eventpress'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_html',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'funfact_section_title',
		array(
		    'label'   => __('Title','eventpress'),
		    'section' => 'Funfact_setting',
			'type'           => 'text',
		)  
	);
	// about Description // 
	$wp_customize->add_setting(
    	'funfact_section_description',
    	array(
	        'default'			=> __('Lorem ipsum is simply a dummy text of the printing and typesetting of industry ','eventpress'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_text',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'funfact_section_description',
		array(
		    'label'   => __('Description','eventpress'),
		    'section' => 'Funfact_setting',
			'type'           => 'textarea',
		)  
	);
	// funfact content Section // 
	
	// countdown time // 
	$wp_customize->add_setting(
    	'funfact_countdown_time',
    	array(
	        'default'			=> __('2019/12/25 12:00:00','eventpress'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_date_time',
		)
	);	
	$wp_customize->add_control( 
		'funfact_countdown_time',
		array(
		    'section' => 'Funfact_setting',
			'type'     => 'date_time',
		)  
	);
	// Funfact Background Section // 
	
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'funfact_background_setting' , 
    	array(
			'default' 			=> EVENTO_PLUGIN_URL . '/inc/eventpress/images/timecounterbg.jpg',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'eventpress_sanitize_url',	
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'funfact_background_setting' ,
		array(
			'label'          => __( 'Background Image', 'eventpress' ),
			'section'        => 'Funfact_setting',
			'settings'   	 => 'funfact_background_setting',
		) 
	));	
}
add_action( 'customize_register', 'eventpress_countdown_setting' );
?>
<?php
// Customizer tabs

function eventpress_funfact_customize_register( $wp_customize ) {
	if ( class_exists( 'eventpress_Customize_Control_Tabs' ) ) {

		
	}
}
add_action( 'customize_register', 'eventpress_funfact_customize_register' );
// funfact selective refresh
function eventpress_home_funfact_section_partials( $wp_customize ){
	// hide show feature
	$wp_customize->selective_refresh->add_partial(
		'hide_show_funfact', array(
			'selector' => '#counter',
			'container_inclusive' => true,
			'render_callback' => 'Funfact_setting',
			'fallback_refresh' => true,
		)
	);
	
	// funfact title
	$wp_customize->selective_refresh->add_partial( 'funfact_section_title', array(
		'selector'            => '#counter .section-title h2',
		'settings'            => 'funfact_section_title',
		'render_callback'  => 'home_section_funfact_section_title_render_callback',
	) );
	
	// funfact description
	$wp_customize->selective_refresh->add_partial( 'funfact_section_description', array(
		'selector'            => '#counter .section-title p',
		'settings'            => 'funfact_section_description',
		'render_callback'  => 'home_section_funfact_section_description_render_callback',
	) );
	}
add_action( 'customize_register', 'eventpress_home_funfact_section_partials' );


// funfact_section_title
function home_section_funfact_section_title_render_callback() {
	return get_theme_mod( 'funfact_section_title' );
}
// description
function home_section_funfact_section_description_render_callback() {
	return get_theme_mod( 'funfact_section_description' );
}