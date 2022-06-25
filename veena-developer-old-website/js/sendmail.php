<?php
include 'includes_config/db.config.class.php';
session_start();

if (isset($_POST["mode"]))

{
    //$captcha = $_POST["captcha"];
    //if($_SESSION['security_code'] == $captcha && !empty($_SESSION['security_code'] ) )
    //{

        

        

         

         
         if ($_POST["mode"] == "sendside")
        {


 	        $form_name = $_POST['fname'];
        	$form_email = $_POST['email'];
            $form_phone = $_POST['mobile'];
        	$form_project = $_POST['project'];
        	$form_message = $_POST['message'];
        	
        	
	       $sqlQueryAdd = "INSERT INTO `msp_enquiry_sidebar` (`projectname`,`name`,`mobile`,`email`,`message`)VALUES ('$form_project','$form_name','$form_phone','$form_email','$form_message')";
            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());

	
   //mail essentials
       $from =  "sales@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
       
       $replyto = "sales@veenadevelopers.com";
  
    $message = "Name : " . $form_name . "<br/>";
	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
	$message .= "Project : " . $form_project . "<br/>";
	$message .= "Message : " . $form_message . "<br/>";

      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= 'Cc: sandy.panchal619@gmail.com\r\n';
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$subject = "Schedule a Visit - " . $form_project . "-". date("d-m-Y");
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
           mail($to, $subject,$message,$headers);
         echo $response = 1;
 
       }
       else {
           echo $response = 0;
       }


   }
 if ($_POST["mode"] == "send")
        {

            $form_name = $_POST['name'];
        	$form_email = $_POST['email'];
            $form_phone = $_POST['mobile'];
        	$form_message = $_POST['message'];
        	
        	
	
            $sqlQueryAdd = "INSERT INTO `msp_enquiry_contact` (`name`,`mobile`,`email`,`message`)VALUES ('$form_name','$form_phone','$form_email','$form_message')";

            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
	
   //mail essentials
       //$from =  "sales@veenadevelopers.com";
	   $from =  "info@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
	   //$to = "arunchauhan.email@gmail.com";
       $replyto = "sales@veenadevelopers.com";
  
    $message = "Name : " . $form_name . "<br/>";
	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
	$message .= "Message : " . $form_message . "<br/>";
      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= 'Cc: sandy.panchal619@gmail.com\r\n';
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$subject = "Quick Enquiry";
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
           mail($to, $subject,$message,$headers);
         echo $response = 1;
 
       }
       else {
           echo $response = 0;
       }

}
   
   
    if ($_POST["mode"] == "sendproject")
        {
            $form_project = $_POST['projectname'];
            $form_name = $_POST['name'];
        	$form_email = $_POST['email'];
            $form_phone = $_POST['mobile'];
            $form_message = $_POST['message'];
        	
        	 $sqlQueryAdd = "INSERT INTO `msp_enquiry_project` (`projectname`,`name`,`mobile`,`email`,`message`)VALUES ('$form_project','$form_name','$form_phone','$form_email','$form_message')";

            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
	

	
   //mail essentials
       $from =  "sales@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
       $replyto = "sales@veenadevelopers.com";
  
    $message = "Name : " . $form_name . "<br/>";
    
	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
    $message .= "Message : " . $form_message . "<br/>";
      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= 'Cc: sandy.panchal619@gmail.com\r\n';
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$subject = "$form_project";
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
           mail($to, $subject,$message,$headers);
         echo $response = 1;
 
       }
       else {
           echo $response = 0;
       }
        }
        
        if ($_POST["mode"] == "sendpartner")
        {


 	        $form_name = $_POST['fname'];
 	         $form_identity = $_POST['identity'];
 	         $form_phone = $_POST['mobile'];
        	$form_email = $_POST['email'];
            
        	$form_property = $_POST['property'];
        	$form_locality = $_POST['locality'];
        	$form_transaction = $_POST['transaction'];
        	$form_category_type = $_POST['category_type'];
        	
          $sqlQueryAdd = "INSERT INTO `msp_enquiry_partner` (`name`,`mobile`,`email`,`identity`,`property`,`locality`,`transaction`,`category_type`)VALUES ('$form_name','$form_phone','$form_email','$form_identity','$form_property',$form_locality','$form_transaction','$form_category_type')";
             $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());

	
   //mail essentials
       $from =  "sales@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
       $replyto = "sales@veenadevelopers.com";
  
    $message = "Name : " . $form_name . "<br/>";
    $message .= "Your Identity : " . $form_identity . "<br/>";
	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
	$message .= "Property Title : " . $form_property . "<br/>";
	$message .= "Property Locality : " . $form_locality . "<br/>";
    $message .= "Nature of Transaction : " . $form_transaction . "<br/>";
    $message .= "Category of Development Proposal : " . $form_category_type . "<br/>";
    
      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= 'Cc: sandy.panchal619@gmail.com\r\n';
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
       $subject = "Partner with Us Enquiry";
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
           mail($to, $subject,$message,$headers);
         echo $response = 1;
 
       }
       else {
           echo $response = 0;
       }


   }
   
   
      if ($_POST["mode"] == "sendcareer")
        {

            $form_name = $_POST['fname'];
 	       $form_phone = $_POST['mobile'];
        	$form_email = $_POST['email'];
            
        	$form_message = $_POST['message'];

            $sqlQueryAdd = "INSERT INTO `msp_enquiry_career` (`name`,`mobile`,`email`,`message`)VALUES ('$form_name','$form_phone','$form_email','$form_message')";
             $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());

	
   //mail essentials
       $from =  "sales@veenadevelopers.com";
       $to = "sales@veenadevelopers.com";
       $replyto = "sales@veenadevelopers.com";
  
    $message = "Name : " . $form_name . "<br/>";
  	$message .= "Contact Number : " . $form_phone . "<br/>";
	$message .= "Email Id : " . $form_email . "<br/>";
	$message .= "Message : " . $form_message . "<br/>";
    
      
       //standard mail headers
       $headers = "From: ".$from."\r\n";
       $headers .= "Reply-To: ".$replyto. "\r\n";
       $headers .= 'Cc: sandy.panchal619@gmail.com\r\n';
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
       $subject = "Career: Enquiry Details";
     

   


   

       //sending the mail - message is not here, but in the header in a multi part

       if(mail($to, $subject,$message,$headers)) {
           mail($to, $subject,$message,$headers);
         echo $response = 1;
 
       }
       else {
           echo $response = 0;
       }


   }
   
}

?>