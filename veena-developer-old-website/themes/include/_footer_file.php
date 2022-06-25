<?php
if(isset($_POST['apifootersubmit']))
{
$curl = curl_init();
 $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['mobile'];
            $message = $_POST['message'];
            $sqlQueryAdd = "INSERT INTO `msp_enquiry_contact` (`name`,`mobile`,`email`,`message`)VALUES ('$name','$phone','$email','$message')";
            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Error : " );
$exid=date('Ymdhms');
$ldate=date('m/d/Y');
$data=array(
  "firstName"=>$name,
  "lastName"=> "",
  "email"=> $email,
  "mobilePhone"=> $phone,
  "leadDate"=> $ldate,
  "comments"=>"Website - Quick Enquiry",
  "originFrom"=> "",
  "product"=> "",
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
<footer id="footer" class="footer divider layer-overlay overlay-dark-8">
		<div class="container pt-70">
		  <div class="row border-bottom">
			<div class="col-sm-6 col-md-4">
			  <div class="widget dark">
				<h4 class="widget-title">Contact Details</h4>
				<div class="small-title">
				  <div class="line1 background-color-white"></div>
				  <div class="line2 background-color-white"></div>
				  <div class="clearfix"></div>
				</div>
				<?php
				$TableName = 'msp_contact_us';
				if($TableName == 'msp_contact_us'){
				$PageInfo = $CMS->GetPageInfo($TableName);
				$contact_us_contents = $PageInfo["contents"];
				echo    $contact_us_contents = str_replace("|", "'", $contact_us_contents);
			  }
				?>
				
			  <ul class="headerSocialIcons">
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconFb"><a href="https://www.facebook.com/VeenaDevelopers/" target="_blank"><i class="fa fa-facebook" style="font-family: FontAwesome !important;"></i></a></li>
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconTw"><a href="https://twitter.com/veena_developer" target="_blank"><i class="fa fa-twitter" style="font-family: FontAwesome !important;"></i></a></li>
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconIns"><a href="https://www.instagram.com/veena_developers/" target="_blank"><i class="fa fa-instagram" style="font-family: FontAwesome !important;"></i></a></li>
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconLikedin"><a href="https://www.linkedin.com/company/veenadevelopers-mumbai " target="_blank"><i class="fa fa-linkedin" style="font-family: FontAwesome !important;"></i></a></li>
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconYt"><a href="https://www.youtube.com/channel/UCmr89-vfqKfwJ9Eb-gtqOuA" target="_blank"><i class="fa fa-youtube" style="font-family: FontAwesome !important;"></i></a></li>
				  <li class="m-0 pl-10 pr-10 padding10 headerIcons headerIconWt"><a href="https://wa.me/918055590590?text=I'm%20interested%20to%20know%20about%20your%20project%20(Project%20Name)" target="_blank"><i class="fa fa-whatsapp" style="font-family: FontAwesome !important;"></i></a></li>
			  </ul>
				
			  </div>
			</div>
			<div class="col-sm-6 col-md-2">
			  <div class="widget dark">
				<h4 class="widget-title">Quick Links</h4>
				<div class="small-title">
				  <div class="line1 background-color-white"></div>
				  <div class="line2 background-color-white"></div>
				  <div class="clearfix"></div>
				</div>
				<ul class="list angle-double-right list-border">
				  <li> <a href="<?=$siteurl;?>">Home </a></li>
				  <li> <a href="<?=$siteurl;?>/about-us">About Us </a></li>
				  <li> <a href="<?=$siteurl;?>/news-room">News Room </a></li>
				  <li><a href="<?=$siteurl;?>/partner-with-us"> Partner with Us</a></li>
				  <li><a href="<?=$siteurl;?>/blog">Blog </a></li>
				  <li><a href="<?=$siteurl;?>/csr">CSR</a></li>
				  <li><a href="#" id='disclaimerPopup'>Disclaimer</a></li>
				</ul>
			  </div>
			</div>
			<div class="col-sm-6 col-md-6">
			  <div class="widget dark">
				<h4 class="widget-title"> Quick Enquiry</h4>
				<div class="small-title">
				  <div class="line1 background-color-white"></div>
				  <div class="line2 background-color-white"></div>
				  <div class="clearfix"></div>
				</div>
				<div class="mb20">
				  <div id="alert_message"></div>
					  <form class="padding-top-30"  id="ContactForm" name="ContactForm" method="post" action="" >
					   <input type="hidden" name="mode" id="mode"  value="send">
					  
					<div class="col-sm-6 padding10">
						<input class="search " name="name" id="name" rquired placeholder="Name" type="text">
					</div>
					<div class="col-sm-6 padding10">
						<input class="search " name="mobile" id="mobile" rquired placeholder="Mobile No" type="text" maxlength="10">
					</div>
					<div class="col-sm-12 padding10">
						<input class="search " name="email" id="email" rquired placeholder="Email ID" type="text">
					</div>
					<div class="col-md-12 padding10" >
						<textarea class="form-control" rows="4" placeholder="Message" name="message" id="comment"></textarea>
					</div>
				   <!-- <div class="col-md-12 padding10" style="padding:5px 15px;">
						<div id="rock">
								  
									   <div class="g-recaptcha" data-sitekey="6Lesf5kUAAAAAF9ryJxElyUB0DU7iA7oGu0MoLoZ"></div>
									  <input type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">
						  
							  </div>
					</div>-->
				   <!-- <div class="col-md-12 padding10">
					  <input class="search " name="message" id="message" rquired placeholder="Your Message" type="text">
					</div>-->
					<!--<div class="col-md-3 padding10">
												
													 <img src="$siteurl;?>/CaptchaSecurityImages.php?width=100&height=30&characters=5"><br>
												 
												  
											  </div>
												 <div class="col-md-5 padding10">
											   
													<input type="text" class="search" name="captcha" id="captcha" required placeholder="Enter Captcha code" value="" />
												  
											  </div>-->
					<div class="col-md-4" style="padding-top: 10px;">
					  <button type="submit" class="btn_fill" id="apifootersubmit" name="apifootersubmit">Submit</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="footer-bottom bg-black-333">
		  <div class="container">
			<div class="row">
			  <div class="col-md-6 col-sm-5">
				<p class="font-11 text-black-777 m-0 copy-right">Copyright <i class="fa fa-copyright" aria-hidden="true"></i> <?php $years = date('Y'); if($years > 2018){ echo "2018 - ".$years;}else{ echo $years; }  ?> <a href="#."><span class="color_red"><?=$sitename;?></span></a>. All Rights Reserved</p>
			  </div>
			  <div class="col-md-6 col-sm-7 text-right">
				<div class="widget no-border m-0">
				  <ul class="list-inline sm-text-center mt-5 font-12">
				   
				  </ul>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		
		  <div class="modal fade" id="onload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="vertical-alignment-helper">
				  <div class="modal-dialog modal-lg">
	  
					  <!-- Modal content-->
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">×</button>
							  <h4 class="modal-title">Disclaimer</h4>
						  </div>
						  <div class="modal-body"> <?=$contents2;?><br>
							<input type="Checkbox"  data-dismiss="modal">I Agree.
						  </div>
						  <div class="modal-footer">
							
							  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>-->
						  </div>
					  </div>
				  </div>
			  </div>
		  </div>
	  
		<script src='https://www.google.com/recaptcha/api.js'></script>
	  </footer>
