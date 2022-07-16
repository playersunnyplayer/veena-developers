


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/listing.css" />


	
    
    <?php include'includes/header1.php';?>

	<section class="breadcrumbSec">
		<div class="container">
			<div class="row">
				<div class="breadcrumbHeading"><?=$this->page_title?></div>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?=$this->page_title?></li>
					</ol>
				</nav>
			</div>
		</div>
	</section>
    <?php if(count($this->rs_project)>0){?>

	<section class="overviewSec projectThumbnailsSec">
		<div class="container">
        
        
			<div class="row">
				<div class="projectThumbnailsWrap">
                
                
                
                	<?php for($i=0;$i<count($this->rs_project);$i++){
						
						
						 $item=$this->rs_project[$i];
		  
		  $name=$item['name'];
		  $subtitle=$item['subtitle'];
		  $image=$item['image'];
		  $slug=$item['slug'];
		  $no_of_building=$item['projects_info_no_of_building'];
		  $no_of_storey=$item['projects_info_no_of_storey'];
		  $type_of_unit=$item['projects_info_type_of_unit'];
		  
		  
		  
		  
		  if($this->getGetVar('slug1')=='ongoing')
		  {
		  
		  	$detailURL='detail/'.$slug.'.html';
		  
		  }
		  else
		  {
			  	$detailURL='javascript:void(0)';
			  
			 }
		  $folder='project';
		  $mainImage=$this->utility->get_image_path($image,$folder,'large');	
											
						
						
						?>
                    
                    
					<div class="projectThumbnail">
						<figure><img src="<?=$mainImage?>" alt="<?=$name?>"></figure>
						<!--<a href="<?=$detailURL?>" class="projectThumbnail_content">-->
						<!--	<h4><?=$name?></h4>-->
      <!--                       <?php if($subtitle!=''){?>-->
						<!--	<h6><?=$subtitle?></h6>-->
      <!--                      <?php }?>-->
						<!--</a>-->
						
						<div href="<?=$detailURL?>" class="projectThumbnail_content">
							<h4><?=$name?></h4>
                             <?php if($subtitle!=''){?>
							<h6><?=$subtitle?></h6>
                            <?php }?>
						</div>
					</div>
                    
                    <?php }?>
					
                    
					
                    
					
                    
					
                    
				</div>
			</div>
            
            
		</div>
	</section>
    
    <?php }else {?>
            
        
            
           




  <img src="images/under-construction.gif" alt="" style="margin: 0 auto;display: inherit;">
	<!-- disclaimer Model -->
    
     <?php }?>
     
	
    
    
    
    <?php include'includes/footer.php';?>
    
      <script>
	  
    setTimeout(function() {
        $("#veenaloader").fadeOut();
    }, 2000);
	
	
    </script> 
	

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
    
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
	<script src="js/function.js"></script>
	<script language='JavaScript' type='text/javascript'>
		function refreshCaptcha() {
			var img = document.images['captchaimg'];
			img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
		}
	</script>
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
		$(document).ready(function () {
			$("#ProjectContactForm7").validate({

				rules: {
					name: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					phone: {
						required: true,
						number: true,
						minlength: 10
					},

					captcha: {
						required: true,
						number: true
					},
					budget: "required",
					nationality: "required"
				},
				messages: {
					name: {
						required: "Invalid name",
						minlength: "Invalid name"
					},
					email: {
						required: "Invalid email",
						email: "Invalid email"
					},
					phone: {
						required: "Invalid mobile number",
						number: "Invalid mobile number",
						minlength: "Invalid mobile number"
					},
					message: {
						required: "Invalid message"
					},

					captcha: {
						required: "Invalid captcha"
					},
					budget: "Please select budget",
					nationality: "Please select nationality"
				}
			});
		})
	</script>
	
    
	<script src="js/form_validator.js"></script>
	<script src="js/sideform.js"></script>
	<script src="js/jquery.validate.js"></script> 
<script src="js/veena.js"></script> 


<?=$this->rs_datas[0]['chat_code']?>