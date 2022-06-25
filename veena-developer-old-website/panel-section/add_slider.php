<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='addslider')
  {
    $url =$_POST["url"];
    $title =$_POST["title"];
    $status =$_POST["status"];
    
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
            $upload_path = "../images/slider_images/";
            $imagename = "slider-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
            
            $image_name =  "../images/slider_images/".$imagename; 
            $size = getimagesize($image_name);
            $height = $size[1];
            $width = $size[0];
        
           /* if ($width > 700)
            {
                $image = new SimpleImage();
                $image->load($image_name);
                //$image->resizeToWidth(700);
                $image->save($image_name);
            }*/
            $sqlQueryAdd = "INSERT INTO `msp_slider` (`msp_title`,`msp_image`,`msp_url`,`msp_status`)VALUES ('$title','$imagename','$url','$status')";
            $sqlRes = $Slider->dbquery($sqlQueryAdd) or die("Err : ");
            header("Location: slider.php?action=add");
            exit();
        }
    }
    else
    {
        $action = "empty";
    }
    
  }
}
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
        <h2> Add Slider </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add Slider  </strong> </li>
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
              
              <form id="SliderForm" name="SliderForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="addslider" type="hidden">
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
                        <input class="form-control" type="file" name="image" id="image"  onchange="readURL(this);" >
                        <label for=""><b>Image size : </b>700px / 700px</label>
                  </div>
                </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="url">URL</label>
                    <input class="form-control"  name="url" id="url" value="<?=$url;?>" placeholder="URL"  type="text">
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="image">Preview Image</label><br>
                        <img id="blah" src="#" alt="your image"  />
                  </div>
                </div>
               
              </div>
               
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='slider.php'">Cancel</button>
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
<script>function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(700)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }</script>
</body>
</html>
