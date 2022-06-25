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
        	
        	
	

	
   //mail essentials
       $from =  "rohit.chandra96@gmail.com";
       $to = "rohit.chandra96@gmail.com";
       
       $replyto = "rohit.chandra96@gmail.com";
  
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
        	
        	
	

	
   //mail essentials
       $from =  "rohit.chandra96@gmail.com";
       
       $to = "rohit.chandra96@gmail.com";
       $replyto = "rohit.chandra96@gmail.com";
  
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
        	
        	
	

	
   //mail essentials
       $from =  "rohit.chandra96@gmail.com";
       $to = "rohit.chandra96@gmail.com";
       $replyto = "rohit.chandra96@gmail.com";
  
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
        	
        

	
   //mail essentials
       $from =  "rohit.chandra96@gmail.com";
       $to = "rohit.chandra96@gmail.com";
       $replyto = "rohit.chandra96@gmail.com";
  
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

        

	
   //mail essentials
       $from =  "rohit.chandra96@gmail.com";
       $to = "rohit.chandra96@gmail.com";
       $replyto = "rohit.chandra96@gmail.com";
  
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