<?php
include 'includes_config/db.config.class.php';
session_start();

if (isset($_POST["mode"]))

{
    if ($_POST["mode"] == "sendcareer")
        {

            $form_name = $_POST['fname'];
 	       $form_phone = $_POST['mobile'];
        	$form_email = $_POST['email'];
            
        	$form_message = $_POST['message'];

            $sqlQueryAdd = "INSERT INTO `msp_enquiry_career` (`name`,`mobile`,`email`,`message`)VALUES ('$form_name','$form_phone','$form_email','$form_message')";
            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());

	
   //mail essentials
       $from =  "info@veenadevelopers.com";
    $to = "sales@veenadevelopers.com";
       $replyto = "sales@veenadevelopers.com";
  
  
    $message = "Name : " . $form_name . "<br/>";
  	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
	$message .= "Message : " . $form_message . "<br/>";
    
      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= 'bcc: rohit.chandra96@gmail.com\r\n';
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
       $subject = "Career: Enquiry Details";
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
          
       echo $response = 1;
      // echo "test";
 
       }
       else {
           echo $response = 0;
       }


   }
}
?>