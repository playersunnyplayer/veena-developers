<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
include 'resize.php';

if (isset($_POST["mode"]))
{
  
  if($_POST["mode"]=='editproject_current_status')
  {
    $ProjectCurrentStatusID = prepare_input($_POST["ProjectCurrentStatusID"]);
   // $month_year = prepare_input($_POST["month_year"]);
    //$mdate = formatdateYearMonthDateDate($month_year);
    //$mmyydate = formatdateYearMonthDate($month_year);
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
            $upload_path = "../images/current_status_images/";
            $imagename = $img_title."-current_status-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
            
            $image_name =  "../images/current_status_images/".$imagename; 
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

            //resize
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name2=time().'.'.$extension;
            $upload_path2 = "../images/current_status_images/resize/";
            $imagename2 = $img_title."-current_status-".$image_name2;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path2.$imagename2);
            
            $image_name2 =  "../images/current_status_images/resize/".$imagename2; 
            $size = getimagesize($image_name2);
            $height = $size[1];
            $width = $size[0];
        
            if ($width > 400)
            {
                $image = new SimpleImage();
                $image->load($image_name);
                $image->resizeToWidth(400);
                $image->save($image_name);
            }
        }
    }
    else
    {
       $imagename = $_POST["old_image"];
       $imagename2 = $_POST["old_image2"];
    }
    $sqlQuery = "UPDATE `msp_project_current_status` set 
                                `msp_website_id` = '$SessionWebsiteID' ,
                                `msp_title` = '$title' ,
                                `msp_image` = '$imagename' ,
                                `msp_image2` = '$imagename2' ,
                                `msp_status` = '$status'
                                where project_current_statusid = '$ProjectCurrentStatusID'";
    $sqlRes = $ProjectCurrentStatus->dbquery($sqlQuery) or die("Err : ");


  

    header("Location: project_current_status.php?wb=$SessionWebsiteID&action='update'");
    exit();
  }
}
$ProjectCurrentStatusID = $_GET["ProjectCurrentStatusID"];
$ProjectCurrentStatusData = $ProjectCurrentStatus->GetProjectCurrentStatusDetails($ProjectCurrentStatusID);
$title = $ProjectCurrentStatusData["msp_title"];
$image = $ProjectCurrentStatusData["msp_image"];
$image2 = $ProjectCurrentStatusData["msp_image2"];
$status = $ProjectCurrentStatusData["msp_status"];
$month_year = $ProjectCurrentStatusData["msp_month_year"];
?>
<!DOCTYPE html>
<html lang="en">
<title>Admin <?=$AdminLoggedUserSitename;?> </title>
<? include 'includes-class/files/head_file.php';?>
<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />
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
        <h2> Edit Current Status </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Current Status  </strong> </li>
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
              
          <form id="EditProjectCurrentStatusForm" name="EditProjectCurrentStatusForm" method="post" enctype="multipart/form-data" action="<?php $PHP_SELF; ?>">
              <input name="mode" id="mode" value="editproject_current_status" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
              <input name="old_image2" id="old_image2" value="<?=$image2;?>" type="hidden">
              <input name="ProjectCurrentStatusID" id="ProjectCurrentStatusID" value="<?=$ProjectCurrentStatusID;?>" type="hidden">
              <div class="row">
                <div class="col-md-6" style="display:none">
                  <div class="form-group">
                    <label for="dtp_input2" class="col-md-12 control-label">Date </label>
                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                      data-link-format="yyyy-mm-dd">
                      <input class="form-control" size="16" name="month_year" value="<?=$month_year;?>" required type="text" readonly>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input2" value="" required />
                    <br/>
                  </div>
                </div>
              </div>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" required value="<?=$title;?>" placeholder="Titile"  type="text">
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
                   <? if(!empty($image)){ ?> <br> <img src="../images/current_status_images/<?=$image;?>" width="150"><? } ?>
                      
                  </div>
                </div>
               
              </div>
               
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project_current_status.php?wb=<?=$SessionWebsiteID;?>'">Cancel</button>
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
<script type="text/javascript" src="assets/js/vendor/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="assets/js/vendor/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
  $('.form_date').datetimepicker({
        language:  'inr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>
</body>
</html>
