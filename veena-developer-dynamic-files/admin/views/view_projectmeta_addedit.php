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


<!-- file upload  --> 
<link href="lib/bootstrap-file/css/fileupload.css" rel="stylesheet" type="text/css" />

<!--image popup -->
<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />



<!--Sweet Alert CSS & JS -->
<link href="lib/alert/css/sweet-alert.css" rel="stylesheet" type="text/css" />
<style>
.scrollbox {
  overflow-y: scroll;
  max-height: 220px;
  border: 1px solid #dae0e8;
}

.even {
  margin-left: 20px;
}

.price_varient {
  padding: 0;
  margin: 0;
}
</style>
<?php include('includes/menu.php');?>
  <div class="content ht-100v pd-0">
    <?php include('includes/header.php');?>
      <!-- content-header -->
      <div class="content-body">
        <div class="container pd-x-0">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Mannage Project</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <?=$this->to_do?>
                  </li>
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">
              <?=$this->to_do?>
              <?=$this->manage_for?>
              </h4>
            </div>
            <div class="d-none d-md-block"> </div>
          </div>
          <?=$this->utility->get_message()?>
            <? $this->htmlBuilder->buildTag("form", array("action"=>"","data-parsley-validate"=>"","class"=>"form-horizontal form-bordered form-validate"), "frm_project_addedit");?>
              <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>$this->getGetVar('id')), "id");?>
                <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>"update_data"), "act");?>
                  <div class="row">
                    <div class="col-lg-12">
                    
                    
					
                      
                      
                      
                      
                      
                      
                      
                      
                      
                     
                      
                      
                      
                      
                      
                      
                      
                      
                      <div data-label="Project Meta" class="df-example demo-forms projectsAll OtherDivs">
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Name <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>"","readonly"=>"readonly"), "title") ;?>
                          </div>


                          
                          
                          <div class="form-group col-md-12">
                  <label class="control-label" for="example-email">Meta Title</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control"), "meta_title") ?>
                  <?=$logo?>
                </div>
                
                <div class="form-group col-md-12">
                  <label class="control-label" for="example-email">Meta Keywords</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control"), "meta_keywords") ?>
                  <?=$logo?>
                </div>
                
                
                <div class="form-group col-md-12">
                  <label class="control-label" for="example-email">Meta Description</label>
                 <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control"), "meta_desc") ?>
                  <?=$logo?>
                </div>
                          
                          
                          
                          
                              <div class="form-group col-md-12">
                  <label class="control-label" for="example-email">Chat Code</label>
                 <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control"), "chat_code") ?>
                  <?=$logo?>
                </div>
                          
                          
                          
                              <div class="form-group col-md-12">
                  <label class="control-label" for="example-email">Header Code</label>
                 <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control"), "head_body") ?>
                  <?=$logo?>
                </div>
                          
                         
                         
                        </div>
                        
                         
						 
                          
                          
                      </div>
                      
                      
                      
                      
                          
                      
                       
                       
                      
                      
                      
                      
                      
                      
                      
                    </div>
                  </div>
                  <div class="row mg-t-15">
                    <div class="col-lg-12">
                      <button class="btn btn-primary" id="product_btn" type="submit">Submit</button> <a class="btn btn-secondary" href="index.php?view=projectmeta_list">Cancel</a> </div>
                  </div>
                  </form>
                  <?php include('includes/footer.php');?>
        </div>
        <!-- container -->
      </div>
  </div>



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

<!-- image popup --> 
<script src="lib/magnific-popup/js/jquery.magnific-popup.js"></script> 

<!-- Custom --> 
<script src="scripts/js/grocery.js"></script> 

 <script src="lib/jqueryui/jquery-ui.min.js"></script>
  <script src="lib/editor/ckeditor/ckeditor.js"></script>
  <script>
  
  
  function checkMasterTagValue()
  {
	  
	 var myarray=$(".tag_idsVal").val();
	 
	
	if(jQuery.inArray("1", myarray))
	{
		
		$(".OtherDivs").hide();
		
		
	}
	else
	{
		$(".OtherDivs").show();
				
		
	}
	
	
	  
	 }
  
function add_attr_fields()
{
	var tabname_rows=$("#tabname_1").html();
	var tabqty_rows=$("#tabqty_1").html();
	var opt_data=$(".masterSelection").html();
	
	
	
	var total_rows=$("#use_rows tr").length;
	var row_id=parseInt(total_rows)+1;
	var html_table_row='<tr id="row_'+row_id+'">';
	html_table_row+='<input type="hidden" name="table_id[]" value="0">';
	
	html_table_row+='<td> <select class="span12 form-control"  id="final_price_p_'+row_id+'" name="final_price_p[]">'+opt_data+'</select></td>';
	html_table_row+='<td> <input type="text"id="points_p_'+row_id+'" name="points_p[]" class="form-control span12"  /> </td>';
	html_table_row+='<td> <a class="btn btn-sm btn-danger" href="javascript:remove_user_row('+row_id+')"> <i class="icon-remove"></i>  <strong>X</strong> </a></td>';
	html_table_row+='</tr>';
	$('#use_rows tr:last').after(html_table_row);
	  jQuery(document).ready(function($) {
	});
	$("input.numbers").keypress(function(event) {
  return /\d/.test(String.fromCharCode(event.keyCode));
});
	 $('.numbersOnly').keyup(function ()
{
    if (this.value != this.value.replace(/[^0-9\.]/g, ''))
	{
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
});
	 remove_error_class();
}
function remove_user_row(del_id)
	{
	var row_id="row_"+del_id;
	$("#"+row_id).remove();
	get_total();
    }
	function remove_user_row1(del_id)
	{
	var row_id="row_"+del_id;
	$("#"+row_id).remove();
	 get_total();
    }
	
	
	
	$(document).on("click",".record_delete_attribute_onclick", function ()
{
	var getid=$(this).data('id');
	if(getid!='')
	{
		 swal({
                title: "Are you sure?",
                text: "You will not be able to undo after this action!",
                type: "warning",
                showCancelButton: true,
				cancelButtonClass: 'btn-primary',
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Yes, delete it!",
				confirmButtonClass: "confirm btn btn-lg btn-warning xyz",
                closeOnConfirm: true
            }, function (r)
			{
				if(r == true)
				{
					$.ajax({
						  type: "POST",
						  dataType: 'json',
						  url: "scripts/ajax/index.php",
						  data: "method=project&actionType=projectHighlightsDelete&getid="+getid,
						  success: function(responseData)
						  {
								  if(responseData.RESULT==0)
								  {
									$(".rowd_"+getid).remove();
									$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>Record Deleted Successfully.</p>', {type:'warning',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
									  
 									return false;
								  }
								  else
								  {
									  swal({ title: "Try Again...",
									  text: data.msg,
									  type: "warning",
									   timer: 1000
									  });
									  return false;
								  }
							  }
						  });
				}
				else
				{
					return false;
				}
            });
	}
	else
	{
		swal({ title: "Try Again...",
                text: "Oops Something gone wrong...",
                type: "warning",
				 timer: 1500
            });
			return false;
	}
});
  </script>


  <script type="text/javascript">
    //select 2 reload
  $(".select2").select2();
  
  
    $(".select3").select2();

  </script>