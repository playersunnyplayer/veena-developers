<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';

$PageName = "press_releases";
$TableName = "msp_press_releases";
$TableIDName = "press_releasesid";
$PageTitle = "Press Releases";

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='edit')
  {
    $TableID = prepare_input($_POST["TableID"]);
    $title = prepare_input($_POST["title"]);
    $video_code = prepare_input($_POST["video_code"]);
    $status = prepare_input($_POST["status"]);
    
    $image2 = $_FILES['image2']['name'];
    if ($image2)
    {
        $filename = stripslashes($_FILES['image2']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        
        if ($extension != "pdf")
        {
            $action = "extension";
        }
        else
        {           
          $directoryName = '../images/'.$PageName.'_images/pdf/';
          if(!is_dir($directoryName)){ //Check if the directory already exists.
              mkdir($directoryName, 0755, true); //Directory does not exist, so lets create it.
          }   

          $filetitle = _prepare_url_text($title);
          $filetitle = strtolower($filetitle);
          $filetitle = substr($filetitle, 0, 80);

          $size=filesize($_FILES['image2']['tmp_name']);   
          $image_name2=time().'.'.$extension;
          $upload_path2 = $directoryName;
          $imagename2 = $filetitle."-".$image_name2;
          $copied = copy($_FILES['image2']['tmp_name'], $upload_path2.$imagename2);
          
          $image_name2 =  $directoryName."".$imagename2; 
          $size = getimagesize($image_name2);
          $height = $size[1];
          $width = $size[0];
      
          
        }
    }
    else
    {
        $imagename2 = $_POST["old_image2"];
    }

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

          $directoryName = '../images/'.$PageName.'_images/';
          if(!is_dir($directoryName)){ //Check if the directory already exists.
              mkdir($directoryName, 0755, true); //Directory does not exist, so lets create it.
          }   

          $filetitle = _prepare_url_text($title);
          $filetitle = strtolower($filetitle);
          $filetitle = substr($filetitle, 0, 80);

          $size=filesize($_FILES['image']['tmp_name']);   
          $image_name=time().'.'.$extension;
          $upload_path = $directoryName;
          $imagename = $filetitle."-".$image_name;
          $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
          
          $image_name =  $directoryName."".$imagename; 
          $size = getimagesize($image_name);
          $height = $size[1];
          $width = $size[0];
      
          if ($width > 300)
          {
              $image = new SimpleImage();
              $image->load($image_name);
              $image->resizeToWidth(300);
              $image->save($image_name);
          }
          
          
        }
    }
    else
    {
       $imagename = $_POST["old_image"];
    }
   
    $sqlQuery = "UPDATE `$TableName` set 
                                `msp_title` = '$title' ,
                                `msp_image` = '$imagename' ,
                                `msp_image2` = '$imagename2' ,
                                `msp_status` = '$status'
                                where $TableIDName = '$TableID'";
    $sqlRes = $CMS->dbquery($sqlQuery) or die("Err : ");
    header("Location: $PageName.php?action='update'");
    exit();
  }
}
$PageID = $_GET["id"];
$PageData = $CMS->GetPageInfoDetails($TableName, $TableIDName, $PageID);
$title = $PageData["msp_title"];
$image = $PageData["msp_image"];
$image2 = $PageData["msp_image2"];
$status = $PageData["msp_status"];

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
        <h2> Edit <?=$PageTitle;?> </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Edit <?=$PageTitle;?>  </strong> </li>
        </ol>
      </div>
    </div>

   

    <div class="ibox float-e-margins">
            <div class="widgets-container">

              <form id="<?=$PageName;?>Form" name="<?=$PageName;?>Form" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="edit" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
              <input name="old_image2" id="old_image2" value="<?=$image2;?>" type="hidden">
              <input name="TableID" id="TableID" value="<?=$PageID;?>" type="hidden">
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

                      <label for="image">Upload Image</label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*" >
                        <label for=""><b>Image size : </b>300px / 250px [Keep blank for old image]</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image)){ ?> <br> <img src="../images/<?=$PageName;?>_images/<?=$image;?>" width="150"><? } ?>

                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                      <label for="image">Upload PDF File</label>
                        <input class="form-control" type="file" name="image2" id="image2" accept="application/pdf"  >
                        <label for=""><b>Pdf size : </b>max: 2mb [Keep blank for old file[</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image2)){ ?> <br><a href="../images/<?=$PageName;?>_images/pdf/<?=$image2;?>" target="_blank" style="font-size:30px; color: #f00;" > <i class="fa fa-file-pdf-o"></i> </a> <? } ?>

                  </div>
                </div>

              </div>
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
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
