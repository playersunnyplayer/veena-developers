<?
include 'includes_config/db.config.class.php';
header('Content-Type:application:json');
 		    $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');
$GetWebTitle = $_GET['pjtid'];
$WebTitleDatas = $Website->GetWebsiteByUrlTitleDetails($GetWebTitle);
$GetWebID = $WebTitleDatas["websiteid"];
if(empty($GetWebID))
header("Location $siteurl");
$WebsiteData = $Website->GetWebsiteDetails($GetWebID);
$Web_sitename = $WebsiteData["website_sitename"];
$Web_siteurl = $WebsiteData["website_siteurl"];
$Web_mobile = $WebsiteData["website_mobile"];
$Web_phone = $WebsiteData["website_phone"];
$Web_email = $WebsiteData["website_email"];
$Web_short_address = $WebsiteData["website_short_address"];
$Web_address = $WebsiteData["website_address"];
$Web_sitecolor = $WebsiteData["website_sitecolor"];
$Web_sitelogo = $WebsiteData["website_sitelogo"];
$Web_type_id = $WebsiteData["website_type_id"];
$Web_typology_id = $WebsiteData["website_typology_id"];
$Web_city_id = $WebsiteData["website_city_id"];
$Web_location_id = $WebsiteData["website_location_id"];
$Website_image=$WebsiteData["website_image"];
$Web_sitepdf = $WebsiteData["website_sitepdf"];
$Web_register_no = $WebsiteData["website_siteregister_no"];
$Web_status = $WebsiteData["website_status"];
$LocationData = $CMS->GetPageInfoDetails("msp_location", "locationid", $WebsiteLocationID);
$LocationTitle = $LocationData['msp_title'];


$TableName = 'msp_project_about_us';
$PageInfo = $CMS->GetPageInfo($TableName);
                        if($TableName == 'msp_project_about_us'){
                        $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                        $project_about_us_title = $PageInfo["title"];
                        $project_about_us_contents = $PageInfo["contents"];
                        $project_about_us_contents = str_replace("|", "'", $project_about_us_contents);
                        $page_title = $PageInfo["page_title"];
$page_keyword = $PageInfo["page_keyword"];
$page_description = $PageInfo["page_description"];
$code = $PageInfo["code"];
                        }
                        
if(isset($_POST['apisubmit']))
{
$curl = curl_init();
$name=$_POST['name'];
$mobile=$_POST['phone'];
$email=$_POST['email'];
$project=$_POST['projectname'];
$sqlQueryAdd = "INSERT INTO `msp_enquiry_project` (`projectname`,`name`,`mobile`,`email`)VALUES ('$project','$name','$mobile','$email')";
            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : " . mysql_error());
$exid=date('Ymdhms');
$ldate=date('m/d/Y');
$data=array(
  "firstName"=>$name,
  "lastName"=> "",
  "email"=> $email,
  "mobilePhone"=> $mobile,
  "leadDate"=> $ldate,
  "comments"=>"Website - ".$project,
  "originFrom"=> "",
  "product"=> $project,
  "campaign"=> "VD Website",
  "isUpdatefromUIDate"=> false,
  "isImported"=> true,
  "ExternalId"=> $exid
);
$new[]=$data;
$data2=json_encode($new);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://server5.farvisioncloud.com/SFA/odata/LeadListSave",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data2,
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer K87KkVZRlkYWrSMMl9-6SJGigxYZQWbT1tQC_6zJSzvnHG63mXmHNCu1_PcA-EFPf8Bt-_9NX1sa6zdPaXg5fLAgQIbyoizERIgzx9aJGqFZ005d93r2R-P0MYBaInlLFzXS8lRNJtmBQsXLCtIhcGgl0H1kTRqs1DHtvSlLY-G84WyKibb0rAvUajCaDcQvJIVznEQl4QkAwHdxDGj-1biWM_e80qEHQccd__dMD87uXwjjQNzcYDgrRw257VNeS5bcQYRDVZI17ri9wK5BjBhwcCvb9IP1kjrxbMWRL50p-K79cmQQYstQ8K9I3y5hKn-CG4M6v9SvtJXw3nkxXvt6FmhCIts2vBUJNEO9rakhHxt1yW9_jOwL1ok0gh4Y1F6xbSGDKXZJGGzwX65LchWt2YBVGAHVzrSU0BqwQtfO5MQY",
    "cache-control: no-cache",
    "content-type: Application/json",
    "postman-token: 4d1e0eb1-0136-a555-736b-422a9454940b"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  //echo "cURL Error #:" . $err;
  header("Location:thank-you2.php");
} else {
  header("Location:../thank-you.php");
}
}


?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="<?=$page_description;?>" />
	<meta name="keywords" content="<?=$page_keyword;?>" />
	<meta name="author" content="<?=$sitename;?>" />
	<title><?=$page_title;?> </title>
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/idea_homes._icons.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/cubeportfolio.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/jquery.fancybox.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/bootsnav.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/range-Slider.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=$siteurl;?>/css/color/color-1.css" id="color" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
	<link rel="shortcut icon" href="<?=$siteurl;?>/images/short_icon.png">
	<style>

	</style>
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	<meta name="google-site-verification" content="CQB7dKoLcGsYZ9Q7BKpF0cMNM6cZA3nGwg-E6U16p9A" />




	<!-- Global site tag (gtag.js) - Google Analytics -->
