<?
include 'includes_config/db.config.class.php';


$title = "Corporate Social Responsibility - Veena Developers";
$page_title = "Corporate Social Responsibility - Veena Developers";
$page_keyword = "Corporate Social Responsibility, affordable housing projects in mumbai,Builders in Mumbai, Real Estate Developers, Commercial projects in Mumbai";
$page_description = "Take a look at the social work done religious, gavshala, social, education, medical, charitable Trust donations by Veena Developers, who believes in helping groups and communities to enhance their well-being.";

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
<div class="page-title page-main-section" style="background-image: url(images/CSR-1.jpg);">
  <div class="container padding-bottom-top-120 text-uppercase text-center">
    <div class="main-title">
      <h1>CSR</h1>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="index.html">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="gallery_1.html">Corporate Social Responsibility</a> </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====-->
<section id="about_us" class="about-us ">
  <div class="container">
    <div class="property-tab bottom20"> 
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <?
      $CSRNum = $CMS->GetPageInfoNum("msp_csr", "csrid");
      $CSRRes = $CMS->GetPageInfoRes("msp_csr", "csrid");
      
      if ($CSRNum > 0)
      {
        $anju=0;
        while ($CSRData = $CMS->dbfetch($CSRRes))
        {
          $anju++;
          $CSRid = $CSRData["csrid"];
          $CSRTitle = $CSRData["msp_title"];
          $CSRContents = $CSRData["msp_contents"];
          $CSRContents = str_replace("|", "'", $CSRContents);
          if($anju==1){$active="active";}else{ $active=""; }
        ?>
        <li role="presentation" class="<?=$active;?>"><a href="#MSP<?=$CSRid;?>" aria-controls="MSP<?=$CSRid;?>" role="tab" data-toggle="tab" aria-expanded="true"> <?=$CSRTitle;?></a> </li>
      <?
        }
      }
      ?>
        
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
      <?
      $CSRNum = $CMS->GetPageInfoNum("msp_csr", "csrid");
      $CSRRes = $CMS->GetPageInfoRes("msp_csr", "csrid");
      
      if ($CSRNum > 0)
      {
        $manoj=0;
        while ($CSRData = $CMS->dbfetch($CSRRes))
        {
          $manoj++;
          $CSRid = $CSRData["csrid"];
          $CSRContents = $CSRData["msp_contents"];
          $CSRContents = str_replace("|", "'", $CSRContents);

          if($manoj==1){$active="active";}else{ $active=""; }
        ?>
        <div role="tabpanel" class="tab-pane <?=$active;?>" id="MSP<?=$CSRid;?>">
          <?=$CSRContents;?>
        </div>
      <?
        }
      }
      ?>
        
      </div>
    </div>
    <div class="padding_t40" >
      <?
      $CSRGalleryNum = $CMS->GetPageInfoNum("msp_csr_gallery", "csr_galleryid");
      $CSRGalleryRes = $CMS->GetPageInfoRes("msp_csr_gallery", "csr_galleryid");
      
      if ($CSRGalleryNum > 0)
      {
        while ($CSRGalleryData = $CMS->dbfetch($CSRGalleryRes))
        {
          $CSRGalleryTitle = $CSRGalleryData["msp_title"];
          $CSRGalleryImage = $CSRGalleryData["msp_image"];
          $CSRGalleryImage2 = $CSRGalleryData["msp_image2"];
        ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="cbp-item latest rent">
        <div class="image details_pro"> <img src="images/csr_gallery_images/resize/<?=$CSRGalleryImage2;?>" alt="<?=$CSRGalleryTitle;?>">
          <div class="overlay"> <a href="images/csr_gallery_images/<?=$CSRGalleryImage;?>" class="fancybox centered" data-fancybox-group="gallery"> <i class="icon-focus"></i> </a> </div>
        </div>
      </div>
    </div>
    <?
      }
    }
    ?>
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
<!--===== #/REQUIRED JS =====-->
</body>
</html>