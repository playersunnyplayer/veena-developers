<?php
session_start();

if (isset($_POST["apisubmit"])) {
    //$captcha = $_POST["captcha"];
    //if($_SESSION['security_code'] == $captcha && !empty($_SESSION['security_code'] ) )
    //{
        
 	        $form_name = $_POST['name'];
        	$form_email = $_POST['email'];
            $form_phone = $_POST['mobile'];
        	$form_job = $_POST['job'];
            
            $from =  $_POST['email'];
            $to = "hr@veenadevelopers.com";
            $replyto = $_POST['email'];
  
            $message = "Name : " . $form_name . "<br>";
        	$message .= "Contact Number : " . $form_phone . "<br>";
        	$message .= "Email Id : " . $form_email . "<br>";
        	$message .= "Job : " . $form_job . "<br>";

            $headers = "From: ".$from."\r\n";
           // $headers .= 'Cc: ankit.shah@veenadevelopers.com' . "\r\n";
          //  $headers .= 'Cc: hastisanghavi@veenadevelopers.com' . "\r\n";
            $headers .= "Reply-To: ".$replyto. "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            $subject = "Careers - " . $form_job . "-". date("d-m-Y");

            if(mail($to, $subject, $message, $headers)){
                header("Location:thankyou.html");
            } else {
                echo $response = 0;
            }
        }

        
?>