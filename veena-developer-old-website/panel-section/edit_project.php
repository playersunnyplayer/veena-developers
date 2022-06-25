<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='editproject')
  {
    $ProjectID = prepare_input($_POST["ProjectID"]);
    $title = prepare_input($_POST["title"]);
    $project_type = prepare_input($_POST["project_type"]);
    $location = prepare_input($_POST["location"]);
    $status = prepare_input($_POST["status"]);
 $project_type_status = prepare_input($_POST["project_type_status"]);


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
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name=time().'.'.$extension;
            $upload_path = "../images/project_images/";
            $imagename = "project-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);

            $image_name =  "../images/project_images/".$imagename; 
            $size = getimagesize($image_name);
            $height = $size[1];
            $width = $size[0];

            if ($width > 500  )
            {
                $image = new SimpleImage();
                $image->load($image_name);
                $image->resizeToWidth(500 );
                $image->save($image_name);
            }
        }
    }
    else
    {
       $imagename = $_POST["old_image"];
    }
    $sqlQuery = "UPDATE `msp_project` set 
                                `msp_title` = '$title' ,
                                `msp_project_type` = '$project_type' ,
                                `msp_location` = '$location' ,
                                `msp_image` = '$imagename' ,
                                `msp_status` = '$status',
                                msp_project_status=' $project_type_status'
                                where projectid = '$ProjectID'";
                                
    $sqlRes = $Project->dbquery($sqlQuery) or die("Err : ");
    header("Location: project.php?action='update'");
    exit();
  }
}
$ProjectID = $_GET["ProjectID"];
$ProjectData = $Project->GetProjectDetails($ProjectID);
$title = $ProjectData["msp_title"];
$image = $ProjectData["msp_image"];
$status = $ProjectData["msp_status"];
$project_type = $ProjectData["msp_project_type"];
$location = $ProjectData["msp_location"];
$project_status = $ProjectData["msp_project_status"];
?>
<!DOCTYPE html>
<html lang="en">
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
        <h2> Edit Project </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Project  </strong> </li>
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

              <form id="EditProjectForm" name="EditProjectForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="editproject" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
              <input name="ProjectID" id="ProjectID" value="<?=$ProjectID;?>" type="hidden">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Title"  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="title">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Active"<? if($status=='Active'){ echo 'selected'; } ?> >Active</option>
                      <option value="Inactive"<? if($status=='Inactive'){ echo 'selected'; } ?> >Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="location">Location </label>
                    <input class="form-control"  name="location" id="location" value="<?=$location;?>" placeholder="Location "  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="project_type">Project Status</label>
                    <select name="project_type_status" id="project_type_status" class="form-control">
                      <option value="1" <? if($project_status=='1'){ echo 'selected'; } ?> >Completed</option>
                      <option value="2" <? if($project_status=='2'){ echo 'selected'; } ?> >Upcoming</option>
                    </select>
                  </div>
                </div>
                
                
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">

                      <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image"  >
                        <label for=""><b>Image size : </b> 500px / 500px</label>
                  </div>
                </div>
                   <div class="col-md-2">
                  <div class="form-group">
                    <label for="project_type">Project Type</label>
                    <select name="project_type" id="project_type" class="form-control">
                      <option value="1" <? if($project_type=='1'){ echo 'selected'; } ?> >Residential</option>
                      <option value="2" <? if($project_type=='2'){ echo 'selected'; } ?> >Commercial</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image)){ ?> <br> <img src="../images/project_images/<?=$image;?>" width="150"><? } ?>

                  </div>
                </div>
               

              </div>

                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project.php'">Cancel</button>
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
