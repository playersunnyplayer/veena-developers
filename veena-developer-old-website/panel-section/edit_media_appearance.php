<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';

$PageName = "media_appearance";
$TableName = "msp_media_appearance";
$TableIDName = "media_appearanceid";
$PageTitle = "Media Appearance";

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='edit')
  {
    $TableID = prepare_input($_POST["TableID"]);
    $title = prepare_input($_POST["title"]);
    $video_code = prepare_input($_POST["video_code"]);
    $status = prepare_input($_POST["status"]);
    
   
    $sqlQuery = "UPDATE `$TableName` set 
                                `msp_title` = '$title' ,
                                `msp_video_code` = '$video_code' ,
                                `msp_status` = '$status'
                                where $TableIDName = '$TableID'";
    $sqlRes = $CMS->dbquery($sqlQuery) or die("Err : ");
    header("Location: $PageName.php?action=update");
    exit();
  }
}
$PageID = $_GET["id"];
$PageData = $CMS->GetPageInfoDetails($TableName, $TableIDName, $PageID);
$title = $PageData["msp_title"];
$video_code = $PageData["msp_video_code"];
$status = $PageData["msp_status"];
$f_video_code = str_replace("https", "http", $video_code);

$myObject = new SimpleYouTube;
$video_id = $myObject->getVideoID($f_video_code);
$videoDetails = $myObject->getVideoDetails($video_id);
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
                         <label for="video_code">Youtube Url Link</label>
                          <input class="form-control"  name="video_code" id="video_code" value="<?=$video_code;?>" placeholder="Youtube Url Link"  type="text">
                          <label for="video_code">Eg : http://www.youtube.com/watch?v=nymfWt0gEiw</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                   <embed src="http://www.youtube.com/v/<?php echo $video_id; ?>&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="100%" height="100%">

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
