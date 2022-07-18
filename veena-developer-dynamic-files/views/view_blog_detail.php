


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="css/about-us.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/blog.css" />
	<link rel="stylesheet" href="css/style.css" />



	
       <?php include'includes/header1.php';?>
    
    
    
    <?php
	 
	 
	 if($this->rs_career_page['header_image']!='' && file_exists(ABS_PATH."/uploads/blog/".$this->rs_career_page['header_image']))
	 {
		 $style='style="background: url(uploads/blog/'.$this->rs_career_page['header_image'].') no-repeat;background-size: cover;"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 
	 					$product=$this->rs_blogs;
						 $title=$product['title'];
						$short_info=$product['short_info'];
						$description=$product['description'];
						$slug=$product['slug'];
						$blog_category_name=$product['blog_category_name'];
						$added_date=$product['added_date'];
						
						
						$f_date=date('d M Y',strtotime($added_date));
						$image=$product['detail_image'];
						 $folder='blog';
		 				 $mainImage=$this->utility->get_image_path($image,$folder,'large');	
	 
	 
	 ?>

	<section class="breadcrumbSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<h1 class="breadcrumbHeading"><?=$title?></h1>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="blog.html">Blog</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="blogList">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="blogListWrap">
						<figure class="blogDetailimage">
							<img src="<?=$mainImage?>" alt="">

							<div class="blogHeadingDetails">
								<p class="blogSemiHeading"><?=$blog_category_name?></p>
								<p><i class="fa fa-calendar"></i> <?=$f_date?> </p>
							</div>
						</figure>
						<h3><?=$title?></h3>
						
                        <div><?=$description?></div>
                        
                        
                        
                        
                        <?php if(count($this->rs_tag_master)>0){?>

						<div class="tagsSec">
							<h4>Tags</h4>
							<div class="tagsWrap">
								<?php for($i=0;$i<count($this->rs_tag_master);$i++){
						
						$slug=$this->rs_tag_master[$i]['slug'];
						$name=$this->rs_tag_master[$i]['name'];
						
						
						?>
						<a href="blog/tag/<?=$slug?>.html"><?=$name?></a>
					
                    <?php }?>
							</div>
						</div>
                        
                        <?php }?>

						<div class="blogSocial">
							<h4>Share <span class="blueText">On</span></h4>
							<ul class="menuSocial socialMedia">
								<li>
									<a target="_blank" href="https://www.facebook.com/VeenaDevelopers/"
										class="facebook_sm"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="https://twitter.com/veena_developer" class="twitter_sm" target="_blank"><i
											class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="https://www.instagram.com/veena_developers/" class="instagram_sm"
										target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="https://www.linkedin.com/company/veenadevelopers-mumbai"
										class="linkedin_sm" target="_blank"><i class="fa fa-linkedin"></i></a>
								</li>
								<li>
									<a href="https://www.youtube.com/channel/UCmr89-vfqKfwJ9Eb-gtqOuA"
										class="youtube_sm" target="_blank"><i class="fa fa-youtube"></i></a>
								</li>
								<li>
									<a target="_blank"
										href="https://wa.me/918055590590?text=I%27m%20interested%20to%20know%20about%20your%20project%20"
										class="whatsapp_sm"><i class="fa fa-whatsapp"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<h4>Related <span class="blueText">Articles</span></h4>
					<ul class="blogCatList">
                    
                    <?php for($i=0;$i<count($this->rs_category);$i++){
						
						$slug=$this->rs_category[$i]['slug'];
						$name=$this->rs_category[$i]['name'];
						if($this->getGetVar('slug')==$slug)
						{
							$activeClass='active';
							
						}
						else
						{
							$activeClass='';
							
						}
						?>
						<li class=""><a href="blog/<?=$slug?>.html"><?=$name?></a></li>
					
                    <?php }?>
						
                        
					</ul>
					<div class="tagsSec">
						<h4>Tags</h4>
						<div class="tagsWrap">
                        
                          <?php for($i=0;$i<count($this->rs_tags);$i++){
						
						$slug=$this->rs_tags[$i]['slug'];
						$name=$this->rs_tags[$i]['name'];
						
						
						?>
						<a href="blog/tag/<?=$slug?>.html"><?=$name?></a>
					
                    <?php }?>
							
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
   
	
    
	
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




  

<script src="js/jquery.validate.js"></script> 
<script src="js/veena.js"></script> 

<?=$this->rs_blogs['chat_code']?>

