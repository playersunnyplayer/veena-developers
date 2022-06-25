<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';


$PageName = 'project_current_status_title';
$TableName = 'msp_project_current_status_title';
$HeaderTitle = 'Current Status Title';

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
        $title = prepare_input($_POST["title"]);
        $date_tab = prepare_input($_POST["date_tab"]);

        
         $PageInfoNum = $CMS->GetWebPageInfoNum($TableName, $SessionWebsiteID);
        
        if ($PageInfoNum > 0 )
        {
            $sqlQuery = "UPDATE `$TableName` set `title` = '$title',`date_tab` = '$date_tab', `websiteid` = '$SessionWebsiteID' where websiteid= '$SessionWebsiteID'";
            $sqlRes = $CMS->dbquery($sqlQuery) or die("Err");

            $action='update';
        }
        else
        {
            $add = "INSERT INTO `$TableName` (`title`,`date_tab`,`websiteid`) VALUES ('$title','$date_tab','$SessionWebsiteID')";
            $add_res = $CMS->dbquery($add) or die("Err");
            $action='add';
        }
    }
  }
$PageInfo = $CMS->GetWebPageInfo($TableName, $SessionWebsiteID);
$title = $PageInfo["title"];
$date_tab = $PageInfo["date_tab"];

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
               
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Title"  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="date_tab">Date Tab Show</label>
                    <select name="date_tab" id="date_tab" class="form-control">
                      <option value="Yes" <? if($date_tab=='Yes'){ echo"selected";} ?> >Yes</option>
                      <option value="No" <? if($date_tab=='No'){ echo"selected";} ?> >No</option>
                    </select>
                  </div>
                </div>
              </div>


               
                <hr>

                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Update</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='project_current_status.php?wb=<?=$SessionWebsiteID;?>'">Cancel</button>
                <button type="button" class="btn btn-danger bottom15-xs " onClick="javascript:DeleteItemTableID('<?=$ProjectDownloadID;?>', '<?=$PageName;?>', '<?=$SessionWebsiteID;?>');"> <i class="fa fa-times"> </i> Remove</button>
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
