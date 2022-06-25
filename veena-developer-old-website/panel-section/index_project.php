<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-  <?=$SessionWebsiteName;?> - <?=$sitename;?></title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- slimscroll -->
    <link href="assets/css/jquery.slimscroll.css" rel="stylesheet">
    <!-- project -->
    <link href="assets/css/project.css" rel="stylesheet">
    <!-- flotCart css -->
    <link href="assets/css/flotCart.css" rel="stylesheet">
    <!-- jvectormap -->
	<link href="assets/css/jqvmap.css" rel="stylesheet">

    

	<!-- dataTables -->
	<link href="assets/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="assets/css/fixedHeader.dataTables.min.css" rel="stylesheet">


    <!-- Fontes -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <link href="assets/css/ameffectsanimation.css" rel="stylesheet">
    <link href="assets/css/buttons.css" rel="stylesheet">
    <!-- animate css -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- top nev css -->
    <link href="assets/css/page-header.css" rel="stylesheet">
    <!-- adminui main css -->
    <link href="assets/css/main.css" rel="stylesheet">
   
    <!-- morris -->
	<link href="assets/css/morris.css" rel="stylesheet">

    <!-- aqua black theme css -->
    <link href="assets/css/aqua-black.css" rel="stylesheet">
    <!-- media css for responsive  -->
    <link href="assets/css/main.media.css" rel="stylesheet">

        <!-- AdminUI demo css-->
    <link href="assets/css/adminUIdemo.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="page-header-fixed ">
    
    <? include 'header_file_msp_project.php';  ?>

    <div class="clearfix"> </div>
    <div class="page-container">
        <!-- Start page sidebar wrapper -->
            <? include 'sidebar_file_msp_project.php';?>
        <!-- End page sidebar wrapper -->
        <!-- Start page content wrapper -->
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">

                
<div class="row">
    <div class="col-lg-6 top15">

    <!-- begin col-3 -->
    <div class="col-lg-6">
        <div class="widget white-bg box-shadow">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <i class="fa fa-photo fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                   <span onclick="window.location='project_slider.php?wb=<?=$SessionWebsiteID;?>'">Total Slider</span></a>

                    <h2 class="font-bold"><?=$ProjectSlider->GetProjectSliderByWebsiteNum($SessionWebsiteID); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- begin col-3 -->
    <div class="col-lg-6">
        <div class="widget white-bg box-shadow">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-photo fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span onclick="window.location='project_slider.php?wb=<?=$SessionWebsiteID;?>'"> Total Gallery </span>
                    <h2 class="font-bold"><?=$ProjectGallery->GetProjectGalleryByWebsiteNum($SessionWebsiteID); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- begin col-3 -->
    <div class="col-lg-6">
        <div class="widget white-bg box-shadow">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-camera fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> Total Video</span>

                    <h2 class="font-bold"><?=$ProjectVideo->GetProjectVideoByWebsiteNum($SessionWebsiteID); ?></h2>
                </div>
            </div>
        </div>
    </div>
   
    


</div>   

 
<!-- Column Chart-->
						<div class="col-lg-6 top15">
							

    <div class="widget white-bg box-shadow p-xl">

        <h2>
            <?=$SessionWebsiteName;?>
        </h2>
        <ul class="list-unstyled m-t-md">
            <li>
                <span class="fa fa-envelope m-r-xs"></span>
                <label>Email:</label> <?=$SessionWebsiteEmail;?>
            </li>
            <li>
                <span class="fa fa-home m-r-xs"></span>
                <label>Address:</label> <?=$SessionWebsiteAddress;?>
            </li>
            <li>
                <span class="fa fa-phone m-r-xs"></span>
                <label>Contact:</label> <?=$SessionWebsiteMobile;?>
            </li>
        </ul>

    </div>
	</div>





