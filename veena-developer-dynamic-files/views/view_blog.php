


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
	 
	 
	 
	 ?>

	<section class="breadcrumbSec" <?=$style?>>
		<div class="container">
			<div class="row">
				<div class="breadcrumbHeading"><?=$this->page_title?></div>

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        
                        <?php if($this->getGetVar('slug')!=''){?>
                        <li class="breadcrumb-item"><a href="blog.html">Blog</a></li>
                        <?php }?>
						<li class="breadcrumb-item active" aria-current="page"><?=$this->page_title?></li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="blogList">
		<div class="container">
			<div class="row">
            
            <div class="col-sm-8">
					<div class="blogListWrap results" id="results">
                  
                  
                    
                    
                    
                   
                   
						
                        
						
                        
					</div>
                    
                     <div class="nonvalued">
                     
                      <?php if($this->getGetVar('slug')!='' && $this->getGetVar('tag')==''){$catv=$this->catID;}else{$catv='no';}?>
                      
                        <?php if($this->getGetVar('slug')!='' && $this->getGetVar('tag')!=''){$tagv=$this->tagID;}else{$tagv='no';}?>
                      
                          <input type="hidden" name="catv" id="catv" value="<?=$catv?>">
                          <input type="hidden" name="subcatv" id="subcatv" value="<?=$tagv?>">
                          <input type="hidden" name="total_products" id="total_products" value="<?=count($this->rs_blogs)?>">
                          <input type="hidden" name="subsubcatv" id="subsubcatv" value="no">
                          <input type="hidden" name="size_v" id="size_v" value="no">
                          <input type="hidden" name="style_v" id="style_v" value="0">
                          <input type="hidden" name="price_v" id="price_v" value="no">
                          <input type="hidden" name="brand_v" id="brand_v" value="no">
                          <input type="hidden" name="order_v" id="order_v" value="no">
                          <input type="hidden" name="serach_keyword" id="serach_keyword" value="">
                          <input type="hidden" name="serach_cat" id="serach_cat" value="no">
                          <input type="hidden" name="product_new" id="product_new" value="no">
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
						<li class="<?=$activeClass?>"><a href="blog/<?=$slug?>.html"><?=$name?></a></li>
					
                    <?php }?>
					</ul>
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

<script src="js/load_blogs.js"></script> 

<?=$this->rs_career_page['chat_code']?>