<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='editwebsite')
  {
    $WebsiteID = prepare_input($_POST["WebsiteID"]);
    $status_id = prepare_input($_POST["status_id"]);
    $type_id = prepare_input($_POST["type_id"]);
    $typology_id = prepare_input($_POST["typology_id"]);
    $city_id = prepare_input($_POST["city_id"]);
    $location_id = prepare_input($_POST["location_id"]);

    $register_no = prepare_input($_POST["register_no"]);
    $sitename = prepare_input($_POST["sitename"]);
   
    $siteurlname = prepare_input($_POST["siteurl"]);
  //  $siteurlname = _prepare_url_text($siteurlname); 
    $siteurlname = strtolower($siteurlname);

    $mobile = prepare_input($_POST["mobile"]);
    $phone = prepare_input($_POST["phone"]);
    $email = prepare_input($_POST["email"]);
    $address = prepare_input($_POST["address"]);
    $short_address = prepare_input($_POST["short_address"]);
    $sitecolor = prepare_input($_POST["sitecolor"]);
    $map_top = prepare_input($_POST["map_top"]);
    $map_left = prepare_input($_POST["map_left"]);
    $show_project = prepare_input($_POST["show_project"]);
    $show_position = prepare_input($_POST["show_position"]);
    $status = prepare_input($_POST["status"]);

    $image = $_FILES['sitelogo']['name'];
    if ($image)
    {
        $filename = stripslashes($_FILES['sitelogo']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        
        if ($extension != "jpg" AND $extension != "gif" AND $extension != "png")
        {
            $action = "extension";
        }
        else
        {    
            $logoname = _prepare_url_text($sitename); 
            $logoname = strtolower($logoname);

            $size=filesize($_FILES['sitelogo']['tmp_name']);   
            $image_name=time().'.'.$extension;
            $upload_path = "../images/sitelogo_images/";
            $imagename = $logoname."-logo-".$image_name;
            $copied = copy($_FILES['sitelogo']['tmp_name'], $upload_path.$imagename);
            
            $image_name =  "../images/sitelogo_images/".$imagename; 
            $size = getimagesize($image_name);
            $height = $size[1];
            $width = $size[0];
        
            if ($width > 500)
            {
                $image = new SimpleImage();
                $image->load($image_name);
                $image->resizeToWidth(500);
                $image->save($image_name);
            }
        }
    }
    else
    {
       $imagename = $_POST["old_image"];
    }


    $image3 = $_FILES['image3']['name'];
    if ($image3)
    {
        $filename = stripslashes($_FILES['image3']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        
        if ($extension != "jpg" AND $extension != "gif" AND $extension != "png")
        {
            $action = "extension";
        }
        else
        {    
            $logoname = _prepare_url_text($sitename); 
            $logoname = strtolower($logoname);

            $size=filesize($_FILES['image3']['tmp_name']);   
            $image_name3=time().'.'.$extension;
            $upload_path3 = "../images/sitelogo_images/project/";
            $imagename3 = $logoname."-project-".$image_name3;
            $copied = copy($_FILES['image3']['tmp_name'], $upload_path3.$imagename3);
            
            $image_name3 =  "../images/sitelogo_images/project/".$imagename3; 
            $size = getimagesize($image_name3);
            $height = $size[1];
            $width = $size[0];
        
            if ($width > 400)
            {
                $image = new SimpleImage();
                $image->load($image_name3);
                $image->resizeToWidth(400);
                $image->save($image_name3);
            }
        }
    }
    else
    {
       $imagename3 = $_POST["old_image3"];
    }

    
     // register pdf
      $image = $_FILES['image']['name'];
      if ($image)
      {
          $filename = stripslashes($_FILES['image']['name']);
          $extension = getExtension($filename);
          $extension = strtolower($extension);
          
          if ($extension != "pdf")
          {
              $action = "extension";
          }
          else
          {    
              
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name2=time().'.'.$extension;
            $upload_path2 = "../images/sitelogo_images/pdf/";
            $imagename2 = $logoname."-register-no-".$image_name2;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path2.$imagename2);
            
            $image_name2 =  "../images/sitelogo_images/pdf/".$imagename2; 
            $size = getimagesize($image_name2);
            $height = $size[1];
            $width = $size[0];
        
          }
        }
        else
        {
            $imagename2 = $_POST["old_image2"];
        }
    $sqlQuery = "UPDATE `msp_website` set 
                                `website_status_id` = '$status_id' ,
                                `website_type_id` = '$type_id' ,
                                `website_typology_id` = '$typology_id' ,
                                `website_city_id` = '$city_id' ,
                                `website_location_id` = '$location_id' ,
                                `website_sitename` = '$sitename' ,
                                `website_siteurl` = '$siteurlname' ,
                                `website_url_title` = '$siteurlname' ,
                                `website_mobile` = '$mobile' ,
                                `website_phone` = '$phone' ,
                                `website_email` = '$email' ,
                                `website_address` = '$address' ,
                                `website_short_address` = '$short_address' ,
                                `website_sitecolor` = '$sitecolor' ,
                                `website_sitelogo` = '$imagename' ,
                                `website_sitepdf` = '$imagename2' ,
                                `website_image` = '$imagename3' ,
                                `website_siteregister_no` = '$register_no' ,
                                `website_show_project` = '$show_project' ,
                                `website_show_position` = '$show_position' ,
                                `website_map_top` = '$map_top' ,
                                `website_map_left` = '$map_left' ,
                                `website_status` = '$status'
                                where websiteid = '$WebsiteID'";
    $sqlRes = $Website->dbquery($sqlQuery) or die("Err : ");
    header("Location: website.php?action=update");
    exit();
  }
}
$WebsiteID = $_GET["WebsiteID"];
$WebsiteData = $Website->GetWebsiteDetails($WebsiteID);

