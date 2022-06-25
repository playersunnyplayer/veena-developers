<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='editaward')
  {
    $AwardID = prepare_input($_POST["AwardID"]);
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
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name=time().'.'.$extension;
            $upload_path = "../images/award_images/";
            $imagename = "award-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);

            $image_name =  "../images/award_images/".$imagename; 
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

            // resize
            $size=filesize($_FILES['image']['tmp_name']);   
            $image_name2=time().'.'.$extension;
            $upload_path2 = "../images/award_images/resize/";
            $imagename2 = "award-resize-".$image_name2;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path2.$imagename2);
            
            $image_name2 =  "../images/award_images/resize/".$imagename2; 
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
    $sqlQuery = "UPDATE `msp_award` set 
                                `msp_title` = '$title' ,
                                `msp_image` = '$imagename' ,
                                `msp_image2` = '$imagename2' ,
                                `msp_status` = '$status'
                                where awardid = '$AwardID'";
    $sqlRes = $Award->dbquery($sqlQuery) or die("Err : ");
    header("Location: award.php?action='update'");
    exit();
  }
}
$AwardID = $_GET["AwardID"];
$AwardData = $Award->GetAwardDetails($AwardID);
$title = $AwardData["msp_title"];
$image = $AwardData["msp_image"];
$image2 = $AwardData["msp_image2"];
$status = $AwardData["msp_status"];
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
        <h2> Edit Award </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit Award  </strong> </li>
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

              <form id="EditAwardForm" name="EditAwardForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="editaward" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
              <input name="old_image2" id="old_image2" value="<?=$image2;?>" type="hidden">
              <input name="AwardID" id="AwardID" value="<?=$AwardID;?>" type="hidden">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Titile</label>
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
                        <label for=""><b>Image size : </b> 800px / 700px </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image2)){ ?> <br> <img src="../images/award_images/resize/<?=$image2;?>" width="150"><? } ?>

                  </div>
                </div>

              </div>

                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='award.php'">Cancel</button>
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
