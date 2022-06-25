<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
include 'resize.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='addproject_current_status')
  {
    
     $month_year = prepare_input($_POST["month_year"]);
     $mdate = formatdateYearMonthDateDate($month_year);
     $mmyydate = formatdateYearMonthDate($month_year);

     $title = prepare_input($_POST["title"]);
     $status = prepare_input($_POST["status"]);
  
    


          $i = 0;
          while(list($key,$image) = each($_FILES[image][name]))
          {
            if(!empty($image))
            {   // this will check if any blank field is entered
              $filename = $image;    // filename stores the value
              $filename = stripslashes($filename);
              $filename = strtolower($filename);
              $filename=str_replace(" ","-",$filename);
              $extension = getExtension($filename);
              $extension = strtolower($extension);

              if ($extension != "jpg" AND $extension != "jpeg" AND $extension != "gif" AND $extension != "png")
              {
                $action = "extension";
              }
              else
              {
                  $img_title = _prepare_url_text($title);
                  $img_title = strtolower($img_title);
                //$size=filesize($_FILES['image']['tmp_name']);
                $image_name=time().$i.'.'.$extension;
                $upload_path = "../images/current_status_images/";
                $imagename = $img_title."-current_status-".$image_name;
                $copied = copy($_FILES['image']['tmp_name'][$key], $upload_path.$imagename);

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
                  $image_name2=time().$i.'.'.$extension;
                  $upload_path2 = "../images/current_status_images/resize/";
                  $imagename2 = $img_title."-current_status-resize-".$image_name2;
                  $copied = copy($_FILES['image']['tmp_name'][$key], $upload_path2.$imagename2);
              
                  $image_name2 =  "../images/current_status_images/resize/".$imagename2; 
                  $size = getimagesize($image_name2);
                  $height = $size[1];
                  $width = $size[0];
              
                  if ($width > 400)
                  {
                      $image = new SimpleImage();
                      $image->load($image_name2);
                      $image->resizeToWidth(400);
                      $image->save($image_name2);
                  }

              $sqlQueryAdd = "INSERT INTO `msp_project_current_status` (`msp_website_id`,`msp_title`,`msp_image`,`msp_image2`,`msp_status`)VALUES ('$SessionWebsiteID', '$title','$imagename','$imagename2','$status')";
              $sqlRes = $ProjectCurrentStatus->dbquery($sqlQueryAdd) or die("Err : ");
          }
          $i = $i + 1;
        }
      }

            header("Location: project_current_status.php?wb=$SessionWebsiteID&action=add");
            exit();
        
    
  }
}
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
        <h2> Add Current Status </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add Current Status  </strong> </li>
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
              
              <form id="ProjectCurrentStatusForm" name="ProjectCurrentStatusForm" method="post" enctype="multipart/form-data" action="<?php $PHP_SELF; ?>">
              <input name="mode" id="mode" value="addproject_current_status" type="hidden">
              <div class="row">
                <div class="col-md-6" style="display:none">
                  <div class="form-group">
                    <label for="dtp_input2" class="col-md-12 control-label">Date </label>
                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                      data-link-format="yyyy-mm-dd">
                      <input class="form-control" size="16" name="month_year" type="text" readonly>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input2" value=""  />
                    <br/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" required value="<?=$title;?>" placeholder="Title"  type="text">
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
                      <label for="image">Image (Multiple select with control key)</label>
                        <input class="form-control" type="file" name="image[]" id="image" multiple accept="image/*" >
                        <label for=""><b>Image size : </b>800px / 800px</label>
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
