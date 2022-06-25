<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='addteam')
  {

    $title = prepare_input($_POST["title"]);
    $position = prepare_input($_POST["position"]);
    $contents = $_POST["contents"];
    $contents = str_replace("'", "|", $contents);
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
            $upload_path = "../images/team_images/";
            $imagename = "team-".$image_name;
            $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);

            $image_name =  "../images/team_images/".$imagename; 
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
            
            $sqlQueryAdd = "INSERT INTO `msp_team` (`msp_title`,`msp_position`,`msp_image`,`msp_contents`,`msp_status`)VALUES ('$category_id','$title','$position','$imagename','$contents','$status')";
            $sqlRes = $Team->dbquery($sqlQueryAdd) or die("Err : ");
            header("Location: team.php?action=add");
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
        <h2> Add Team </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add Team  </strong> </li>
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

              <form id="TeamForm" name="TeamForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="addteam" type="hidden">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Name</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Name"  type="text">
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
              <div class="col-md-12">
                <div class="form-group">
                  <label for="position">Position</label>
                  <input class="form-control"  name="position" id="position" value="<?=$position;?>" placeholder="Position"  type="text">
                </div>
              </div>
              
            </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image" required  >
                        <label for=""><b>Image size : </b>500px / 400px</label>
                  </div>
                </div>

              </div>
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="contents">Description</label>
                  <textarea class="form-control"  name="contents" id="contents" placeholder="Description"><?=$contents;?></textarea>

                </div>
              </div>

            </div>
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='team.php'">Cancel</button>
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
