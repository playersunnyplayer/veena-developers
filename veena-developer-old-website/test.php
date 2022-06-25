<?php
include 'includes_config/db.config.class.php';
 $GetWebID=5;
    $ProjectSliderNum = $ProjectSlider->GetProjectSliderByWebsiteNum($GetWebID);
                     echo $ProjectSliderNum;
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
                  /*

$curl = curl_init();
$name='lorum ipsum';
$mobile='2200221144';
$email='lfok_890@gmail.ccmv';
$project='Veena Signature';
/*$sqlQueryAdd = "INSERT INTO `msp_enquiry_project` (`projectname`,`name`,`mobile`,`email`)VALUES ('$project','$name','$mobile','$email')";
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
  "campaign"=> "",
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
  header("Location:../thank-you.php?msg=$response");
}*/
//phpinfo();
?>