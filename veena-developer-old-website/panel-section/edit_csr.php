<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'fckeditor/fckeditor.php';

$PageName = "csr";
$TableName = "msp_csr";
$TableIDName = "csrid";
$PageTitle = "CSR";

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='edit')
  {
    $TableID = prepare_input($_POST["TableID"]);
    $title = prepare_input($_POST["title"]);
    $contents = $_POST["contents"];
    $contents = str_replace("'", "|", $contents);
    $status = prepare_input($_POST["status"]);
    
    $sqlQuery = "UPDATE `$TableName` set 
                                `msp_title` = '$title' ,
                                `msp_contents` = '$contents' ,
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
$contents = str_replace("|", "'", $contents);
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
