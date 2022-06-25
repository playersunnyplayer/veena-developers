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
	<title>
		<? echo $page_title;?>
	</title>
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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

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
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'UA-133692233-1');
	</script>
	<?php include_once('externalcode.php');?>
</head>

<body>
	<script src="https://www.kenyt.ai/botapp/ChatbotUI/dist/js/bot-loader.js" type="text/javascript"
		data-bot="Veena_Developers"></script>
	<!--LOADER -->
	<?php include_once($msp_header);?>
	<!-- HEADER  -->

	<!--homepageCarousel start-->
	<div class="owl-carousel homepageCarousel" id="homepageCarousel">
     <?php
                      $qry = mysql_query("SELECT * FROM `msp_slider` where msp_status='Active' order by sliderid desc ");
                      $SliderNum = mysql_num_rows($qry);
                      
                      if ($SliderNum > 0)
                      {
                        while ($SliderData = mysql_fetch_array($qry))
                        {
                          $SliderID = $SliderData["sliderid"];
                          $SliderTitle = $SliderData["msp_title"];
                          $SliderImages = $SliderData["msp_image"];
                          $SliderUrl = $SliderData["msp_url"];
                          $SliderStatus = $SliderData["msp_status"];
                        ?>
                        
		<div class="item">
		    <a href="<?=$SliderUrl;?>" target="_blank">
		<!--	<img src="images/home-desktop-banner.png" /> -->
<img src="images/slider_images/<?=$SliderImages;?>"  alt="<?=$SliderTitle?>">
</a>
		</div>
		
		<?php  } }
	    ?>
	</div>
	<!--homepageCarousel end-->

	<!--residentialProjectSec start-->
	<section class="residentialProjectSec projectSec">
		<div class="container">
			<div class="newHeading">Residential Projects</div>
 			<?php 
//               $qry=mysql_query("SELECT heading_text FROM `msp_project_heading`  WHERE `project_type`='1' and heading_type='1' and heading_status='Active' order by heading_id desc limit 1;");
//               $ProjectNum = mysql_num_rows($qry);
//               if($ProjectNum > 0)
//               {
//                   $res=mysql_fetch_row($qry);
//                   $htext=$res[0];
//               }else{$htext='Text Not Fount';}?>
 			<!-- <p><?=$htext;?>.</p>-->
			<div class="owl-carousel" id="residentialProjectCarousel">
			  
 <?php
              $qry=mysql_query("SELECT * FROM `msp_website`  WHERE `website_type_id`='1' and website_status='Active' and `website_show_project`='Yes' order by websiteid desc;");
              $ProjectNum = mysql_num_rows($qry);
             // $ProjectRes = $Project->GetProjectCompletedRes();
              if($ProjectNum > 0)
              {
                ?>
                <!--<div class="col-md-3 projectListing_Thumb">
                    <a href="http://www.veenasamrajya.com" target="_blank">
                        <div class="image">
                             <img src="images/sitelogo_images/project/veena-samrajya-project-1583733868.jpg " width="100%">                           </div>
                        
                        <div class="project_cap top10 text-center">
                            <h4>Veena Samrajya</h4>
                            <h6>Palghar</h6>
                        </div>
                    </a>
                </div>
                -->
                <div class="item">
					<div class="projectThumb">
						<figure>
						      <a href="http://www.veenasamrajya.com" target="_blank">
						          <img src="images/sitelogo_images/project/veena-samrajya-project-1583733868.jpg"  alt=""> 
							      <figcaption>
							        Veena Samrajya
							        <span>Palghar</span>
							      </figcaption>
							    </a>
						</figure>
					</div>
				</div>
                
                <?php
                while ($WebsiteData = mysql_fetch_array($qry))
                {
                 
                  
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
				<div class="item">
					<div class="projectThumb">
						<figure>
						      <a href="<?=$urlhtaccess?>">
						          <img src="images/sitelogo_images/project/<?=$WebsiteImage;?>"  alt=""> 
							      <figcaption>
							        <?=$WebsiteName?>
							        <span><?= $WebsiteAddress;?></span>
							      </figcaption>
							    </a>
						</figure>
					</div>
				</div>
<?php } }?>
			</div>
		</div>
	</section>
	<!--residentialProjectSec end-->

	<!-- about Us start -->
	<section class="aboutSec">
		<div class="container">
			<div class="aboutContentArea">
				<div class="aboutHeading">About <span>veena Developers</span></div>
<?php $a=mysql_fetch_array(mysql_query("SELECT page_description FROM `msp_about_us`  order by about_usid desc limit 1"));?>
				<p><?php echo $a['page_description']?></p>

				<a href="/about-us" class="greyBtn">Discover</a>
			</div>
		</div>
	</section>
	<!-- about Us end -->

	<!--comercialProjectSec start-->
	<section class="comercialProjectSec projectSec">
		<div class="container">
			<div class="newHeading">Commercial Projects</div>
				 	<?php 
    //           $qry=mysql_query("SELECT heading_text FROM `msp_project_heading`  WHERE `project_type`='2' and heading_type='1' and heading_status='Active'  order by heading_id desc limit 1;");
    //           $ProjectNum = mysql_num_rows($qry);
    //           if($ProjectNum > 0)
    //           {
    //               $res=mysql_fetch_row($qry);
    //               $htext=$res[0];
    //           }else{$htext='Text Not Fount';}?>
			<!--<p><?=$htext;?>.</p> -->
			<div class="owl-carousel" id="residentialProjectCarousel">
			 
