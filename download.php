<?php
if(isset($_POST['downloadapisubmit']))
{

$curl = curl_init();
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['mobile'];
            $message = $_POST['message'];
     //       $sqlQueryAdd = "INSERT INTO `msp_enquiry_contact` (`name`,`mobile`,`email`,`message`)VALUES ('$name','$phone','$email','$message')";
       //     $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Error : " );
$exid=date('Ymdhms');
$ldate=date('Y-m-d H:m:s');
$data=array(
 "firstName"=>$name, 
 "lastName" => "", 
 "email" => $email, 
 "mobilePhone" => $phone, 
 "leadDate"=> $ldate,
 "comments" => "Website - Floor Plan ", 
 "originFrom" => "Auto Source", 
 "product" => "", 
 "campaign" => "VD Website", 
 "isUpdatefromUIDate" => false,
 "isImported" => true, 
 "DumpdataObjectId" => $exid, 
 "tenantId" => 219
);

//$new[]=$data;
$data2=json_encode($data);

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://farvisioncloud.com/sfasync/api/syncleads/website",
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
  
  header("Location:thankyou.html");
} else {

   header("Location:thankyou.html");
    
   
}

}


?>