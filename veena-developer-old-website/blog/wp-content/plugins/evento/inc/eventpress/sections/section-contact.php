<?php 
	if ( ! function_exists( 'evento_eventpress_contact' ) ) :
	function evento_eventpress_contact() {
	$contact_form_setting		= get_theme_mod('contact_form_setting','1'); 
	$cont_form_title			= get_theme_mod('cont_form_title','Send Wishes'); 
	$cont_form_description		= get_theme_mod('cont_form_description','Lorem Ipsum is simply dummy text of the printing and typesetting industry'); 
	$contactss_form_shortcode	= get_theme_mod('contactss_form_shortcode',''); 
	if($contact_form_setting == '1') { 
	?>
 <section id="contact" class="section-padding contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="section-title">
                        <?php if($cont_form_title) {?>
							<h2><?php echo esc_attr($cont_form_title); ?></h2>
						<?php } ?>
						<?php 
							if ( function_exists( 'eventpress_title_seprator' ) ) :
								eventpress_title_seprator(); 
							endif;	
						?>
						<?php if($cont_form_description) {?>
							<p><?php echo esc_attr($cont_form_description); ?></p>
						<?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 contact-form">
					<?php 
						if($contactss_form_shortcode != '') {
							echo do_shortcode( $contactss_form_shortcode );
						}else{
					?>
						<form action="#">
							<div class="row">
								<div class="col-sm-6">
									<div class="input-effect">
										<input class="effect-21" type="text" placeholder="">
										<label>Your Name</label>
										<span class="focus-border">
											<i></i>
										</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-effect">
										<input class="effect-21" type="text" placeholder="">
										<label>Your Friend's Name</label>
										<span class="focus-border">
											<i></i>
										</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-effect">
										<input class="effect-21" type="email" placeholder="">
										<label>Your Email</label>
										<span class="focus-border">
											<i></i>
										</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-effect">
										<input class="effect-21" type="email" placeholder="">
										<label>Your Friend's Email</label>
										<span class="focus-border">
											<i></i>
										</span>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-effect">
										<textarea name="message" class="effect-21" id="message" rows="5" placeholder=""></textarea>
										<label>Your Message</label>
										<span class="focus-border">
											<i></i>
										</span>
									</div>
								</div>
								<div class="col-sm-12">
								</div>
								<div class="col-12 text-center">
									<a href="#" class="send-wishes hover-effect">Send Wishes</a>
								</div>
							</div>
						</form>
					<?php } ?>
                </div>
            </div>
        </div>
    </section>
	<?php } }
endif;
if ( function_exists( 'evento_eventpress_contact' ) ) {
$section_priority = apply_filters( 'eventpress_section_priority', 14, 'evento_eventpress_contact' );
add_action( 'eventpress_sections', 'evento_eventpress_contact', absint( $section_priority ) );
} 
?>