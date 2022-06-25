<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';

$PageName = 'project_location_advantage';
$HeaderTitle = 'Location Advantage';
$TableName = 'msp_project_location_advantage';


if (isset($_GET["mode"]))
{

  if ($_GET["mode"] == "delete_item")
  {
      $item_id = $_GET["item_id"];
      $page = $_GET["page"];
      $Query = "delete from msp_project_contents_images where mspid = '$item_id'";
      $CMS->dbquery($Query);
    header("Location: $PageName.php?wb=$SessionWebsiteID&action=delete");
    break;
  }

  if ($_GET["mode"] == "arrange")
  {
    // parse id
    $web = $_GET["wb"];
    $order_numbers = $_GET["order_numbers"];
    $TableName = $_GET["TableName"];
    if (!empty($order_numbers)) 
    {
      $numbers = explode(";", $order_numbers);
      $i = "111";
      $j = 0;
      foreach($numbers as $idnumber)
      {
        $id = $numbers[$j];
        $sqlQuery = "update `msp_project_contents_images` set number = '$i' where mspid = '$id'";
        $CMS->dbquery($sqlQuery) or die("Err");

        $i++;
        $j++;
      }
      header("Location: $PageName.php?wb=$web&action=arrange");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$HeaderTitle;?> <?=$sitename;?></title>
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
<link rel="stylesheet" type="text/css" href="assets/image_arrenge/css/images_order.css" media="screen" />
<script src="assets/image_arrenge/js/images.order.js" type="text/javascript"></script>
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
          <li> <a href="#"><?=$SessionWebsiteName;?></a> </li>
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
            if ($_GET['action'] == "delete") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully delete details.
            </div>
            <?php
            }
            if ($_GET['action'] == "arrange") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully arrange image details.
            </div>
            <?php
            }?>
        <div class="col-lg-12">
          <div class="ibox-title">
                <h5><?=$HeaderTitle;?> Manegments</h5>
                <div class="ibox-tools" > <a class="btn aqua btn-xs" href="#" onclick="window.location='edit_<?=$PageName;?>.php?wb=<?=$SessionWebsiteID;?>'" >Update <?=$HeaderTitle;?></a> </div>
              </div>
          <div class="ibox float-e-margins">
            <div class="widgets-container">
                <div class="row">
                  <div class="col-md-3"><label for="image">Page Title: </label></div>
                  <div class="col-md-9"><?=$page_title;?></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label for="image">Page Keyword: </label></div>
                  <div class="col-md-9"><?=$page_keyword;?></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label for="image">Page Description: </label></div>
                  <div class="col-md-9"><?=$page_description;?></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><label for="image">Title: </label></div>
                  <div class="col-md-9"><?=$title;?></div>
                </div>
                <hr>
                <div class="form-group">
                  <label for="title">Description</label><br>
                   <?=$contents;?>
                </div>
               <hr>
               <?
               $ContentsImageNum = $CMS->GetContentsImageWebsiteIDNum($TableName, $SessionWebsiteID);
               if ($ContentsImageNum > 0)
               {
               ?>
                <div class="row">
                  <div class="col-md-12">

                    <div id="mainContainer">
                <!-- START DRAGABLE CONTENT -->
                                <div id="dragableElementsParentBox">
                                    <?
                                    $ContentsImageNum = $CMS->GetContentsImageWebsiteIDNum($TableName, $SessionWebsiteID);
                                    $ContentsImageRes = $CMS->GetContentsImageWebsiteIDRes($TableName, $SessionWebsiteID);

                                    if ($ContentsImageNum > 0)
                                    {
                                        $i = 0;
                                        $j = 0;
                                        while ($ContentsImageData = $CMS->dbfetch($ContentsImageRes))
                                        {
                                            $ContentsImageID = $ContentsImageData["mspid"];
                                            $ContentsImage = $ContentsImageData["image"];
                                            $ContentsImageResize = $ContentsImageData["imageresize"];
                                            $PhotoNumber = $ContentsImageData["number"];

                                            if (empty($PhotoNumber))
                                            {
                                                $PhotoNumber = $i;
                                            }
                                            ?>
                                            <span>
                                            <div class="bigArticle" dragableBox="true" id="<? echo $ContentsImageID; ?>">

                                            <img src="../images/contents_images/<?=$ContentsImage;?>" border="0" style="height:200px!important; width:200px!important;" />
                                            <span><a href="#" onClick="javascript:DeleteParentImage('<?=$ContentsImageID;?>', '<?=$PageName;?>', '<?=$SessionWebsiteID;?>');"   > <i class="fa fa-trash-o"></i> Delete</a></span>
                                            </div>
                                            </span>
                                            <?
                                            $i = $i + 1;
                                        }
                                    }
                                    ?>

                                    <div class="clear" id="clear"></div>    
                                </div>
                                <!-- END DRAGABLE CONTENT -->


                                </div>

                                <div class="heading-buttons">
                                <div class="buttons pull-left" style="margin: 0;">
                                    <button type="button" class="btn btn-primary btn-icon glyphicons ok_2" onClick="saveData2('<?=$TableName;?>','<?=$PageName;?>','<?=$SessionWebsiteID;?>')"><i></i> Arrange Images</button>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                            <!-- REQUIRED DIVS -->
                            <div id="insertionMarker">
                                <img src="theme/images/marker_top.gif">
                                <img src="theme/images/marker_middle.gif" id="insertionMarkerLine">
                                <img src="theme/images/marker_bottom.gif">
                            </div>
                            <!-- END REQUIRED DIVS -->
                  </div>
                </div>
                <?
                  }
              
                ?>


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
