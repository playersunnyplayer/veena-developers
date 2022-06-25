<?php
//error_reporting(E_ALL); ini_set("display_errors", 1);
$msg = "";$headers='';

if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
  $eol="\r\n";
} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
  $eol="\r";
} else {
  $eol="\n";
}


# Message Subject
$emailsubject='Lead for Esika World';

# To mail id
$receiver_mail_id = 'sandypanchal619@gmail.com';

	$code=$_POST['code'];
    $name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$email = $_POST['email'];
	$enquiry = $_POST['enquiry'];
	
	 if($_POST['radio2']=='Yes'){
		$ac= 'Yes';
	}else if($_POST['radio2']=='No'){
		$ac='No';
	}
	 
	 
	   if($_POST['radio3']=='Yes'){
		$ac= 'Yes';
	}else if($_POST['radio3']=='No'){
		$ac='No';
	}
	
	
# Message Body
ob_start();
require("mail-content.html");
$body=ob_get_contents(); ob_end_clean();
	 
$body = str_replace('<code>', $code, $body);
$body = str_replace('<name>', $name, $body);
$body = str_replace('<mobile>', $mobile, $body);
$body = str_replace('<city>', $city, $body);
$body = str_replace('<state>', $state, $body);
$body = str_replace('<country>', $country, $body);
$body = str_replace('<email>', $email, $body);
$body = str_replace('<enquiry>', $enquiry, $body);
 

	 
/*   $body = "From: 
		 Name : $name<br/>
         Email :  $email<br/> 
		 Mobile : $mobile<br/>
		 Age : $age<br/>
		 City : $city<br/>
		 State : $state<br/>
		 Employment : $employment<br/>";*/
		 
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', '465');
ini_set('sendmail_from', 'contact@theinspium.com');
ini_set('username','contact@theinspium.com');
ini_set('password','inspium23');


# Common Headers
$mime_boundary=md5(time());
$headers .= 'From:'.$name.$eol;
$headers .= 'Subject: '.$emailsubject.$eol;
$headers .= 'Cc: sandy.panchal619@gmail.com' .$eol;
//$headers .= 'Bcc: kamatapurva23@gmail.com' .$eol;
$headers .= 'Reply-To: Webmaster <webmaster@veenadevelopers.com>' .$eol;
$headers .= 'Return-Path: Webmaster <webmaster@veenadevelopers.com>'.$eol;       
$headers .= "Message-ID: <".$mime_boundary."TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
$headers .= "X-Mailer: PHP v".phpversion().$eol;                                

# Boundry for marking the split & Multitype Headers
$headers .= 'MIME-Version: 1.0'.$eol;
$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol;
$headers .= "Content-length:".strlen($body).$eol;

# Setup for text OR html
$msg .= "Content-Type: multipart/alternative".$eol;

# HTML Version
$msg .= "--".$mime_boundary.$eol;
$msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
$msg .= "Content-Transfer-Encoding: 8bit".$eol;
$msg .= $body.$eol.$eol;

# Finished
$msg .= "--".$mime_boundary."--".$eol.$eol;   // finish with two eol's for better security. see Injection.

# SEND THE EMAIL


@ini_set(sendmail_from,'.webmaster@veenadevelopers.com');  // the INI lines are to force the From Address to be used !
//echo phpinfo();die();

$sent = mail($receiver_mail_id, $emailsubject, $msg, $headers);
@ini_restore(sendmail_from);

if($sent){
    
	header("location:acknowledgement.html");
} else {
    echo 'failure';
}
?>