<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='addwebsite')
  {
    $status_id = prepare_input($_POST["status_id"]);
    $type_id = prepare_input($_POST["type_id"]);
    $typology_id = prepare_input($_POST["typology_id"]);
    $city_id = prepare_input($_POST["city_id"]);
    $location_id = prepare_input($_POST["location_id"]);

    $sitename = prepare_input($_POST["sitename"]);

    $siteurlname = prepare_input($_POST["siteurl"]);
    $siteurlname = _prepare_url_text($siteurlname); 
    $siteurlname = strtolower($_POST["siteurl"]);

    $mobile = prepare_input($_POST["mobile"]);
    $phone = prepare_input($_POST["phone"]);
    $email = prepare_input($_POST["email"]);
    $address = prepare_input($_POST["address"]);
    $short_address = prepare_input($_POST["short_address"]);
    $sitecolor = prepare_input($_POST["sitecolor"]);
    $register_no = prepare_input($_POST["register_no"]);

    $show_project = prepare_input($_POST["show_project"]);
    $show_position = prepare_input($_POST["show_position"]);
    $map_top = prepare_input($_POST["map_top"]);
    $map_left = prepare_input($_POST["map_left"]);
    $status = prepare_input($_POST["status"]);

    $logoname = _prepare_url_text($sitename); 
    $logoname = strtolower($logoname);
  

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
          $action = "empty";
      }

        // property 
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
            $action = "empty";
        }
        // property 

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
            $action = "empty";
        }

      $sqlQueryAdd = "INSERT INTO `msp_website` (`website_status_id`,`website_type_id`,`website_typology_id`,`website_city_id`,`website_location_id`,`website_sitename`,`website_url_title`,`website_siteurl`,`website_mobile`,`website_phone`,`website_email`,`website_address`,`website_short_address`,`website_sitelogo`,`website_sitepdf`,`website_image`,`website_show_project`,`website_show_position`,`website_siteregister_no`,`website_map_top`,`website_map_left`,`website_sitecolor`,`website_status`)
                VALUES ('$status_id','$type_id','$typology_id','$city_id','$location_id','$sitename','$siteurlname','$siteurlname','$mobile','$phone','$email','$address','$short_address','$imagename','$imagename2','$imagename3','$show_project','$show_position','$register_no','$map_top','$map_left','$sitecolor','$status')";
      
      $sqlRes = $Website->dbquery($sqlQueryAdd) or die("Err : ");
      header("Location: website.php?action=add");
      exit();

  }
}
?>
<html lang="en">
<title><?=$AdminLoggedUserSitename;?> - admin</title>
<?php include 'includes-class/files/head_file.php';?>
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
        <h2> Add Ongoing Projects </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add Ongoing Projects  </strong> </li>
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

              <form id="AddWebsiteForm" name="AddWebsiteForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="addwebsite" type="hidden">
              <input name="status_id" id="status_id" value="1" type="hidden">

              <div class="row">
                
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="type_id">Project Type

                      
                    </label>
                    <select name="type_id" id="type_id" required class="form-control">
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
                      <option value="<?=$ProjectTypeID;?>"><?=$ProjectTypeTitle;?></option>
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
                      <option value="<?=$TypologyID;?>"><?=$TypologyTitle;?></option>
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
                    <select name="city_id" id="cityid" required class="form-control">
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
                      <option value="<?=$CityID;?>"><?=$CityTitle;?></option>
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
                    <select name="location_id" id="location_id" required class="form-control">
                     
                      
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
                      <option value="<?=$ProjectStatusID;?>"><?=$ProjectStatusTitle;?></option>
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
                    <input class="form-control"  name="sitename" id="sitename" required placeholder="Project Name"  type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="siteurl"> Project Url Name</label>
                    <input class="form-control"  name="siteurl" id="siteurl" required placeholder="Project Url Name"  type="text">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile">Mobile No</label>
                    <input class="form-control"  name="mobile" id="mobile"  placeholder="Mobile No"  type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone No</label>
                    <input class="form-control"  name="phone" id="phone"  placeholder="Phone No"  type="text">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input class="form-control"  name="email" id="email" placeholder="Email Address"  type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="register_no">RERA Reg No</label>
                    <input class="form-control"  name="register_no" id="register_no" placeholder="Register No."  type="text">
                  </div>
                </div>
                
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control"  name="address" id="address" required placeholder=" Address"  type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="short_address">Short Address</label>
                    <input class="form-control"  name="short_address" id="short_address" required placeholder="Short Address"  type="text">
                  </div>
                </div>
              </div>
              <h3>Address Mapping</h3>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="map_top">Top</label>
                    <input class="form-control"  name="map_top" id="map_top" placeholder=" Top"  type="number">
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
                    <input class="form-control"  name="map_left" id="map_left" placeholder=" Left"  type="number">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="logo">Project Logo </label>
                    <input class="form-control"  name="sitelogo" id="sitelogo" required  type="file" accept="image/*">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="logo">Project Register Certificate PDF </label>
                    <input class="form-control"  name="image" id="image"   type="file" accept="application/pdf">
                     <label for="logo">Max Size : 2mb </label>
                  </div>
                </div>
                <!-- <div class="col-md-4">
                  <label class="control-label">Website color  </label>
                    <div class="input-group date form_datetime col-md-12">
                      <input type="text" data-format="hex" class="form-control" name="sitecolor" id="cp8" value="" required />
                    </div>
                </div> -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="logo">Project Image </label>
                    <input class="form-control"  name="image3" id="image3" required  type="file" accept="image/*">
                    <label for="logo">Image Size : 400px / 400px </label>
                  </div>
                </div>

               
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="show_project">Show Home Page</label>
                    <select name="show_project" id="show_project" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-2" id="positionid">
                  <div class="form-group">
                    <label for="show_position">Show Home Position</label>
                    <select name="show_position" id="show_position" class="form-control">
                      <option value="1">Top</option>
                      <option value="2">Center</option>
                      <option value="3">Bottom</option>
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

           // $('#cp8').colorpicker({ colorSelectors: { 'default': '#777777', 'primary': '#337ab7', 'success': '#5cb85c', 'info': '#5bc0de', 'warning': '#f0ad4e', 'danger': '#d9534f' } });
           $('#cp8').colorpicker({ colorSelectors: { '#777777': '#777777', '#337ab7': '#337ab7', '#5cb85c': '#5cb85c', '#5bc0de': '#5bc0de', '#f0ad4e': '#f0ad4e', '#d9534f': '#d9534f' } });

            $('#cp7').colorpicker({ color: '#ffaa00', container: true, inline: true });
    });
</script>

<script type="text/javascript">
 $(document).ready(function(){  
  
      $('#positionid').hide();
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
