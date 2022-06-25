<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
include 'resize.php';

if (isset($_POST["mode"]))
{
  
  if($_POST["mode"]=='editproject_plan')
  {
    $ProjectPlanID = prepare_input($_POST["ProjectPlanID"]);
    $title = prepare_input($_POST["title"]);
    $status = prepare_input($_POST["status"]);
    
    
    $image = $_FILES['image']['name'];
    if ($image)
    {
        $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        
        if ($extension != "jpg" AND $extension != "gif" AND $extension != "png")
        {
            $action = "extension";
        }
        else
        { 
            $img_title = _prepare_url_text($title);
            $img_title = strtolower($img_title);          
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name=time().'.'.$extension;
            $upload_path = "../images/plan_images/";
            $imagename = $img_title."-plan-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
            
            $image_name =  "../images/plan_images/".$imagename; 
            $size = getimagesize($image_name);
            $height = $size[1];
            $width = $size[0];
        
            if ($width > 800)
            {
                $image = new SimpleImage();
                $image->load($image_name);
                $image->resizeToWidth(800);
                $image->save($image_name);
            }


            $img_title = _prepare_url_text($title);
            $img_title = strtolower($img_title);          
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name2=time().'.'.$extension;
            $upload_path2 = "../images/plan_images/resize/";
            $imagename2 = $img_title."-plan-".$image_name2;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path2.$imagename2);
            
            $image_name2 =  "../images/plan_images/resize/".$imagename2; 
            $size = getimagesize($image_name2);
            $height = $size[1];
            $width = $size[0];
        
            if ($width > 300)
            {
                $image = new SimpleImage();
                $image->load($image_name2);
                $image->resizeToWidth(300);
                $image->save($image_name2);
            }

            
        }
    }
    else
    {
       $imagename = $_POST["old_image"];
       $imagename2 = $_POST["old_image2"];
    }
    $sqlQuery = "UPDATE `msp_project_plan` set 
                                `msp_website_id` = '$SessionWebsiteID' ,
                                `msp_title` = '$title' ,
                                `msp_image` = '$imagename' ,
                                `msp_image2` = '$imagename2' ,
                                `msp_status` = '$status'
                                where project_planid = '$ProjectPlanID'";
    $sqlRes = $ProjectPlan->dbquery($sqlQuery) or die("Err : ");


  

    header("Location: project_plan.php?wb=$SessionWebsiteID&action='update'");
    exit();
  }
}
$ProjectPlanID = $_GET["ProjectPlanID"];
$ProjectPlanData = $ProjectPlan->GetProjectPlanDetails($ProjectPlanID);
$title = $ProjectPlanData["msp_title"];
$image = $ProjectPlanData["msp_image"];
$image2 = $ProjectPlanData["msp_image2"];
$status = $ProjectPlanData["msp_status"];
?>
<!DOCTYPE html>
<html lang="en">
<title>Admin <?=$AdminLoggedUserSitename;?> </title>
<? include 'includes-class/files/head_file.php';?>
<body class="page-header-fixed ">
  <? include 'header_file_msp_project.php';?>
<div class="clearfix"> </div>
<div class="page-container">
  <!-- Start page sidebar wrapper -->
<? include 'sidebar_file_msp_project.php';?>
<!-- End page sidebar wrapper -->
<!-- Start page content wrapper -->
<div class="page-content-wrapper animated fadeInRight">
  <div class="page-content" >
    <div class="row wrapper border-bottom page-heading">
      <div class="col-lg-12">
        <h2> Edit Plan </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Plan  </strong> </li>
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
              
          <form id="EditProjectPlanForm" name="EditProjectPlanForm" method="post" enctype="multipart/form-data" action="<?php $PHP_SELF; ?>">
              <input name="mode" id="mode" value="editproject_plan" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
              <input name="old_image2" id="old_image2" value="<?=$image2;?>" type="hidden">
              <input name="ProjectPlanID" id="ProjectPlanID" value="<?=$ProjectPlanID;?>" type="hidden">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Titile"  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="title">Status</label>
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
                
                      <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image"  >
                        <label for=""><b>Image size : </b> 800px / 800px</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image)){ ?> <br> <img src="../images/plan_images/<?=$image;?>" width="150"><? } ?>
                      
                  </div>
                </div>
               
              </div>
               
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project_plan.php?wb=<?=$SessionWebsiteID;?>'">Cancel</button>
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
</body>
</html>
