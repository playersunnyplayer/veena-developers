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

<!-- file upload  --> 
<link href="lib/bootstrap-file/css/fileupload.css" rel="stylesheet" type="text/css" />

<!--image popup -->
<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
<?php include('includes/menu.php');?>

<div class="content ht-100v pd-0">
  <?php include('includes/header.php');?>
  
  <!-- sidebar -->
  <div class="section-nav" style="display:none;">
    <label class="nav-label">On This Page</label>
    <nav id="navSection" class="nav flex-column"> <a href="#section1" class="nav-link">Basic DataTable</a> <a href="#section2" class="nav-link">Responsive DataTable</a> <a href="#section3" class="nav-link">Data Source (Array)</a> <a href="#section4" class="nav-link">Data Source (Object)</a> </nav>
  </div>
  <!-- df-section-nav -->

  <?php 
    $type=$this->GetgetVar('type');
    if($type=='Enquiry')
    {
        $Enquiry='active';
    }
    elseif($type=='Brochure')
    {
        $Brochure='active';
    }
    elseif ($type=='Floor')
    {
        $Floor='active';
    }
    else
    {
        $All='active';
    }
    ?>          
  
  <div class="content-body">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb df-breadcrumbs mg-b-10">
              <li class="breadcrumb-item"><a href="javascript:void(0)">ENQUIRIES</a></li>
              <li class="breadcrumb-item active" aria-current="page">Project Enquiry</li>
            </ol>
          </nav>
          <h3 class="mg-b-0 tx-spacing--1">Project Enquiry</h3>
        </div>
        <div class="">
         
          <a href="index.php?view=project_enquiry_list&act=export_data&type=<?=$type?>" class="btn btn-sm pd-x-15 btn-warning btn-uppercase mg-l-5"><i data-feather="download" class="wd-10 mg-r-5"></i> Excel Export</a>


          <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5" onclick="mulitple_project_enquiry_select();"><i data-feather="trash" class="wd-10 mg-r-5"></i> Delete</button>
        </div>
      </div>
      
      <?=$this->utility->get_message()?>
     <!-- <p class="mg-b-30">Sytem accept only order of below project_enquiry.</p>-->
        

        <div class="df-example datatable-menu-tab">
          <ul class="nav justify-content-left">
        
          <input type="hidden" name="data_type" id="data_type" value="<?=$type?>">

            <li class="nav-item">
              <a class="nav-link <?=$All?>" href="index.php?view=project_enquiry_list&amp;type=">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=$Enquiry?>" href="index.php?view=project_enquiry_list&amp;type=Enquiry">Enquiry</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=$Brochure?>" href="index.php?view=project_enquiry_list&amp;type=Brochure">Brochure</a>
            </li>
            
              <li class="nav-item">
              <a class="nav-link <?=$Floor?>" href="index.php?view=project_enquiry_list&amp;type=Floor">Floor Plan</a>
            </li>

          </ul>
      </div>



      <div data-label="" class="df-example demo-table">
        <table id="table_project_enquiry" class="table">
          <thead>
            <tr>
              <th class="wd-5p"><div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input checkAll" id="customCheck0" name="select_multiple" value="Yes">
                  <label class="custom-control-label" for="customCheck0"></label>
                </div></th>
              <th class="wd-5p">SR.</th>
              <th class="wd-10p">Project</th>
               <th class="wd-10p">Type</th>
              <th class="wd-10p">Name</th>
              <th class="wd-10p">Phone</th>
               <th class="wd-10p">Email</th>
              <th class="wd-10p">Date</th>
              <th class="wd-10p">Action</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- df-example -->
      
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
<script src="lib/validate/js/jquery.validate.min.js"></script> 


<!-- file upload  --> 
<script src="lib/bootstrap-file/js/fileupload.js"></script> 
<!-- Custom --> 
<script src="scripts/js/grocery.js"></script> 
<script src="scripts/js/project_enquiry.js<?=ALLVERSION?>"></script> 
