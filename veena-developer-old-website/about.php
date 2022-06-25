<?php
include 'includes_config/db.config.class.php';

$TableName = 'msp_about_us';
$PageInfo = $CMS->GetPageInfo($TableName);
$title = $PageInfo["title"];
$title2 = $PageInfo["title2"];
$title3 = $PageInfo["title3"];
$title4 = $PageInfo["title4"];
if($title4=="Chairmans message"){ $title4="Chairman's message";}
$contents = $PageInfo["contents"];
$contents = str_replace("|", "'", $contents);
$contents2 = $PageInfo["contents2"];
$contents2 = str_replace("|", "'", $contents2);
$contents3 = $PageInfo["contents3"];
$contents3 = str_replace("|", "'", $contents3);
$contents4 = $PageInfo["contents4"];
$contents4 = str_replace("|", "'", $contents4);
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
<title><?=$page_title;?></title>
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
    <div class="loader">
      <div class="cssload-thecube">
      <img  class="loaderimg2" src="<?=$siteurl;?>/images/loaderimg2.png" alt="logo"/></a> 
      <img class="loaderimg1" src="<?=$siteurl;?>/images/loaderimg1.png" alt="logo"/></a> 
   
   
      </div>
    </div> 
<?php include_once($msp_header);?>
<!--===== #/HEADER =====--> 
   
<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section" style="background-image: url(images/about-us.jpg);">
  <div class="container padding text-uppercase text-center">
    <div class="main-title">
      <h1><?=$title;?></h1>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#"><?=$title;?></a> </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====--> 
<!--===== ABOUT US =====-->
<section id="about_us" class="about-us ">
  <div class="container">
  <div class="property-tab bottom20"> 
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <?php if(!empty($title)){ ?>
      <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab" aria-expanded="true">About Us</a></li>
      <?php } if(!empty($title2)){ ?>
      <li role="presentation" class=""><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab" aria-expanded="false"><?=$title2;?></a></li>
      <?php } if(!empty($title3)){ ?>
      <li role="presentation" class=""><a href="#features" aria-controls="features" role="tab" data-toggle="tab" aria-expanded="false"><?=$title3;?></a></li>
      <?php } if(!empty($title4)){ ?>
      <li role="presentation" class=""><a href="#tab_contact" aria-controls="tab_contact" role="tab" data-toggle="tab" aria-expanded="false"><?=$title4;?></a></li>
      <?php } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="description">
        <span class="p-font-15"><?=$contents;?></span>
      </div>
      <div role="tabpanel" class="tab-pane" id="summary">
        <span class="p-font-15"><?=$contents2;?></span>
      </div>
      <div role="tabpanel" class="tab-pane" id="features">
        <span class="p-font-15"><?=$contents3;?></span>
      </div>
      <div role="tabpanel" class="tab-pane" id="tab_contact">
        <span class="p-font-15"><?=$contents4;?></span>
      </div>
    </div>
  </div>
</section>
<!--===== #/ABOUT US =====--> 
<!--===== #/WHO WE ARE =====--> 
<!--===== TEAM  =====-->
<section id="agent-2" class="">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center top20 bottom20">
        <h2 class="text-uppercase">Management <span class="color_red">Team</span></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
    <?php
    $TeamNum = $Team->GetTeamNum();
    $TeamRes = $Team->GetTeamRes();

    if ($TeamNum > 0)
    {
      while ($TeamData = $Team->dbfetch($TeamRes))
      {
        $TeamID = $TeamData["teamid"];
        $TeamTitle = $TeamData["msp_title"];
        $TeamPosition = $TeamData["msp_position"];
        $TeamContents = $TeamData["msp_contents"];
        $TeamContents = str_replace("|", "'", $TeamContents);
        $TeamImages = $TeamData["msp_image"];
      ?>
      <div class="col-md-4 col-sm-4 col-xs-12 top20 bottom20">
        <div class="item">
          <div class="image"> <img src="images/team_images/<?=$TeamImages;?>" class="img-responsive">
            <div class="img-info">
              <h3><?=$TeamTitle;?></h3>
              <p class="padding_t40 bottom30"><?=$TeamContents;?></p>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      }
      ?>
      
      <div class="col-md-2"></div>
    </div>
  </div>
</section>
<!--===== #/TEAM  =====--> 
<!--===== #/WHAT WE DO =====-->
<?php
$TableName = 'msp_journey_of_years';
if($TableName == 'msp_journey_of_years'){
$PageInfo = $CMS->GetPageInfo($TableName);
$journey_of_years_title = $PageInfo["title"];
$journey_of_years_title2 = $PageInfo["title2"];
$journey_of_years_title3 = $PageInfo["title3"];
$journey_of_years_title4 = $PageInfo["title4"];
$journey_of_years_title5 = $PageInfo["title5"];
$journey_of_years_value2 = $PageInfo["value2"];
$journey_of_years_value3 = $PageInfo["value3"];
$journey_of_years_value4 = $PageInfo["value4"];
$journey_of_years_value5 = $PageInfo["value5"];
$journey_of_years_contents = $PageInfo["contents"];
$journey_of_years_contents = str_replace("|", "'", $journey_of_years_contents);
?>
<section id="about_us" class="about-us padding20">
  <div class="container">
    <div class="row">
      <div class="history-section">
        <div class="col-md-12 col-sm-12 col-xs-12 details-home padding20">
          <h3 class="text-uppercase"><?=$journey_of_years_title;?></h3>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
          <p class="top20"><?=$journey_of_years_contents;?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/OUR PARTNER =====--> 
<!--===== CONTACT =====-->
<!--<section id="contact" class="bg-color-red">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="get-tuch">
          <ul>
            <li>
              <h2 class="bottom40" style="color: #fff;"><?=$journey_of_years_value2;?></h2>
            </li>
            <li>
              <h4><?=$journey_of_years_title2;?></h4>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="get-tuch">
          <ul>
            <li>
              <h2  class="bottom40" style="color: #fff;"><?=$journey_of_years_value3;?></h2>
            </li>
            <li>
              <h4><?=$journey_of_years_title3;?></h4>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="get-tuch">
          <ul>
            <li>
              <h2   class="bottom40" style="color: #fff;"><?=$journey_of_years_value4;?></h2>
            </li>
            <li>
              <h4><?=$journey_of_years_title4;?></h4>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="get-tuch">
          <ul>
            <li>
              <h2 class="bottom40" style="color: #fff;"><?=$journey_of_years_value5;?></h2>
            </li>
            <li>
              <h4><?=$journey_of_years_title5;?></h4>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>-->
<?php
  }
?>
<!--===== #/CONTACT =====--> 
<!-- FOOTER -->
<?php include_once($msp_footer);?>

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
  $("#about_us a").on('click', function(e) {
    e.preventDefault();
  });
});
</script>
<script>
    $('.bottom40').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
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
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
</body>
</html>