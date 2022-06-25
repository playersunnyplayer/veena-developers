<?

include 'includes-class/db.config.class.php';

include 'sessions_file.php';



if (isset($_POST["mode"]))

{



    // admin setting

    if ($_POST["mode"] == "addmode")

    {

        



        $siteusername = prepare_input($_POST["username"]);

        $sitefirstname = prepare_input($_POST["firstname"]);

        $sitelastname = prepare_input($_POST["lastname"]);

        $siteemail = prepare_input($_POST["email"]);

        $siteemail2 = prepare_input($_POST["siteemail2"]);

        $sitephone = prepare_input($_POST["phone"]);

        $sitemobile = prepare_input($_POST["mobile"]);

        $sitewhatsapp = prepare_input($_POST["whatsapp"]);

        $sitename = prepare_input($_POST["name"]);

        $siteurl = prepare_input($_POST["siteurl"]);

        $siteaddress = prepare_input($_POST["address"]);

        $siteaddress2 = prepare_input($_POST["address2"]);



        $sqlQuery = "UPDATE `msp_admin` set

                    `admin_username` = '$siteusername' ,

                    `admin_firstname` = '$sitefirstname' ,

                    `admin_lastname` = '$sitelastname' ,

                    `admin_address` = '$siteaddress' ,

                    `admin_address2` = '$siteaddress2' ,

                    `admin_email` = '$siteemail' ,

                    `admin_email2` = '$siteemail2' ,

                    `admin_phone` = '$sitephone' ,

                    `admin_mobile` = '$sitemobile' ,

                    `admin_whatsapp` = '$sitewhatsapp' ,

                    `admin_sitename` = '$sitename' ,

                    `admin_siteurl` = '$siteurl' where adminid='$AdminLoggedUserID'";

        $sqlRes = $Admin->dbquery($sqlQuery) or die("Err");

     

        echo '<div class="alert alert-success" id="MessageID" > <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Success! </strong>Successfully updated details. </div>';



        //echo $response = 1;



     

       //header("Location: thankyou.html");

      // exit();



      



    } 



    if ($_POST["mode"] == "addchangepassw")

    {



        $current_password = prepare_input($_POST["current_password"]);

        $sitepassword = prepare_input($_POST["password"]);

        $admin_pass_md_word = md5($sitepassword);



        $PasswordCheckNum = $Admin->ValidateAdminPassword($admin_username, $current_password);

        if ($PasswordCheckNum == 0)

        {

           echo $response = 0;     

        }

        else

        {



            $sqlQuery = "UPDATE `msp_admin` set

                        `admin_password` = '$sitepassword' ,

                        `admin_pass_md_word` = '$admin_pass_md_word'

                        where adminid = '$AdminLoggedUserID'";

            $sqlRes = $Admin->dbquery($sqlQuery) or die("Err");

         

            //echo '<div class="alert alert-success" id="MessageID" > <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Success! </strong>Successfully updated details. </div>';

            echo $response = 1; 

        }



    }



    if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    //Get all state data
    $cityid = $_POST["city_id"];
     $LocationNum = $CMS->GetLocationByCityNum($cityid);
      $LocationRes = $CMS->GetLocationByCityRes($cityid);
      
      if ($LocationNum > 0)
      {
        echo '<option value="">Select location</option>';
        while ($LocationData = $CMS->dbfetch($LocationRes))
        {
          $LocationID = $LocationData["locationid"];
          $LocationTitle = $LocationData["msp_title"];
        ?>
        <option value="<?=$LocationID;?>"><?=$LocationTitle;?></option>
      <?
        }

      }
        else
        {
            echo '<option value="">city not available</option>';
        }
    
    }




}

?>