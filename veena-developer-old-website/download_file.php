<?
include 'includes_config/db.config.class.php';
header('Content-Type:application:json');
session_start();
if(isset($_POST['mode']) || !empty($_POST['mode'])){
     $curl = curl_init();
	if($_POST['mode']=='down'){
     $title = $_POST['title'];
	 $downid = $_POST['downid'];
	 $name = $_POST['name'];
	 $mobile = $_POST['mobile'];
	 $email = $_POST['email'];
     $pname = $_POST['pname'];
	 $mes = $_POST['message'];	
     $project = $pname.'-'.$title;
     
     $curl = curl_init();
//$name='lorum ipsum';
//$mobile='2200221144';
//$email='lfok_890@gmail.ccmv';
//$project='Veena Signature';
/*$sqlQueryAdd = "INSERT INTO `msp_enquiry_project` (`projectname`,`name`,`mobile`,`email`)VALUES ('$project','$name','$mobile','$email')";
            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : " . mysql_error());*/
$exid=date('Ymdhms');
$ldate=date('m/d/Y');
$data=array(
  "firstName"=>$name,
  "lastName"=> "",
  "email"=> $email,
  "mobilePhone"=> $mobile,
  "leadDate"=> $ldate,
  "comments"=>$project,
  "originFrom"=> "",
  "product"=> $pname,
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


     
	$ProjectDownloadsData = $ProjectDownload->GetProjectDownloadDetails($downid);
	  $ProjectDownloadTitle = $ProjectDownloadsData["msp_title"];
	  $ProjectCurrentStatusImages2 = $ProjectDownloadsData["msp_image2"];
	
	  $sqlQueryAdd = "INSERT INTO `msp_enquiry_download` (`project_title`,`project_name`,`name`,`mobile`,`email`)VALUES ('$pname','$title','$name','$mobile','$email')";

   	$sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ");
    $filepath = "images/download_images/pdf/".$ProjectCurrentStatusImages2;
   

    // Process download
    if(file_exists($filepath)) {
          //mail essentials
       $from1 =  "info@veenadevelopers.com";
       $to1 = $email;
       $replyto1 = "info@veenadevelopers.com";
  
        $from =  "info@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
       $replyto = "info@veenadevelopers.com";
  
  
    $message = "Name : " . $name . "<br/>";
	$message .= "Contact Number : " . $mobile . "<br/>";
	$message .= "Email Id : " . $email . "<br/>";
	$message .= "Message : " . $mes . "<br/>";
   
       $message1 = $siteurl."/".$filepath;
       $message2 .= "<a href=". $message1 . " target='_blank'>Download Brochure</a> ";
       
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$subject = "Request For ". $title .$pname;
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers) && mail($to1, $subject,$message2,$headers)) {
         $_SESSION["link"] = $message2;
         if($err){
             header("Location: $siteurl/thank-you2.php?msg=$response");
         }else{
             header("Location: $siteurl/thank-you.php?msg=$response");
         }
         
 
       }
       else {
           header("Location: $siteurl");
       }
        
        
        
        
        
    }else{
	    header("Location: $siteurl/projects");
    }
    
    
    
    
	}
	
}

?>