$Web_status_id = $WebsiteData["website_status_id"];
$Web_sitename = $WebsiteData["website_sitename"];
$Web_siteurl = $WebsiteData["website_siteurl"];
$Web_mobile = $WebsiteData["website_mobile"];
$Web_phone = $WebsiteData["website_phone"];
$Web_email = $WebsiteData["website_email"];
$Web_address = $WebsiteData["website_address"];
$Web_sitecolor = $WebsiteData["website_sitecolor"];
$Web_sitelogo = $WebsiteData["website_sitelogo"];
$Web_type_id = $WebsiteData["website_type_id"];
$Web_typology_id = $WebsiteData["website_typology_id"];
$Web_city_id = $WebsiteData["website_city_id"];
$Web_location_id = $WebsiteData["website_location_id"];

$Web_sitepdf = $WebsiteData["website_sitepdf"];
$Web_register_no = $WebsiteData["website_siteregister_no"];

$Web_short_address = $WebsiteData["website_short_address"];
$Web_image = $WebsiteData["website_image"];
$Web_show_project = $WebsiteData["website_show_project"];
$Web_show_position = $WebsiteData["website_show_position"];

$Web_map_top = $WebsiteData["website_map_top"];
$Web_map_left = $WebsiteData["website_map_left"];

$Web_status = $WebsiteData["website_status"];
?>
<!DOCTYPE html>
<html lang="en">
<title><?=$AdminLoggedUserSitename;?> - admin</title>
<? include 'includes-class/files/head_file.php';?>
<link href="assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<body class="page-header-fixed ">
  <? include 'header_file_msp.php';?>
<div class="clearfix"> </div>
<div class="page-container">
  <!-- Start page sidebar wrapper -->
