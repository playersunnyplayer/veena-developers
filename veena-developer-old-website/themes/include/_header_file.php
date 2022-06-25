<?php
if(isset($_POST['apisidesubmit']))
{
$curl = curl_init();
$name=$_POST['fname'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$project=$_POST['project'];
$projectname=$_POST['projectname'];
$form_message = $_POST['message'];
$sqlQueryAdd = "INSERT INTO `msp_enquiry_sidebar` (`projectname`,`name`,`mobile`,`email`,`message`)VALUES ('$project','$name','$mobile','$email','$form_message')";
$sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ");
$exid=date('Ymdhms');
$ldate=date('m/d/Y');
$data=array(
  "firstName"=>$name,
  "lastName"=> "",
  "email"=> $email,
  "mobilePhone"=> $mobile,
  "leadDate"=> $ldate,
  "comments"=>"Website - Schedule a Visit",
  "originFrom"=> "",
  "product"=> $projectname,
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
  //header("Location:../thank-you.php?val=$response");
  echo "<script> window.location.href = '../thank-you' </script>";
}
}


?>

<a href="#." class="back-to"><i class="icon-arrow-up2"></i></a>
<!-- BACK TO TOP -->
<!-- HEADER -->
<style>
  
</style>
<header id="main_header">
  <nav class="navbar navbar-default navbar-sticky bootsnav">
    <div class="headicon">
        <div class="container">
            <div class="row">
                <ul class="headerSocialIcons">
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconFb"><a href="https://www.facebook.com/VeenaDevelopers/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconTw"><a href="https://twitter.com/veena_developer" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconIns"><a href="https://www.instagram.com/veena_developers/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconLikedin"><a href="https://www.linkedin.com/company/veenadevelopers-mumbai " target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconYt"><a href="https://www.youtube.com/channel/UCmr89-vfqKfwJ9Eb-gtqOuA" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconWt"><a href="https://wa.me/918055590590?text=I'm%20interested%20to%20know%20about%20your%20project%20(Project%20Name)" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                </ul>
                
                <div class="topRight">
					<div class="headerSMSNum">&nbsp;</div>
                    <strong class="headerPhone_desktop">Call Us:</strong><a href="tel:+91-8767351351" class="headerPhone"> <i class="fa fa-phone" style="font-family: FontAwesome !important;"></i> +91 8767-351-351</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
      <div class="row">
        <div class="col-md-2"> <a href="<?=$siteurl;?>" ><img src="<?=$siteurl;?>/images/<?=$sitelogo;?>" alt="<?=$sitename;?>" class="headerLogo"/></a> </div>
        <div class="col-md-10">
          <!-- Start Header Navigation -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i></button>
          </div>
          <!-- End Header Navigation -->
          <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav pull-right" data-in="fadeInDown" data-out="fadeOutUp">
              <li><a class="hvr-overline-from-center" href="<?=$siteurl;?>">HOME</a></li>
              <li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/about-us">ABOUT US</a></li>
              <li class="dropdown menu"><a class="dropdown-toggle" data-toggle="dropdown" href="JavaScript:Void(0);">PROJECTS</a>
               <ul class="dropdown-menu menu-content" role="menu">
              <li class="dropdown menu"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Residential</a>
                 <ul class="dropdown-menu menu-content" role="menu">
                       <li><a href="<?=$siteurl;?>/residential-ongoing-projects">Ongoing</a></li>
                      <li><a href="<?=$siteurl;?>/residential-upcoming-projects">Upcoming</a></li>
                       <li><a href="<?=$siteurl;?>/residential-completed-projects">Completed</a></li>
                </ul>
              </li>
                
              <li class="dropdown menu"><a class=" dropdown-toggle" data-toggle="dropdown" href="#">Commercial</a>
                 <ul class="dropdown-menu menu-content" role="menu">
                     <li><a href="<?=$siteurl;?>/commercial-ongoing-projects">Ongoing</a></li>
                      <li><a href="<?=$siteurl;?>/commercial-upcoming-projects">Upcoming</a></li>
                       <li><a href="<?=$siteurl;?>/commercial-completed-projects">Completed</a></li>
                     </ul>
              </li>
              </ul>
              </li>
              <li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/csr">CSR</a></li>
              <li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/careers">CAREERS</a></li>
              <li><a class="hvr-overline-from-center" href="#footer">Contact Us</a></li>
              <li><a href="tel:02261069800" class="headerPhone_menu headerPhone_desktop"> <i class="fa fa-phone"></i> 022-61069800</a></li>
              <!--<li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/news-room">NEWS ROOM</a></li>-->
              
              <!--<li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/partner-with-us"> PARTNER WITH US</a></li>-->
              
              <!-- <li><a class="hvr-overline-from-center" href="<?=$siteurl;?>/buyers-guide">BUYER’S GUIDE</a></li> -->
            </ul>
		  </div>
		  
			<div class="headerPhone_mobile"><a href="tel:02261069800" class="headerPhone"> <i class="fa fa-phone"></i> 022-61069800</a></div>
        </div>
      </div>
    </div>
  </nav>
</header>
<ul class="stick">
  <a data-toggle="modal" data-target="#squarespaceModal"><li><img src="<?=$siteurl;?>/images/visit.jpg"></li></a>
</ul>
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h3 class="modal-title" id="lineModalLabel">Schedule a Visit</h3>
          <p>Please fill in the details to schedule a visit for the desired project/location.</p>
        </div>
        <div class="modal-body">
          
          <!-- content goes here -->
          <div class="row checkout-area" style="padding: 0px 30px;">
           <div id="alert_message_head"></div>
            <form  class="callus padding-bottom"   id="SidebarEnquiryForm" name="SidebarEnquiryForm" method="post" action="" >
              <input type="hidden" name="mode" id="mode"  value="sendside">
              
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
                  <input type="email" class="keyword-input" placeholder="E-Mail" name="email" id="email" required>
                </div>
              </div>
               <div class="col-md-6">
                <div class="single-query">
                  <input type="text" class="keyword-input" placeholder="Mobile" name="mobile" id="mobile" maxlength="10" required>
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="single-query">
                  <div class="intro">
                    <select name="project" id="project">
                      <option selected="" value="">Project</option>
                      <?php
                      $WebsiteEnuqiryRes = $Website->GetWebsiteRes();
                      
                      while ($WebsiteEnuqiryData = $Website->dbfetch($WebsiteEnuqiryRes))
                      {
                      
                      $WebsiteName = $WebsiteEnuqiryData["website_sitename"];
                      ?>
                      <option value="<?=$WebsiteName;?>"><?=$WebsiteName;?></option>
                      <?php
                      
                      }
                      ?>
                      <option value="Veena Samrajya">Veena Samrajya</option>
                      
                    </select>
                    <input type="text" name="projectname"id='projectname' style="display:none">
                  </div>
                </div>
              </div>
          
              <div class="col-md-12">
                <div class="single-query">
                  
                  <textarea class="form-control" rows="5" name="message" placeholder="Message" id="comment" style="height:100px;"></textarea>
                </div>
              </div>
         <div class="col-md-12">
              <div class="single-query">
                  <?php
  $no1=rand(1,9);
  $no2=rand(2,9);
  ?>     
	 
   <input type="hidden" name="hidTotal" id="hidTotal" value="<?=$no1+$no2?>">						<div class="col-md-3"><label>Captcha: </label></div>
   <div class="col-md-3" style="text-align:right;padding-top:10px;font-weight:bold"><?=$no1?> + <?=$no2?>=</div>
   <div class="col-md-6"><input type="tel" name="captcha" id="captcha" class="form-control required number" placeholder=""   ></div>
					
			   
			   </div>
			   </div>
              <div class="col-md-12">
                <button type="submit" class="btn_fill" name="apisidesubmit"id="apisidesubmit" >SEND</button>
              </div>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>