

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />


	
        <?php include'includes/header1.php';?>
    


 <?php
	 
	 
	 if($this->rs_about_page['page_image']!='' && file_exists(ABS_PATH."/uploads/about/".$this->rs_about_page['page_image']))
	 {
		 $style='style="background: url(uploads/about/'.$this->rs_about_page['page_image'].') no-repeat;background-size: cover;"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 ?>


	<section class="breadcrumbSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<h1 class="breadcrumbHeading">About Veena Developers</h1>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">About Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="overviewSec whoWeSec">
		<div class="container">
			<div class="row">
				<div class="col-md-6 whoWeSec_left">
					<h3 class="verticalText verticalText_MobileReset">
						 <?=$this->rs_about_page['career_heading']?>
					</h3>
					<div class="bgRec wow animate__animated animate__zoomIn" data-wow-delay="1s"></div>
					<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
					<!-- <div class="dotBoxesWrap">
						<svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400" overflow="visible"></svg>
					</div> -->
					<div class="projectVideoSec wow animate__animated animate__zoomIn" data-wow-delay="1.5s">
						<div class="projectVideoSecInner">
                        <?php if($this->rs_about_page['image']!=''){?>
							<img src="uploads/about/<?=$this->rs_about_page['image']?>" alt="" />
                            
                            <?php }?>
						</div>
                        
                        
                        <?php if($this->rs_about_page['video_url']!=''){?>
                     <a href="<?=$this->rs_about_page['video_url']?>" class="playBtn"
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
				<div class="col-md-6 rightContent_inner">
					 <?=$this->rs_about_page['career_desc']?>

				</div>
			</div>
		</div>
	</section>
    
    
    <?php if(count($this->rs_team)>0){?>

	<section class="managementSec">
		<div class="container">
			<div class="row">
				<h3 class="verticalText verticalText_MobileReset">
					 <?=$this->rs_about_page['job_heading']?>
				</h3>

				<div class="col-sm-12">
                
                
                <?php for($i=0;$i<count($this->rs_team);$i++){
					
					if($i==0 || $i==2 || $i==4 || $i==6 || $i==8)
					{
					?>
					<div class="row managementThumb leftSec">
						<div class="col-md-8">
						    <div>
							    <?=$this->rs_team[$i]['short_desc']?>
							</div>
							<div class="managerName wow animate__animated animate__fadeIn"><?=$this->rs_team[$i]['title']?> <?php if($this->rs_team[$i]['designation']!=''){?><span class="managerNameDesignation"><?=$this->rs_team[$i]['designation']?></span><?php }?></div>
						</div>
						<div class="col-md-4" data-aos="fade-down" data-aos-duration="1000">
							<div class="managementImgSec">
								<img src="uploads/team/<?=$this->rs_team[$i]['image']?>" alt=""
									class="wow animate__animated animate__zoomIn">
								<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="1s"></div>
							</div>
						</div>
					</div>
                    
                    <?php }else{?>
					<div class="row managementThumb rightSec">
						<div class="col-md-8">
						    <div>
							    <?=$this->rs_team[$i]['short_desc']?>
							</div>
							<div class="managerName wow animate__animated animate__fadeIn"><?=$this->rs_team[$i]['title']?> <?php if($this->rs_team[$i]['designation']!=''){?><span class="managerNameDesignation"><?=$this->rs_team[$i]['designation']?></span><?php }?></div>
						</div>
						<div class="col-md-4" data-aos="fade-down" data-aos-duration="1000">
							<div class="managementImgSec">
								<img src="uploads/team/<?=$this->rs_team[$i]['image']?>" alt=""
									class="wow animate__animated animate__zoomIn">
								<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
							</div>
						</div>
					</div>
                    
                     <?php }?>
                    
                    <?php }?>
				</div>
			</div>
		</div>
	</section>
    
    <?php }?>

	<section class="visionSec container">
		<div class="visionThumb" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
			<div class="visionThumbInner">
				<h3 class="verticalText verticalText_MobileReset blueText"> <?=$this->rs_about_page['vision_title']?></h3>
				 <?=$this->rs_about_page['vision_desc']?>
				<img src="images/vision-icon.png" class="icon" alt="">
			</div>
		</div>
		<div class="visionThumb" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
			<div class="visionThumbInner">
				<h3 class="verticalText verticalText_MobileReset blueText"> <?=$this->rs_about_page['mision_title']?></h3>
				 <?=$this->rs_about_page['mision_desc']?>
				<img src="images/mission-icon.png" class="icon" alt="">
			</div>
		</div>
	</section>
    
    
    <?php
	 
	 
	 if($this->rs_about_page['ch_bg_image']!='' && file_exists(ABS_PATH."/uploads/about/".$this->rs_about_page['ch_bg_image']))
	 {
		 $style='style="background: url(uploads/about/'.$this->rs_about_page['ch_bg_image'].') no-repeat;background-size: cover;"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 ?>
     
     
     
     <?php if($this->rs_about_page['ch_title']!=''){?>


	<section class="chairmanSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<div class="charimanTextWrap">
					<h3>
						<?=$this->rs_about_page['ch_title']?>
					</h3>

					
                    

					<?=$this->rs_about_page['ch_desc']?>

				<?php if($this->rs_about_page['ch_tag_line']!=''){?>
					<p class="slogan">"<?=nl2br($this->rs_about_page['ch_tag_line'])?>"</p>
                    <?php }?>
                    
                    	<?php if($this->rs_about_page['ch_image']!=''){?>
                    
					<img src="uploads/about/<?=$this->rs_about_page['ch_image']?>"
						class="chairmanImg wow animate__animated animate__fadeIn hide_767" alt="">
                        
                        
                        <?php }?>
				</div>
			</div>
		</div>
	</section>
    
    <?php }?>
    
    
      <?php if($this->rs_about_page['philo_title']!=''){?>


	<section class="overviewSec companyPhiloshySec">
		<div class="container">
			<div class="row">
				<div class="col-md-6 leftArea">
					<div class="bgRec yellow wow animate__animated animate__zoomIn" data-wow-delay="1s"></div>
					<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
					<div class="projectVideoSec wow animate__animated animate__zoomIn" data-wow-delay="1.5s">
						<div class="projectVideoSecInner">
                        	<?php if($this->rs_about_page['philo_image']!=''){?>
							<img src="uploads/about/<?=$this->rs_about_page['philo_image']?>" alt="" />
                              <?php }?>
						</div>
					</div>
				</div>
				<div class="col-md-6 rightContent_inner">
					<h4><?=$this->rs_about_page['philo_title']?></h4>
					<?=$this->rs_about_page['philo_desc']?>
				</div>
			</div>
		</div>
	</section>
    
    <?php }?>

	<!-- disclaimer Model -->
	
    
	
        <?php include'includes/footer.php';?>
    
    <script>
    setTimeout(function() {
        $("#veenaloader").fadeOut();
    }, 2000);
    </script> 


	<!-- Modal -->
	<div class="modal fade" id="BookModal" tabindex="-1" role="dialog" aria-labelledby="BookModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-body" style="cursor: pointer;">
				<img src="images/book-cover.jpg" alt="">
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
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

			//Get the button
			var mybutton = document.getElementById("myBtn");

			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function () { scrollFunction() };

			function scrollFunction() {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					mybutton.style.display = "block";
				} else {
					mybutton.style.display = "none";
				}
			}

			function topFunction() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}

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
	<script language='JavaScript' type='text/javascript'>
		function refreshCaptcha() {
			var img = document.images['captchaimg'];
			img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
		}
	</script>

	
    
	<script src="js/function.js"></script>
	<script src="js/form_validator.js"></script>
	<script src="js/sideform.js"></script>


    <script src="js/jquery.validate.js"></script> 
<script src="js/veena.js"></script> 


<?=$this->rs_about_page['chat_code']?>