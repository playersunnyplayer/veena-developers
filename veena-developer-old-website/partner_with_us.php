<?
include 'includes_config/db.config.class.php';

$TableName = 'msp_partner_with_us';
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
<? include_once($msp_header);?>
<!--===== #/HEADER =====--> 
 
<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section" style="background-image: url(images/News-Media-1.jpg);">
  <div class="container padding text-uppercase text-center">
    <div class="main-title">
      <h1> <?=$title;?></h1>
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
        <div class="col-md-6 col-sm-6 col-xs-12 details-home padding20">
          <?=$contents;?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 details-home padding20">
          <div class="row">
            <div id="alert_message"></div>
                <form class="callus padding-bottom"  id="PartnerForm" name="PartnerForm" method="post" action="#" >
                 <input type="hidden" name="mode" id="mode"  value="sendpartner">
              <div class="form-group">
                <div id="result"> </div>
              </div>
              <div class="col-md-6">
                <div class="single-query">
                  <input type="text" class="keyword-input" placeholder="Name" name="fname" id="name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-query">
                  <div class="intro">
                    <select name="identity" required >
                      <option selected="" value="">Your Identity *</option>
                      <option value="Owner">Owner</option>
<option value="Owner's Representative">Owner's Representative</option>
<option value="Agent">Agent</option></select>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="single-query">
                  <input type="text" class="keyword-input" placeholder="Mobile *" name="mobile" id="mobile" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-query">
                  <input type="email" class="keyword-input" placeholder="E-Mail" name="email" id="email" required >
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-query" style="margin-bottom: 0;">
                  <div class="intro">
                    <select name="property" required style="margin-bottom: 0px;">
                      <option selected="" value="">Property Title *</option>
                      <?
            $ProjectTypeNum = $CMS->GetProjectTypeNum();
            $ProjectTypeRes = $CMS->GetProjectTypeRes();
            
            if ($ProjectTypeNum > 0)
            {
              while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
              {
                $ProjectTypeID = $ProjectTypeData["typeid"];

                $ProjectLocationRes = $Website->GetWebsiteDistinctLocationRes($ProjectTypeID);
                while ($ProjectLocationData = $Website->dbfetch($ProjectLocationRes))
                {
                  $ProjectTypeLocationID = $ProjectLocationData["website_location_id"];
                  
                  $LocationTableData = $CMS->GetPageInfoDetails("msp_location", "locationid", $ProjectTypeLocationID);
                  $LocationTitle = $LocationTableData["msp_title"];

            ?>
              <option value="<?=$ProjectTypeLocationID;?>"><?=$LocationTitle;?></option>
              <?
                }
              }
            }
              ?>
                    </select>
                  </div>
                </div>
              </div>
             
          
              <div class="col-md-6">
                <div class="single-query">
                  <input type="text" class="keyword-input" placeholder="Property Locality *" name="locality" id="locality" required>
                </div>
              </div>
            
            
              <div class="col-md-6">
                <div class="single-query">
                  <select name="transaction" required>
                      <option selected="" value="">Nature of Transaction *</option>
                      <option value="Outright">Outright</option>
<option value="JV">JV</option>
<option value="Redevelopment">Redevelopment</option>
<option value="Others">Others</option>
</select>
                    
                 
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-query">
                  <select name="category_type" required>
                      <option selected="" value="">Category of Development Proposal*</option>
                      <?php
                      $ProjectTypeNum = $CMS->GetProjectTypeNum();
                      $ProjectTypeRes = $CMS->GetProjectTypeRes();
                      
                      if ($ProjectTypeNum > 0)
                      {
                        while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
                        {
                          $ProjectTypeID = $ProjectTypeData["typeid"];
                          $ProjectTypeTitle = $ProjectTypeData["msp_title"];
                        ?>
                      <option value="<?=$ProjectTypeTitle;?>"><?=$ProjectTypeTitle;?></option>
                      <?
                        }
                      }
                      ?>
</select>
                 
                </div>
              </div>
              
             <!-- <div class="col-md-6">
               <div id="rock">
								 <div id="reca" class="g-recaptcha" data-sitekey="6Lesf5kUAAAAAF9ryJxElyUB0DU7iA7oGu0MoLoZ"></div>
								<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
						</div>


              </div>  -->     
                  
              <div class="col-md-6">
                <button type="submit" class="btn_fill" id="btn_submit" name="btn_submit">SEND</button>
              </div>
            </form>
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