<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133692233-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'UA-133692233-1');
	</script>-->
	<style>
		.error {
			color: red;
		}

		.hidde {
			display: none;
		}
	</style>



	<?php include_once('externalcode.php');?>
</head>

<body>
	<!--LOADER -->
	<? include_once($msp_header);?>

	<script src="https://www.kenyt.ai/botapp/ChatbotUI/dist/js/bot-loader.js" type="text/javascript" data-bot="<?php if(!empty($code)){
      echo "$code";
      }else{
          echo "Veena_Developers";
      }?>"></script>

	<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section">
		<div id="first-slider">
		
				<!-- Indicators -->
	
				<!-- Wrapper for slides -->
				<div class="owl-carousel homepageCarousel" id="carousel-example-generic">
					<!-- Item 1 -->
					<?php
                      $ProjectSliderNum = $ProjectSlider->GetProjectSliderByWebsiteNum($GetWebID);
                     $ProjectSliderRes = $ProjectSlider->GetProjectSliderByWebsiteRes($GetWebID);
                      
                      if ($ProjectSliderNum > 0)
                      {
                        $anju=0;
                        while ($ProjectSliderData = $ProjectSlider->dbfetch($ProjectSliderRes))
                        {
                         $anju++;
                          $ProjectSliderID = $ProjectSliderData["project_sliderid"];
                         $ProjectSliderTitle = $ProjectSliderData["msp_title"];
                         $ProjectSliderImages = $ProjectSliderData["msp_image"];
                         $ProjectSliderStatus = $ProjectSliderData["msp_status"];
                          if($anju==1){ $active='active';}else{ $active='';}
                          
                        ?>
					<div class="item">
						<img src="<?=$siteurl;?>/images/slider_images/<?=$ProjectSliderImages;?>">
					</div>
					<?
                    }
                  }
                  ?>

			
				
			</div>
		</div>
	</div>
	<!--===== #/PAGE TITLE =====-->
	<section id="about_us_backup" class="about-us padding20 hide">
		<div class="container">
			<div class="row">
				<div class="history-section">
					<div class="col-md-12 col-sm-12 col-xs-12  padding20">


						<div class="col-md-3 col-sm-6 col-xs-12"><img
								src="<?=$siteurl;?>/images/sitelogo_images/<?=$Web_sitelogo;?>"
								alt="<?=$Web_sitename;?>">
							<h5><?=$Web_short_address;?></h5>
						</div>
						<div class="col-md-6">
							<!--  <p class="top20">It has been an inspiring 28 years journey so far. There have been great learning experiences in a journey that built relationships out of transparency and trust. The journey had humble beginning, but the goals were pursued with sincere and relentless effort by a team of dynamic, young and experienced pioneers. </p> -->
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<? if($Web_type_id==1){?>
							<h5>RERA Reg No . <?=$Web_register_no;?></h5>
							<? if(!empty($Web_sitepdf)){ ?> <a class="link_arrow dark_border top20"
								href="<?=$siteurl;?>/images/sitelogo_images/pdf/<?=$Web_sitepdf;?>"
								target="_blank">Download RERA Reg Certificate</a>
							<? } ?>
							<br> <br>
							<h5>Call Us : <?=$Web_mobile;?></h5>
							<? }else{ ?>
							<?
                          $TableName = 'msp_project_area';
                          if($TableName == 'msp_project_area'){
                            $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                            $project_area_title = $PageInfo["title"];
                            $project_area_contents = $PageInfo["contents"];
                        //  echo  $project_area_contents = str_replace("|", "'", $project_area_contents);
                          }
                          ?>

							<?}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="about_us" class="about-us " data-spy="scroll" data-target=".scrollingNav">
		<div class="property-tab bottom0">
			<div class="container">
				<!-- Nav tabs -->
				<div class="scrollingNav_hamburger" id="scrollingNav_hamburger"> <span>&#9776;</span> Quick scroll</div>
				<ul class="scrollingNav">
					<li><a href="#Overview">Overview</a></li>
					<? if($Web_type_id==1){ ?>
					<?
							$ProjectAmenitiesNum = $ProjectAmenities->GetProjectAmenitiesByWebsiteNum($GetWebID);
							if($ProjectAmenitiesNum > 0){
							?>
					<li class=""><a href="#Amenities">Amenities </a></li>
					<? } 

							$ProjectPlanNum = $ProjectPlan->GetProjectPlanByWebsiteNum($GetWebID);
							if($ProjectPlanNum > 0){
							?>
					<li class=""><a href="#Plans">Plans</a></li>
					<? }
								$ProjectCurrentStatusRes2 = $ProjectCurrentStatus->GetProjectCurrentStatusDistinctByWebsiteRes($GetWebID);
							while ($ProjectCurrentStatusData2 = $ProjectCurrentStatus->dbfetch($ProjectCurrentStatusRes2))
							{
							
							$ProjectCurrentStatusDate = $ProjectCurrentStatusData2["msp_mmyydate"];
							$ProjectCurrentStatusNum = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteNum($GetWebID, $ProjectCurrentStatusDate);
							}
							if($ProjectCurrentStatusNum > 0){
							?>

					<li class=""><a href="#Status">Current Status</a></li>
					<? }
					
							$ProjectGalleryNum = $ProjectGallery->GetProjectGalleryByWebsiteNum($GetWebID);
							$ProjectVideoNum = $ProjectVideo->GetProjectVideoByWebsiteNum($GetWebID);
							if(($ProjectGalleryNum > 0) || ($ProjectVideoNum > 0)){
							?>
					<li class=""><a href="#Gallery">Gallery </a></li>
					<? }
							
				
							
							$PageTabInfoNum = $CMS->GetWebPageInfoNum("msp_project_walkthrough", $GetWebID);
							if($PageTabInfoNum > 0){
							?>
					<li class=""><a href="#Walkthrough">Walkthrough</a></li>
					<?
						}
							$ProjectDownloadsNum = $ProjectDownload->GetProjectDownloadByWebsiteNum($GetWebID);
							if($ProjectDownloadsNum > 0){
							?>

					<li class=""><a href="#Download">Download</a></li>
					<? } ?>
					<? }  ?>
					<? if($Web_type_id==2){ ?>
					  <li class=""><a href="#Highlights">Project Highlights</a></li>
					<li class=""><a href="#Area">Project Area</a></li>
					<?   $TableName = 'msp_project_brands_associated';
							if($TableName == 'msp_project_brands_associated'){
								$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
							}
							if($PageInfo > 0){ ?>
					<li class=""><a href="#Brands">Brand Associates</a></li>
					<? } }?>
					
					<li class=""><a href="#Contact">Location</a></li>


				</ul>
			</div>
			<!-- Tab panes -->
				<?
                        $TableName = 'msp_project_about_us';
                        if($TableName == 'msp_project_about_us'){
                        $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                        $project_about_us_title = $PageInfo["title"];
                        $project_about_us_contents = $PageInfo["contents"];
                        $project_about_us_contents = str_replace("|", "'", $project_about_us_contents);
                        ?>
				<div id="Overview" class="projectDataSec">
					<div class="container">
						<div class="col-sm-7">
					<div class="projectHeading"><?= $project_about_us_title;?></div>

								<!--	<p><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis obcaecati
									aspernatur maiores dignissimos perferendis unde. Deleniti officiis voluptatem culpa
									veritatis aperiam</strong></p>
							<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat rerum natus quia ipsam
								minima quod velit quidem, ipsa deleniti quam tempora doloribus voluptatem distinctio
								molestiae impedit recusandae ad inventore soluta.</p>

							<a href="#" class="ocRecieved">OC Recieved Till 12th Floor</a>

						-->
								<?=$project_about_us_contents;?>
									<a href="../images/sitelogo_images/pdf/<?=$Web_sitepdf?>" class="main_btn">Download Brochure</a>
						</div>

						<div class="col-sm-5">
						     <img src="../images/sitelogo_images/project/<?=$Website_image;?>"  alt="">
						
						</div>

						<!--<?=$project_about_us_contents;?>-->


					
                         
                         
					
					
					</div>
				</div>
				<?
                            }
                        ?>
				<div id="Amenities" class="projectDataSec" 	<?php $ProjectAmenitiesNum = $ProjectAmenities->GetProjectAmenitiesByWebsiteNum($GetWebID);
							if($ProjectAmenitiesNum < 1){?> style="display:none" <?php } else{?> <?php } ?> >
					<div class="container">
						<div class="text-uppercase text-left bottom20 top10"><h3>Amenities</h3></div>
						<?
                            $TableName = 'msp_project_amenities_contents';
                            if($TableName == 'msp_project_amenities_contents'){
                            $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                            $project_amenities_contents_title = $PageInfo["title"];
                            $project_amenities_contents_contents = $PageInfo["contents"];
                            echo $project_amenities_contents_contents = str_replace("|", "'", $project_amenities_contents_contents);
                            }
                            ?>

						<br>
						<div class="row amenitieswrapForamenities_only">
							<?
                                $ProjectAmenitiesRes = $ProjectAmenities->GetProjectAmenitiesByWebsiteRes($GetWebID);
                                 $chumma=0;
                                 while ($ProjectAmenitiesData = $ProjectAmenities->dbfetch($ProjectAmenitiesRes))
                                 {
                                   $chumma++;
                                   $ProjectAmenitiesID = $ProjectAmenitiesData["project_galleryid"];
                                   $ProjectAmenitiesTitle = $ProjectAmenitiesData["msp_title"];
                                   $ProjectAmenitiesImages = $ProjectAmenitiesData["msp_image"];
                                   $ProjectAmenitiescontents = $ProjectAmenitiesData["msp_contents"];
                                    $ProjectAmenitiescontents = str_replace("|", "'", $ProjectAmenitiescontents);
                                ?>
							<div class="col-md-6 aminities-stl-ul">
								<h5><?=$ProjectAmenitiesTitle;?></h5>
								<br>
								<?=$ProjectAmenitiescontents;?>

								<br>
							</div>
							<?
                                    if($chumma==2){ echo '<div class="clearfix"></div>'; $chumma=0;}
                                    }
                                ?>
						</div>
					</div>
				</div>

				<div id="Plans" class="projectSec responsiveProjectSec  projectDataSec alternativeBg" <?php	$ProjectPlanNum = $ProjectPlan->GetProjectPlanByWebsiteNum($GetWebID);
							if($ProjectPlanNum < 1){?> style="display:none" <?php } ?>>
					<div class="container">
						<h3 class="text-uppercase  bottom20 top10">Floor Plans</h3>
						<div class="row">
						    	<div class="owl-carousel" id="residentialProjectCarousel">
							<?php
									$ProjectPlanNum = $ProjectPlan->GetProjectPlanByWebsiteNum($GetWebID);
									$ProjectPlanRes = $ProjectPlan->GetProjectPlanByWebsiteRes($GetWebID);
									
									if ($ProjectPlanNum > 0)
									{
									while ($ProjectPlanData = $ProjectPlan->dbfetch($ProjectPlanRes))
									{
										$ProjectPlanID = $ProjectPlanData["project_planid"];
										$ProjectPlanTitle = $ProjectPlanData["msp_title"];
										$ProjectPlanImages = $ProjectPlanData["msp_image"];
										$ProjectPlanImages2 = $ProjectPlanData["msp_image2"];
									?>
						
								<div class="projectThumb">
									<img src="<?=$siteurl;?>/images/plan_images/resize/<?=$ProjectPlanImages2;?>"
										alt="<?=$ProjectPlanTitle;?>">
									<div class="overlay">
									    <a href="<?=$siteurl;?>/images/plan_images/<?=$ProjectPlanImages;?>"
											class="fancybox centered" data-fancybox-group="plans">
										</a>
									</div>
									
									<h4> <?=$ProjectPlanTitle;?></h4>
								</div>
						
					
						<?
										}
									}
									?>
										</div>

					</div>
				</div>
			</div>
			<div id="Status" class="projectDataSec " <?php $ProjectCurrentStatusRes2 = $ProjectCurrentStatus->GetProjectCurrentStatusDistinctByWebsiteRes($GetWebID);
							while ($ProjectCurrentStatusData2 = $ProjectCurrentStatus->dbfetch($ProjectCurrentStatusRes2))
							{
							
							$ProjectCurrentStatusDate = $ProjectCurrentStatusData2["msp_mmyydate"];
							$ProjectCurrentStatusNum = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteNum($GetWebID, $ProjectCurrentStatusDate);
							}
							if($ProjectCurrentStatusNum < 1){
							?>  style="display:none" <?php } ?>>
				<div class="container">
					<h3 class="text-uppercase bottom20 top10">
						<?
								$TableName = 'msp_project_current_status_title';
								if($TableName == 'msp_project_current_status_title'){
									$PageInfoNum = $CMS->GetWebPageInfoNum($TableName, $GetWebID);
									if($PageInfoNum > 0){
									$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
								echo  $project_current_status_title = $PageInfo["title"];
								}else{ ?>
						Current Status
						<?
								}
							}
								?>
					</h3>
				</div>
				
				<div class="container p-font-15">
					<div class="tabbable-panel">
						<div class="tabbable-line">
							<?
								$TableName = 'msp_project_current_status_title';
								if($TableName == 'msp_project_current_status_title'){
								
									$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
									$project_current_status_date_tab = $PageInfo["date_tab"];
								
									}
									?>
							<div class="tab-content">
								<div class="row">
									<div class="col-md-12 col-sm-6 col-xs-12">
										<?
											$ProjectCurrentStatusRes2 = $ProjectCurrentStatus->GetProjectCurrentStatusDistinctByWebsiteRes($GetWebID);
												$Anju=0;
											while ($ProjectCurrentStatusData2 = $ProjectCurrentStatus->dbfetch($ProjectCurrentStatusRes2))
												{
												$Anju++;
												$ProjectCurrentStatusDate = $ProjectCurrentStatusData2["msp_mmyydate"];
												
												if($Anju==1){$active='active';}else{ $active='active';}
											?>


										<?php
												$ProjectCurrentStatusNum = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteNum($GetWebID, $ProjectCurrentStatusDate);
												$ProjectCurrentStatusRes = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteRes($GetWebID, $ProjectCurrentStatusDate);
												?>


										<?
												if ($ProjectCurrentStatusNum > 0)
												{
													while ($ProjectCurrentStatusData = $ProjectCurrentStatus->dbfetch($ProjectCurrentStatusRes))
													{
													
													$ProjectCurrentStatusID = $ProjectCurrentStatusData["project_current_statusid"];
													$ProjectCurrentStatusTitle = $ProjectCurrentStatusData["msp_title"];
													$ProjectCurrentStatusImages = $ProjectCurrentStatusData["msp_image"];
													$ProjectCurrentStatusImages2 = $ProjectCurrentStatusData["msp_image2"];

													?>
										<!--<div class=" col-md-4 col-sm-6 col-xs-12 cbp-item latest rent">
											<div class="image details_pro">
												<img src="<?=$siteurl;?>/images/current_status_images/resize/<?=$ProjectCurrentStatusImages2;?>"
													alt="<?=$ProjectPlanTitle;?>">
												<div class="overlay"> <a
														href="<?=$siteurl;?>/images/current_status_images/<?=$ProjectCurrentStatusImages;?>"
														class="fancybox centered" data-fancybox-group="gallery">
														<h4> <?=$ProjectCurrentStatusTitle;?></h4>
													</a> </div>
											</div>
										</div>-->
												<div class="projectThumb col-sm-4 col-xs-12">
													<div class="cbp-item latest rent">
														<figure class="image details_pro">
															<img src="<?=$siteurl;?>/images/current_status_images/resize/<?=$ProjectCurrentStatusImages2;?>" quality=85 auto=format fit=max
																alt="<?=$ProjectCurrentStatusalt;?>">
																
																<figcaption><?=$ProjectCurrentStatusTitle;?></figcaption>

																<div class="overlays">
																	<a href="<?=$siteurl;?>/images/current_status_images/<?=$ProjectCurrentStatusImages;?>"
																		class="fancybox centered"
																		data-fancybox-group="gallery">
																	</a>
																</div>
														</figure>
													</div>
											</div>

										<?
													} 
												}
												?>






										<? } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="Gallery" class="projectDataSec projectSec" <?php 	$ProjectGalleryNum = $ProjectGallery->GetProjectGalleryByWebsiteNum($GetWebID);
							$ProjectVideoNum = $ProjectVideo->GetProjectVideoByWebsiteNum($GetWebID);
							if(($ProjectGalleryNum >0) || ($ProjectVideoNum >0)){ ?> style="display:block" <?php } else {?> style="display:none"<?php }?>>
				<div class="container">
					<h3 class="text-uppercase text-left bottom20 top10">Gallery</h3>
					<div class="p-font-15">
						<div class="tabbable-panel">
							<div class="tabbable-line">
								<div class="tab-pane active" id="tab_default_1">
									<div class="row">
										<div class="" id="">
											<?php
															$ProjectGalleryNum = $ProjectGallery->GetProjectGalleryByWebsiteNum($GetWebID);
															$ProjectGalleryRes = $ProjectGallery->GetProjectGalleryByWebsiteRes($GetWebID);
															
															if ($ProjectGalleryNum > 0)
															{
																$dhammu=0;
															while ($ProjectGalleryData = $ProjectGallery->dbfetch($ProjectGalleryRes))
															{
																$dhammu++;
																$ProjectGalleryID = $ProjectGalleryData["project_galleryid"];
																$ProjectGalleryTitle = $ProjectGalleryData["msp_title"];
																$ProjectGalleryImages = $ProjectGalleryData["msp_image"];
																$ProjectGalleryImages2 = $ProjectGalleryData["msp_image2"];
																$ProjectGalleryStatus = $ProjectGalleryData["msp_status"];
																$ProjectGalleryalt = $ProjectGalleryData["msp_alt"];
															?>

											
												<div class="projectThumb col-sm-4 col-xs-12">
													<div class="cbp-item latest rent">
														<figure class="image details_pro">
															<img src="<?=$siteurl;?>/images/gallery_images/resize/<?=$ProjectGalleryImages2;?>" quality=85 auto=format fit=max
																alt="<?=$ProjectGalleryalt;?>">
																
																<figcaption><?=$ProjectGalleryTitle;?></figcaption>

																<div class="overlays">
																	<a href="<?=$siteurl;?>/images/gallery_images/<?=$ProjectGalleryImages;?>"
																		class="fancybox centered"
																		data-fancybox-group="gallery">
																	</a>
																</div>
														</figure>
													</div>
											</div>
											<? /*if($dhammu==4) { echo'<div class="clearfix"></div>'; $dhammu=0; } */
																
																}
															}
															?>
										</div>
									</div>
								</div>
							</div>
							<div id="tab_default_2" <?php 	$ProjectVideoNum = $ProjectVideo->GetProjectVideoByWebsiteNum($GetWebID); if($ProjectViceoNum<1){?> style="display:none" <?php } ?>>
								<div class="row">
									<?php
													$ProjectVideoNum = $ProjectVideo->GetProjectVideoByWebsiteNum($GetWebID);
													$ProjectVideoRes = $ProjectVideo->GetProjectVideoByWebsiteRes($GetWebID);
													
													if ($ProjectVideoNum > 0)
													{
													while ($ProjectVideoData = $ProjectVideo->dbfetch($ProjectVideoRes))
													{
														$ProjectVideoID = $ProjectVideoData["project_videoid"];
														$ProjectVideoTitle = $ProjectVideoData["msp_title"];
														$ProjectVideoStatus = $ProjectVideoData["msp_status"];
														$video_code = $ProjectVideoData["msp_video_code"];
														$video_code = str_replace("https", "http", $video_code);
														$myObject = new SimpleYouTube;
														$video_id = $myObject->getVideoID($video_code);
														$videoDetails = $myObject->getVideoDetails($video_id);
													?>
									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="cbp-item latest rent">
											<div class="image">
												<iframe width="auto" height="auto"
													src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
													frameborder="0"
													allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
													allowfullscreen></iframe>
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
		


		<?
                        $TableName = 'msp_project_walkthrough';
                        if($TableName == 'msp_project_walkthrough'){
                        $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                        $project_walkthrough_title = $PageInfo["title"];
                        $project_walkthrough_image = $PageInfo["image"];
                        $project_walkthrough_video_code = $PageInfo["video_code"];
                        $project_walkthrough_video_code = str_replace("https", "http", $project_walkthrough_video_code);
                         $myObject = new SimpleYouTube;
                          $video_id = $myObject->getVideoID($project_walkthrough_video_code);
                          $videoDetails = $myObject->getVideoDetails($video_id);
                        ?>
		<div id="Walkthrough" class="projectDataSec projectDataSec_Walkthrough" <?php 	$PageTabInfoNum = $CMS->GetWebPageInfoNum("msp_project_walkthrough", $GetWebID);
							if($PageTabInfoNum <1){ ?> style="display:none" <?php }?>>
			<div class="row">
				<div class="container">
				    <h3>Walkthrough</h3>
					<div class="col-md-6">
						<iframe src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
							frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
		<?
                            }
                        ?>
		<div id="Download"  class="projectDataSec" <?php 	$ProjectDownloadsNum = $ProjectDownload->GetProjectDownloadByWebsiteNum($GetWebID);
							if($ProjectDownloadsNum <1){
					
 ?> style="display:none" <?php }?>>
			<div class="">
				<div class="container">
				    <h3>Download</h3>
					<div class="col-md-2"></div>
					<?php
								$ProjectDownloadsNum = $ProjectDownload->GetProjectDownloadByWebsiteNum($GetWebID);
								$ProjectDownloadsRes = $ProjectDownload->GetProjectDownloadByWebsiteRes($GetWebID);
								
								if ($ProjectDownloadsNum > 0)
								{
									$jaan=0;
									while ($ProjectDownloadsData = $ProjectDownload->dbfetch($ProjectDownloadsRes))
									{
									$jaan++;
									$ProjectDownloadID = $ProjectDownloadsData["project_downloadid"];
									$ProjectDownloadTitle = $ProjectDownloadsData["msp_title"];
									$ProjectDownloadImages = $ProjectDownloadsData["msp_image"];
									$ProjectDownloadImages2 = $ProjectDownloadsData["msp_image2"];

									?>
					<div class="col-md-4">
						<a href="#" data-toggle="modal" data-target=".Download_Brochure<?=$ProjectDownloadID;?>">
							<img src="<?=$siteurl;?>/images/download_images/<?=$ProjectDownloadImages;?>"
								class="img-responsive" alt="">
							<h3 style="text-align: center;"><?=$ProjectDownloadTitle;?></h3>
						</a>
					</div>
					<?
										}
									}
									?>

					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
	   <div id="Highlights"   <?   $TableName = 'msp_project_highlights';
                         $pageInfo=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `msp_project_highlights` where  websiteid='$GetWebID';"));	
							if($pageInfo < 1){ ?> class="projectDataSec hide" <?php } else { ?> class="projectDataSec" <? } ?>>
								<div class="container">
								    <h3>Project Highlights</h3>
                          <?
                          $TableName = 'msp_project_highlights';
                          if($TableName == 'msp_project_highlights'){
                            $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                            $project_highlights_title = $PageInfo["title"];
                            $project_highlights_contents = $PageInfo["contents"];
                          echo  $project_highlights_contents = str_replace("|", "'", $project_highlights_contents);
                          }
	  
						  ?>
						  </div>
						</div> 

		<div id="Area"  <?php  
				             $pageInfo=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `msp_project_area` where  websiteid='$GetWebID';"));
							if($pageInfo < 1){ ?> class="projectDataSec hide" <?php } else { ?> class="projectDataSec" <? } ?>>
			<div class="container">
			    <h3>Project Area</h3>
				<?
								$TableName = 'msp_project_area';
								if($TableName == 'msp_project_area'){
									$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
									$project_area_title = $PageInfo["title"];
									$project_area_contents = $PageInfo["contents"];
								echo  $project_area_contents = str_replace("|", "'", $project_area_contents);
								}
		
								?>
			</div>
		</div>

		<div id="Brands"  <?php  
				                $TableName = 'msp_project_brands_associated';
						 $pageInfo=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `msp_project_brands_associated` where  websiteid='$GetWebID';"));
							if($pageInfo < 1){ ?> class="projectDataSec hide" <?php } else { ?> class="projectDataSec" <? } ?>>
			<div class="container">
			    <h3>Brand Associates</h3>
				<?
								$TableName = 'msp_project_brands_associated';
								if($TableName == 'msp_project_brands_associated'){
									$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
									$project_brands_associated_title = $PageInfo["title"];
									$project_brands_associated_contents = $PageInfo["contents"];
								echo $project_brands_associated_contents = str_replace("|", "'", $project_brands_associated_contents);
								}
		
								?>
			</div>
		</div>
        <div id="Contact" class="projectDataSec">
            	<?
                        $TableName = 'msp_project_site_address';
                        if($TableName == 'msp_project_site_address'){
                        $PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
                        $project_site_address_title = $PageInfo["title"];
                        $project_site_address_contents = $PageInfo["contents"];
                        $project_site_address_contents = str_replace("|", "'", $project_site_address_contents);
                        $project_site_address_contents2 = $PageInfo["contents2"];
                        $project_site_address_contents2 = str_replace("|", "'", $project_site_address_contents2);
                        $project_site_address_map = $PageInfo["map"];
                        ?>
        <div id="PropertyLocation" >
				<div class="container">
				    <h3>Property Location</h3>
					<div class="row">
						<div class="col-md-4">
						<?=$project_site_address_map;?>
						</div>
						<?php
									$TableName = 'msp_project_site_address';
									if($TableName == 'msp_project_site_address'){
									$PageInfo = $CMS->GetWebPageInfo($TableName, $GetWebID);
									$project_site_address_title = $PageInfo["title"];
									$project_site_address_contents = $PageInfo["contents"];
									$project_site_address_contents = str_replace("|", "'", $project_site_address_contents);
									?>
						<div class="col-md-8">
						    	<!--<h3><?=$project_site_address_title;?></h3>-->
							<div class="amenities-marker">
								<?=$project_site_address_contents;?>
							</div>
						</div>
						<?
										}

									?>
					</div>
				</div>
			</div>

			<? } ?>
			<div class="container">
				<div class="row padding20">
					<div class="col-md-12">
					    	<div class="row">
							<div id="alert_message"></div>
                            <h3>Contact Us</h3>
							<form class="callus padding-bottom" id="ProjectContactForm7" name="ProjectContactForm7" method="post" >
							    <?php if(strtolower($Web_siteurl) == "veenaserenity"): ?>
								<input type="hidden" name="account" id="account" value="5">
								<input type="hidden" name="project" id="project" value="Veena Serenity">
								<input type="hidden" name="description" id="description" value="I am Interested in Veena Serenity">
								<?php else: ?>
								<input type="hidden" name="account" id="account" value="6">
								<input type="hidden" name="project" id="project" value="Veena Crest">
								<input type="hidden" name="description" id="description" value="I am Interested in Veena Crest">
								<?php endif; ?>
								<input type="hidden" name="source" id="source" value="2">
								<input type="hidden" name="assignee_id" id="assignee_id" value="56">
								<input type="hidden" name="utm_source" id="utm_source" value="Goolge">
								<input type="hidden" name="utm_campaign" id="utm_campaign" value="Corona">
								<input type="hidden" name="utm_medium" id="utm_medium" value="SiteVisit Form">
								<input type="hidden" name="location" id="location" value="Mumbai">
								<input type="hidden" name="auto_assign" id="auto_assign" value="true">
								<input type="hidden" name="projectname" id="projectname"
									value="<?=$Web_sitename;?>">

								<div class="form-group">
									<div id="result"> </div>
								</div>
								
								<div class="">
									<div class="col-md-3">
										<div class="single-query">
										    <label>Full Name</label>
											<input type="text" class="keyword-input" placeholder="Full Name" name="name"
												id="name">
										</div>
									</div>
									<div class="col-md-3">
										<div class="single-query">
										     <label>Email</label>
											<input type="email" class="keyword-input" placeholder="E-Mail" name="email"
												id="email">
										</div>
									</div>
									<div class="col-md-3">
										<div class="single-query">
										     <label>Mobile</label>
											<input type="text" class="keyword-input" placeholder="Mobile" name="phone"
												id="phone" maxlength="10">
										</div>
									</div>
									<div class="col-md-3">
									    	
										     <label></label>
										<button type="submit" class="btn_fill" name="apisubmit">Submit</button>
									</div>
								</div>

							<!--	<div class="col-md-10">
									<div class="single-query">
										<textarea class="keyword-input" rows="4" placeholder="Message"
											name="message" id="comment" style="height:100px;"></textarea>
									</div>
								</div>
								<!--<div class="col-md-10">
												<div class="single-query">
												<div id="rock">
													<div id="reca" class="g-recaptcha" data-sitekey="6Lesf5kUAAAAAF9ryJxElyUB0DU7iA7oGu0MoLoZ"></div>
													<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
											</div>
												</div>
											</div> -->
						
							</form>
						</div>
					</div>
				</div>
				<?=$project_site_address_contents2;?>
			</div>
		</div>


		</div>
		</div>
	</section>
	<!-- Gallery ends -->
	<!--===== #/CONTACT =====-->
	<? include_once($msp_footer);?>
	<?php
       $ProjectDownloadsNum = $ProjectDownload->GetProjectDownloadByWebsiteNum($GetWebID);
       $ProjectDownloadsRes = $ProjectDownload->GetProjectDownloadByWebsiteRes($GetWebID);
       
       if ($ProjectDownloadsNum > 0)
       {
        $jaan=0;
         while ($ProjectDownloadsData = $ProjectDownload->dbfetch($ProjectDownloadsRes))
         {
          $jaan++;
           $ProjectDownloadID = $ProjectDownloadsData["project_downloadid"];
           $ProjectDownloadTitle = $ProjectDownloadsData["msp_title"];
         ?>
	<div class="modal fade Download_Brochure<?=$ProjectDownloadID;?>" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="vertical-alignment-helper">
			<div class="modal-dialog modal-sm">



				<form method="post" class="DownloadForm" action="<?=$siteurl;?>/download_file.php" id="quickForm">
					<input type="hidden" name="mode" id="mode" value="down">
					<input type="hidden" name="downid" id="downid" value="<?=$ProjectDownloadID;?>">
					<input type="hidden" name="title" id="title" value="<?=$ProjectDownloadTitle;?>">
					<input type="hidden" name="pname" id="pname" value="<?=$Web_sitename;?>">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h5 class="modal-title">Please provide your details to get download link </h5>
						</div>
						<div class="modal-body">
							<div class="single-query">
								<input type="text" class="keyword-input" name="name" id="name" required
									placeholder="NAME">
							</div>
							<div class="single-query">
								<input type="text" class="keyword-input" name="email" id="email" required
									placeholder="EMAIL ID">
							</div>
							<div class="single-query">
								<input type="text" class="keyword-input" name="mobile" id="mobile" required
									placeholder="MOBILE NO" maxlength="10">
							</div>
							<div class="single-query">
								<textarea class="keyword-input" rows="4" placeholder="Message" name="message"
									id="comment" style="height:100px;"></textarea>
							</div>
							<!--<div class="single-query">
						  <div id="rock">
							<div class="container">
								 <div id="reca" class="g-recaptcha" data-sitekey="6Lesf5kUAAAAAF9ryJxElyUB0DU7iA7oGu0MoLoZ"></div>
								<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
							</div>
						</div>
						</div> -->
						</div>
						<div class="modal-footer">
							<button name="downloadapisubmit" type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?
      }
  }
        ?>
	<!--===== #/FOOTER =====-->
	<!--===== REQUIRED JS =====-->
	<script src="<?=$siteurl;?>/js/jquery.2.2.3.min.js"></script>
	<script src="<?=$siteurl;?>/js/sideform.js"></script>
	<script src="<?=$siteurl;?>/js/form_validator.js"></script>
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
		
		$('p').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});

