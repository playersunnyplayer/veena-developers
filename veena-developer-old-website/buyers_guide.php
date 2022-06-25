<?
include 'includes_config/db.config.class.php';

$TableName = 'msp_buyers_guide_contents';
$PageInfo = $CMS->GetPageInfo($TableName);
$title = $PageInfo["title"];
$contents = $PageInfo["contents"];
$contents = str_replace("|", "'", $contents);
$page_title = $PageInfo["page_title"];
$page_keyword = $PageInfo["page_keyword"];
$page_description = $PageInfo["page_description"];
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
<div class="page-title page-main-section" style="background-image: url(images/Buyers-Guide-1.jpg);">
  <div class="container padding text-uppercase text-center">
    <div class="main-title">
      <h1><?=$title;?> </h1>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#"> <?=$title;?></a> </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====--> 
<!--===== #/TEAM  =====--> 
<!--===== #/WHAT WE DO =====-->
<section id="about_us" class="about-us padding20">
  <div class="container">
    <div class="row">
      <div class="history-section">
        <div class="col-md-12 col-sm-12 col-xs-12 details-home padding20">
          <h3 class="text-uppercase"><?=$title;?> </h3>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
          <?=$contents;?>
          <br>
          <br>
          <div class="bs-example">
            <div class="panel-group" id="accordion">
              <?
              $BuyersGuideNum = $CMS->GetPageInfoNum("msp_buyers_guide", "buyers_guideid");
              $BuyersGuideRes = $CMS->GetPageInfoRes("msp_buyers_guide", "buyers_guideid");
              
              if ($BuyersGuideNum > 0)
              {
                $anju=0;
                while ($BuyersGuideData = $CMS->dbfetch($BuyersGuideRes))
                {
                  $anju++;
                  $BuyersGuideid = $BuyersGuideData["buyers_guideid"];
                  $BuyersGuideTitle = $BuyersGuideData["msp_title"];
                  $BuyersGuideContents = $BuyersGuideData["msp_contents"];
                  $BuyersGuideContents = str_replace("|", "'", $BuyersGuideContents);
                  if($anju==1){$active="in";}else{ $active=""; }
                ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#MSP<?=$BuyersGuideid;?>"><?=$BuyersGuideTitle;?></a> </h4>
                </div>
                <div id="MSP<?=$BuyersGuideid;?>" class="panel-collapse collapse <?=$active;?>">
                  <div class="panel-body">
                    <?=$BuyersGuideContents;?>
                  </div>
                </div>
              </div>
              <?
                }
              }
              ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/CONTACT =====--> 
<!-- FOOTER -->
<? include_once($msp_footer);?>
<!--===== #/FOOTER =====--> 
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
</body>
</html>