<?php
              $qry=mysql_query("SELECT * FROM `msp_website`  WHERE `website_type_id`='2' and website_status='Active' and `website_show_project`='Yes' order by websiteid desc;");
              $ProjectNum = mysql_num_rows($qry);
             // $ProjectRes = $Project->GetProjectCompletedRes();
              if($ProjectNum > 0)
              {
                
                while ($WebsiteData = mysql_fetch_array($qry))
                {
                 
                  
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
				<div class="item">
					
					
					<div class="projectThumb">
						<figure>
						      <a href="<?=$urlhtaccess?>">
						          <img src="images/sitelogo_images/project/<?=$WebsiteImage;?>"  alt=""> 
							      <figcaption>
							        <?=$WebsiteName?>
							        <span><?= $WebsiteAddress;?></span>
							      </figcaption>
							    </a>
						</figure>
					</div>
				</div>
<?php } }?>
			</div>
		</div>
	</section>
	<!--comercialProjectSec end-->

    <div class="counterAreaSec">
    	
    	<!-- fact counter-->
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
        
        <section id="contact" class="col-sm-6 bg-color-red homepage_counter">
              <div class="col-xs-6 text-center">
                <div class="get-tuch">
                  <ul>
                    <li>
                      <h2 class="bottom40 count" style="color: #fff;"><?=$journey_of_years_value2;?></h2>
                    </li>
                    <li>
                      <h4><?=$journey_of_years_title2;?></h4>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-6 text-center">
                <div class="get-tuch">
                  <ul>
                    <li>
                      <h2  class="bottom40 count" style="color: #fff;"><?=$journey_of_years_value3;?></h2>
                    </li>
                    <li>
                      <h4><?=$journey_of_years_title3;?></h4>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-6 text-center">
                <div class="get-tuch">
                  <ul>
                    <li>
                      <h2   class="bottom40 count" style="color: #fff;"><?=$journey_of_years_value4;?></h2>
                    </li>
                    <li>
                      <h4><?=$journey_of_years_title4;?></h4>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-6 text-center">
                <div class="get-tuch">
                  <ul>
                    <li>
                      <h2 class="bottom40 count" style="color: #fff;"><?=$journey_of_years_value5;?></h2>
                    </li>
                    <li>
                      <h4><?=$journey_of_years_title5;?></h4>
                    </li>
                  </ul>
                </div>
              </div>
        </section>
        <?php
          }
        ?>
        
        
        <!-- testimonialSec start -->
    	<section class="col-sm-6 testimonialSec">
			<div class="newHeading">Our Testimonial</div>

			<div class="owl-carousel" id="testimonialCarousel">
				<!-- Quote 1 -->
				<?php $qry="SELECT * FROM `msp_testimonial` where msp_testimonial_status='Active' order by msp_testimonial_id desc" ;
				$excqry=mysql_query($qry);
				$numrows=mysql_num_rows($excqry);
				if($numrows>0){
				    while($fetch=mysql_fetch_row($excqry)){?>
				        
				<div class="item active">
					<div class="row">
						<div class="col-sm-12">
							<p>&ldquo;<?=$fetch[1];?>&rdquo;</p>
							<small><strong><?php echo $fetch[2].' '.$fetch[3].' '.$fetch[4];?></strong></small>
						</div>
					</div>
				</div>
<?php
				    }
				}
				?>
				<!-- Quote 2 -->
			

				<!-- Quote 3 -->
			
			</div>
    	</section>
    	<!-- testimonialSec end -->    
    </div>
<!-- factcounter close-->

<div class="clearfix"></div>

	<!-- FOOTER -->
	<?php include_once($msp_footer);?>
	<!-- FOOTER -->
	

	<!--  #/TEAM POPUP  -->
	<script src="js/jquery.2.2.3.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$('#keytitle').keyup(function () {
				var query = $(this).val();
				if (query != '') {
					$.ajax({
						url: "search_project_title.php",
						method: "POST",
						data: { query: query },
						success: function (data) {
							$('#SearchFilTitleList').fadeIn();
							$('#SearchFilTitleList').html(data);
						}
					});
				}
			});
			$(document).on('click', '.srchli', function () {
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
		$(document).ready(function () {
			$('#datePicker')
				.datepicker({
					format: 'mm/dd/yyyy'
				})
				.on('changeDate', function (e) {
					// Revalidate the date field
					$('#eventForm').formValidation('revalidateField', 'date');
				});

		});
	</script>
<script>$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 10000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});</script>
	<script>
		$(document).ready(function () {
			// Add smooth scrolling to all links
			$("a").on('click', function (event) {

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
					}, 800, function () {

						// Add hash (#) to URL when done scrolling (default click behavior)
						window.location.hash = hash;
					});
				} // End if
			});
		});
	</script>
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
	<script>
// 		$(window).load(function () {
// 			$('#onload').modal('show');
// 		});
	</script>
</body>

</html>