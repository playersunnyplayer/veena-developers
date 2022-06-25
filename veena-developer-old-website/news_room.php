<?
include 'includes_config/db.config.class.php';


$title = "Veena Developers - News Room";
$page_title = "Veena Developers - News Room";
$page_keyword = "3 BHK Flats,2 BHK Flats Mumbai,Veena Developers ,residential projects in mumbai";
$page_description = "Latest Update about project ,announcement other news activity";

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
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
  <div class="loader">
      <div class="cssload-thecube">
      <img  class="loaderimg2" src="<?=$siteurl;?>/images/loaderimg2.png" alt="logo"/></a> 
      <img class="loaderimg1" src="<?=$siteurl;?>/images/loaderimg1.png" alt="logo"/></a> 
   
   
      </div>
    </div> 
   <? include_once($msp_header);?>
<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section" style="background-image: url(images/News-Media-1.jpg);">
  <div class="container padding-bottom-top-120 text-uppercase text-center">
    <div class="main-title">
      <h1><?=$title;?></h1>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#"><?=$title;?></a> </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====-->
<section id="about_us" class="about-us ">
  <div class="container">
    <div class="property-tab bottom20"> 
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Events" aria-controls="tab_contact" role="tab" data-toggle="tab" aria-expanded="false">Events</a></li>
        <li role="presentation" class=""><a href="#Press" aria-controls="summary" role="tab" data-toggle="tab" aria-expanded="false"> Press Releases </a></li>
        <!--<li role="presentation" class=""><a href="#Media" aria-controls="features" role="tab" data-toggle="tab" aria-expanded="false">Media Appearances </a></li>-->
        <li role="presentation" class=""><a href="#Awards" aria-controls="tab_contact" role="tab" data-toggle="tab" aria-expanded="false">Awards</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content ">
        <div role="tabpanel" class="tab-pane active" id="Events">
          <h3 class="text-uppercase  bottom20 top10">Events</h3>
          
          <div class="row" >
              <?php
              $EventNum = $Event->GetEventNum();
              $EventRes = $Event->GetEventRes();
              
              if ($EventNum > 0)
              {
                $anju=0;
                while ($EventData = $Event->dbfetch($EventRes))
                {
                  $anju++;
                  $EventID = $EventData["eventid"];
                  $EventTitle = $EventData["msp_title"];
                  $EventImages = $EventData["msp_image"];
                  $EventImages2 = $EventData["msp_image2"];
                  $EventStatus = $EventData["msp_status"];
                ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="cbp-item latest rent">
                  <div class="image details_pro">
                    <img src="images/event_images/resize/<?=$EventImages2;?>" alt="<?=$EventTitle;?>">
                    <div class="overlay"> <a href="images/event_images/<?=$EventImages;?>" class="fancybox centered" data-fancybox-group="gallery"> <h4><?=$EventTitle;?></h4> </a> </div>
                  </div>
                  <div class="project_cap top10 text-center">
                    <h5><a href="#"><?=$EventTitle;?></a></h5>
                  </div>
                </div>
              </div>
              <?
              if($anju==4){ echo '<div class="clearfix"></div>'; $anju=0; } 
                
              }
              }
              ?>
          </div>
        
        </div>
        <div role="tabpanel" class="tab-pane" id="Press">
          <h3 class="text-uppercase  bottom20 top10">Press Releases </h3>
        
          <div class="row" >
            <?php
            $PressReleasesNum = $CMS->GetPageInfoNum("msp_press_releases", "press_releasesid");
            $PressReleasesRes = $CMS->GetPageInfoRes("msp_press_releases", "press_releasesid");
            
            if ($PressReleasesNum > 0)
            {
              $anju=0;
              while ($PressReleasesData = $CMS->dbfetch($PressReleasesRes))
              {
                $anju++;
                $PressReleasesTitle = $PressReleasesData["msp_title"];
                $PressReleasesImage = $PressReleasesData["msp_image"];
                $PressReleasesImage2 = $PressReleasesData["msp_image2"];
              ?>
            <div class="col-md-3 col-sm-6 col-xs-12"><div class="cbp-item latest rent">
              <div class="image details_pro"> <a href="images/press_releases_images/pdf/<?=$PressReleasesImage2;?>" target="_blank"> <img src="images/press_releases_images/<?=$PressReleasesImage;?>" alt="<?=$PressReleasesTitle;?>"></a> </div>
            </div></div>
            <?
              if($anju==4){ echo '<div class="clearfix"></div>'; $anju=0; } 
              }
            }
            ?>
            
          </div>
       
        </div>
        <div role="tabpanel" class="tab-pane" id="Media">
          <h3 class="text-uppercase  bottom20 top10">Media <span class="color_red">Appearances</span></h3>
      
          <div class="row">

            <?php
            $MediaNum = $CMS->GetPageInfoNum("msp_media_appearance", "media_appearanceid");
            $MediaRes = $CMS->GetPageInfoRes("msp_media_appearance", "media_appearanceid");
            
            if ($MediaNum > 0)
            {
              $anju=0;
              while ($MediaData = $CMS->dbfetch($MediaRes))
              {
                $anju++;
                $MediaDataID = $MediaData["media_appearanceid"];
                $MediaDataTitle = $MediaData["msp_title"];
                $MediaDataVideo_Code = $MediaData["msp_video_code"];
                $MediaDataStatus = $MediaData["msp_status"];

                $video_code = str_replace("https", "http", $MediaDataVideo_Code);

                $myObject = new SimpleYouTube;
                $video_id = $myObject->getVideoID($video_code);
                $videoDetails = $myObject->getVideoDetails($video_id);
              ?>
            <div class="col-md-3 col-sm-6 col-xs-12"><div class="cbp-item latest rent">
              <div class="image">

                <embed src="http://www.youtube.com/v/<?php echo $video_id; ?>&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="100%" height="250">
              </div>
            </div></div>
            <?
            if($anju==4){ echo '<div class="clearfix"></div>'; $anju=0; } 
              }
            }
            ?>
           
          </div>
       
        </div>
     <div role="tabpanel" class="tab-pane" id="Awards">
   <h3 class="text-uppercase  bottom20 top10">Awards</h3>
   <div class="row" >
     
       <?php
              $AwardNum = $Award->GetAwardNum();
              $AwardRes = $Award->GetAwardRes();
              
              if ($AwardNum > 0)
              {
                $anju=0;
                while ($AwardData = $Award->dbfetch($AwardRes))
                {
                  $anju++;
                  $AwardID = $AwardData["eventid"];
                  $AwardTitle = $AwardData["msp_title"];
                  $AwardImages = $AwardData["msp_image"];
                  $AwardImages2 = $AwardData["msp_image2"];
                  $AwardStatus = $AwardData["msp_status"];

                ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="cbp-item latest rent">
                  <div class="image details_pro">
                    <img src="images/award_images/resize/<?=$AwardImages2;?>" alt="<?=$AwardTitle;?>">
                    <div class="overlay"> <a href="images/award_images/<?=$AwardImages;?>" class="fancybox centered" data-fancybox-group="gallery"> <h4><?=$EventTitle;?></h4></a> </div>
                  </div>
                  <div class="project_cap top10 text-center">
                    <h5><a href="#"><?=$AwardTitle;?></a></h5>
                  </div>
                </div>
              </div>
              <?
              if($anju==4){ echo '<div class="clearfix"></div>'; $anju=0; } 
                }
              }
              ?>
   </div>
</div>
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

<script src="<?=$siteurl;?>/js/form_validator.js"></script> 
<script src="<?=$siteurl;?>/js/jquery.validate.js"></script> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    
});
</script>

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

<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.appear.js"></script> 
<script src="js/modernizr.html"></script> 
<script src="js/jquery.parallax-1.1.3.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.fancybox.js"></script> 
<script src="js/cubeportfolio.min.js"></script> 
<script src="js/range-Slider.min.js"></script> 
<script src="js/selectbox-0.2.min.js"></script> 
<script src="js/bootsnav.js"></script> 
<script src="js/zelect.js"></script> 
<script src="js/functions.js"></script> 
<!--===== #/REQUIRED JS =====-->
</body>
</html>