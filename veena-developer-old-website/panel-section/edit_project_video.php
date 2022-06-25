<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';

if (isset($_POST["mode"]))
{
  
  if($_POST["mode"]=='editproject_video')
  {
    $ProjectVideoID = prepare_input($_POST["ProjectVideoID"]);
    $title = prepare_input($_POST["title"]);
    $status = prepare_input($_POST["status"]);
    $video_code = $_POST["video_code"];
    
    
    $sqlQuery = "UPDATE `msp_project_video` set 
                                `msp_website_id` = '$SessionWebsiteID' ,
                                `msp_title` = '$title' ,
                                `msp_video_code` = '$video_code' ,
                                `msp_status` = '$status'
                                where project_videoid = '$ProjectVideoID'";
    $sqlRes = $ProjectVideo->dbquery($sqlQuery) or die("Err : ");


  

    header("Location: project_video.php?wb=$SessionWebsiteID&action='update'");
    exit();
  }
}
$ProjectVideoID = $_GET["ProjectVideoID"];
$ProjectVideoData = $ProjectVideo->GetProjectVideoDetails($ProjectVideoID);
$title = $ProjectVideoData["msp_title"];
$video_code = $ProjectVideoData["msp_video_code"];
$status = $ProjectVideoData["msp_status"];
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
        <h2> Edit Video </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Video  </strong> </li>
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
              
          <form id="EditProjectVideoForm" name="EditProjectVideoForm" method="post" enctype="multipart/form-data" action="<?php $PHP_SELF; ?>">
              <input name="mode" id="mode" value="editproject_video" type="hidden">
              <input name="ProjectVideoID" id="ProjectVideoID" value="<?=$ProjectVideoID;?>" type="hidden">
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
                      <label for="video_code">Video (Youtube url link)</label>
                      <input class="form-control"  name="video_code" id="video_code" value="<?=$video_code;?>" placeholder="Youtube url link"  type="text">
                        
                        <label for=""><b>Eg : </b>https://www.youtube.com/watch?v=QEOQ-a6B2P0</label>
                  </div>
                </div>
               
              </div>
               
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project_video.php?wb=<?=$SessionWebsiteID;?>'">Cancel</button>
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
