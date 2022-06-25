<?php
/* Notifications in customizer */


require get_template_directory() . '/inc/customizer-notify/eventpress-customizer-notify.php';
$config_customizer = array(
	'recommended_plugins'       => array(
		'evento' => array(
			'recommended' => true,
			'description' => sprintf('Install and activate <strong>Evento</strong> plugin for taking full advantage of all the features this theme has to offer %s.', 'eventpress'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'eventpress' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'eventpress' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'eventpress' ),
	'activate_button_label'     => esc_html__( 'Activate', 'eventpress' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'eventpress' ),
);
Eventpress_Customizer_Notify::init( apply_filters( 'eventpress_customizer_notify_array', $config_customizer ) );
?>