<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
$con=mysqli_connect('127.0.0.1','veena3oh_dbuser','igD*]e!vYC{y','veena3oh_demo')or die('can\'t establish connection with mysqli servver');
            $mySelectDB=mysqli_select_db($con,'veena3oh_demo') or die('could not connect to the database');
$PageName = 'project_heading.php';
//$TableName = 'msp_testimonial';
$HeaderTitle = 'Project Heading';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='add')
  {
     $id=$_POST['old_id'];
    $p_type = ($_POST["p_type"]);
    $h_type = ($_POST["h_type"]);
    $heading = ($_POST["heading"]);
    $status = ($_POST["status"]);

    $sqlQueryAdd = "update `msp_project_heading` set `project_type`='$p_type', `heading_type`='$h_type', `heading_text`='$heading', `heading_status`='$status' where heading_id=$id";

    $sqlRes = mysqli_query($con,$sqlQueryAdd);
    if($sqlRes){
    header("Location: project_heading.php?action=update");
    }else{
     header("Location: add_project_heading?action=prob");
    }
   
       
  }
}

if (isset($_GET["eid"]))
  {
     
          $item_id = $_GET["eid"];
          $Query = "SELECT * FROM `msp_project_heading` WHERE heading_id = '$item_id'";
          $abc=mysqli_query($con,$Query);
          $num=mysqli_num_rows($abc);
         $fetch=mysqli_fetch_row($abc);
         $id=$fetch[0];
         $text=$fetch[3];
         $ptype=$fetch[1];
         $htype=$fetch[2];
         $status=$fetch[4];
      
  }
  if(isset($_GET["action"])){$msg=$_GET["action"];}
?>
<!DOCTYPE html>
<html lang="en">
<title>Admin - <?=$AdminLoggedUserSitename;?></title>
<? include 'includes-class/files/head_file.php';?>
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
        <h2> Edit Project Heading </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Project Heading  </strong> </li>
        </ol>
      </div>
    </div>
      
          <div class="ibox float-e-margins">
            <div class="widgets-container">
              
              <form id="Form1" name="Form1" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="add" type="hidden">
              <input name="old_id" id="old_id" value="<?=$id;?>" type="hidden">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Project Type</label>
                    <select name="p_type" id="p_type" class="form-control">
                      <option <?php if($ptype=='1'){?>Selected <?php }?> value="1">Residential</option>
                      <option <?php if($ptype=='2'){?>Selected<?php }?> value="2">Commercial</option>
                    </select>
                  </div>
                </div>
                     <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Heading Type</label>
                    <select name="h_type" id="h_type" class="form-control">
                      <option <?php if($htype=='1'){?>Selected<?php }?> value="1">Ongoing</option>
                      <option <?php if($htype=='2'){?>Selected<?php }?> value="2">Upcoming</option>
                      <option <?php if($htype=='3'){?>Selected<?php }?> value="3">Complited</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option <?php if($status=='Active'){?>Selected<?php }?> value="Active">Active</option>
                      <option <?php if($status=='Inactive'){?>Selected<?php }?> value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
             <div class="row">
                             <div class="col-md-12">
                  <div class="form-group">
                    <label for="title">Project Heading</label>
                    <textarea class="form-control"  name="heading" id="heading"  placeholder="Project Heading"  type="text"><?=$text;?></textarea>
                  </div>
                </div>
                </div>
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Update</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='<?=$PageName;?>.php'">Cancel</button>
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
