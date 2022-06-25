<?php 
	$booknow_setting			= get_theme_mod('booknow_setting','1'); 
	$header_btn_icon			= get_theme_mod('header_btn_icon','fa-bell'); 
	$header_btn_lbl				= get_theme_mod('header_btn_lbl'); 
	$header_btn_link			= get_theme_mod('header_btn_link'); 
?>
<!--===================== 
        Start: Navbar
     =====================-->
	<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
			<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>">
		</a>
	<?php endif;  ?>
     <div class="navbar-wrapper multipage <?php echo esc_attr(eventpress_sticky_menu()); ?>">
         <nav class="navbar navbar-expand-lg navbar-default">
            <div class="container">
				<div class="logo-bbc">
					<!-- LOGO -->
						<?php
							if(has_custom_logo())
							{	
								the_custom_logo();
							}
							else { 
							?>
							<a class="navbar-brand logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<p class="site-title"><?php echo esc_html(bloginfo('name')); ?></p>	
							</a>    	
						<?php 						
							}
						?>
						<?php
							$description = get_bloginfo( 'description');
							if ($description) : ?>
								<p class="site-description"><?php echo esc_html($description); ?></p>
						<?php endif; ?>
                </div>
				<div class="d-none d-lg-block navbar-flex" id="navbarCollapse">
                   <?php 
					wp_nav_menu( 
						array(  
							'theme_location' => 'primary_menu',
							'container'  => '',
							'menu_class' => 'navbar-nav ml-auto',
							'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
							'walker' => new WP_Bootstrap_Navwalker()
							 ) 
						);
					?>					
                </div>
				<?php if($booknow_setting == '1') { ?>
					<div class="d-none d-lg-block" id="navbarCollapse">
						<ul class="nav-left">
							<?php if ( ! empty( $header_btn_lbl ) ) : ?>
								<li><a href="<?php echo esc_url( $header_btn_link ); ?>" class="hover-effect2 nav-btn"><i class="fa <?php echo esc_attr( $header_btn_icon ); ?>"></i><?php echo esc_html( $header_btn_lbl ); ?></a></li>
							<?php endif; ?>	
						</ul>
					</div>
				<?php } ?>
                
            </div>        
        </nav>

        <!-- Start Mobiel Menu -->
        <div class="mobile-menu-area d-lg-none">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-menu">
                            <nav class="mobile-menu-active">
                               <?php 
								wp_nav_menu( 
									array(  
										'theme_location' => 'primary_menu',
										'container'  => '',
										'menu_class' => '',
										'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
										'walker' => new WP_Bootstrap_Navwalker()
										 ) 
									);
								?>
                            </nav>                            
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Mobile Menu -->
	</div>
    <!--===================== 
        End: Navbar
     =====================-->
<?php 
	if ( !is_page_template( 'templates/template-homepage.php' ) ) {
			eventpress_breadcrumbs_style(); 
		}
?>