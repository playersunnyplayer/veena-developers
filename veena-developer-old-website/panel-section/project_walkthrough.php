<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';



$PageName = 'project_walkthrough';
$TableName = 'msp_project_walkthrough';
$HeaderTitle = 'Walkthrough';

if (isset($_GET["mode"]))
 {
   if ($_GET["mode"] == "delete_item")
   {
      
    $wb = $_GET["wb"];
    $item_id = $_GET["item_id"];
    $page = $_GET["page"];
    $Query = "update $TableName set image='' where websiteid = '$wb'";
    $CMS->dbquery($Query);
    
    header("Location: $PageName.php?wb=$wb&action=remove");
    exit();
   }
   if ($_GET["mode"] == "delete_itemtable")
   {
      
    $wb = $_GET["wb"];
    $item_id = $_GET["item_id"];
    $page = $_GET["page"];
    $Query = "delete from $TableName where websiteid = '$wb'";
    $CMS->dbquery($Query);
    
    header("Location: $PageName.php?wb=$wb&action=remove");
    exit();
   }
 }


if (isset($_POST["mode"]))
{
    if ($_POST["mode"] == "add")
    {
        $page_title = prepare_input($_POST["page_title"]);
        $page_description = prepare_input($_POST["page_description"]);
        $page_keyword = prepare_input($_POST["page_keyword"]);
        $title = prepare_input($_POST["title"]);
        $video_code = $_POST["video_code"];
        
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
                $size=filesize($_FILES['image']['tmp_name']);   
                $image_name=time().'.'.$extension;
                $upload_path = "../images/contents/";
                $imagename = "walkthrough-".$image_name;
                $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);

                $image_name =  "../images/contents/".$imagename; 
                $size = getimagesize($image_name);
                $height = $size[1];
                $width = $size[0];

                if ($width > 470)
                {
                    $image = new SimpleImage();
                    $image->load($image_name);
                    $image->resizeToWidth(470);
                    $image->save($image_name);
                }
            }
        }
        else
        {
           $imagename = $_POST["old_image"];
        }
         $PageInfoNum = $CMS->GetWebPageInfoNum($TableName, $SessionWebsiteID);
        
        if ($PageInfoNum > 0 )
        {
            $sqlQuery = "UPDATE `$TableName` set `page_title` = '$page_title', `page_keyword` = '$page_keyword' , `page_description` = '$page_description' , `title` = '$title' , `contents` = '$contents', `video_code` = '$video_code' , `image` = '$imagename' where websiteid= '$SessionWebsiteID'";
            $sqlRes = $CMS->dbquery($sqlQuery) or die("Err");

            $action='update';
        }
        else
        {
            $add = "INSERT INTO `$TableName` (`websiteid` ,`page_title` , `page_keyword` , `page_description` , `title` , `contents` , `video_code`, `image`) VALUES ('$SessionWebsiteID','$page_title', '$page_keyword', '$page_description', '$title', '$contents', '$video_code', '$imagename')";
            $add_res = $CMS->dbquery($add) or die("Err");
            $action='add';
        }
    }
  }
