

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/careers.css" />
	
    
	
     <?php include'includes/header1.php';?>
     
     
     
     
     <?php
	 
	 
	 if($this->rs_career_page['page_image']!='' && file_exists(ABS_PATH."/uploads/careers/".$this->rs_career_page['page_image']))
	 {
		 $style='style="background: url(uploads/careers/'.$this->rs_career_page['page_image'].') no-repeat;background-size: cover;"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 ?>
     
     
     

	<section class="breadcrumbSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<h1 class="breadcrumbHeading">Careers</h1>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Careers</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="overviewSec careerwarp">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="careerLeft">
						<h3 class="verticalText verticalText_MobileReset">
                            <?=$this->rs_career_page['career_heading']?>
						</h3>

                        <?=$this->rs_career_page['career_desc']?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="bgRec yellow wow animate__animated animate__zoomIn" data-wow-delay="1s"></div>
					<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
					<div class="projectVideoSec wow animate__animated animate__zoomIn" data-wow-delay="1.5s">
						<div class="projectVideoSecInner">
                        
                        <?php if($this->rs_career_page['image']!=''){?>
							<img src="uploads/careers/<?=$this->rs_career_page['image']?>" alt="" />
                            <?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="overviewSec currentSec gradientArea">
		<div class="container">
			<div class="col-md-12">
				<h3 class="verticalText verticalText_MobileReset">
					 <?=$this->rs_career_page['job_heading']?>
				</h3>
				<div class="designationThumbsArea">
                
                <?php for($i=0;$i<count($this->rs_jobs);$i++){?>
                
					<div class="designationThumbs wow animate__animated animate__fadeIn" data-wow-delay="0.<?=($i+1)?>s">
						<h4><span> <?=$this->rs_jobs[$i]['title']?></span> <button type="submit" class="btn btn-trinary careerApplyClick"
								data-id="<?=$this->rs_jobs[$i]['id']?>" data-title="<?=$this->rs_jobs[$i]['title']?>" >Apply Now</button></h4>
					
                    
                    	<?php if($this->rs_jobs[$i]['experience']!=''){?>
						<p><strong>Experience</strong> – <?=$this->rs_jobs[$i]['experience']?></p>
                        <?php }?>
                        
                        <?php if($this->rs_jobs[$i]['qualification']!=''){?>
						<p><strong>Min. Qualification</strong> – <?=$this->rs_jobs[$i]['qualification']?></p>
                        <?php }?>
					</div>
                    
                    
                    <?php }?>
                    
                    
					
                    
					
                    
                    
					
                    
					
                    
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="careerModel" tabindex="-1" role="dialog" aria-labelledby="careerModelLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content verticalText_model">
				<h3 class="verticalText">
					We are <span class="blueText">Hiring</span>
				</h3>
				<div class="modal-body">
					<form id="CareerForm" name="CareerForm" method="post" action="" enctype="multipart/form-data">
                    
                    
                    <input type="hidden" name="jobId" id="jobId" value="">
                    
                    <div class="form-group">
							<label for="exampleInputPassword1">Job title</label>
							<input type="text" class="form-control" name="jobTitle" id="jobTitle" readonly="readonly" aria-describedby="emailHelp"
								placeholder="" value="">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Full Name</label>
							<input type="text" class="form-control required" name="name" id="name" aria-describedby="emailHelp"
								placeholder="Full Name">

						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input type="email" class="form-control required" aria-describedby="emailHelp" placeholder="Email"
								name="email" id="email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Mobile</label>
							<input type="text" class="form-control required numbers" placeholder="Mobile" name="phone" id="phone"
								maxlength="10">
						</div>
                        
                        
                        <div class="form-group">
							<label for="exampleInputPassword1">Resume File</label>
							<input type="file" class="form-control required"  name="file1" id="file1">
						</div>
						
						<div class="modelFooter">
							<button type="button" data-dismiss="modal" aria-label="Close"
								class="btn btn-outline-secondary mb-3">Cancel</button>
							<button type="submit" class="btn btn-primary mb-3 careerBtns" name="apisubmit">Submit</button>
						</div>
                        
                        
                        <div class="careerMsg">
							
                            
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

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
    <script src="js/jquery.validate.min.js"></script> 
    <script src="js/veena.js"></script>
    
    
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



	<script src="js/form_validator.js"></script>
	<script src="js/function.js"></script>
	<script src="js/sideform.js"></script>
	<script src="js/jquery.validate.js"></script>


<?=$this->rs_career_page['chat_code']?>