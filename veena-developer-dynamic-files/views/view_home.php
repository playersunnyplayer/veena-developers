<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="css/owl.carousel.min.css" />
<link rel="stylesheet" href="css/owl.theme.default.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" />
<?php include'includes/header.php';?>
<!-- mobile banners -->

<?php if(count($this->banner)>0){?>
<div class="slider-wrapper theme-default show_767">
  <div id="sliderDesktop" class="nivoSlider">
    <?php for($i=0;$i<count($this->banner);$i++){
          if($this->banner[$i]['mobile_image']!='' && file_exists(ABS_PATH."/uploads/banner/".$this->banner[$i]['mobile_image'])) { ?>
    <img src="uploads/banner/<?=$this->banner[$i]['mobile_image']?>" alt="">
    <?php } }?>
  </div>
</div>

<!-- desktop banners -->
<div class="slider-wrapper theme-default hide_767">
  <div id="sliderMobile" class="nivoSlider">
    <?php for($i=0;$i<count($this->banner);$i++){
          if($this->banner[$i]['banner_image']!='' && file_exists(ABS_PATH."/uploads/banner/".$this->banner[$i]['banner_image'])){
    ?>
    <img src="uploads/banner/<?=$this->banner[$i]['banner_image']?>" alt="">
    <?php } }?>
  </div>
</div>
<?php }?>
<section class="container journeySec">
  <div class="row">
  
  
  <?php
	 
	 
	 if($this->rs_home['page_image']!='' && file_exists(ABS_PATH."/uploads/home/".$this->rs_home['ch_bg_image']))
	 {
		 $style='style="background: url(uploads/home/'.$this->rs_home['ch_bg_image'].')"';
		 
	 }
	 else
	 {
		 $style='';
		 
     }
	 
	 
	 
	 ?>
  
  
    <div class="year31SecWrap">
      <div class="year31Sec" <?=$style?>>
        <div class="bg">
          <div class="wrap wow animate__animated animate__zoomIn">
          
          <?php
	 
	 
	 if($this->rs_home['ch_image']!='' && file_exists(ABS_PATH."/uploads/home/".$this->rs_home['ch_image']))
	 {?>
		
		
		   <img src="uploads/home/<?=$this->rs_home['ch_image']?>" alt="" class="img_31" />
	 
     <?php }
	 
	 
	 ?>
          
          
          
         
           
           
            <div class="verticalText"><?=$this->rs_home['ch_title']?></div>
          </div>
          <div class="ex wow animate__animated animate__fadeInUp"><?=$this->rs_home['ch_desc']?></div>
        </div>
      </div>
    </div>
    <div class="col-sm-9 rightContent_home">
      <h2><?=$this->rs_home['career_heading']?></h2>
    <?=$this->rs_home['career_desc']?>
    
    
    
    <?php if($this->rs_home['counter1']!='' || $this->rs_home['counter2']!='' || $this->rs_home['counter3']!='' || $this->rs_home['counter4']!=''){
		
		
		
		
		
		$counter1=$this->rs_home['counter1'];
		$counter2=$this->rs_home['counter2'];
		$counter3=$this->rs_home['counter3'];
		$counter4=$this->rs_home['counter4'];
		
		
		$mystring='+';
		
		if (strpos($counter1, '+') !== false) 
		{
			
			
			$prelabel1='+';
			
			
			
		}
		
		
		if (strpos($counter2, '+') !== false) 
		{
			
			
			$prelabel2='+';
			
			
			
		}
		if (strpos($counter3, '+') !== false) 
		{
			
			
			$prelabel3='+';
			
			
			
		}
		if (strpos($counter4, '+') !== false) 
		{
			
			
			$prelabel4='+';
			
			
			
		}
		
		
		
		
		
		
		$title1=$this->rs_home['title1'];
		$title2=$this->rs_home['title2'];
		$title3=$this->rs_home['title3'];
		$title4=$this->rs_home['title4'];
		
		
		
		$subtitle1=$this->rs_home['subtitle1'];
		$subtitle2=$this->rs_home['subtitle2'];
		$subtitle3=$this->rs_home['subtitle3'];
		$subtitle4=$this->rs_home['subtitle4'];
		
		
		
		?>
    
      <div class="factCounterSec">
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter1?>" data-speed="1500"></span><?=$prelabel1?></div>
            <div class="verticalText"><?=$title1?></div>
          </div>
          <div class="hor"><?=$subtitle1?></div>
        </div>
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter2?>" data-speed="1500"></span><?=$prelabel2?></div>
            <div class="verticalText"><?=$title2?> </div>
          </div>
          <div class="hor"><?=$subtitle2?></div>
        </div>
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter3?>" data-speed="1500"></span><?=$prelabel3?></div>
            <div class="verticalText"><?=$title3?></div>
          </div>
          <div class="hor"><?=$subtitle3?></div>
        </div>
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter4?>" data-speed="1500"></span><?=$prelabel4?></div>
            <div class="verticalText"> <?=$title4?></div>
          </div>
          <div class="hor"><?=$subtitle4?></div>
        </div>
      </div>
      
      
      <?php }?>
      
      
      <?php if($this->rs_home['counter5']!='' || $this->rs_home['counter6']!='' || $this->rs_home['counter7']!=''){
		
		
		
		
		
		$counter5=$this->rs_home['counter5'];
		$counter6=$this->rs_home['counter6'];
		$counter7=$this->rs_home['counter7'];
		
		
		
		
		$mystring='+';
		
		if (strpos($counter5, '+') !== false) 
		{
			
			
			$prelabel5='+';
			
			
			
		}
		
		
		if (strpos($counter6, '+') !== false) 
		{
			
			
			$prelabel6='+';
			
			
			
		}
		if (strpos($counter7, '+') !== false) 
		{
			
			
			$prelabel7='+';
			
			
			
		}
			
		
		
		
		
		
		$title5=$this->rs_home['title5'];
		$title6=$this->rs_home['title6'];
		$title7=$this->rs_home['title7'];
		
		
		
		
		
		$subtitle5=$this->rs_home['subtitle5'];
		$subtitle6=$this->rs_home['subtitle6'];
		$subtitle7=$this->rs_home['subtitle7'];
		
		
		
		
		
		?>
    
      <div class="factCounterSec">
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter5?>" data-speed="1500"></span><?=$prelabel5?></div>
            <div class="verticalText"><?=$title5?></div>
          </div>
          <div class="hor"><?=$subtitle5?></div>
        </div>
        <?php if($this->rs_home['counter6']!=''){ ?>
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter6?>" data-speed="1500"></span><?=$prelabel6?></div>
            <div class="verticalText"><?=$title6?> </div>
          </div>
          <div class="hor"><?=$subtitle6?></div>
        </div>
        <?php } ?>
        <?php if($this->rs_home['counter7']!=''){ ?>
        <div class="factThumb">
          <div class="numWrap">
            <div class="numCounter"><span class="timer count-title count-number numCounter_num" data-to="<?=(int)$counter7?>" data-speed="1500"></span><?=$prelabel7?></div>
            <div class="verticalText"><?=$title7?></div>
          </div>
          <div class="hor"><?=$subtitle7?></div>
        </div>
        <?php } ?>
        
      </div>
      
      
      <?php }?>
    </div>
  </div>
