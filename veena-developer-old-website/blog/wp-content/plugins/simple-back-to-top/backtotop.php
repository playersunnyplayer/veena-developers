<?php
/*
Plugin Name: Simple Back To Top
Plugin URI: http://www.phpboys.in/simple-back-to-top-wordpress-plugin.html
Description: Simple Back to top
Version: 1.0
Author: Praveen Punniyamoorthy
Author URI: http://www.phpboys.in
Licenses: GPL2
*/

// Define constant for plugin path
define('SBTT_PATH', plugin_dir_url( __FILE__ ));

global $default_image;

$default_image	=	array(
							'sbtt_image'	=>  SBTT_PATH . 'images/backtotop.png'
						);

function activation_UpdateDefault()
{
	global $default_image;
	update_option('sbtt_options', $default_image);
}

function sbtt_deactivate()
{
	delete_option( 'sbtt_options' );
}

function sbtt_menu() 
{
    add_options_page( 'Sbtt Plugin Options', 'Back To Top - SBTT', 'manage_options', 'sbtt-option', 'sbtt_plugin_options' );
}

function sbtt_plugin_options() 
{
    if ( !current_user_can( 'manage_options' ) )  
    {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    include __DIR__."/options.php";
}

//inline settings menu on admin section
function sbtt_settings_link( $links ) 
{
    $settings_link = '<a href="'.admin_url( 'options-general.php?page=sbtt-option' ).'">Settings</a>';
    array_push( $links, $settings_link );
    return $links;
}

$plugin = plugin_basename( __FILE__ );

register_activation_hook(__FILE__,'activation_UpdateDefault');
register_deactivation_hook( __FILE__, 'sbtt_deactivate' );
add_action( 'admin_menu', 'sbtt_menu');
add_filter( "plugin_action_links_$plugin", 'sbtt_settings_link' );

function sbtt_backend_styles()
{
    wp_enqueue_style( 'sbtt', SBTT_PATH . 'css/sbtt-back.css'); 
}

function sbtt_scripts() 
{
	$localize_image	=	get_option('sbtt_options');
	wp_enqueue_style( 'sbtt-style', SBTT_PATH . '/css/sbtt-front.css');
	wp_enqueue_script( 'sbtt-scripts', SBTT_PATH . '/js/sbtt.js', array('jquery'));
	wp_localize_script( 'sbtt-scripts', 'sbttback', array('sbttimg' =>$localize_image['sbtt_image']));
}

add_action( 'wp_enqueue_scripts', 'sbtt_scripts' );

add_action('admin_init', 'sbtt_backend_styles');



