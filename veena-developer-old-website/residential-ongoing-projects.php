<?
include 'includes_config/db.config.class.php';
$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');

$title = "Residential Ongoing Projects 1, 2, 3 BHK Flats in Mumbai";
$page_title = "Residential Ongoing Projects 1, 2, 3 BHK Flats in Mumbai";
$page_keyword = "Residential Ongoing Projects,3 BHK Flats in Mumbai, Veena Serenity, Veena Velocity ,Veena Signature, Royale Villa, Veena Crest, Nikunj Signature, Veena Saraswati, Veena Senterio";
$page_description = "Residential Ongoing Projects 1,2,3 BHK Flats in Mumbai, We have completed more than 10 residential Veena Serenity, Veena Velocity, Veena Signature Etc.";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="<?=$page_description;?>" />
<meta name="keywords" content="<?=$page_keyword;?>" />
<meta name="author" content="<?=$sitename;?>" />
<title><?=$page_title;?> </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/idea_homes._icons.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/settings.css">
    <link rel="stylesheet" type="text/css" href="css/cubeportfolio.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="css/bootsnav.css">
    <link rel="stylesheet" type="text/css" href="css/range-Slider.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/color/color-1.css" id="color" />
    <link rel="shortcut icon" href="images/short_icon.png">
<meta name="google-site-verification" content="CQB7dKoLcGsYZ9Q7BKpF0cMNM6cZA3nGwg-E6U16p9A" /> 

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133692233-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-133692233-1');
</script>
  <?php include_once('externalcode.php');?>
  </head>
  <body>
      <script src="https://www.kenyt.ai/botapp/ChatbotUI/dist/js/bot-loader.js" type="text/javascript" data-bot="Veena_Developers"></script>
    <!--LOADER -->
    <? include_once($msp_header);?>
    <!--===== #/HEADER =====-->  
    <!--===== PAGE TITLE =====-->
    <div class="page-title page-main-section" style="background-image: url(images/Careers-2.jpg);">
      <div class="container padding-bottom-top-120 text-uppercase text-center">
        <div class="main-title">
          <h1> Residential Ongoing Projects  </h1>
          <div class="line_4"></div>
    
          <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#"> Residential Ongoing Projects  </a> 
        </div>
      </div>
    </div>
    <!--===== #/PAGE TITLE =====-->
    <section id="about_us" class="about-us ">
      <div class="container">
        <div class="padding_t40" >
            <?php 
              $qry=mysqli_query($con,"SELECT heading_text FROM `msp_project_heading`  WHERE `project_type`='1' and heading_type='1' and heading_status='Active' order by heading_id desc limit 1;");
              $ProjectNum = mysqli_num_rows($qry);
              if($ProjectNum > 0)
              {
                  $res=mysqli_fetch_row($qry);
                  $htext=$res[0];
              }else{$htext='Text Not Fount';}
                ?>
            <h2 class="projectListing_Heading">Residential Ongoing Projects  </h2>
            <p class="projectListing_Para"><?=$htext?></p>
            
   <div >
        
              <?php
              $qry=mysqli_query($con,"SELECT * FROM `msp_website`  WHERE `website_type_id`='1' and website_status='Active' order by websiteid desc;");
              $ProjectNum = mysqli_num_rows($qry);
             // $ProjectRes = $Project->GetProjectCompletedRes();
              if($ProjectNum > 0)
              {
                  ?>
                    <div class="col-md-3 projectListing_Thumb">
                    <a href="http://www.veenasmarthome.com/" target="_blank">
                        <div class="image">
                             <img src="images/sitelogo_images/project/codename-smarthome-project-1622617506.jpg" width="100%">                           </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4>Veena Smart Homes</h4>
                            <h6>Kandivali (W)</h6>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 projectListing_Thumb">
                    <a href="http://www.veenasamrajya.com" target="_blank">
                        <div class="image">
                             <img src="images/sitelogo_images/project/veena-samrajya-project-1583733868.jpg " width="100%">                           </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4>Veena Samrajya</h4>
                            <h6>Palghar</h6>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 projectListing_Thumb">
                    <a href="https://www.veenaserene.com" target="_blank">
                        <div class="image">
                             <img src="images/sitelogo_images/project/veena-serene-project-1614622962.jpg " width="100%">                           </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4>Veena Serene</h4>
                            <h6>SAHAKAR NAGAR, CHEMBUR</h6>
                        </div>
                    </a>
                    </div>
                    
                    
                    <div class="col-md-3 projectListing_Thumb">
                    <a href="https://www.veenasenterio.in" target="_blank">
                        <div class="image">
                             <img src="images/sitelogo_images/project/veena-senterio-project-1581862576.jpg" width="100%">                           </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4>Veena Senterio</h4>
                            <h6>SAHAKAR NAGAR, CHEMBUR</h6>
                        </div>
                    </a>
                    </div>
                    
                    
                    
                  
				
				
				
                    
                
                <?php
                $manoj=0;
                while ($WebsiteData = mysqli_fetch_array($qry))
                {
                  $manoj++;
                  
      $WebsiteID = $WebsiteData["websiteid"];
      $WebsiteName = $WebsiteData["website_sitename"];
      $WebsiteLogo = $WebsiteData["website_sitelogo"];
      $WebsiteImage = $WebsiteData["website_image"];
      $WebsiteMobile = $WebsiteData["website_mobile"];
      $WebsitePhone = $WebsiteData["website_phone"];
      $WebsiteAddress = $WebsiteData["website_short_address"];
      $WebsiteColor = $WebsiteData["website_sitecolor"];
      $WebsiteStatus = $WebsiteData["website_status"];
      $WebsiteURL = $WebsiteData["website_url_title"];

      $CatTitSpaceRemove = _prepare_url_text($WebsiteData["website_url_title"]);
        $urlhtaccess = strtolower($siteurl.'/project/'. $WebsiteURL);
                  $urlhtaccess = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
                ?>
               
                <div class="col-md-3 projectListing_Thumb">
                    <a href="<?=$urlhtaccess?>">
                        <div class="image">
                            <? if(!empty($WebsiteImage)){ ?> <img src="images/sitelogo_images/project/<?=$WebsiteImage;?> " width="100%">   <? }else{ ?> <img src="images/contents/building-icon.jpg" alt="<?=$WebsiteName;?>"> <? } ?>
                        </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4><?= $WebsiteName;?></h4>
                            <h6><?=$WebsiteAddress;?></h6>
                        </div>
                    </a>
                </div>
                <?
                  if($manoj==3){echo '<div class="clearfix"></div>'; $manoj=0;}
                  }
              }else{ ?><h3>No any Projects</h3> <br><Br><? }
              ?>

               
              </div>
        </div>
      </div>
    </section>
    <!-- Gallery ends -->
    <!--===== #/CONTACT =====--> 
    <? include_once($msp_footer);?>
    <!--===== #/FOOTER =====--> 
    <!--===== REQUIRED JS =====--> 
    <script src="js/jquery.2.2.3.min.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery.appear.js"></script>
    <script src="js/modernizr.html"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script> 
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.fancybox.js"></script> 
    <script src="js/cubeportfolio.min.js"></script> 
    <script src="js/image-light-box.js"></script> 
    <script src="js/range-Slider.min.js"></script> 
    <script src="js/selectbox-0.2.min.js"></script> 
    <script src="js/bootsnav.js"></script> 
    <script src="js/zelect.js"></script> 
    <script src="js/themepunch/jquery.themepunch.tools.min.js"></script>
    <script src="js/themepunch/jquery.themepunch.revolution.min.js"></script>   
    <script src="js/themepunch/revolution.extension.layeranimation.min.js"></script> 
    <script src="js/themepunch/revolution.extension.navigation.min.js"></script> 
    <script src="js/themepunch/revolution.extension.parallax.min.js"></script> 
    <script src="js/themepunch/revolution.extension.slideanims.min.js"></script> 
    <script src="js/themepunch/revolution.extension.video.min.js"></script>
    <script src="js/functions.js"></script>
    
      <script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
    
    <!--===== #/REQUIRED JS =====--> 
  </body>
</html>