<?php include_once('externalcode.php');?><?
include 'includes_config/db.config.class.php';

$title = "Projects";
$page_title = "Projects";
$page_keyword = "Projects";
$page_description = "Projects";
if(isset($_POST['mode']))
{
  if($_POST['mode'] == 'searchf')
  {
      $keywrd = prepare_input($_POST["keywrd"]);
     $location_id = prepare_input($_POST["location_id"]);
     $type_id = prepare_input($_POST["type_id"]);
     $typology_id = prepare_input($_POST["typology_id"]);

    if(!empty($keywrd))
    {
        $data1 = "website_sitename = '$keywrd' AND";
    }else{
        $data1 = "";
    }
    if(!empty($location_id))
    {
        $data2 = "website_location_id = '$location_id' AND";
    }else{
        $data2 = "";
    }
    if(!empty($type_id))
    {
        $data3 = "website_type_id = '$type_id' AND";
    }else{
        $data3 = "";
    }
    if(!empty($typology_id))
    {
        $data4 = "website_typology_id = '$typology_id'";
    }else{
        $data4 = "";
    }


    $main_string = "WHERE $data1 $data2 $data3 $data4"; //All details

    $stringAnd = "AND"; //And

    $main_string = trim($main_string); //Remove whitespaces from the beginning and end of the main string

    $endAnd = substr($main_string, -3); //Gets the AND at the end

    if($stringAnd == $endAnd)
    {
    $main_string = substr($main_string, 0, -3);
    }else if($main_string == "WHERE"){
        $main_string = "";
    }
    else{
        $main_string = "WHERE $data1 $data2 $data3 $data4";
    }

    if($main_string == ""){ //Doesn't show all the products

    }else{
        
        $WebsiteSearchNum = $Website->GetWebsiteSearchNum($main_string);
        $WebsiteSearchRes = $Website->GetWebsiteSearchRes($main_string);
    }
  }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Veena Developers</title>
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
<? include_once($msp_header);?>

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
      <div class="col-md-2 col-sm-2">
        <div class="single-query form-group">
          <div class="intro">
            <select name="type_id">
              <option value="" selected>Select Type</option>
              <?
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
              <?
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
              <?
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
              <?
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
<!--LISTING STYLE- 2 -->




<!-- LISTING -->
<section id="listings" class="padding">
  <div class="container">

    <div class="row bottom30">
      <?
       if ($WebsiteSearchNum > 0)
                  {
                    while ($WebsiteData = $Website->dbfetch($WebsiteSearchRes))
                    {
                      $WebsiteID = $WebsiteData["websiteid"];
                      $Web_status_id = $WebsiteData["website_status_id"];
                      $Web_sitename = $WebsiteData["website_sitename"];
                      $Web_siteurl = $WebsiteData["website_siteurl"];
                      $Web_mobile = $WebsiteData["website_mobile"];
                      $Web_phone = $WebsiteData["website_phone"];
                      $Web_email = $WebsiteData["website_email"];
                      $Web_address = $WebsiteData["website_address"];
                      $Web_short_address = $WebsiteData["website_short_address"];
                      $Web_sitecolor = $WebsiteData["website_sitecolor"];
                      $Web_sitelogo = $WebsiteData["website_sitelogo"];
                      $Web_image = $WebsiteData["website_image"];
                      $Web_type_id = $WebsiteData["website_type_id"];
                      $Web_typology_id = $WebsiteData["website_typology_id"];
                      $Web_city_id = $WebsiteData["website_city_id"];
                      $Web_location_id = $WebsiteData["website_location_id"];

                      $Web_sitepdf = $WebsiteData["website_sitepdf"];
                      $Web_register_no = $WebsiteData["website_siteregister_no"];

                      $Web_map_top = $WebsiteData["website_map_top"];
                      $Web_map_left = $WebsiteData["website_map_left"];

                      $Web_status = $WebsiteData["website_status"];

                      $ProjectTypeData = $CMS->GetPageInfoDetails("msp_project_type", "typeid", $Web_type_id);
                      $ProjectTypeTitle = $ProjectTypeData['msp_title'];
                      $ProjectTypologyData = $CMS->GetPageInfoDetails("msp_project_typology", "typologyid", $Web_typology_id);
                      $ProjectTypologyTitle = $ProjectTypologyData['msp_title'];
                      $LocationData = $CMS->GetPageInfoDetails("msp_location", "locationid", $WebsiteLocationID);
                      $LocationTitle = $LocationData['msp_title'];

                      $CatTitSpaceRemove = _prepare_url_text($WebsiteData["website_url_title"]);
                        $urlhtaccess = strtolower($siteurl.'/project/'. $CatTitSpaceRemove);
                      ?>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="property_item heading_space">
                          <div class="image">
                            <img src="<?=$siteurl;?>/images/sitelogo_images/project/<?=$Web_image;?>" alt="<?=$Web_sitename;?>" class="img-responsive">
                          <div class="feature"><span class="tag"><img src="<?=$siteurl;?>/images/sitelogo_images/<?=$Web_sitelogo;?>" alt=""> </span></div>
                         
                          <div class="overlay">
                            <div class="centered"><a class="link_arrow white_border" href="<?=$urlhtaccess;?>">View Detail</a></div>
                          </div>
                       <!--    <div class="property_meta">
                            
                            <span><i class="fa fa-bed"></i><?=$ProjectTypologyTitle;?></span>
                         
                          </div> -->
                          </div>
                          <div class="proerty_content">
                          <div class="proerty_text">
                            <h3><a href="<?=$urlhtaccess;?>"><?=$Web_sitename;?></a></h3>
                            <span class="bottom10"><?=$Web_short_address;?></span>
                            <p><strong><i class="fa fa-home"></i> <?=$ProjectTypeTitle;?></strong></p>
                          </div>
                  
                        </div>
                        </div>
                      </div>
                      <?
                    }
                  }else{
                    ?> <h3>Record not Found !!!</h3><?
                  }
                ?>
 

    </div>
    <!-- <div class="row top40">
      <div class="col-md-12">
        <ul class="pager">
          <li><a href="#.">1</a></li>
          <li class="active"><a href="#.">2</a></li>
          <li><a href="#.">3</a></li>
        </ul>
      </div>
    </div> -->
  </div>
</section>
<!--LISTING FILTER -->


<!--CONTACT-->




<!--===== FOOTER =====-->
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
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U"></script>
<script src="js/custom-map.js"></script> 
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
<script src="js/themepunch/jquery.themepunch.tools.min.js"></script>
<script src="js/themepunch/jquery.themepunch.revolution.min.js"></script>   
<script src="js/themepunch/revolution.extension.layeranimation.min.js"></script> 
<script src="js/themepunch/revolution.extension.navigation.min.js"></script> 
<script src="js/themepunch/revolution.extension.parallax.min.js"></script> 
<script src="js/themepunch/revolution.extension.slideanims.min.js"></script> 
<script src="js/themepunch/revolution.extension.video.min.js"></script>
<!-- <script src="js/functions.js"></script> -->
<!--===== #/REQUIRED JS =====--> 
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

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
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

</body>

</html>
