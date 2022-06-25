<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';

$PageName = "location";
$TableName = "msp_location";
$TableIDName = "locationid";
$PageTitle = "Location";

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='add')
  {
    
    $city_id = prepare_input($_POST["city_id"]);
    $title = prepare_input($_POST["title"]);
    $status = prepare_input($_POST["status"]);

    $sqlQueryAdd = "INSERT INTO `$TableName` (`msp_city_id`,`msp_title`,`msp_status`)VALUES ('$city_id','$title','$status')";

    $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ");
    header("Location: $PageName.php?action=add");
    exit();
       
  }
}
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
        <h2> Add <?=$PageTitle;?> </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add <?=$PageTitle;?>  </strong> </li>
        </ol>
      </div>
    </div>
      
          <div class="ibox float-e-margins">
            <div class="widgets-container">
              
              <form id="<?=$PageName;?>Form" name="<?=$PageName;?>Form" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="add" type="hidden">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="city_id">City</label>
                    <select name="city_id" id="cityid" class="form-control">
                      <option value="">Select city</option>
                      <?php
                      $CityNum = $CMS->GetCityNum();
                      $CityRes = $CMS->GetCityRes();
                      
                      if ($CityNum > 0)
                      {
                        while ($CityData = $CMS->dbfetch($CityRes))
                        {
                          $CityID = $CityData["cityid"];
                          $CityTitle = $CityData["msp_title"];
                        ?>
                      <option value="<?=$CityID;?>"><?=$CityTitle;?></option>
                      <?
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Title" required  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
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
