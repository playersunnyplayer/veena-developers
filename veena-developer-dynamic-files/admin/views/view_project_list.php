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
.select2-container {
    z-index: 99;
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
              <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Project</a></li>
              <li class="breadcrumb-item active" aria-current="page">Projects</li>
            </ol>
          </nav>
          <h3 class="mg-b-0 tx-spacing--1">Projects</h3>
        </div>
       
        <div class="d-none d-md-block">
	
      <a href="index.php?view=project_addedit" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="plus" class="wd-10 mg-r-5" ></i> Add New</a>

          <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5" onclick="mulitple_project_select();"><i data-feather="trash" class="wd-10 mg-r-5"></i> Delete</button>
        
        </div>
      </div>
      
      
     <?=$this->utility->get_message()?>
     
     
     <div data-label="Search" class="df-example demo-table">

          <!-- General Elements Title -->

          

          <!-- END General Elements Title --> 

          

          <!-- General Elements Content -->

          

          <? $this->htmlBuilder->buildTag("form", array("action"=>"","method"=>"post","autocomplete"=>"off","class"=>"form-validate","data-parsley-validate"=>""), "frm_search");?>
          
          

          <div class="row">

            
                                    
                                     <div class="form-group col-md-4">
                                     
                                
                                
                                   <label>Tag</label>
                                   
                                   
                                    <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$_SESSION['search_p_cat_id'], "values"=>$this->category), "p_cat_id") ?>
                                    </div>
                                    
                                       <div class="form-group col-md-6" style="padding-top:28px">
                                        <label></label>
                                           <button type="button" class="btn btn-success search_button" id="search_payment">Search</button>
                
                <a  class="btn btn-danger" href="javascript:void(0)" onclick="reset_p_data();">Reset</a> 
                                       
                                       
                                       </div>

              

           

          </div>

          
        
        
        
            
            
            </div>
     
    
    <div class="df-example datatable-menu-tab">
          <ul class="nav justify-content-left">
          
          <?php
		  
		   $all='';
		   $paid='';
		   $Canceled='';
		  
		  if($this->getGetVar('product_status')=='')
		  {
			   $all='active';  
		  }
		  else  if($this->getGetVar('product_status')=='Residential')
		  {
			   $paid='active';
		  }
		  else  if($this->getGetVar('product_status')=='Commercial')
		  {
			   $Collect='active';
		  }
		  
		  else
		  {
			  $all='active'; 
			  
		 }
		  ?>
          
          
          <input type="hidden" name="current_status" id="current_status" value="<?=$this->getGetVar('product_status')?>">

            <li class="nav-item">
              <a class="nav-link <?=$all?>"  href="index.php?view=project_list&product_status=">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?=$paid?>" href="index.php?view=project_list&product_status=Residential">Residential</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link <?=$Collect?>" href="index.php?view=project_list&product_status=Commercial">Commercial</a>
            </li>
            
            
          </ul>
      </div>
      <div data-label="" class="df-example demo-table">
        <table id="table_project" class="table">
          <thead>
            <tr>
              <th class="wd-5p"><div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input checkAll" id="customCheck0" name="select_multiple" value="Yes">
                  <label class="custom-control-label" for="customCheck0"></label>
                </div></th>
              <th class="wd-5p">SR.</th>
              <th class="wd-15p">Name</th>
               <th class="wd-15p">Tags</th>
              <th class="wd-10p">Sort Order</th>
              <th class="wd-5p">Status</th>
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
<script src="scripts/js/project.js<?=ALLVERSION?>"></script> 

<script>
$(function() {
$('#search_payment').click(function(){
	
	var p_cat_id=$('#p_cat_id').val();
	
	
		$.ajax

			({

					type: "POST",
					dataType: 'json',
					url: "scripts/ajax/index.php",
					data: "method=set_project_session_data&p_cat_id="+p_cat_id,
					success: function(data)

					{
						
						var oTable = $('#table_project').dataTable( );
						oTable.api().ajax.reload();
						
						
					}

			});	 
	
	
	
	});
});




function reset_p_data()
{
	
	$('#p_cat_id').val('');
	var p_cat_id='';
	
	
	
	
		$.ajax

			({

					type: "POST",
					dataType: 'json',
					url: "scripts/ajax/index.php",
					data: "method=set_project_session_data&p_cat_id="+p_cat_id,
					success: function(data)

					{
						
						var oTable = $('#table_project').dataTable( );
						oTable.api().ajax.reload();
						
						
					}

			});	
	
}
</script>