</section>

<?php 


if(count($this->rs_resi_projects)>0){?>
<section class="gradientArea residentialSec projectCarousel">
  <div class="container">
    <div class="row">
      <h3 class="verticalText verticalText_MobileReset"> Residential <span class="blueText">Project</span> </h3>
      <div class="owl-carousel owl-theme" id="residential-carousel">
      <?php for($i=0;$i<count($this->rs_resi_projects);$i++){
		  
		  $item=$this->rs_resi_projects[$i];
		  
		  $name=$item['name'];
		  $subtitle=$item['subtitle'];
		  $image=$item['image'];
		  $slug=$item['slug'];
		  $no_of_building=$item['projects_info_no_of_building'];
		  $no_of_storey=$item['projects_info_no_of_storey'];
		  $type_of_unit=$item['projects_info_type_of_unit'];
		  
		  
		  
		  $detailURL='detail/'.$slug.'.html';
		  $folder='project';
		  $mainImage=$this->utility->get_image_path($image,$folder,'large');	
		  ?>
      
        <div class="item wow animate__animated animate__fadeInRight">
          <figure> <img src="<?=$mainImage?>" alt="<?=$name?>" /> </figure>
          <div class="projectTitleArea">
            <div class="projectTitleHidden">
              <div class="projectTitle"><?=$name?></div>
              <?php if($subtitle!=''){?>
              <p class="projectPlace"><?=$subtitle?></p>
              <?php }?>
              <div class="titlePara">
                <p><strong>Total No. of Buildings</strong></p>
                <?php if($no_of_building!=''){?>
                <p class="mb-2"><?=$no_of_building?></p>
                <?php }?>
                <?php if($no_of_storey!=''){?>
                <p><strong>No. of Storey</strong></p>
                <p class="mb-2"><?=$no_of_storey?></p>
                 <?php }?>
                <?php if($type_of_unit!=''){?>
                <p><strong>Type of Units</strong></p>
                <p class="mb-2"><?=$type_of_unit?></p>
                 <?php }?>
                
				
              </div>
            </div>
            <a href="<?=$detailURL?>" class="projectTitleVisible"> <?=$name?> <i class="fa fa-long-arrow-right"></i> </a> </div>
        </div>
        
        <?php }?>
        
        
        
        
        
        
        
        
        
        
        
      </div>
    </div>
  </div>
</section>

<?php }?>

