<?
include 'includes_config/db.config.class.php';

$title = "Residential and Commercial Projects in Mumbai | Veena Developer";
$page_title = "Residential and Commercial Projects in Mumbai | Veena Developer";
$page_keyword = "Projects";
$page_description = "A well-reputed real estate company with a portfolio spanning successful residential & commercial projects in Mumbai by Veena Developers assuring best residential flats and business space in the city. ";

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
<link rel="stylesheet" type="text/css" href="css/location.css">
<link rel="stylesheet" type="text/css" href="css/color/color-1.css" id="color" />
<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
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
<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section" style="background-image: url(images/about-us-1.jpg);">
  <div class="container padding text-uppercase text-center">
    <div class="col-md-12">
      <div class="main-title">
      <h1>OUR PROJECTS</h1>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="<?=$siteurl;?>">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="#">OUR PROJECTS</a> </div>
    </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====--> 
<!--===== #/TEAM  =====--> 
<!--===== #/WHAT WE DO =====-->
<section id="about_us" class="about-us padding20">
  <div class="container"> 
    <script>
jQuery(document).ready(function($) {
	$(".project_category li a").bind("hover",function(){
	var project_location_box_id = $(this).attr('rel');
	$(".project_location_box").hide();	
	$(".map_box_names").hide();	
	jQuery("."+ project_location_box_id).show();	
	});		
	$(".project_location_list li a").bind("hover",function(){
	var map_box_names_id = $(this).attr('rel');
	$(".map_box_names").hide();
	jQuery("."+ map_box_names_id).show();
	});		
	});	
