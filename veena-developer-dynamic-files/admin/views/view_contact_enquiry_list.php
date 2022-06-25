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







<!--image popup -->

<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />



<style>

.search_box .select2-container {

    z-index: 99;

}



#help_price_form .select2-container {

    z-index: 999 !important;

}

</style>

<?php include('includes/menu.php');?>



<div class="content ht-100v pd-0">



  <?php include('includes/header.php');?>

  

  

  

  <div class="content-body">

    <div class="container">

      <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">

        <div>

          <nav aria-label="breadcrumb">

            <ol class="breadcrumb df-breadcrumbs mg-b-10">

              <li class="breadcrumb-item"><a href="javascript:void(0)">ENQUIRIES</a></li>

              <li class="breadcrumb-item active" aria-current="page">Quick Inquiry</li>

            </ol>

          </nav>

          <h3 class="mg-b-0 tx-spacing--1">Quick Inquiry</h3>

        </div>

       

        <div class="d-none d-md-block">

	
           <a href="index.php?view=contact_enquiry_list&act=export_data" class="btn btn-sm pd-x-15 btn-warning btn-uppercase mg-l-5"><i data-feather="download" class="wd-10 mg-r-5"></i> Excel Export</a>


        </div>

      </div>

      

      

      

     <?=$this->utility->get_message()?>

     
    <div class="df-example datatable-menu-tab">
          <ul class="nav justify-content-left">
          
          <?php
		  
		   $all='';
		   $paid='';
		   $Canceled='';
		  
		  if($this->getGetVar('mastertype')=='')
		  {
			   $all='active';  
		  }
		  else  if($this->getGetVar('mastertype')=='Today')
		  {
			   $paid='active';
		  }
		  
		  
		  
		  else
		  {
			  $all='active'; 
			  
		 }
		  ?>
          
          
          <input type="hidden" name="current_status" id="current_status" value="<?=$this->getGetVar('mastertype')?>">

            <li class="nav-item">
              <a class="nav-link <?=$all?>"  href="index.php?view=contact_enquiry_list&mastertype=">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=$paid?>" href="index.php?view=contact_enquiry_list&mastertype=Today">Today's</a>
            </li>
            
          
          
            
            
          </ul>
      </div>

      <div data-label="" class="df-example demo-table">

        <table id="table_contact_enquiry" class="table">

          <thead>

            <tr>

            
            

              <th class="wd-5p">SR.</th>
              <th class="wd-25p">Name & Phone</th>

             
              <th class="wd-40p">Message</th>

              


              
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



<!-- image popup --> 

<script src="lib/magnific-popup/js/jquery.magnific-popup.js"></script> 



<script src="lib/validate/js/jquery.validate.min.js"></script> 



<!-- Custom --> 

<script src="scripts/js/grocery.js"></script> 

<script src="scripts/js/contact_enquiry.js<?=ALLVERSION?>"></script> 

