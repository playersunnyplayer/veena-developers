

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/owl.theme.default.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/csr.css" />


	
        <?php include'includes/header1.php';?>
        
        
        
        
 <?php
	 
	 
	 if($this->rs_about_page['page_image']!='' && file_exists(ABS_PATH."/uploads/csr/".$this->rs_about_page['page_image']))
	 {
		 $style='style="background: url(uploads/csr/'.$this->rs_about_page['page_image'].') no-repeat;background-size: cover;"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 ?>
   
   


	<section class="breadcrumbSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<h1 class="breadcrumbHeading">Corporate Social Responsibility</h1>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Corporate Social Responsibility</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="overviewSec companyPhiloshySec">
		<div class="container">
			<div class="row">
				<div class="col-md-6 leftArea">
					<div class="bgRec yellow wow animate__animated animate__zoomIn" data-wow-delay="1s"></div>
					<div class="bgDot wow animate__animated animate__zoomIn" data-wow-delay="0.5s"></div>
					<div class="projectVideoSec wow animate__animated animate__zoomIn" data-wow-delay="1.5s">
						<div class="projectVideoSecInner">
                         <?php if($this->rs_about_page['image']!=''){?>
							<img src="uploads/csr/<?=$this->rs_about_page['image']?>" alt="" />
                            <?php }?>
						</div>
					</div>
				</div>
				<div class="col-md-6 rightContent_inner">
					<h4><?=$this->rs_about_page['career_heading']?></h4>
					<!-- <p class="semiHeading" data-wow-delay="0.5s">Under this trust name Veena Developers do all the social activities on regular basis.</p> -->
					 <?=$this->rs_about_page['career_desc']?>
				</div>
			</div>
		</div>
	</section>
    
	<section class="csrSec filterTabsSec">
		<div class="container">
			<h2><?=$this->rs_about_page['job_heading']?></h2>
			
			<ul class="nav nav-pills" id="pills-tab" role="tablist">
            
              <?php for($i=0;$i<count($this->rs_csr_category);$i++){
				  
				  
				  if($i==0)
				  {
					  
					  $active='active';
					  
				  }
				  else
				  {
					  $active='';
					  
				  }
				  
				  ?>
				<li class="nav-item">
					<a class="nav-link <?=$active?>" id="<?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>-tab" data-toggle="pill" href="#<?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>" role="tab"
						aria-controls="<?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>" aria-selected="false">
						<h3>
						<?=$this->rs_csr_category[$i]['title']?>
						</h3>
					</a>
				</li>
                <?php }?>
				
                
			</ul>

			<div class="tab-content" id="pills-tabContent">
            
            
             <?php for($i=0;$i<count($this->rs_csr_category);$i++){
				  
				  
				  if($i==0)
				  {
					  
					  $active='show active';
					  
				  }
				  else
				  {
					  $active='';
					  
				  }
				  
				  
				  
				  $obj_model_csr_images=$this->load_model('csr_category_images');
				  $rs_images=$obj_model_csr_images->execute("SELECT",false,"","status='Active' and csr_category_id='".$this->rs_csr_category[$i]['id']."'","sort_id ASC");
	
				  
				  
				  
				  ?>
				<div class="tab-pane fade <?=$active?>" id="<?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>" role="tabpanel" aria-labelledby="<?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>-tab">
					<div class="filter filterContentArea <?=substr($this->rs_csr_category[$i]['title'], 0, 4);?>">
						 
                        <?=$this->rs_csr_category[$i]['short_desc']?>
					</div>
					<div class="galleryImagesArea religious">
                    
                    <?php if(count($rs_images)>0){?>
						<div class="owl-carousel owl-theme" id="religious-carousel">
                        
                        <?php for($j=0;$j<count($rs_images);$j++){?>
							<div class="item">
								<a href="uploads/csr/<?=$rs_images[$j]['image']?>" class="galleryThumb"
									data-fancybox="<?=$this->rs_csr_category[$i]['title']?>" data-caption="<?=$this->rs_csr_category[$i]['title']?>">
									<img src="uploads/csr/<?=$rs_images[$j]['image']?>" class="img-responsive">
								</a>
							</div>
							
                             <?php }?>
						</div>
                        
                        <?php }?>
						
                        
					</div>
				</div>
                
                <?php }?>
				
                
				
                
				
                
				
                
				
                
			</div>
		</div>
	</section>
    
    
	
    

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

			setInterval("switchImage();", 2000);

			let defaultFilterActive = $(".filter-button.active").attr("data-filter");
			$(`.filter`).animate({ maxWidth: '0', padding: '0' }, "slow");
			$(`.filter.${defaultFilterActive}`).animate({ maxWidth: '100%', padding: '0 10px' }, "slow");

			$(".filter-button").click(function () {
				var value = $(this).attr('data-filter');

				$(".filter").not('.' + value).animate({ maxWidth: '0', padding: '0' }, "slow");
				$('.filter').filter('.' + value).animate({ maxWidth: '100%', padding: '0 10px' }, "slow");

				if ($(".filter-button").removeClass("active")) {
					$(this).removeClass("active");
				}
				$(this).addClass("active");
			});
		});

		$("#religious-carousel, #gavshala-carousel, #social-carousel, #education-carousel, #medical-carousel, #donations-carousel").owlCarousel({
			loop: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 5000,
			nav: true,
			items: 1,
			margin: 30,
			autoHeight: true,
			animateOut: 'fadeOut'
		});
	</script>
	
    
	<script src="js/form_validator.js"></script>
	<script src="js/sideform.js"></script>
	<script src="js/jquery.validate.js"></script>


<?=$this->rs_about_page['chat_code']?>