<?php if(count($this->rs_comm_projects)>0){?>
<section class="gradientArea commercialSec projectCarousel">
  <div class="container">
    <div class="row">
      <h3 class="verticalText verticalText_MobileReset"> Commercial <span class="blueText">Project</span> </h3>
      <div class="owl-carousel owl-theme" id="commercial-carousel">
      
       <?php for($i=0;$i<count($this->rs_comm_projects);$i++){
		  
		  $item=$this->rs_comm_projects[$i];
		  
		  $name=$item['name'];
		  $subtitle=$item['subtitle'];
		  $image=$item['image'];
		  $slug=$item['slug'];
		  $no_of_building=$item['projects_info_no_of_building'];
		  $no_of_storey=$item['projects_info_no_of_storey'];
		  $type_of_unit=$item['projects_info_type_of_unit'];
		  
		  
		  
		  $detailURL='detail/'.$slug.'.html';
		  $folder='project';
		  $mainImage=$this->utility->get_image_path($image,$folder,'large');	
		  ?>
      
        <div class="item wow animate__animated animate__fadeInRight">
          <figure> <img src="<?=$mainImage?>" alt="<?=$name?>" /> </figure>
          <div class="projectTitleArea">
            <div class="projectTitleHidden">
              <div class="projectTitle"><?=$name?></div>
              <?php if($subtitle!=''){?>
              <p class="projectPlace"><?=$subtitle?></p>
              <?php }?>
              <div class="titlePara">
                <p><strong>Total No. of Buildings</strong></p>
                <?php if($no_of_building!=''){?>
                <p class="mb-2"><?=$no_of_building?></p>
                <?php }?>
                <?php if($no_of_storey!=''){?>
                <p><strong>No. of Storey</strong></p>
                <p class="mb-2"><?=$no_of_storey?></p>
                 <?php }?>
                <?php if($type_of_unit!=''){?>
                <p><strong>Type of Units</strong></p>
                <p class="mb-2"><?=$type_of_unit?></p>
                 <?php }?>
                
				
              </div>
            </div>
            <a href="<?=$detailURL?>" class="projectTitleVisible"> <?=$name?> <i class="fa fa-long-arrow-right"></i> </a> </div>
        </div>
        
        <?php }?>
        
        
        
        
        
      </div>
    </div>
  </div>
</section>

<?php }?>
<?php if(count($this->testimonial)>0){?>
<section class="testimonial">
  <div class="container">
    <div class="row">
      <h4>What people <span class="blueText">say about us</span></h4>
      <div class="owl-carousel owl-theme" id="testimonial-carousel">
        <?php for($i=0;$i<count($this->testimonial);$i++){?>
        <div class="item wow animate__animated animate__fadeInRight">
          <div class="testiThumbSec">
            <div class="testiNameSec">
              <figure> <img src="images/testimonial-img.png" alt="" /> </figure>
              <div>
                <div class="testiName">
                  <?=$this->testimonial[$i]['name']?>
                </div>
                <div class="testiPlace">
                  <?=$this->testimonial[$i]['post']?>
                </div>
              </div>
            </div>
            <p>
              <?=nl2br($this->testimonial[$i]['content']);?>
            </p>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</section>
<?php }?>
<!-- disclaimer Model -->
<div class="modal fade" id="disclaimerModel" tabindex="-1" role="dialog" aria-labelledby="disclaimerModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <h3><span class="blueText">Disclaimer</span> <img src="images/close-icon.svg" data-dismiss="modal"
                        aria-label="Close" alt=""></h3>
      <div class="modal-body">
        <p>This disclaimer (“disclaimer”) will be applicable whoever further navigate through to the website www.veenadevelopers.com and such other links to other website. By using or accessing the website you agree with the disclaimer without any qualification or limitation. <br>
          <br>
          The websites and all its content are provided with all faults on an “as is” and “as available” basis. No information given under this website creates a warranty or expand the scope of any warranty that cannot be disclaimed under applicable law. Your use of the website is solely at your own risk. This website is for guidance only. It does not constitute part of an offer or contract. Design &amp; specifications are subject to change without prior notice. Computer generated images are the artist’s impression and are an indicative of the actual designs. The company reserves the right to add, alter or delete material from the website at any time and may, at any time, revise these terms without notifying you. You are bound by any such amendments and the company therefore advise that you periodically visit this page to review the current terms. <br>
          <br>
          All information (including but not limited to, project/ apartments/flats, amenities, presentations brochures etc.) On the website is provided as convenience to you and accordingly may not be fully in line thereof as of date so you are therefore required to verify all the details, including area, amenities, services, terms of sales and payments and other relevant terms independently with the sales team/ company prior to concluding any decision for buying any unit(s) in any of the said projects. Till such time the details are fully updated, the said information will not be construed as an advertisement. To find out more about a project / development, please telephone our sales centres or visit our sales office during opening hours and speak to one of our sales staff. <br>
          <br>
          All information under “buyers guide” tab is of a general nature, for informational purposes only, and is not to be relied upon or construed as real estate, legal, accounting or other professional advice or a substitute therefore. You should not use any information contained on the website as a substitute for consultation with legal or accounting professionals or other professional advisors. You should not act or abstain from acting based upon information obtained from the website without first consulting appropriate professional advisors. Since all real estate transactions are unique, diligence and prudence are essential. <br>
          <br>
          In no event will the company be liable for claim made by the users including seeking any cancellation for any of the inaccuracies in the information provided in this website, though all efforts have been made to ensure accuracy. The company will no circumstance will be liable for any expense, loss or damage including, without limitation, indirect or consequential loss or damage, or any expense, loss or damage whatsoever arising from use, or loss of use, of data, arising out of or in connection with the use of this website. </p>
      </div>
    </div>
  </div>
</div>
<?php include'includes/footer.php';?>

<script>
    setTimeout(function() {
        $("#veenaloader").fadeOut();
    }, 2000);
    </script> 
<!-- Global site tag (gtag.js) - Google Analytics --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133692233-1"></script> 
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
	dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'UA-133692233-1');
