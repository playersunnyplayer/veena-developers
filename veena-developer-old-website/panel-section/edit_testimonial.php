<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';
include 'fckeditor/fckeditor.php';
$con=mysqli_connect('127.0.0.1','veena3oh_dbuser','igD*]e!vYC{y','veena3oh_demo')or die('can\'t establish connection with mysqli servver');
            $mySelectDB=mysqli_select_db($con,'veena3oh_demo') or die('could not connect to the database');
$PageName = 'add_testimonial.php';
$TableName = 'msp_testimonial';
$HeaderTitle = 'Testimonial';
if (isset($_POST["mode"]))
{
    if ($_POST["mode"] == "add")
    {       $id=$_POST['old_id'];
            $testi=$_POST['testimonial'];
            $author=$_POST['author'];
            $comp=$_POST['comp'];
            $desg=$_POST['desg'];
            $status=$_POST['status'];
            $date=date('d/m/Y');
            $qry="UPDATE `msp_testimonial` SET 
          `msp_testimonial_text`='$testi',`msp_testimonial_author`='$author',`msp_testimonial_desg`='$desg',`msp_testimonial_company`='$comp',`msp_testimonial_status`='$status' WHERE `msp_testimonial_id`='$id'";
            $qry1=mysqli_query($con,$qry);
          if($qry1){
            $action='update';
              header("Location: testimonial.php?action=$action");}else{
                   $action='sub';
              header("Location: edit_testimonial.php?action=$action");
                  
              }
    }
  }
    if (isset($_GET["eid"]))
  {
     
          $item_id = $_GET["eid"];
          $Query = "SELECT * FROM `msp_testimonial` WHERE msp_testimonial_id = '$item_id'";
          $abc=mysqli_query($con,$Query);
          $num=mysqli_num_rows($abc);
         $fetch=mysqli_fetch_row($abc);
         $id=$fetch[0];
         $text=$fetch[1];
         $author=$fetch[2];
         $desg=$fetch[3];
         $comp=$fetch[4];
         $status=$fetch[6];
      
  }
  if(isset($_GET["action"])){$msg=$_GET["action"];}
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
        <h2> <?=$HeaderTitle;?> </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> <?=$HeaderTitle;?>  </strong> </li>
        </ol>
      </div>
    </div>
    <div class="wrapper-content ">
      <div class="row">
        <!-- Basic Form start -->
        <?php
            if ($msg == "add") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully added details.
            </div>
            <?php
            }
      if ($msg == "update") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully updated details.
            </div>
            <?php
            }?>
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
            <div class="widgets-container">

              <form id="CMSForm" name="CMSForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="add" type="hidden">
              <input name="old_image" id="old_image" value="<?=$imagename;?>" type="hidden">
                <input name="old_id" id="old_id" value="<?=$id;?>" type="hidden">
                <div class="form-group">
                  <label for="page_title">Testimonial</label>
                  <textarea class="form-control"  name="testimonial" id="testimonial"  placeholder="Testimonial Text" rows="5" ><?=$text;?></textarea>
                </div>
              
               
                <hr>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title">Author</label>
                      <input class="form-control"  name="author" id="author" value="<?=$author;?>" placeholder="Author"  type="text">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title2">Designation</label>
                      <input class="form-control"  name="desg" id="desg" value="<?=$desg;?>" placeholder="Designation"  type="text">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title3">Company</label>
                      <input class="form-control"  name="comp" id="comp" value="<?=$comp;?>" placeholder="Company Name"  type="text">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                     <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option <?php if($status=='Active'){ ?> selected <?php } ?> value="Active">Active</option>
                      <option  <?php if($status=='Inactive'){ ?> selected <?php } ?> value="Inactive">Inactive</option>
                    </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Update Testimonial</button>
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
