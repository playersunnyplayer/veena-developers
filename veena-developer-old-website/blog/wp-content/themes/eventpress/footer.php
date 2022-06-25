<?php 
	$hide_show_foo_top			= get_theme_mod('hide_show_foo_top','1'); 
	$footer_logo_setting		= get_theme_mod('footer_logo_setting',get_template_directory_uri() . '/images/footerlogo.png');
	$foot_regards_text			= get_theme_mod('foot_regards_text');
	$footer_info_setting		= get_theme_mod('footer_info_setting','1');
	$footer_info_contents		= get_theme_mod('footer_info_contents');
	$hide_show_copyright		= get_theme_mod('hide_show_copyright','1');
	$copyright_content			= get_theme_mod('copyright_content');
	$footer_background_setting	= get_theme_mod('footer_background_setting',get_template_directory_uri() . '/images/footerbg.jpg');
?>
<!--===================== 
        Start: Footer Area
     =====================-->
    <footer class="footer-section section-padding" style="background-image:url('<?php echo esc_url($footer_background_setting); ?>');">
		<div class="rocket text-center scrolltotop">
			<i class="fa fa-chevron-up"></i>
		</div>
        <div class="container">
			<?php if($hide_show_foo_top == '1') { ?> 
				<div class="row" id="foot-top">
					<div class="col-md-12 text-center footer-logo">
						<?php if ( ! empty( $footer_logo_setting ) ) : ?>
							<img src="<?php echo esc_url( $footer_logo_setting ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
						<?php endif; ?>
						<?php if($foot_regards_text) {?>
							<h2 class="thanks"><?php echo esc_html($foot_regards_text); ?></h2>
						<?php } ?>	
						<?php 
							if ( function_exists( 'eventpress_title_seprator_dark' ) ) :
								eventpress_title_seprator_dark(); 
							endif;	
						?>	
					</div>
				</div>
			<?php } ?>
			<?php if($footer_info_setting == '1') { ?> 
				<div class="row contact-info" id="foo-co-in">
					<?php
						if ( ! empty( $footer_info_contents ) ) {
						$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'b'      => array(),
						'i'      => array(),
						);
						$footer_info_contents = json_decode( $footer_info_contents );
						foreach ( $footer_info_contents as $footer_info_contents_item ) {
							$eventpress_fi_title = ! empty( $footer_info_contents_item->title ) ? apply_filters( 'eventpress_translate_single_string', $footer_info_contents_item->title, 'footer section' ) : '';
							$subtitle = ! empty( $footer_info_contents_item->subtitle ) ? apply_filters( 'eventpress_translate_single_string', $footer_info_contents_item->subtitle, 'footer section' ) : '';
							$icon = ! empty( $footer_info_contents_item->icon_value ) ? apply_filters( 'eventpress_translate_single_string', $footer_info_contents_item->icon_value, 'footer section' ) : '';
					?>
							<div class="col-md-3 col-sm-6 mb-md-0 mb-4">
								<div class="icon">
									<?php if ( ! empty( $icon ) ) :?>
										<i class="fa <?php echo esc_attr( $icon ); ?>"></i>		
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $eventpress_fi_title ) ) : ?>
									<h4><?php echo esc_html( $eventpress_fi_title ); ?></h4>
								<?php endif; ?>	
								<?php if ( ! empty( $subtitle ) ) : ?>
									<p><?php echo esc_html( $subtitle ); ?></p>
								<?php endif; ?>		
							</div>
					<?php  } } ?>
				</div>
			<?php } ?>
        </div>
		<?php if($hide_show_copyright == '1') { ?>
			<div class="container-fluid">
				<div class="row footer-copyright">
					<div class="col-12">
						<?php if ( ! empty( $copyright_content ) ){ ?>
							<p><?php echo wp_kses_post($copyright_content); ?></p>
						<?php  }else{ ?>	
							<p><?php esc_html_e('© 2020 All Right Reserved | EventPress WordPress Theme','eventpress'); ?></p>
						<?php } ?>	
					</div>
				</div>
			</div>
		<?php } ?>
    </footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
