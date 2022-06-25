<?
include 'includes_config/db.config.class.php';
$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');

$title = "Upcoming Residential 1, 2, 3BHK Flats in Mumbai &amp; Mhada Flats in Palghar";
$page_title = "Upcoming Residential 1, 2, 3BHK Flats in Mumbai &amp; Mhada Flats in Palghar";
$page_keyword = "Upcoming Residential, 1,2,3BHK Flats in Mumbai, Upcoming residential projects in mumbai,Mhada Flats In Palghar, Upcoming Mhada Flat Palghar, MHADA lottery Palghar, PMAY project in Palghar";
$page_description = "Residential Upcoming Residential 1,2, 3BHK Flats in Mumbai,We have Upcoming Residential 1,2,3BHK flats Chembur, Malad Kandivali, Borivali,Mhada lottery flats in Palghar.";

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
          <h1> Residential Upcoming Projects  </h1>
          <div class="line_4"></div>
    
          <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#"> Residential Upcoming Projects  </a> 
        </div>
      </div>
    </div>
    <!--===== #/PAGE TITLE =====-->
    <section id="about_us" class="about-us ">
      <div class="container">
    
        <div class="padding_t40" >
             <?php 
              $qry=mysqli_query($con,"SELECT heading_text FROM `msp_project_heading`  WHERE `project_type`='1' and heading_type='2' and heading_status='Active' order by heading_id desc limit 1;");
              $ProjectNum = mysqli_num_rows($qry);
              if($ProjectNum > 0)
              {
                  $res=mysqli_fetch_row($qry);
                  $htext=$res[0];
              }else{$htext='Text Not Fount';}
                ?>
            <h2 class="projectListing_Heading">Residential Upcoming Projects  </h2>
            <p class="projectListing_Para"><?=$htext?></p>
   <div >
              <?
              $qry=mysqli_query($con,"SELECT * FROM `msp_project` WHERE msp_project_type='1' and msp_status='active' and msp_project_status='2'  order by projectid desc");
              $ProjectNum = mysqli_num_rows($qry);
             // $ProjectRes = $Project->GetProjectCompletedRes();
              if($ProjectNum > 0)
              {
                $manoj=0;
                while ($ProjectData = mysqli_fetch_array($qry))
                {
                  $manoj++;
                  $ProjectID = $ProjectData["projectid"];
                  $ProjectTitle = $ProjectData["msp_title"];
                  $ProjectProjectType = $ProjectData["msp_project_type"];
                  $ProjectLocation = $ProjectData["msp_location"];
                  $ProjectImages = $ProjectData["msp_image"];
                  $ProjectStatus = $ProjectData["msp_status"];
                ?>
                <div class="col-md-3 projectListing_Thumb">
                    <a href="#">
                        <div class="image">
                            <? if(!empty($ProjectImages)){ ?> <img src="images/project_images/<?=$ProjectImages;?>" alt="<?=$ProjectName;?>"><? }else{ ?> <img src="images/contents/building-icon.jpg" alt="<?=$ProjectName;?>"> <? } ?>
                        </div>
                        
                        <div class="project_cap top10 text-center">
                          <h4><?=$ProjectTitle;?></h4>
                          <h6><?=$ProjectLocation;?></h6>
                        </div>
                    </a>
                </div>
                <?
                  if($manoj==4){echo '<div class="clearfix"></div>'; $manoj=0;}
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