</div>







                <!-- start footer -->
                 <? include 'footer_file_msp.php';?>
                
            </div>
        </div>
    </div>
    </div>
    <!-- Go top -->
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
    <!-- Go top -->
    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/vendor/jquery.min.js"></script>
	<!-- bootstrap js -->
	<script src="assets/js/vendor/bootstrap.min.js"></script>
	<!--  morris Charts  -->
	
    


    <!-- dataTables-->
	<script type="text/javascript" src="assets/js/vendor/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.bootstrap.min.js"></script>
	<!-- js for print and download -->
	<script type="text/javascript" src="assets/js/vendor/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.flash.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/jszip.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/vfs_fonts.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.html5.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.print.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.fixedHeader.min.js"></script>
    
	<script src="assets/js/vendor/chartJs/Chart.bundle.js"></script>
	<script src="assets/js/dashboard1.js"></script>
	<!-- slimscroll js -->
	<script type="text/javascript" src="assets/js/vendor/jquery.slimscroll.js"></script>
	<!-- pace js -->
	<script src="assets/js/vendor/pace/pace.min.js"></script>
	<!-- Sparkline -->
<script src="assets/js/vendor/jquery.sparkline.min.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
<!-- AdminUI demo js-->
<script src="assets/js/adminUIdemo.js"></script>
<!-- start theme config -->
<div class="theme-config ">
    <div class="theme-config-box">
        <div class="spin-icon"> <i class="fa fa-cogs fa-spin"></i> </div>
        <div class="skin-setttings">
            <div class="title">Configuration</div>
            <div class="setings-item"> <span> Collapse menu </span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu" type="checkbox">
                        <label class="onoffswitch-label" for="collapsemenu">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
            </label>
                    </div>
                </div>
            </div>
            <div class="setings-item"> <span> Fixed sidebar </span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar" type="checkbox">
                        <label class="onoffswitch-label" for="fixedsidebar">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
            </label>
                    </div>
                </div>
            </div>
            <div class="setings-item"> <span> Header Fixed </span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input name="headerfixed" class="onoffswitch-checkbox" id="headerfixed" type="checkbox" checked>
                        <label class="onoffswitch-label" for="headerfixed">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
            </label>
                    </div>
                </div>
            </div>
            <div class="setings-item"> <span> Boxed layout </span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout" type="checkbox">
                        <label class="onoffswitch-label" for="boxedlayout">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
            </label>
                    </div>
                </div>
            </div>
            <div class="setings-item"> <span> Fixed footer </span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter" type="checkbox">
                        <label class="onoffswitch-label" for="fixedfooter">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
            </label>
                    </div>
                </div>
            </div>
           <!--  <div class="setings-item viewAllThemes"> <span class="skin-name"> <a href="#"> View All Themes </a> </span> </div>
            <div class="setings-item gohome "> <span class="skin-name"> <a href="http://AdminUI-v1.3.bittyfox.com/"> Go to Lending Page </a> </span> </div> -->
        </div>
    </div>
</div>
<!-- end theme config -->
<!-- start theme View -->
<div class="request-form ng-scope hidden">
    <div class="col-md-12">
        <div class="crossrightsingle">
            <a href="#" class="closeForm"></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>All AdminUI Themes</h2>
                <hr class="small custom">
            </div>
        </div>
        <!-- /.row -->
        <div class="hover14 column row">
            <div class="col-lg-3">
                <a href="../aqua-black/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/aqua-black.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Aqua Black</span> </a>
            </div>
            <div class="col-lg-3">
                <a href="../red/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/red.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Red</span> </a>
            </div>

            <div class="col-lg-3">
                <a href="../light/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/light.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Light</span> </a>
            </div>

            <div class="col-lg-3">
                <a href="../red-green/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/red-green.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Red Green</span> </a>
            </div>
        </div>
        <div class="hover14 column row">
            <div class="col-lg-3">
                <a href="../green/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/green.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Green</span> </a>
            </div>

            <div class="col-lg-3">
                <a href="../dark/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/dark.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Ddark Madison</span> </a>
            </div>

            <div class="col-lg-3">
                <a href="../dark-black/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/dark-black.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Ddark Black</span> </a>
            </div>

            <div class="col-lg-3">
                <a href="../dark-grey/index.html">
                    <figure><img alt="" class="img-responsive" src="../../lendingPage/img/themes/dark-grey.jpg"><samp class="viewDemo">View Demo</samp> </figure>
                    <span>Ddark Grey</span> </a>
            </div>
        </div>
        <!-- /.container -->
    </div>
</div>
<!-- End theme View -->
    
</body>

</html>