<?php

include 'includes_config/db.config.class.php';

$TableName = 'msp_home';
$PageInfo = $CMS->GetPageInfo($TableName);
$title = $PageInfo["title"];
$contents = $PageInfo["contents"];
$contents = str_replace("|", "'", $contents);
$contents2 = $PageInfo["contents2"];
$contents2 = str_replace("|", "'", $contents2);
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
<title><? echo $page_title;?> </title>
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
   <?php include_once($msp_header);?>
<!-- HEADER  -->
<div class="search_2 search_2_set">
  <form class="findus clearfix" method="post" action="project-search" autocomplete="off">
    <input type="hidden" name="mode" value="searchf">
    <div class="row">

      <div class="col-md-4 col-sm-4">
        <div class="single-query">
          <input type="text" class="keyword-input" name="keywrd" id="keytitle"  placeholder="Find Project">
          <div id="SearchFilTitleList"></div> 
        </div>
      </div>
      <div class="col-md-2 col-sm-2">
        <div class="single-query form-group">
          <div class="intro">
            <select name="location_id">
              <option value="" selected>Select Location</option>
              
               <?php
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
              <?php
                }
              }
            }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-2">
        <div class="single-query form-group">
          <div class="intro">
            <select name="type_id">
              <option value="" selected>Select Type</option>
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
              <option value="<?=$ProjectTypeID;?>"><?=$ProjectTypeTitle;?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-2">
        <div class="single-query form-group">
          <div class="intro">
            <select name="typology_id">
              <option value="" selected>Select Typology</option>
              <?php
              $TypologyNum = $CMS->GetProjectTypologyNum();
              $TypologyRes = $CMS->GetProjectTypologyRes();
              
              if ($TypologyNum > 0)
              {
                while ($TypologyData = $CMS->dbfetch($TypologyRes))
                {
                  $TypologyID = $TypologyData["typologyid"];
                  $TypologyTitle = $TypologyData["msp_title"];
                ?>
              <option value="<?=$TypologyID;?>"><?=$TypologyTitle;?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="query-submit-button form-group">
          <button type="submit" class="btn_fill">Search</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php include_once($msp_slider);?>
<!--SLIDER --> 
<!-- SERVICES -->
<section id="about_us" class="about-us padding20">
  <div class="container">
    <div class="row">
      <div class="history-section">
       
      <?php
        $WebsiteCenterRes = $Website->GetWebsiteHomeCenterRes();
        
        while ($WebsiteCenterData = $Website->dbfetch($WebsiteCenterRes))
          {
            
            $WebsiteCenterName = $WebsiteCenterData["website_sitename"];
            $WebsiteImage = $WebsiteCenterData["website_image"];
            $Websiteshort_Address = $WebsiteCenterData["website_short_address"];
            $CatTitSpaceRemove = _prepare_url_text($WebsiteCenterData["website_url_title"]);
            $urlhtaccessCenter = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
          ?>
          <div class="col-md-3 col-sm-3"> <a href="<?=$urlhtaccessCenter;?>"  >
          <div class="property_item">
            <div class="image"> <img src="images/sitelogo_images/project/<?=$WebsiteImage;?>" alt="<?=$WebsiteCenterName;?>" class="img-responsive">
              <div class="overlay">
                <div class="centered">
                  <h4><?=$WebsiteCenterName;?></h4>
                  <h5><?=$Websiteshort_Address;?></h5>
                </div>
              </div>
            </div>
          </div>
          </a> 
        </div>
              
          <?php
            
            }
          ?>

        <div class="col-md-6 col-sm-6 col-xs-12  details-home padding20">
          <h2 class="text-uppercase">ABOUT <span class="color_red">US</span></h2>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
          <?=$contents;?>
          
          <a href="about-us" class="link_arrow top20">Read More</a> </div>
      </div>
    </div>
  </div>
</section>
<!-- SERVICES -->
<section id="about_us" class="about-us padding20">
  <div class="container">
    <div class="row">
      <div class="history-section">
        <div class="col-md-3 col-sm-6 col-xs-12 padding20">
          <h3 class="text-uppercase">CHAIRMAN’S <span class="color_red">MESSAGE</span></h3>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
          <p class="top20">At the outset I’d like to thank my team, vendors, contractors, suppliers, associates, investors and channel partners, who’ve immensely contributed to the success and growth story of the group.</p>
          <a href="about-us" class="link_arrow top20">Read More</a> </div>

           <?php
        $WebsiteBottomRes = $Website->GetWebsiteHomeBottomRes();
        
        while ($WebsiteBottomData = $Website->dbfetch($WebsiteBottomRes))
          {
            
            $WebsiteBottomName = $WebsiteBottomData["website_sitename"];
            $WebsiteImage = $WebsiteBottomData["website_image"];
            $Websiteshort_Address = $WebsiteBottomData["website_short_address"];
            $CatTitSpaceRemove = _prepare_url_text($WebsiteBottomData["website_url_title"]);
            $urlhtaccessBotton = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
          ?>
          <div class="col-md-3 col-sm-3"> <a href="<?=$urlhtaccessBotton;?>"  >
          <div class="property_item">
            <div class="image"> <img src="images/sitelogo_images/project/<?=$WebsiteImage;?>" alt="<?=$WebsiteBottomName;?>" class="img-responsive">
              <div class="overlay">
                <div class="centered">
                  <h4><?=$WebsiteBottomName;?></h4>
                  <h5><?=$Websiteshort_Address;?></h5>
                </div>
              </div>
            </div>
          </div>
          </a> 
        </div>
              
          <?php
            
            }
          ?>
        
      </div>
    </div>
  </div>
</section>
<!-- PROPERTY SEARCH -->
<section id="our-partner" class="padding20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-uppercase">All <span class="color_red">Projects</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="partner_slider_2" class="owl-carousel">
          <?php
        $WebsiteNum = $Website->GetWebsiteNum();
        $WebsiteRes = $Website->GetWebsiteRes();
        
        if ($WebsiteNum > 0)
        {
          while ($WebsiteData = $Website->dbfetch($WebsiteRes))
          {
            $WebsiteID = $WebsiteData["websiteid"];
            $WebsiteName = $WebsiteData["website_sitename"];
            $WebsiteTypeID = $WebsiteData["website_type_id"];
            $WebsiteURL = $WebsiteData["website_url_title"];
            $Websiteshort_Address = $WebsiteData["website_short_address"];
            $WebsiteLogo = $WebsiteData["website_sitelogo"];
            $CatTitSpaceRemove = _prepare_url_text($WebsiteData["website_url_title"]);
            $urlhtaccess = strtolower($siteurl.'/project/'. $WebsiteURL);

            $ProjectTypeTableData = $CMS->GetPageInfoDetails("msp_project_type", "typeid", $WebsiteTypeID);
            $ProjectTypeTitle = $ProjectTypeTableData["msp_title"];

          ?>
          <div class="item"><a href="<?=$urlhtaccess;?>"><img src="images/sitelogo_images/<?=$WebsiteLogo;?>" alt="<?=$WebsiteName;?>"> </a>
            <br><br><h5><?=$Websiteshort_Address;?></h5> <h6>(<?=$ProjectTypeTitle;?>)</h6></div>
          <?php
            }
          }
          ?>
          
        </div>
      </div>
    </div>
	
  </div>
</section>
<!-- PARTNER --> 
<!-- CONTACT --> 
<!-- FOOTER -->
 <?php include_once($msp_footer);?>
<!-- FOOTER -->
<div class="modal fade" id="onload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
    <div class="modal-dialog modal-lg"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Disclaimer</h4>
      </div>
      <div class="modal-body"> <?=$contents2;?> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
</div>

<!--  #/TEAM POPUP  --> 
<script src="js/jquery.2.2.3.min.js"></script> 
<script type="text/javascript">
 $(document).ready(function(){  
      $('#keytitle').keyup(function(){  
         var query = $(this).val(); 
         if(query != '')  
         {  
            $.ajax({  
                 url:"search_project_title.php",  
                 method:"POST",  
                 data:{query:query},  
                 success:function(data)  
                 {  
                    $('#SearchFilTitleList').fadeIn();  
                    $('#SearchFilTitleList').html(data);  
                 }  
            });  
         }  
      });  
      $(document).on('click', '.srchli', function(){  
           $('#keytitle').val($(this).text());  
           $('#SearchFilTitleList').fadeOut();  
      });  
 });  
</script> 
<script src="js/bootstrap.min.js"></script> 


<script src="<?=$siteurl;?>/js/form_validator.js"></script> 
<script src="<?=$siteurl;?>/js/sideform.js"></script>
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
<script>    $(window).load(function(){
                $('#onload').modal('show');
            });</script>
</body>
</html>