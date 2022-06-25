<?php
$code = $_POST['itemCode'];
$email = $_POST['email'];
$to = "enquiry@esikaworld.com";
$subject = "Request For Download";
$message .= "<h2> Request For Download</h2>";
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Item Code:</strong></td><td> ".strip_tags($_POST["itemCode"])."</td></tr>";
$message .= "<tr style='background: #eee;'><td><strong>Email:</strong></td><td> ".strip_tags($_POST["email"])."</td></tr>";
$header = "From:Your Server<sandypanchal619@gmail.com> \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
$retval = mail ($to,$subject,$message,$header);
if( $retval == true )
{
}else
{}
?>