<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='addproject_amenities')
  {
    
     $title = prepare_input($_POST["title"]);
     $status = prepare_input($_POST["status"]);
     $contents = $_POST["contents"];
     $contents = str_replace("'", "|", $contents);
  
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
            $upload_path = "../projects/images/amenities_images/";
            $imagename = $img_title."-amenities-icon-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
            
            $image_name =  "../projects/images/amenities_images/".$imagename; 
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
            
            
        }
    }
    else
    {
        $action = "empty";
    }

    $sqlQueryAdd = "INSERT INTO `msp_project_amenities` (`msp_website_id`,`msp_title`,`msp_contents`,`msp_image`,`msp_image2`,`msp_status`)VALUES ('$SessionWebsiteID', '$title','$contents','$imagename','$imagename2','$status')";
            $sqlRes = $ProjectAmenities->dbquery($sqlQueryAdd) or die("Err : ");
            header("Location: project_amenities.php?wb=$SessionWebsiteID&action=add");
            exit();
    
  }
}
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
        <h2> Add Amenities </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add Amenities  </strong> </li>
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
              
              <form id="ProjectAmenitiesForm" name="ProjectAmenitiesForm" method="post" enctype="multipart/form-data" action="<?php $PHP_SELF; ?>">
              <input name="mode" id="mode" value="addproject_amenities" type="hidden">
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
              <!-- <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image"  >
                        <label for=""><b>Image size : </b>800px / 800px</label>
                  </div>
                </div>
               
              </div> -->
               <hr>
                <div class="form-group">
                  <label for="title">Description</label>
                  <div class="uniformjs">
                                      <?php
                        $oFCKeditor = new FCKeditor('contents') ;
                        $oFCKeditor->BasePath = "fckeditor/" ;
                        $oFCKeditor->Value = $contents;
                        $oFCKeditor->Width  = '100%' ;
                        $oFCKeditor->Height = '300' ;
                        $oFCKeditor->Create() ;
                          ?>
                                    </div>
                </div>
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project_amenities.php?wb=<?=$SessionWebsiteID;?>'">Cancel</button>
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
