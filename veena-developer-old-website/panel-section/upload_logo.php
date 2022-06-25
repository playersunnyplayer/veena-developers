<?php

include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';



if (isset($_POST["mode"]))

{

  if ($_POST["mode"] == "addmode")

  {

    //

    $image=$_FILES['image']['name'];

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

        $upload_path = "../images/";

        $imagename = "sitelogo-".$image_name;

        $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);



        $sqlQuery = "UPDATE `msp_admin` set `admin_sitelogo` = '$imagename'";

        $sqlRes = $Admin->dbquery($sqlQuery) or die("Err");



       $action='update';

      }

    }

    else

    {

      $action = "empty";

    }

    //

  }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Logo</title>

<!-- Bootstrap -->

<link href="assets/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css">

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





<? include 'header_file_msp.php';  ?>



<div class="clearfix"> </div>

<div class="page-container">

<!-- Start page sidebar wrapper -->

<? include 'sidebar_file_msp.php';?>

<!-- End page sidebar wrapper -->

<!-- Start page content wrapper -->

<div class="page-content-wrapper animated fadeInRight">

  <div class="page-content" >

    <div class="row wrapper border-bottom page-heading">

      <div class="col-lg-6">

        <h2> Logo </h2>

        <ol class="breadcrumb">

          <li> <a href="index.php"><i class="fa fa-home"> </i></a> </li>

          <li> <a><?=$sitename;?></a> </li>

          <li class="active"> <strong> Logo </strong> </li>

        </ol>

      </div>



        <div class="col-lg-6">

        <div id="alert_message"></div>

       

      </div>



    </div>

    <div class="wrapper-content ">

      <div class="row">

       <?

       if ($action == "update") {



            ?>



            <div class="alert alert-success">



                <button type="button" class="close" data-dismiss="alert">&times;</button>



                Successfully updated details.



            </div>



            <?php



            }

            ?>

        

        <!-- Visible labels Form start -->

        <div class="col-lg-12 top20">

          <div class="widgets-container">

           <!--  <h5>Visible labels Form</h5>

            -->

           

            <form id="SiteLogoForm" name="SiteLogoForm" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="mode" id="mode"  value="addmode">

              

              <hr>

              <div class="row">

                 <label class="col-md-2 control-label">Upload Logo  </label>

                  <div class="  col-md-4 ">

                      <div class="fileinput fileinput-new" data-provides="fileinput">

                          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> <img src="../images/<?=$sitelogo;?>"></div>

                          <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

                              <input type="file" name="image" required>

                              </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>

                      </div>

                  </div>

              </div>

              <hr>

              <div class="row">

                <div class="col-md-3">

                 <button type="submit" class="btn aqua">Submit</button>

                 <button type="button" class="btn aqua" onClick="document.location='index.php'"><i></i>Cancel</button>

                </div>

                

              </div>

            </form>

          </div>

        </div>

        <!--Visible labels Form End -->

        <!--All form elements  start -->

       

      </div>

    </div>

    

<!-- start footer -->

<? include 'footer_file_msp.php';?>

  </div>

</div>

<!-- Go top -->

<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>

<!-- Go top -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

 <script src="assets/js/vendor/jquery-1.11.1.min.js"></script>

<script src="assets/js/vendor/form_custome.js"></script>

<script src="assets/js/vendor/jquery.validate.js"></script>

<!-- icheck -->

<script src="assets/js/vendor/icheck.js"></script>

<!-- bootstrap js -->

<script src="assets/js/vendor/bootstrap.min.js"></script>

<script type="text/javascript" src="assets/js/vendor/jasny-bootstrap.min.js" charset="UTF-8"></script>

<!-- slimscroll js -->

<script type="text/javascript" src="assets/js/vendor/jquery.slimscroll.js"></script>

<!-- pace js -->

<script src="assets/js/vendor/pace/pace.min.js"></script>

<!-- Sparkline -->

<script src="assets/js/vendor/jquery.sparkline.min.js"></script>

<!-- main js -->

<script src="assets/js/main.js"></script>



</body>

</html>

