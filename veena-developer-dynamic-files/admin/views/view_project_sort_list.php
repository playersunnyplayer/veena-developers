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
              <li class="breadcrumb-item active" aria-current="page">Sort Projects</li>
            </ol>
          </nav>
          <h3 class="mg-b-0 tx-spacing--1">Sort Projects</h3>
        </div>
       
        <div class="d-none d-md-block">
	
   
   
        
        </div>
      </div>
      
      
 
 
     <div data-label="Search" class="df-example demo-table">

          <!-- General Elements Title -->

          

          <!-- END General Elements Title --> 

          

          <!-- General Elements Content -->

          

          <? $this->htmlBuilder->buildTag("form", array("action"=>"","method"=>"post","autocomplete"=>"off","class"=>"form-validate","data-parsley-validate"=>""), "frm_search");?>
          
          
           

          <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>"search"), "act") ?>

          <div class="row">

            
           
                <div class="form-group col-md-3" >
             <label for="inputEmail4">Category  <span class="tx-danger">*</span></label>
             
                <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control required","selected"=>$this->getGetVar('category_id'),"values"=>$this->rs_cats), "category_id") ?>
              </div>
              
              
            
            
                    <div class="form-group col-md-3" >
             <label for="inputEmail4">Tags  <span class="tx-danger">*</span></label>
             
                <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control required","selected"=>$this->getGetVar('tag_id'),"values"=>$this->rs_tags), "tag_id") ?>
              </div>
              
              
              
                 <div class="form-group col-md-4" style="padding:27px 20px" >
           <button type="submit" class="btn btn-success search_button" id="search_payment">Search</button>
                
                <a  class="btn btn-danger" href="index.php?view=project_sort_list">Reset</a> 
              </div>
              
               
                           

              

           

          </div>

          
          
        
        
        
        
            
            
            </div>
    
    
    
    <?php if($this->getGetVar('category_id')!=''){?>
    
      <div data-label="" class="df-example demo-table">
        <table id="table_project" class="table">
          <thead>
            <tr>
             
             
              <th class="">#</th>
              <th class="">Name</th>
               <th class="">Subtitle</th>
                <th class="">Tag</th>
               
            </tr>
            
            <?php if(count($this->rs_projects)>0){?>
            
            <tbody class="row_position">
                    <?php
                       foreach ($this->rs_projects as $user)
					   {
						   
						   if($user['category_ids']=='1')
						{
							$res_type='<br/><span class="badge badge-success">Residential</span>';	
						}
						else if($user['category_ids']=='2')
						{
							$res_type='<br/><span class="badge badge-primary">Commercial</span>';	
						}
						else
						{
							$res_type='';	
						}
						
						
						
					$tag_ids=$this->utility->get_tag_names($user['tag_ids']);
                    ?>
                        <tr id="<?php echo $user['id'] ?>">
                            <td><i class="fa fa-sort"></i></td>
                            <td><?php echo $user['name'] ?><?=$res_type?></td>
                             <td><?php echo $user['subtitle'] ?></td>
                             <td><?php echo $tag_ids ?></td>
                            
                            
                        </tr>
                    <?php 
                        } 
                    ?>
                    </tbody>
                    
                    
                    <?php }else{?>
                    
                    <tbody class="">
                  
                  
                        <tr >
                            <td colspan="4"><p style="text-align:center">No Projects Found</p></td>
                            
                            
                            
                            
                        </tr>
                   
                   
                    </tbody>
                    
                    <?php }?>
          </thead>
        </table>
      </div>
      
      
      <?php }?>
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
<script>
$(function() {
$('#search_payment').click(function(){


	
	
	
	
	
	var category_id=$('#category_id').val();
	var tag_id=$('#tag_id').val();
	
	
	
	//var order_master_name=$('#order_master_name').val();
	
	
	
	if(category_id=='')
	{
		alert("Please Select Category");
		return false;
		
	}
	if(tag_id=='')
	{
		alert("Please Select Tag");
		return false;
		
	}
	
	
	
		
		window.location.href = 'index.php?view=project_sort_list&category_id='+category_id+'&tag_id='+tag_id;
		return false;
	
	
	
	});
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });
        function updateOrder(data) {
            $.ajax({
				
				url: "scripts/ajax/index.php",
               
			   
			 data: "method=project&actionType=projectSort&position="+data,
                type:'post',
               
			   
                success:function(data){
                  
				  
                }
            })
        }
    </script>