<? include 'sidebar_file_msp.php';?>
<!-- End page sidebar wrapper -->
<!-- Start page content wrapper -->
<div class="page-content-wrapper animated fadeInRight">
  <div class="page-content" >
    <div class="row wrapper border-bottom page-heading">
      <div class="col-lg-12">
        <h2> Edit Ongoing Projects </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Ongoing Projects  </strong> </li>
        </ol>
      </div>
    </div>

    <?php
      if ($action == "extension") {
      ?>
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          Please upload only jpg, gif or png extension file.
      </div>
      <?php
      }
      ?>
      <?php
      if ($action == "empty") {
      ?>
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          Please upload only jpg, gif or png extension file.
      </div>
      <?php
      }
      ?>

    <div class="ibox float-e-margins">
            <div class="widgets-container">

              <form id="EditWebsiteForm" name="EditWebsiteForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="editwebsite" type="hidden">
              <input name="old_image" id="old_image" value="<?=$Web_sitelogo;?>" type="hidden">
              <input name="old_image2" id="old_image2" value="<?=$Web_sitepdf;?>" type="hidden">
              <input name="old_image3" id="old_image3" value="<?=$Web_image;?>" type="hidden">
              <input name="WebsiteID" id="WebsiteID" value="<?=$WebsiteID;?>" type="hidden">
              <input name="status_id" id="status_id" value="1" type="hidden">
              <div class="row">
                
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="type_id">Project Type

                      
                    </label>
                    <select name="type_id" id="type_id" class="form-control">
                      <option value="">Select type</option>
                      <?php
                      $ProjectTypeNum = $CMS->GetProjectTypeNum();
                      $ProjectTypeRes = $CMS->GetProjectTypeRes();
                      
                      if ($ProjectTypeNum > 0)
                      {
                        while ($ProjectTypeData = $CMS->dbfetch($ProjectTypeRes))
                        {
                          $ProjectTypeID = $ProjectTypeData["typeid"];
                          $ProjectTypeTitle = $ProjectTypeData["msp_title"];
                        ?>
                      <option value="<?=$ProjectTypeID;?>" <? if($ProjectTypeID==$Web_type_id){ echo 'selected'; } ?>><?=$ProjectTypeTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="typology_id">Project Typology</label>
                    <select name="typology_id" id="typology_id" class="form-control">
                      <option value="">Select Typology</option>
                      <?php
                      
                      $TypologyNum = $CMS->GetProjectTypologyNum();
                      $TypologyRes = $CMS->GetProjectTypologyRes();
                      
                      if ($TypologyNum > 0)
                      {
                        while ($TypologyData = $CMS->dbfetch($TypologyRes))
                        {
                          $TypologyID = $TypologyData["typologyid"];
                          $TypologyTitle = $TypologyData["msp_title"];
                        ?>
                      <option value="<?=$TypologyID;?>" <? if($TypologyID==$Web_typology_id){ echo 'selected'; } ?>><?=$TypologyTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="city_id">Project City</label>
                    <select name="city_id" id="cityid" class="form-control">
                      <option value="">Select type</option>
                      <?php
                      $CityNum = $CMS->GetCityNum();
                      $CityRes = $CMS->GetCityRes();
                      
                      if ($CityNum > 0)
                      {
                        while ($CityData = $CMS->dbfetch($CityRes))
                        {
                          $CityID = $CityData["cityid"];
                          $CityTitle = $CityData["msp_title"];
                        ?>
                      <option value="<?=$CityID;?>" <? if($CityID==$Web_city_id){ echo 'selected'; } ?>><?=$CityTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="location_id">Project Location</label>
                    <select name="location_id" id="location_id" class="form-control">
                      <option value="">Select location</option>
                      <?php
                      $LocationNum = $CMS->GetLocationByCityNum($Web_city_id);
                      $LocationRes = $CMS->GetLocationByCityRes($Web_city_id);
                      
                      if ($LocationNum > 0)
                      {
                        while ($LocationData = $CMS->dbfetch($LocationRes))
                        {
                          $LocationID = $LocationData["locationid"];
                          $LocationTitle = $LocationData["msp_title"];
                        ?>
                      <option value="<?=$LocationID;?>" <? if($LocationID==$Web_location_id){ echo 'selected'; } ?>><?=$LocationTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                
              </div>
               <!-- <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status_id">Project Status</label>
                    <select name="status_id" id="status_id" class="form-control">
                      <option value="">Select type</option>
                      <?php
                      $ProjectStatusNum = $CMS->GetProjectStatusNum();
                      $ProjectStatusRes = $CMS->GetProjectStatusRes();
                      
                      if ($ProjectStatusNum > 0)
                      {
                        while ($ProjectStatusData = $CMS->dbfetch($ProjectStatusRes))
                        {
                          $ProjectStatusID = $ProjectStatusData["statusid"];
                          $ProjectStatusTitle = $ProjectStatusData["msp_title"];
                        ?>
                      <option value="<?=$ProjectStatusID;?>"<? if($ProjectStatusID==$Web_status_id){ echo 'selected'; } ?> > <?=$ProjectStatusTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="sitename"> Project Name</label>
                    <input class="form-control"  name="sitename" id="sitename" value="<?=$Web_sitename;?>" required placeholder=" Project Name"  type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="siteurl"> Project Url Name</label>
                    <input class="form-control"  name="siteurl" id="siteurl" value="<?=$Web_siteurl;?>" required placeholder=" Project Url Name"  type="text">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile">Mobile No</label>
                    <input class="form-control"  name="mobile" id="mobile" value="<?=$Web_mobile;?>" placeholder="Mobile No"  type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone No</label>
                    <input class="form-control"  name="phone" id="phone" value="<?=$Web_phone;?>" placeholder="Phone No"  type="text">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input class="form-control"  name="email" id="email" value="<?=$Web_email;?>" placeholder="Email Address"  type="text">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="register_no">RERA Reg No</label>
                    <input class="form-control" name="register_no" id="register_no" value="<?=$Web_register_no;?>" placeholder="Register No."  type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control"  name="address" id="address" value="<?=$Web_address;?>" placeholder=" Address"  type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="short_address">Short Address</label>
                    <input class="form-control"  name="short_address" id="short_address" value="<?=$Web_short_address;?>" placeholder=" Address"  type="text">
                  </div>
                </div>
              </div>
              <h3>Address Mapping</h3>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="map_top">Top</label>
                    <input class="form-control"  name="map_top" id="map_top" value="<?=$Web_map_top;?>" placeholder=" Top"  type="number">
                  </div>
                </div>
                <!-- <div class="col-md-3">
                  <div class="form-group">
                    <label for="map_botton">Botton</label>
            
                    <input class="form-control"  name="map_botton" id="map_botton" placeholder=" Bottom"  type="number">
                  </div>
                </div> -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="map_left">Left</label>
                    <input class="form-control"  name="map_left" id="map_left" value="<?=$Web_map_left;?>" placeholder=" Left"  type="number">
                  </div>
                </div>
                <!-- <div class="col-md-3">
                  <div class="form-group">
                    <label for="map_right">Right</label>
                    <input class="form-control"  name="map_right" id="map_right" placeholder=" Right"  type="number">
                  </div>
                </div> -->
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="logo">Website Logo </label>
                    <input class="form-control"  name="sitelogo" id="sitelogo"  type="file" accept="image/*">
                    <label for="logo">Keep blank old image </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <img src="../images/sitelogo_images/<?=$Web_sitelogo;?>">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="logo">Project Register Certificate PDF </label>
                    <input class="form-control"  name="image" id="image"  type="file" accept="application/pdf">
                    <label for="logo">Max Size : 2mb </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <? if(!empty($Web_sitepdf)){?> <a href="../images/sitelogo_images/pdf/<?=$Web_sitepdf;?>" target="_blank" style="font-size: 40px; color: #f00;"> <i class="fa fa-file-pdf-o"></i></a> <? }else{ echo "pdf not available";} ?>
                  </div>
                </div>
                <!-- <div class="col-md-4">
                  <label class="control-label" style="background-color: <?=$sitecolor;?>; padding: 0px 5px;">Website color  <span ></span></label>
                    <div class="input-group date form_datetime col-md-12">
                      <input type="text" data-format="hex" class="form-control" name="sitecolor" id="cp8" value="<?=$sitecolor;?>"  required />
                    </div>
                </div> -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Active" <? if($Web_status=='Active'){echo'selected'; } ?> >Active</option>
                      <option value="Inactive" <? if($Web_status=='Inactive'){echo'selected'; } ?> >Inactive</option>
                    </select>
                  </div>
                </div>
                
              </div>

              <div class="row">
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="logo">Project Image</label>
                    <input class="form-control"  name="image3" id="image3"  type="file" accept="image/*">
                    <label for="logo">Image Size : 400px / 400px [Keep blank old image] </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <img src="../images/sitelogo_images/project/<?=$Web_image;?>" width="50%">
                  </div>
                </div>
               

               
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="show_project">Show Home Page</label>
                    <select name="show_project" id="show_project" class="form-control">
                      <option value="No" <? if($Web_show_project=='No'){echo'selected'; } ?> >No</option>
                      <option value="Yes" <? if($Web_show_project=='Yes'){echo'selected'; } ?> >Yes</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-2" id="positionid" <? if($Web_show_project=='No'){ ?> style="display: none;" <? } ?>>
                  <div class="form-group">
                    <label for="show_position">Show Home Position</label>
                    <select name="show_position" id="show_position" class="form-control">
                      <option value="1" <? if($Web_show_position=='1'){echo'selected'; } ?> >Top</option>
                      <option value="2" <? if($Web_show_position=='2'){echo'selected'; } ?> >Center</option>
                      <option value="3" <? if($Web_show_position=='3'){echo'selected'; } ?> >Bottom</option>
                    </select>
                  </div>
                </div>
                
              </div>
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='website.php'">Cancel</button>
              </form>
            </div>
          </div>
          <!-- start footer -->
<?  include 'footer_file_msp.php'; ?>
  </div>
</div>
<!-- Go top -->
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<!-- Go top -->
<? include 'includes-class/files/foot_file.php';?>
<script type="text/javascript" src="assets/js/vendor/bootstrap-colorpicker.js" charset="UTF-8"></script>
<script type="text/javascript">

        $(function () {
           $('#cp1').colorpicker();
           $('#cp2').colorpicker();
           $('#cp3').colorpicker({ color: '#AA3399', format: 'rgba' });
            $('#cp6').colorpicker({ color: "#88cc33", horizontal: true });
            $('#cp4').colorpicker().on('changeColor', function(e) { $('.page-content')[0].style.backgroundColor = e.color.toHex(); });
            $('#cp8').colorpicker({ colorSelectors: { '#777777': '#777777', '#337ab7': '#337ab7', '#5cb85c': '#5cb85c', '#5bc0de': '#5bc0de', '#f0ad4e': '#f0ad4e', '#d9534f': '#d9534f' } });

            $('#cp7').colorpicker({ color: '#ffaa00', container: true, inline: true });
    });
</script>

<script type="text/javascript">
 $(document).ready(function(){  
  
     
      $('#show_project').change(function(){  
         var query = $(this).val(); 
         if(query == 'Yes')  
         {  
            $('#positionid').show();
         }else{
          
            $('#positionid').hide();
         }  
      });  
      
 });  
</script> 
</body>
</html>
