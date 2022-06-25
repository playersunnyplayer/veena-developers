<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$servername = 'localhost';
$username = 'veena3oh_dbuser';
$password = 'igD*]e!vYC{y';
$dbname = 'veena3oh_treaser';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_POST["submit"]))

{
    
    
    
    
     

            $name=$_POST['name'];
            $date=date("d-m-Y h:i");
            $mobile=$_POST['mobile'];
            
            $intrested=$_POST['optradio'];

             $sql = "INSERT INTO contact (name, mobile, intrested, date) VALUES ('$name', '$mobile', '$intrested','$date')";

            if ($conn->query($sql) === TRUE) {
   
            //echo "You got it!";

            $strMessageBody = "Contact: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Intrested: $intrested <br><Br>";
           

            $senderemail = "$name"."<noreply@veenadevelopers.com>";


            $subject = "Contact enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";
            

           //hastisanghavi@veenadevelopers.com, ankit.shah@veenadevelopers.com
            if(mail("hastisanghavi@veenadevelopers.com, ankit.shah@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
            mail("hastisanghavi@veenadevelopers.com, ankit.shah@veenadevelopers.com", $subject, $strMessageBody, $mailheaders);
              header('Location: thankyou.php');
                echo 1;
            }else{
                echo 0;
            }
            
         }
//$_SESSION['page_count'] = "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>