$(document).ready(function () {
    $("#ProjectContactForm7").validate({

    	rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				number: true,
				minlength: 10
			},
		
			captcha: {
				required: true,
				number: true
			},
			budget: "required",
			nationality: "required"
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			phone: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number"
			},
			message: {
				required: "Invalid message"
			},
		
			captcha: {
				required: "Invalid captcha"
			},
			budget: "Please select budget",
			nationality: "Please select nationality"
		}
});
})
$(document).ready(function () {
    $("#quickForm").validate({

    	rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			mobile: {
				required: true,
				number: true,
				minlength: 10
			}
		},
		messages: {
			name: {
				required: "Invalid name",
				minlength: "Invalid name"
			},
			email: {
				required: "Invalid email",
				email: "Invalid email"
			},
			mobile: {
				required: "Invalid mobile number",
				number: "Invalid mobile number",
				minlength: "Invalid mobile number"
			}
		}
});
})
	</script>

	<script>
		$(document).ready(function () {
		    $('.scrollingNav a').on('click',function(event){
                event.preventDefault();
                var target_offset = $(this.hash).offset() ? $(this.hash).offset().top : 0;
                //change this number to create the additional off set        
                var customoffset = 175
                $('html, body').animate({scrollTop:target_offset - customoffset}, 500);
            });
		});
	</script>


	<script src="<?=$siteurl;?>/js/bootstrap.min.js"></script>
	<script src="<?=$siteurl;?>/js/jquery.appear.js"></script>
	<script src="<?=$siteurl;?>/js/modernizr.html"></script>
	<script src="<?=$siteurl;?>/js/jquery.parallax-1.1.3.js"></script>
	<script src="<?=$siteurl;?>/js/owl.carousel.min.js"></script>
	<script src="<?=$siteurl;?>/js/jquery.fancybox.js"></script>
	<script src="<?=$siteurl;?>/js/cubeportfolio.min.js"></script>
	<script src="<?=$siteurl;?>/js/range-Slider.min.js"></script>
	<script src="<?=$siteurl;?>/js/selectbox-0.2.min.js"></script>
	<script src="<?=$siteurl;?>/js/bootsnav.js"></script>
	<script src="<?=$siteurl;?>/js/zelect.js"></script>
	<script src="<?=$siteurl;?>/js/functions.js"></script>

	<!--===== #/REQUIRED JS =====-->
</body>

</html>