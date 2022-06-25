<header>

  <?php if($this->gs['logo_file']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->gs['logo_file']))
      {
        $logo="uploads/logo/".$this->gs['logo_file'];
      }
      else
      {
        $logo="uploads/logo/default_logo.svg";
      }?>
      
      
      
      
      
      
      
      
      
       <?php if($this->gs['menu_bg_image']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->gs['menu_bg_image']))
      {
        $menu_bg_image="uploads/logo/".$this->gs['menu_bg_image'];
      }
      else
      {
        $menu_bg_image="";
      }?>

		<div class="topBar">
			<div class="container">
				<div class="row">
					<figure class="logo">
						<a href="index.html">
							<img src="<?=$logo?>" class="img-fluid" alt="" />
						</a>
					</figure>

					<div class="col-sm-9 topRightSec">
                     <?php if($this->gs['contact_number']!=''){?>
						<div class="phoneIcon">
							<a target="_blank" href="tel:<?=$this->gs['contact_number']?>">
								<!-- <img src="images/home-contact-header-icon.svg" alt="" /> -->
								<span class="hide_767"><?=$this->gs['contact_number']?></span>
							</a>
						</div>
                        
                        <?php }?>
						<div class="hamburgerIcon desktopMenu">
							<nav>
								<input type="checkbox" name="toggle-nav" />
								<label for="toggle-nav">
									<span class="menu-icon"></span>
								</label>
								<section class="side-nav-panel">
									   <div class="menuImg"> <?php if($menu_bg_image!=''){?><img src="<?=$menu_bg_image?>" alt="" /><?php }?> </div>
									<div class="menuRightArea">
										<div class="menuRight_top">
											<ul class="mainMenuLinks">
												<li><a href="index.html">Home</a></li>
												<li><a href="about-us.html">About Us</a></li>
												<li><a href="csr.html">CSR</a></li>
												<li><a href="careers.html">Careers</a></li>
												<!--<li><a href="#">Contact Us</a></li>-->
											</ul>
                                            
                                              <?php include'menu.php';?>

											
                                            
										</div>
										<div class="menuRight_bottom">
											
                                            <div class="menuContact">
                      <?php if($this->gs['contact_number']!=''){?>
                      <a href="tel:<?=$this->gs['contact_number']?>"> <img src="images/menu-phone-icon.svg" alt="" />
                      <?=$this->gs['contact_number']?>
                      </a>
                      <?php }?>
                      <?php if($this->gs['contact_email']!=''){?>
                      <a target="_blank" href="mailto:<?=$this->gs['contact_email']?>"> <img src="images/menu-email-icon.svg" alt="" />
                      <?=$this->gs['contact_email']?>
                      </a>
                      <?php }?>
                    </div>


											
                                            <ul class="menuSocial socialMedia">
                      <?php if($this->gs['facebook_link']!=''){?>
                      <li> <a target="_blank" href="<?=$this->gs['facebook_link']?>" class="facebook_sm"><i class="fa fa-facebook"></i></a> </li>
                      <?php }?>
                      <?php if($this->gs['twitter_link']!=''){?>
                      <li> <a href="<?=$this->gs['twitter_link']?>" class="twitter_sm" target="_blank"><i class="fa fa-twitter"></i></a> </li>
                      <?php }?>
                      <?php if($this->gs['instagram_link']!=''){?>
                      <li> <a href="<?=$this->gs['instagram_link']?>" class="instagram_sm" target="_blank"><i  class="fa fa-instagram"></i></a> </li>
                      <?php }?>
                      <?php if($this->gs['linkedin_link']!=''){?>
                      <li> <a href="<?=$this->gs['linkedin_link']?>" class="linkedin_sm" target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                      <?php }?>
                      <?php if($this->gs['youtube_link']!=''){?>
                      <li> <a href="<?=$this->gs['youtube_link']?>" class="youtube_sm" target="_blank"><i class="fa fa-youtube"></i></a> </li>
                      <?php }?>
                      <?php if($this->gs['contact_number1']!=''){?>
                      <li> <a target="_blank" href="https://wa.me/91<?=$this->gs['contact_number1']?>?text=I%27m%20interested%20to%20know%20about%20your%20project%20" class="whatsapp_sm"><i class="fa fa-whatsapp"></i></a> </li>
                      <?php }?>
                    </ul>
										</div>
									</div>
								</section>
							</nav>
						</div>
						<div class="hamburgerIcon mobileMenu">
							<nav>
								<input type="checkbox" name="toggle-nav" />
								<label for="toggle-nav">
									<span class="menu-icon"></span>
								</label>
								<section class="side-nav-panel">
									<ul class="mainMenuLinks">
										<li><a href="index.html">Home</a></li>
										<li><a href="about-us.html">About Us</a></li>
										<li><a href="csr.html">CSR</a></li>
										<li><a href="careers.html">Careers</a></li>
										<!--<li><a href="#">Contact Us</a></li>-->
									</ul>

									
  <?php include'mobile_menu.php';?>
									<div class="menuRight_bottom">
										
                                        <div class="menuContact">
                    <?php if($this->gs['contact_number1']!=''){?>
                    <a href="tel:<?=$this->gs['contact_number']?>"> <img src="images/menu-phone-icon.svg" alt="" />
                    <?=$this->gs['contact_number']?>
                    </a>
                    <?php }?>
                    <?php if($this->gs['contact_number1']!=''){?>
                    <a target="_blank" href="mailto:<?=$this->gs['contact_email']?>"><img src="images/menu-email-icon.svg" alt="" />
                    <?=$this->gs['contact_email']?>
                    </a>
                    <?php }?>
                  </div>

										
                                        <ul class="menuSocial socialMedia">
                    <?php if($this->gs['facebook_link']!=''){?>
                    <li> <a href="<?=$this->gs['facebook_link']?>" class="facebook_sm"><i class="fa fa-facebook" target="_blank"></i></a> </li>
                    <?php }?>
                    <?php if($this->gs['twitter_link']!=''){?>
                    <li> <a href="<?=$this->gs['twitter_link']?>" class="twitter_sm" target="_blank"><i class="fa fa-twitter"></i></a> </li>
                    <?php }?>
                    <?php if($this->gs['instagram_link']!=''){?>
                    <li> <a href="<?=$this->gs['instagram_link']?>" class="instagram_sm" target="_blank"><i class="fa fa-instagram"></i></a> </li>
                    <?php }?>
                    <?php if($this->gs['linkedin_link']!=''){?>
                    <li> <a href="<?=$this->gs['linkedin_link']?>" class="linkedin_sm" target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                    <?php }?>
                    <?php if($this->gs['youtube_link']!=''){?>
                    <li> <a href="<?=$this->gs['youtube_link']?>" class="youtube_sm" target="_blank"><i class="fa fa-youtube"></i></a> </li>
                    <?php }?>
                    <?php if($this->gs['contact_number1']!=''){?>
                    <li> <a href="https://wa.me/91<?=$this->gs['contact_number1']?>?text=I%27m%20interested%20to%20know%20about%20your%20project%20" class="whatsapp_sm"><i class="fa fa-whatsapp"></i></a> </li>
                    <?php }?>
                  </ul>
									</div>
								</section>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>