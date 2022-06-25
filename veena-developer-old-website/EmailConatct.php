<?php
include 'includes_config/db.config.class.php';
session_start();

if (isset($_POST["mode"]))

{
    //$captcha = $_POST["captcha"];
    //if($_SESSION['security_code'] == $captcha && !empty($_SESSION['security_code'] ) )
    //{

        if ($_POST["mode"] == "send")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];

             $sqlQueryAdd = "INSERT INTO `msp_enquiry_contact` (`name`,`mobile`,`email`,`message`)VALUES ('$name','$mobile','$email','$message')";

            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
         
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
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Message: $message <br><Br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Contact enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }

        if ($_POST["mode"] == "sendproject")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];
            $projectname = $_POST["projectname"];
            $budget = $_POST["budget"];
            $nationality = $_POST["nationality"];

             $sqlQueryAdd = "INSERT INTO `msp_enquiry_project` (`projectname`,`budget`,`nationality`,`name`,`mobile`,`email`,`message`)VALUES ('$projectname','$budget','$nationality','$name','$mobile','$email','$message')";

            $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
         
            //echo "You got it!";

            $strMessageBody = "Project: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Project Name: $projectname <br><Br>";
            $strMessageBody .= "Budget: $budget <br><Br>";
            $strMessageBody .= "Budget: $budget <br><Br>";
            $strMessageBody .= "Nationality: $nationality";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Project enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }

         if ($_POST["mode"] == "sendenquiry")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];
            $project = $_POST["project"];
         
            //echo "You got it!";

            $strMessageBody = "Quick: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Project: $project <br><Br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Quick enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }

         if ($_POST["mode"] == "send")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];
            $project = $_POST["project"];
         
            //echo "You got it!";

            $strMessageBody = "Quick: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Project: $project <br><Br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Quick enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }
         if ($_POST["mode"] == "sendside")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];
            $project = $_POST["project"];
            $location = $_POST["location"];
            $visit_date = $_POST["visit_date"];
            $visit_time = $_POST["visit_time"];
         
             $sqlQueryAdd = "INSERT INTO `msp_enquiry_sidebar` (`projectname`,`location`,`visit_date`,`visit_time`,`name`,`mobile`,`email`,`message`)VALUES ('$project','$location','$visit_date','$visit_time','$name','$mobile','$email','$message')";
             $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
            //echo "You got it!";

            $strMessageBody = "Visit: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Project: $project <br><Br>";
            $strMessageBody .= "Location: $location <br><Br>";
            $strMessageBody .= "Visit Date: $visit_date <br><Br>";
            $strMessageBody .= "Visit time: $visit_time <br><Br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Visit enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }


          if ($_POST["mode"] == "sendcareer")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];

            $qualification = $_POST["qualification"];
            $total_expr = $_POST["total_expr"];
            $corrent_company = $_POST["corrent_company"];
            $dob = $_POST["dob"];
            $designation = $_POST["designation"];
            $address = $_POST["address"];
            $current_location = $_POST["current_location"];
            $skills = $_POST["skills"];
            $resume = $_POST["resume"];

            $sqlQueryAdd = "INSERT INTO `msp_enquiry_career` (`name`,`mobile`,`email`,`message`,`qualification`,`total_expr`,`corrent_company`,`dob`,`designation`,`address`,`current_location`,`skills`,`resume`)VALUES ('$name','$mobile','$email','$message','$qualification','$total_expr','$corrent_company','$dob','$designation','$address','$current_location','$skills','$resume')";
             $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
         
            //echo "You got it!";

            $strMessageBody = "Career: Enquiry Details";
            $strMessageBody .= "<br>";
            
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Qualification: $qualification <br><Br>";
            $strMessageBody .= "Location: $location <br><Br>";
            $strMessageBody .= "total Experience: $total_expr <br><Br>";
            $strMessageBody .= "Current Company: $corrent_company <br><Br>";
            $strMessageBody .= "Birth day: $dob <br><Br>";
            $strMessageBody .= "Designation: $designation <br><Br>";
            $strMessageBody .= "Address: $address <br><Br>";
            $strMessageBody .= "Current Location: $current_location <br><Br>";
            $strMessageBody .= "Skills: $skills <br><Br>";
            $strMessageBody .= "Detailed Resume: $resume <br><Br>";
           
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Career enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            //if(mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders)){
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }
         

        if ($_POST["mode"] == "sendpartner")
        {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $message = $_POST["message"];
            
            $identity = $_POST["identity"];
            $property = $_POST["property"];
            $country = $_POST["country"];
            $state = $_POST["state"];
            $city = $_POST["city"];
            $locality = $_POST["locality"];
            $fsi = $_POST["fsi"];
            $size_property = $_POST["size_property"];
            $transaction = $_POST["transaction"];
            $category_type = $_POST["category_type"];
         
            $sqlQueryAdd = "INSERT INTO `msp_enquiry_partner` (`name`,`mobile`,`email`,`message`,`identity`,`property`,`country`,`state`,`city`,`locality`,`fsi`,`size_property`,`transaction`,`category_type`)VALUES ('$name','$mobile','$email','$message','$identity','$property','$country','$state','$city','$locality','$fsi','$size_property','$transaction','$category_type')";
             $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());
            //echo "You got it!";

            $strMessageBody = "Visit: Enquiry Details";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<u><b>Customer details</b></u>";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Full Name: $name";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Mobile: $mobile";
            $strMessageBody .= "<br><br>";
            $strMessageBody .= "Email: $email";
            $strMessageBody .= "<br>";
            $strMessageBody .= "Identity: $identity <br><Br>";
            $strMessageBody .= "Project: $property <br><Br>";
            $strMessageBody .= "Country: $country <br><Br>";
            $strMessageBody .= "State: $state <br><Br>";
            $strMessageBody .= "City: $city <br><Br>";
            $strMessageBody .= "Locality: $locality <br><Br>";
            $strMessageBody .= "FSI Potential: $fsi <br><Br>";
            $strMessageBody .= "Size Property: $size_property <br><Br>";
            $strMessageBody .= "Transaction: $transaction <br><Br>";
            $strMessageBody .= "Category Type: $category_type <br><Br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<br>";
            $strMessageBody .= "<p> $siteurl <br></p><p>Thank You<br> $sitename </p>";

            $senderemail = "$name"."<$email>";


            $subject = "Visit enquiry details from: $name";
           // $mailheaders = "From: $senderemail\nContent-Type: text/html";
            $mailheaders = "MIME-Version: 1.0" . "\r\n";
            $mailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $mailheaders .= 'From: '.$senderemail. "\r\n";

           
            if(mail("sales@veenadevelopers.com", $subject, $strMessageBody, $mailheaders)){
                //mail("manojsinghpatel61@gmail.com", $subject, $strMessageBody, $mailheaders);
              
                mail("googlelead@yoptions.in", $subject, $strMessageBody, $mailheaders);
                echo $response =1;
            }else{
                echo $response =0;
            }
            
         }







    //}
    //else
    //{
        //echo $response =2;
    //}
       


}
?>