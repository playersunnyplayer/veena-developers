<?php
 /**
 * Enqueue scripts and styles.
 */
function eventpress_scripts() {
	
	// Styles
	
	wp_enqueue_style( 'eventpress-style', get_stylesheet_uri() );
	wp_enqueue_style('eventpress-color-default', get_template_directory_uri() . '/css/color/default.css');
	
	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/css/bootstrap.min.css');
	
	wp_enqueue_style('meanmenu-min',get_template_directory_uri().'/css/meanmenu.min.css');
	
	wp_enqueue_style('fontawesome',get_template_directory_uri().'/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');
	
	wp_enqueue_style('eventpress-widget',get_template_directory_uri().'/css/widget.css');
	
	wp_enqueue_style('eventpress-editor-style',get_template_directory_uri().'/css/editor-style.css');
	
	wp_enqueue_style('eventpress-typography',get_template_directory_uri().'/css/typography/typography.css');
	
	wp_enqueue_style('eventpress-responsive',get_template_directory_uri().'/css/responsive.css');
	
	
	// Scripts
	
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
	
	wp_enqueue_script('sticky-js', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), false, true);
	
	wp_enqueue_script('counterup', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('eventpress-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true);
	
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eventpress_scripts' );

//Customizer Enqueue for Premium Buttons
function eventpress_premium_css()	{
	wp_enqueue_style('style-customizer',get_template_directory_uri(). '/css/style-customizer.css');
}
add_action('customize_controls_print_styles','eventpress_premium_css');

function eventpress_customizer_script() {
	 wp_enqueue_script( 'eventpress_customizer_section', get_template_directory_uri() .'/js/customizer-section.js', array("jquery"),'', true  );	
}
add_action( 'customize_controls_enqueue_scripts', 'eventpress_customizer_script' );
?>