$PageInfo = $CMS->GetWebPageInfo($TableName, $SessionWebsiteID);
$title = $PageInfo["title"];
$contents = $PageInfo["contents"];
$contents = str_replace("|", "'", $contents);
$page_title = $PageInfo["page_title"];
$page_keyword = $PageInfo["page_keyword"];
$page_description = $PageInfo["page_description"];
$image = $PageInfo["image"];
$video_code = $PageInfo["video_code"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$HeaderTitle;?> <?=$AdminLoggedUserSitename;?></title>
<!-- Bootstrap -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<!-- slimscroll -->
<link href="assets/css/jquery.slimscroll.css" rel="stylesheet">
<!-- Fontes -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/simple-line-icons.css" rel="stylesheet">
<!-- all buttons css -->
<link href="assets/css/buttons.css" rel="stylesheet">
<!-- animate css -->
<link href="assets/css/animate.css" rel="stylesheet">
<!-- top nev css -->
<link href="assets/css/page-header.css" rel="stylesheet">
<!-- adminui main css -->
<link href="assets/css/main.css" rel="stylesheet">
<!-- aqua black theme css -->
<link href="assets/css/aqua-black.css" rel="stylesheet">
<!-- media css for responsive  -->
<link href="assets/css/main.media.css" rel="stylesheet">
<!-- icheck -->
<link href="assets/css/skins/all.css" rel="stylesheet">
<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
<!--[if lt IE 9]> <script src="dist/html5shiv.js"></script> <![endif]-->
</head>
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
        <h2> <?=$HeaderTitle;?> </h2>
        <ol class="breadcrumb">
          <li> <a href="index_project.php">Home</a> </li>
          <li > <strong> <?=$SessionWebsiteName;?>  </strong> </li>
          <li class="active"> <strong> <?=$HeaderTitle;?>  </strong> </li>
        </ol>
      </div>
    </div>
    <div class="wrapper-content ">
      <div class="row">
        <!-- Basic Form start -->
        <?php
            if ($action == "add") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully added details.
            </div>
            <?php
            }
      if ($action == "update") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully updated details.
            </div>
            <?php
            }
            if ($_GET["action"] == "remove") {
           ?>
          <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
               Successfully removed details.
           </div>
          <?php
          }
          ?>
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
            <div class="widgets-container">

              <form id="CMSForm" name="CMSForm" method="post" enctype="multipart/form-data" action="<?=$_PHP_SELF; ?>">
              <input name="mode" id="mode" value="add" type="hidden">
              <input name="old_image" id="old_image" value="<?=$image;?>" type="hidden">
                <div class="form-group">
                  <label for="page_title">Page Title</label>
                  <input class="form-control"  name="page_title" id="page_title" value="<?=$page_title;?>" placeholder="Page Title" type="text">
                </div>
                <div class="form-group">
                  <label for="page_keyword">Page Keyword </label>
                  <input class="form-control"  name="page_keyword" id="page_keyword" value="<?=$page_keyword;?>" placeholder="Page Keyword" type="text">
                </div>
                <div class="form-group">
                  <label for="page_description">Page Description</label>
                  <input class="form-control"  name="page_description" id="page_description" value="<?=$page_description;?>" placeholder="Page Description"  type="text">
                </div>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Title"  type="text">
                </div>
                
                <hr>
                
               
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="video_code">Youtube Vedio Url link</label>
                    <input class="form-control"  name="video_code" id="video_code" value="<?=$video_code;?>" placeholder="Youtube Vedio link"  type="text">
                    <label for="video_code">eg:- http://www.youtube.com/watch?v=u4JJ_0lWYRs</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?
                    $myObject = new SimpleYouTube;
                    $video_id = $myObject->getVideoID($video_code);
                    $videoDetails = $myObject->getVideoDetails($video_id);
                    ?>
                   <embed src="http://www.youtube.com/v/<?php echo $video_id; ?>&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="150" height="100">

                  </div>
                </div>

              </div> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                      <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image"  >
                        <label for=""><b>Image size : </b> 470px / 315px</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                   <? if(!empty($image)){ ?> <br> <img src="../images/contents/<?=$image;?>" width="150"> <span onClick="javascript:DeleteParentImage('<?=$ProjectDownloadID;?>', 'project_walkthrough', '<?=$SessionWebsiteID;?>');"><i class="fa fa-times"> Remove Image </i></span><? } ?>

                  </div>
                </div>

              </div>
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


                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Update</button>
                <button type="button" class="btn btn-danger bottom15-xs " onClick="javascript:DeleteItemTableID('<?=$ProjectDownloadID;?>', 'project_walkthrough', '<?=$SessionWebsiteID;?>');"> <i class="fa fa-times"> </i> Remove</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- start footer -->
<?  include 'footer_file_msp.php'; ?>
  </div>
</div>
<!-- Go top -->
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<!-- Go top -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/vendor/jquery-1.11.1.min.js"></script>
<script src="assets/js/vendor/form_validator.js"></script>
<script src="assets/js/vendor/form_custome.js"></script>
<script src="assets/js/vendor/jquery.validate.js"></script>
<!-- icheck -->
<script src="assets/js/vendor/icheck.js"></script>
<!-- bootstrap js -->
<script src="assets/js/vendor/bootstrap.min.js"></script>
<!-- slimscroll js -->
<script type="text/javascript" src="assets/js/vendor/jquery.slimscroll.js"></script>
<!-- pace js -->
<script src="assets/js/vendor/pace/pace.min.js"></script>
<!-- Sparkline -->
<script src="assets/js/vendor/jquery.sparkline.min.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
<!-- calendr -->
<link rel="stylesheet" type="text/css" href="assets/calendar/tcal.css" />
  <script type="text/javascript" src="assets/calendar/tcal.js"></script> 
  <!-- calendr -->
</body>
</html>
