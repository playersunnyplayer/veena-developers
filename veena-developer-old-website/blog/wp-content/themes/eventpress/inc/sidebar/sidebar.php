<?php	
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eventpress
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
 
function eventpress_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'eventpress' ),
		'id' => 'sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'eventpress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );	
}
add_action( 'widgets_init', 'eventpress_widgets_init' );
 
?>