</script> 
<script src="js/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> 
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script> 
<script type="text/javascript">
    $('#sliderDesktop, #sliderMobile').nivoSlider({
        pauseOnHover: false,
        pauseTime: 5000,
        animSpeed: 1000,
        effect: 'fold',
        prevText: '',
        nextText: '',
    });
    </script> 
<script src="js/script.js"></script> 
<!-- Skitter JS --> 
<script src="js/jquery.easing.1.3.js"></script> 
<script src="js/counter.js"></script> 
<!-- Init Skitter --> 
<script type="text/javascript" language="javascript">
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if(scroll >= 100) {
            $(".homeTopbar").addClass("homeHeaderBg");
        } else {
            $(".homeTopbar").removeClass("homeHeaderBg");
        }
    }); //missing );
    var horizontalAccordions = $(".accordion.width");
    horizontalAccordions.each(function() {
        var accordion = $(this);
        var collapse = accordion.find(".collapse");
        var bodies = collapse.find("> *");
        accordion.height(accordion.height());
        bodies.width(bodies.eq(0).width());
        collapse.not(".show").each(function() {
            $(this).parent().find("[data-toggle='collapse']").addClass("collapsed");
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
        if(i == 4) {
            i = 1; // retour au debut sur image 1
        } else {
            i++; // image suivante
        }
    }
    $("#testimonial-carousel").owlCarousel({
        autoHeight: true,
        loop: true,
        margin: 10,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            1000: {
                items: 2,
            },
        },
    });
    $("#residential-carousel , #commercial-carousel").owlCarousel({
        loop: true,
        autoplay: 8000,
        margin: 50,
        dots: false,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1.5,
            },
            1000: {
                items: 2.5,
            },
        },
    });
    $('.carousel').carousel({
        interval: 4000
    })
    $('[data-toggle="tooltip"]').tooltip()
        //Get the button
    var mybutton = document.getElementById("myBtn");
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    </script> 


<script src="js/form_validator.js"></script> 
<script src="js/sideform.js"></script> 
<script src="js/function.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/veena.js"></script> 

<?=$this->rs_home['chat_code']?>