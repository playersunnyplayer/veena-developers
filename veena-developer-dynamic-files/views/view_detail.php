

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="home-slider/css/demo.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="home-slider/css/style2.css" /> -->
	<link rel="stylesheet" href="css/owl.theme.default.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/project-individual.css" />





<?php include'includes/header1.php';?>


	<?php
	
	
		  $folder='project';
		  $banenrImage=$this->utility->get_image_path($this->rs_project['banner'],$folder,'large');
		  $mobileBanenrImage=$this->utility->get_image_path($this->rs_project['mobile_banner'],$folder,'large');
	
	
	?>

	
	<div class="projectBannerSec">
		<div class="projectBannerImg">
			<picture>
				<source srcset="<?=$mobileBanenrImage?>"
					media="(max-width: 767px)">
				<source srcset="<?=$banenrImage?>">
				<img class="d-block w-100" src="<?=$banenrImage?>"
					alt="<?=$this->rs_project['name']?>">
			</picture>
		</div>
		<div class="projectBannerInner">
			<div class="container">
				<div class="projectNameDetails">
					<h1><?=$this->rs_project['name']?></h1>
                    <?php if($this->rs_project['rera_reg_no']!=''){?>
					<h2>RERA Reg No: <?=$this->rs_project['rera_reg_no']?></h2>
                    <?php }?>
				</div>
                
                <?php if(count($this->rs_projects_highlights)>0){?>
				<div class="productFeatures wow animate__animated animate__fadeIn">
					<h3 class="verticalText verticalText_MobileReset">

						Highlights

					</h3>
					<ul>
                    
                    	<?php for($i=0;$i<count($this->rs_projects_highlights);$i++){?>
						<li>
							<figure>
								<img src="uploads/highlights/<?=$this->rs_projects_highlights[$i]['highlights_image']?>" alt="">
							</figure><?=$this->rs_projects_highlights[$i]['highlights_name']?>: <strong><?=$this->rs_projects_highlights[$i]['value_data']?></strong>
						</li>
                        
                        <?php }?>
						
                        
					</ul>
				</div>
                
                <?php }?>
			</div>
		</div>
	</div>
	<div class="mouseDownSec">
		<img src="images/mouse-down-icon.svg" class="mouseIcon" alt="">
		<img src="images/mouse-arrow-down-icon.svg" class="mouseDownIcon" alt="">
	</div>
	<div class="stickyMenuWrapSec" id="navbar-example2">
		<ul class="stickyMenuSec container">
        
        
        <?php
		
		$masterURL=SERVER_ROOT.'/detail/'.$this->getGetVar('slug').'.html';
		?>
        
        
        
        
         <?php if($this->rs_project['projects_info_about_heading']!=''){?>
			<li><a class="nav-link" href="<?=$masterURL?>#overviewSec">ABOUT US</a>
			</li>
            
            <?php }?>
              <?php if($this->rs_project['projects_info_floor_heading']!=''){?>
			<li><a class="nav-link" href="<?=$masterURL?>#floorPlanSec">FLOOR PLAN</a>
			</li>
            
            <?php }?>
            
            
            
            <?php if(count($this->rs_projects_gallery_cat)>0){
				
				for($i=0;$i<count($this->rs_projects_gallery_cat);$i++)
				{
					
					if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Project Gallery')
					{
						$display_name='GALLERY';
						$hrefID='gallerySec';
						
					}
					else if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Current Status')
					{
						$display_name='Current Status';
						$hrefID='CurrentStatusSec';
						
					}
					else if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Brand Associates')
					{
						$display_name='Brand Associates';
						$hrefID='brandAssociatesSec';
						
					}
				
				?>
            
            
            
            
			<li><a class="nav-link" href="<?=$masterURL?>#<?=$hrefID?>"><?=$display_name?></a>
			</li>
            
            <?php }?>
            
            
			
            
             <?php }?>
            
             <?php if($this->rs_project['projects_info_location_heading']!=''){?>
			<li><a class="nav-link" href="<?=$masterURL?>#propertyLocationSec">LOCATION</a>
			</li>
            
            <?php }?>
			
            
			<li><a class="nav-link projectApplyClick"  data-id=""  data-type="Project Enquiry"  data-title="" href="javascript:void(0)"  >Enquire Now</a>
			</li>
             <?php if($this->rs_project['micro_web']!=''){?>
			<li><a class="nav-link" href="<?=$this->rs_project['micro_web']?>" target="_blank">Go To Mircosite</a>
			</li>
            <?php }?>
		</ul>
	</div>
	<div style="position: relative;">
    
    
    <?php if($this->rs_project['projects_info_about_heading']!=''){?>
    
		<section class="overviewSec" id="overviewSec">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h3 class="verticalText verticalText_MobileReset">

							<?=$this->rs_project['projects_info_about_heading']?>

						</h3>
						<div class="bgRec wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
						<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0s"></div>
						<!-- <div class="dotBoxesWrap">

							<canvas id="playground"></canvas>

						</div> -->
						<div class="projectVideoSec wow animate__animated animate__zoomIn" data-wow-delay="1s">
                        
                      
							<div class="projectVideoSecInner">
                              <?php if($this->rs_project['projects_info_about_image']!=''){?>
								<img src="uploads/project/<?=$this->rs_project['projects_info_about_image']?>" alt="" />
                                  <?php }?>
							</div>
                            
                              <?php if($this->rs_project['projects_info_about_video']!=''){?>
                            
                          
						<a href="<?=$this->rs_project['projects_info_about_video']?>" class="playBtn"
								data-fancybox="gallery-2" data-caption="">
								<div class="circle pulse"></div>
								<div class="circle">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
										<polygon points="40,30 65,50 40,70"></polygon>
									</svg>
								</div>
							</a> 
                            
                            <?php }?>
						</div>
					</div>
					<div class="col-sm-6 rightContent_home wow animate__animated animate__zoomIn" data-wow-delay="1s">
						<h4><?=$this->rs_project['projects_info_about_title']?></h4>                        
                        <?=$this->rs_project['projects_info_about_desc']?>
						
                        
					</div>
				</div>
			</div>
		</section>
        
        
        
        <?php }?>
        <?php if(count($this->rs_amenities_master)>0){
			
			if($this->rs_project['projects_info_amenities_bg']!='')
			{
				$bgStyle='style="background-image:url(uploads/project/'.$this->rs_project['projects_info_amenities_bg'].')"';	
				
			}
			else
			{
				$bgStyle='';	
			}
			
			?>
            
        
        
        
        
		<section class="amenitiesSec" <?=$bgStyle?>>
			<div class="container">
				<div class="row">
					<div class="amenitiesGrphic wow animate__animated animate__zoomIn">
                    
                    	<?php if($this->rs_project['projects_info_amenities_image']!=''){?>
                    
						<img src="uploads/project/<?=$this->rs_project['projects_info_amenities_image']?>" alt="">
                        <?php }?>
					</div>
					<div class="col-lg-9">
						<h3 class="verticalText verticalText_MobileReset">

							<?=$this->rs_project['projects_info_amenities_heading']?>

						</h3>
						<div class="amenitiesGrid">
                        
                        <?php for($i=0;$i<count($this->rs_amenities_master);$i++){?>
							<div class="amenitiesThumb wow animate__animated animate__zoomIn" data-wow-delay="0.<?=($i+1)?>s">
								<figure>
									<img src="uploads/amenities_master/<?=$this->rs_amenities_master[$i]['image']?>" alt="<?=$this->rs_amenities_master[$i]['name']?>">
								</figure>
								<figcaption><?=$this->rs_amenities_master[$i]['name']?></figcaption>
							</div>
                            
                            <?php }?>
							
							
							
							
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
		</section>
        
        <?php }?>
        
        
        <?php if($this->rs_project['projects_info_floor_heading']!=''){?>
		<section class="floorPlanSec" id="floorPlanSec">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<h3 class="verticalText verticalText_MobileReset">

							<?=$this->rs_project['projects_info_floor_heading']?>

						</h3>
						<div class="inner">
							<h4><?=$this->rs_project['projects_info_floor_title']?></h4>
							<?=$this->rs_project['projects_info_floor_desc']?>
						</div>
					</div>
					<div class="col-sm-5">
                    
                    <input type="hidden" name="" id="b_file_1" value="<?=$this->rs_project['projects_info_floor_link1_file']?>">
                     <input type="hidden" name="" id="b_file_2" value="<?=$this->rs_project['projects_info_floor_link2_file']?>">
                     
                     
                     
                    
                     <?php if($this->rs_project['projects_info_floor_img']!=''){?>
                    
						<img src="uploads/project/<?=$this->rs_project['projects_info_floor_img']?>"
							class="architectural-drawing" alt="">
                            
                            <?php }?>
						<div class="floorPlanBoxWrap">
                        
                          <?php if($this->rs_project['projects_info_floor_link1_file']!=''){?>
							<div class="iconBox floorPlanBox wow animate__animated animate__zoomIn">
                            
								<figure>
									<img src="images/brochure-icon.svg" alt="">
								</figure>
                                
								<figcaption>Download <span class='blueText'>Brochure</span></span>
								</figcaption> <a href="javascript:void(0)" 
									class="btn btn-trinary projectApplyClick"  data-id="1"  data-type="Download"  data-title="<?=strip_tags($this->rs_project['projects_info_floor_link1'])?>">Enquiry</a>
							</div>
                            
                            <?php }?>
                                <?php if($this->rs_project['projects_info_floor_link2_file']!=''){?>
							<div class="iconBox brochureBox wow animate__animated animate__zoomIn" data-wow-delay="200">
                          
								<figure>
									<img src="images/floor-plan-icon.svg" alt="">
								</figure>
                                								<figcaption>Download <span class='blueText'>Floor Plan</span></span>
								</figcaption> <a href="javascript:void(0)" 
									class="btn btn-trinary projectApplyClick"  data-id="2"  data-type="Download"  data-title="<?=strip_tags($this->rs_project['projects_info_floor_link2'])?>">Enquiry</a>
							</div>
                            
                             <?php }?>
						</div>
					</div>
				</div>
			</div>
		</section>
        
        
        <?php }?>
        
        
        
        <?php for($i=0;$i<count($this->rs_projects_gallery_cat);$i++){
			
			
				if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Project Gallery')
					{
						
						
						$hrefID='gallerySec';
						
					}
					else if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Current Status')
					{
						
						
						$hrefID='CurrentStatusSec';
						
					}
					else if($this->rs_projects_gallery_cat[$i]['projects_gallery_category_name']=='Brand Associates')
					{
						
						
						$hrefID='brandAssociatesSec';
						
					}
					
					$obj_model_gallery=$this->load_model('projects_gallery');
					$rs_images=$obj_model_gallery->execute("SELECT",false,"","projects_id='".$this->rs_project['id']."' and projects_gallery.status='Active' and projects_gallery_category_id='".$this->rs_projects_gallery_cat[$i]['projects_gallery_category_id']."'","sort_id ASC","");
			
				
		?>
        
        
        
        <?php if($hrefID=='brandAssociatesSec'){?>
        
        
        <section class="gallerySec gradientArea brandAssociatesSec" id="brandAssociatesSec">
			<div class="container">
				<div class="row">
					<h3 class="verticalText verticalText_MobileReset">
							<?=$this->rs_projects_gallery_cat[$i]['projects_gallery_category_heading']?>
					</h3>
					<div class="brandLogosWrap">
                     <?php for($j=0;$j<count($rs_images);$j++){
						$m=$j+1;
						
						$sec=$m*100;
						
						?>
						<div class="brand-logo wow animate__animated animate__zoomIn" data-wow-delay="<?=$sec?>"><img
								src="uploads/projects_gallery/<?=$rs_images[$j]['image']?>" alt=""></div>
						 <?php }?>
					</div>
				</div>
			</div>
		</section>
        
        
        <?php }else{?>
        
        
		<section class="gallerySec gradientArea" id="<?=$hrefID?>">
			<div class="container">
				<div class="row">
					<h3 class="verticalText verticalText_MobileReset">

						<?=$this->rs_projects_gallery_cat[$i]['projects_gallery_category_heading']?>

					</h3>
					<div class="galleryGrap">
                    
                    <?php for($j=0;$j<count($rs_images);$j++){
						$m=$j+1;
						
						$sec=$m*100;
						
						?>
                    
						<a href="uploads/projects_gallery/<?=$rs_images[$j]['image']?>" class="galleryThumb wow animate__animated animate__fadeIn"
							data-fancybox="gallery" data-caption="<?=$rs_images[$j]['title']?>" data-wow-delay="<?=$sec?>">
							<div class="zoomHover"> <span class="galleryThumbName"><?=$rs_images[$j]['title']?></span>
								<span class="clickZoom">Click to zoom</span>
							</div>
							<img src="uploads/projects_gallery/<?=$rs_images[$j]['image']?>" alt="<?=$rs_images[$j]['image']?>">
						</a>
                        
                        <?php }?>
                        
						
                        
						
                        
					</div>
				</div>
			</div>
		</section>
        
         <?php }?>
        
        <?php }?>
		
        
        
        
        <?php if($this->rs_project['projects_info_location_heading']!=''){?>
        
        
		<section class="propertyLocationSec" id="propertyLocationSec">
			<div class="container">
				<div class="row">
					<h3 class="verticalText verticalText_MobileReset">

						<?=$this->rs_project['projects_info_location_heading']?>

					</h3>
					<div class="col-md-6 mapWrap" data-aos="fade-up" data-aos-duration="1000">
                    
                    
                    <?=$this->rs_project['projects_info_location_map']?>
						
                        
					</div>
					<div class="col-md-6">
						<div class="container wow animate__animated animate__fadeIn">
							<div class="row">
								<div class="col-md-6">
									  <?=$this->rs_project['projects_info_location_p1']?>
								</div>
								<div class="col-sm-6">
									  <?=$this->rs_project['projects_info_location_p2']?>
								</div>
							</div>
						</div>
						<div class="contactIconSec">
                        
                        <?php if($this->rs_project['phone']!=''){?>
							<div class="iconBox phone wow animate__animated animate__zoomIn" data-wow-delay="100">
								<figure>
									<img src="images/phone-contact-icon.svg" alt="">
								</figure>
								<figcaption><a href="tel:<?=$this->rs_project['phone']?>"><?=$this->rs_project['phone']?></a>
								</figcaption>
							</div>
                            
                            <?php }?>
                             <?php if($this->rs_project['email']!=''){?>
							<div class="iconBox email wow animate__animated animate__zoomIn" data-wow-delay="200">
								<figure>
									<img src="images/email-contact-icon.svg" alt="">
								</figure>
								<figcaption><a href="mailto:<?=$this->rs_project['email']?>"><?=$this->rs_project['email']?></a>
								</figcaption>
							</div>
                            
                            <?php }?>
						</div>
					</div>
				</div>
			</div>
		</section>
        
        <?php }?>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content verticalText_model">
				<h3 class="verticalText"> Enquire <span class="blueText">Now</span> </h3>
				<div class="modal-body">
					<form id="ProjectContactForm" name="ProjectContactForm" method="post" action="">
						<input type="hidden" class="hidden" name="project_id" id="project_id" value="<?=$this->rs_project['id']?>" >
                        
                        <input type="hidden"  name="data_id" id="data_id" value="" >
                        <input type="hidden"  name="data_type" id="data_type" value="" >
                        <input type="hidden"  name="data_value" id="data_value" value="" >
                        
						<div class="form-group"> <label for="exampleInputEmail1">Full Name</label>
							<input type="text" class="form-control required" name="name" id="name" aria-describedby="emailHelp"
								placeholder="Full Name">
						</div>
						<div class="form-group"> <label for="exampleInputEmail1">Email</label>
							<input type="email" class="form-control required" id="email" name="email"
								aria-describedby="emailHelp" placeholder="Email">
						</div>
						<div class="form-group"> <label for="exampleInputPassword1">Mobile</label>
							<input type="text" class="form-control required numbers" name="phone" id="phone" maxlength="10"
								placeholder="Mobile">
						</div>
						<div class="modelFooter">
							<button type="button" data-dismiss="modal" aria-label="Close"
								class="btn btn-outline-secondary mb-3">Cancel</button>
							<button type="submit" class="btn btn-primary mb-3 projectsBtns" name="">Submit</button>
						</div>
                        
                         <div class="projectsMsg">
							
                            
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	
    
	<!-- disclaimer Model -->
	
    
	
    <?php include'includes/footer.php';?>
    
    <script>
    setTimeout(function() {
        $("#veenaloader").fadeOut();
    }, 2000);
    </script> 
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/veena.js?v=1"></script> 
	
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
        
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
	<script src="js/script.js"></script>
	<script>
	



		var horizontalAccordions = $(".accordion.width");



		horizontalAccordions.each(function () {

			var accordion = $(this);

			var collapse = accordion.find(".collapse");

			var bodies = collapse.find("> *");

			accordion.height(accordion.height());

			bodies.width(bodies.eq(0).width());

			collapse.not(".show").each(function () {

				$(this)

					.parent()

					.find("[data-toggle='collapse']")

					.addClass("collapsed");

			});

		});



		//FUNCTION AUTO-CLICK

		// var $ = jQuery.noConflict();

		var i = 2; // premier switch vers image 2



		function switchImage() {

			$(".current").removeAttr("checked");

			$(".current").removeClass("current");



			$("#select-img-" + i).addClass("current");

			$("#select-img-" + i).attr("checked", true);



			if (i == 4) {

				i = 1; // retour au debut sur image 1

			} else {

				i++; // image suivante

			}

		}



		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip()

			//on lance l"annimation en boucle toute les 5 secondes (5000 miliseconde)

			setInterval("switchImage();", 2000);

		});



		$("#testimonial-carousel").owlCarousel({

			loop: true,

			margin: 10,

			dots: true,

			nav: false,

			responsive: {

				0: {

					items: 1,

				},

				600: {

					items: 3,

				},

				1000: {

					items: 2.2,

				},

			},

		});

		$("#residential-carousel , #commercial-carousel").owlCarousel({

			loop: true,

			margin: 50,

			dots: false,

			nav: true,

			responsive: {

				0: {

					items: 1,

				},

				600: {

					items: 3,

				},

				1000: {

					items: 2.5,

				},

			},

		});

		
	</script>
	
    
    


	<script src="js/form_validator.js"></script>
	<script src="js/sideform.js"></script>
	
	<script src="js/project-individual.js"></script>
	<script src="js/function.js"></script>
 
 

	<?=$this->rs_project['projects_info_chat_code']?>