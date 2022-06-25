<!-- vendor css -->
<link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/typicons.font/typicons.css" rel="stylesheet">
<link href="lib/prismjs/themes/prism-vs.css" rel="stylesheet">
<link href="lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="lib/select2/css/select2.min.css" rel="stylesheet">

<!-- DashForge CSS -->
<link rel="stylesheet" href="assets/css/dashforge.css">
<link rel="stylesheet" href="assets/css/dashforge.demo.css">

<!-- Skin CSS -->
<link rel="stylesheet" href="assets/css/skin.cool.css">
<!--<link rel="stylesheet" href="assets/css/skin.charcoal.css">-->

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/custom.css">

<!--Sweet Alert CSS & JS -->
<link href="lib/alert/css/sweet-alert.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="lib/dropzone/dropzone.css" />
<?php include('includes/menu.php');?>

<div class="content ht-100v pd-0">
  <?php include('includes/header.php');?>
  
  <!-- sidebar -->
  <div class="section-nav" style="display:none;">
    <label class="nav-label">On This Page</label>
    <nav id="navSection" class="nav flex-column"> <a href="#section1" class="nav-link">Basic DataTable</a> <a href="#section2" class="nav-link">Responsive DataTable</a> <a href="#section3" class="nav-link">Data Source (Array)</a> <a href="#section4" class="nav-link">Data Source (Object)</a> </nav>
  </div>
  <!-- df-section-nav -->
  
  <div class="content-body">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb df-breadcrumbs mg-b-10">
              <li class="breadcrumb-item"><a href="javascript:void(0)">CSR Page</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">CSR Category</a></li>
              
              <li class="breadcrumb-item active" aria-current="page"><?=$this->rs_product['title']?></li>
            </ol>
          </nav>
          <h3 class="mg-b-0 tx-spacing--1">Images Upload - <span style=""><?=$this->rs_product['title']?></span></h3>


        </div>
      </div>
      <!--  <p class="mg-b-30">Sytem accept only order of below city.</p>-->
      <div data-label="Multi Images Upload" class="df-example demo-table">
        <div class="block">
          <form class="dropzone" id="my_awesome_dropzone" enctype="multipart/form-data">
            
            
            
            <input type="hidden" name="product_id" id="product_id" value="<?=$this->getGetVar("product_id")?>"/>
            <input type="hidden" name="folder" id="folder" value="<?=$this->rs_product['folder']?>"/>
            
            
          </form>

          <span class="tx-11-f tx-danger"><strong>Dimensions :</strong> 1000 x 1000 px</span>
          
          <div class="form-bordered" style="clear:both;    margin-top: 20px;">
            

            <div class="form-group form-actions">
              <button type="button"  id="newAlbum" class="btn btn-effect-ripple btn-primary">Upload Photos</button>
              <a href="index.php?view=multi_image_upload&product_id=<?=$this->getGetVar("product_id")?>" class="btn btn-effect-ripple btn-danger">Reset</a> </div>
          </div>
        </div>
      </div>
      <!-- df-example -->
      
      
      <div data-label="Images" class="df-example demo-table">
        <table id="table_product" class="table">
          <thead>
            <tr>
              <th class=""><div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input checkAll" id="customCheck0" name="select_multiple" value="Yes">
                  <label class="custom-control-label" for="customCheck0"></label>
                </div></th>
              <th class="">SR.</th>
              <th class="">Image</th>
             
              <th class="">Sort ID</th>            
             
              <th class="">Status</th>
              <th class="">Action</th>
            </tr>
          </thead>
        </table>
      </div>
      
      <?php include('includes/footer.php');?>
      <!-- content-footer --> 
      
    </div>
    <!-- container --> 
  </div>
</div>
<!-- content --> 

<script src="lib/jquery/jquery.min.js"></script> 
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="lib/feather-icons/feather.min.js"></script> 
<script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
<script src="lib/prismjs/prism.js"></script> 
<script src="lib/parsleyjs/parsley.min.js"></script> 
<script src="lib/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script> 
<script src="lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script> 
<script src="lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script> 
<script src="lib/select2/js/select2.min.js"></script> 
<script src="assets/js/dashforge.aside.js"></script> 
<script src="assets/js/dashforge.js"></script> 

<!-- other include --> 
<script src="lib/alert/js/sweet-alert.min.js"></script> 
<script src="lib/alert/js/jquery.sweet-alert.init.js"></script> 

<!-- image popup --> 
<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
<script src="lib/magnific-popup/js/jquery.magnific-popup.js"></script> 

<script src="lib/validate/js/jquery.validate.min.js"></script> 

<!-- Custom --> 
<script src="scripts/js/grocery.js"></script> 

<script src="scripts/js/product_images.js<?=ALLVERSION?>"></script> 
<script src="lib/dropzone/dropzone.js"></script> 
<script>

Dropzone.autoDiscover = false;
$(function() {
	
	
	
			var product_id=$("#product_id").val();
			var folder=$("#folder").val();
			

        var myDropzone = new Dropzone("#my_awesome_dropzone",{
            url: "scripts/ajax/index.php?method=images_uploads&product_id="+product_id+"&folder="+folder+"",
            addRemoveLinks: true,
			acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFiles: 30,
			
            uploadMultiple: true,
            parallelUploads: 100,
            createImageThumbnails: true,
            autoProcessQueue: false
        });
			$(document).on("click","#newAlbum", function ()
			{
				myDropzone.on("sending", function(file, xhr, formData) {
	   
				});
				myDropzone.processQueue(); // Tell Dropzone to process all queued files.
          	// alert('show this to have time to upload');
        });

    });
</script> 

<!-- file upload  -->
<link href="lib/bootstrap-file/css/fileupload.css" rel="stylesheet" type="text/css" />
<!-- file upload  --> 
<script src="lib/bootstrap-file/js/fileupload.js"></script> 