</script>
    <div class="col-md-12"><div class="projects_content_left fl "> 
      <!--project header starts!-->
      <div class="project_header">
        <div class="fl page_heading" >
          <h1 class="black font36  uppcase font_light" style="display: inline-block;">OUR PROJECTS</h1>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <br>

      <!--project header ends!-->

      
      <!--project type starts!-->

      <!--project type ends!--> 
    </div></div>
    <div class="col-md-6 col-sm-12 col-xs-12">      


 <div class="on-projs on-selected" id="ongoing_status">Ongoing &nbsp; &nbsp;</div>
      <div class="co-projs co-selected" id="completed_status"> Completed &nbsp; &nbsp;</div>
 <div class="up-projs up-selected" id="upcoming_status">Upcoming  &nbsp; &nbsp;</div>
      
      <br><br>
      <div class="project_type"> 
        <!--project category listing starts!-->
    <ul class="project_category">
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
          <li class="on-projs"><a href="JavaScript:void(0);" class="project_category_anchor" rel="msp_projects<?=$ProjectTypeID;?>"><?=$ProjectTypeTitle;?></a></li>
          <?
            }
          }
          ?>
          <li class="co-projs"><a href="completed-projects" class="project_category_anchor" >Completed Projects</a></li>
          <li class="up-projs"><a href="upcoming-projects" class="project_category_anchor" >Upcoming Projects</a></li>
          
      
        </ul>
        <!--project category listing ends!--> 
        
        <!--project location listing starts!-->
        <div class="project_location" style="float:left">
          <ul class="project_location_list">
            <div class="clr"></div>
           <?
          $ProjectTypeNum = $CMS->GetProjectTypeNum();
          $ProjectTypeRes = $CMS->GetProjectTypeRes();
          
          if ($ProjectTypeNum > 0)
          {
            while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
            {
              $ProjectTypeID = $ProjectTypeData["typeid"];
              $ProjectTypeTitle = $ProjectTypeData["msp_title"];

                
              $ProjectLocationRes = $Website->GetWebsiteDistinctLocationRes($ProjectTypeID);
              while ($ProjectLocationData = $Website->dbfetch($ProjectLocationRes))
              {
                $ProjectTypeLocationID = $ProjectLocationData["website_location_id"];
                
                $LocationTableData = $CMS->GetPageInfoDetails("msp_location", "locationid", $ProjectTypeLocationID);
                $LocationTitle = $LocationTableData["msp_title"];
                $LocationFilterTitle = _prepare_url_text($LocationTitle);
                $LocationFilterTitle = strtolower($LocationFilterTitle);

            ?>
            <li class="msp_projects<?=$ProjectTypeID;?> project_location_box" style="display: none;"> <a href="JavaScript:void(0);" class="project_location_anchor" rel="location_<?=$LocationFilterTitle;?>_msp_projects<?=$ProjectTypeID;?>"><?=$LocationTitle;?></a> </li>
            <?
                }
          }
        }
            ?>
            
          </ul>
        </div>
        <!--project location listing ends!--> 
        
        <!--project name listing ends!-->
        <div class="project_name_list" style="float:left">
          <ul class="project_list ">
            <?php
          $ProjectTypeNum = $CMS->GetProjectTypeNum();
          $ProjectTypeRes = $CMS->GetProjectTypeRes();
          
          if ($ProjectTypeNum > 0)
          {
            while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
            {
              $ProjectTypeID = $ProjectTypeData["typeid"];
              $ProjectTypeTitle = $ProjectTypeData["msp_title"];

                
              $ProjectRes = $Website->GetWebsiteByTypeRes($ProjectTypeID);
              while ($ProjectData = $Website->dbfetch($ProjectRes))
              {
                $ProjectID = $ProjectData["websiteid"];
                $ProjectStatusID = $ProjectData["website_status_id"];
                $ProjectTypeLocationID = $ProjectData["website_location_id"];
                $ProjectName = $ProjectData["website_sitename"];
                $LocationTableData = $CMS->GetPageInfoDetails("msp_location", "locationid", $ProjectTypeLocationID);
                $LocationTitle = $LocationTableData["msp_title"];
                $LocationFilterTitle = _prepare_url_text($LocationTitle);
                $LocationFilterTitle = strtolower($LocationFilterTitle);

                if($ProjectStatusID=='1'){ 
                  $status_styl= "ongoing_project_list"; 
                  $CatTitSpaceRemove = _prepare_url_text($ProjectData["website_url_title"]);
                  $urlhtaccess = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
                }
                elseif($ProjectStatusID=='2'){ 
                  $status_styl= "upcoming_project_list"; 
                  $urlhtaccess="upcoming-projects";
                }
                elseif($ProjectStatusID=='3'){ 
                  $status_styl= "completed_project_list"; 
                  $urlhtaccess="completed-projects";
                }
                else{ $status_styl= "completed_project_list";
                  $urlhtaccess="completed-projects";
                 }

                
                
            ?>
            <li class="location_<?=$LocationFilterTitle;?>_msp_projects<?=$ProjectTypeID;?> map_box_names <?=$status_styl;?>" style="display:none;"> <a href="<?=$urlhtaccess;?>"  class="location project_list_anchor" rel="" ><?=$ProjectName;?></a> </li>
          <?    }
              }
            }
          ?>
            
            <div class="clr"></div>
          </ul>
        </div>
        <!--project name listing ends!-->
        
        <div class="clr"></div>
      </div></div>
 <div class="col-md-6 col-sm-12 col-xs-12">   <div class="projects_content_right fr" style="position:relative;">
      <div class="location_goregaon goregaon_map" style="display:block"> 
        <!--resiential map_proj starts!-->
        <?php
          $ProjectTypeNum = $CMS->GetProjectTypeNum();
          $ProjectTypeRes = $CMS->GetProjectTypeRes();
          
          if ($ProjectTypeNum > 0)
          {
            while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
            {
              $ProjectTypeID = $ProjectTypeData["typeid"];
              $ProjectTypeTitle = $ProjectTypeData["msp_title"];

                
                $ProjectRes = $Website->GetWebsiteByTypeRes($ProjectTypeID);
                while ($ProjectData = $Website->dbfetch($ProjectRes))
              {
                $ProjectID = $ProjectData["websiteid"];
                $ProjectStatusID = $ProjectData["website_status_id"];
                $ProjectTypeLocationID = $ProjectData["website_location_id"];
                $ProjectName = $ProjectData["website_sitename"];
                $ProjectMapTop = $ProjectData["website_map_top"];
                $ProjectMapLeft = $ProjectData["website_map_left"];
                $LocationTableData = $CMS->GetPageInfoDetails("msp_location", "locationid", $ProjectTypeLocationID);
                $LocationTitle = $LocationTableData["msp_title"];
                $LocationFilterTitle = _prepare_url_text($LocationTitle);
                $LocationFilterTitle = strtolower($LocationFilterTitle);

                if($ProjectStatusID=='1'){ 
                  $status_styl= "ongoing_project_list"; 
                  $CatTitSpaceRemove = _prepare_url_text($ProjectData["website_url_title"]);
                  $urlhtaccess = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
                }
                elseif($ProjectStatusID=='2'){ 
                  $status_styl= "upcoming_project_list"; 
                  $urlhtaccess="upcoming-projects";
                }
                elseif($ProjectStatusID=='3'){ 
                  $status_styl= "completed_project_list"; 
                  $urlhtaccess="completed-projects";
                }
                else{ $status_styl= "completed_project_list";
                  $urlhtaccess="completed-projects";
                }
                
            ?>
        <div style="position:absolute;display:none;width:25px;top:<?=$ProjectMapTop;?>px;left:<?=$ProjectMapLeft;?>px;" class="location_<?=$LocationFilterTitle;?>_msp_projects<?=$ProjectTypeID;?> map_box_names"> <a href="<?=$urlhtaccess;?>"  style="position:relative;display:block; cursor:pointer"> <img src="images/map_icon.png" align="absmiddle" alt=""> <span style="width:150px; left:27px; position:absolute; top:1px;font-size:12px;font-weight: 600;"> <?=$ProjectName;?> </span> </a> <br>
        </div>
        <?
        	}
        }
    }
        ?>
        
      </div>
      <div class="clr"></div>
    </div></div>
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