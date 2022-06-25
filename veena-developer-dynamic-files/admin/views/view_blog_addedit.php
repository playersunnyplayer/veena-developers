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
                  <li class="breadcrumb-item"><a href="#">Mannage Blog</a></li>
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
                    
                      
                      <div data-label="Project Location" class="df-example demo-forms">
                        <div class="form-row">
                        
                        
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Category <span class="tx-danger">*</span></label>
                           <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control ", "values"=>$this->cat_data,"required"=>""), "category_id") ;?>
                          </div>
                          
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Date <span class="tx-danger">*</span></label>
                            
                            
                            <?php
							if($this->getGetVar('id')>0)
							{
								
								$added_date=$this->rscat["added_date"];
							}
							else
							{
								$added_date=date('d-m-Y');
								
							}
							?>
                            
                            
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control input-datepicker required","type"=>"text","data-date-format"=>"dd-mm-yyyy","required"=>"","value"=>$added_date), "added_date") ;?>
                            
                            
                            
                            
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Title <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>""), "title") ;?>
                          </div>


                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Slug <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>""), "slug") ;?>
                            <span class="tx-danger" style="font-size: 11px;"><strong>Note :</strong> Do not use space and special characters (%,* etc)</span>
                          </div>
                          
                          
                          
                          
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Tags</label>
                             <select class="form-control select3" multiple="multiple" name="projects_amenities_master_ids1[]">
                            
                            
                            
                            
                            
                            
                            
                            
                              <? for($i=0;$i<count($this->rs_amenities_master);$i++)
                                  {
                                  $micro_items=explode(',',$this->rscat['tag_ids']);
                                  ?>
                                <option value="<?=$this->rs_amenities_master[$i]['id']; ?>" <? for($j=0;$j<count($micro_items);$j++) {if($this->rs_amenities_master[$i]['id']==trim($micro_items[$j])){echo 'selected';}} ?>>
                                  <?=$this->rs_amenities_master[$i]['name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                          </div>
                           
                           
                             <div class="form-group col-md-12">
                            <label for="inputEmail4">Short Description <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control","required"=>"","rows"=>"3"), "short_info") ;?>
                          </div>
                          
                          

                          
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Description</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor"), "description") ;?>
                          </div>
                          
                          
                          
                          
                           <?php 
                          $folder='blog';
                          $image=$this->rscat["image"];
                          $image_img=$this->utility->get_image_path($image,$folder,'large');

                           if($image!='')
                            {
                              $file_class="fileupload-exists";
                            }
                            else
                            {
                              $file_class="fileupload-new";
                            }
                          ?>
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">List Page Image <span class="tx-danger">*</span></label>

                            <div class="fileupload <?=$file_class;?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"><img src="<?=$image_img;?>" class="up_img"/></div>
                              <div> 
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "image") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                              <span class="tx-11-f tx-danger"><strong>Dimension :</strong>  550 x 550 px</span>
                            </div>

                          </div>
                          
                            <?php 
                          $folder='blog';
                          $image=$this->rscat["detail_image"];
                          $image_img=$this->utility->get_image_path($image,$folder,'large');

                           if($image!='')
                            {
                              $file_class="fileupload-exists";
                            }
                            else
                            {
                              $file_class="fileupload-new";
                            }
                          ?>
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Detail Page Image <span class="tx-danger">*</span></label>

                            <div class="fileupload <?=$file_class;?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"><img src="<?=$image_img;?>" class="up_img"/></div>
                              <div> 
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "detail_image") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                              <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 1920 x 340 px</span>
                            </div>

                          </div>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Sort ID</label>
                           <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control ", "values"=>$this->utility->sort_order('blog'),"required"=>""), "sort_order") ;?>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Status</label>
                           <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control ", "values"=>array("Active"=>"Active","Inacitve"=>"Inacitve"),"required"=>""), "status") ;?>
                          </div>
                         
                         
                        </div>
                        
                  
                
                      </div>



                       <div data-label="SEO Info" class="df-example demo-forms">
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Title</label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text"), "meta_title") ;?>
                          </div>

                          	  <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Keywords</label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text"), "meta_keywords") ;?>
                          </div>

                          
                          
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Description</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control"), "meta_desc") ;?>
                          </div>

                              <div class="form-group col-md-6">
                            <label for="inputEmail4">Head Code</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text"), "head_code") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Body Code </label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text"), "body_code") ;?>
                          </div>
                          
                         <div class="form-group col-md-12">
                            <label for="inputEmail4">Chat Code</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control"), "chat_code") ;?>
                          </div>
                         
                        </div>
                        
                  
                
                      </div>
                      

                      
                      
                      
                      
                      
                    </div>
                  </div>
                  <div class="row mg-t-15">
                    <div class="col-lg-12">
                      <button class="btn btn-primary" id="product_btn" type="submit">Submit</button> <a class="btn btn-secondary" href="index.php?view=blog_list">Cancel</a> </div>
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
  
  
  
  

<!--<script src='lib/selectdropdown/jquery-ui.min.js' type='text/javascript'></script> --> 

<script>

     

	 



$(function () {

  $(".input-datepicker").datepicker({ 

  format: 'dd-mm-yyyy',

  minDate: '<?=$this->minDate?>',

  maxDate: '<?=$this->maxDate?>',

  autoclose: true	        

  });

});

    </script> 
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
  
  
   // $(".select3").select2();
	
	
	
	
  $('.select3').select2({
    placeholder: 'select a value',
    width: '100%'
  });

  //set select order
  $(".select3").on("select2:select", function(evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });

  //Drap and drop
  $.fn.extend({
    select2_sortable: function() {
      var select = $(this);
      var ul = $(select).next(".select2-container").first("ul.select2-selection__rendered");
      ul.sortable({
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        items: "li:not(.select2-search__field)",
        tolerance: "pointer",
        stop: function() {
          $($(ul).find(".select2-selection__choice").get().reverse()).each(function() {
            var title = $(this).attr("title");
            var option = $(select).find("option:contains(" + title + ")");
            $(select).prepend(option);
          });
        }
      });
    }
  });

  $(".select3").each(function() {
    $(this).select2_sortable();
  });



  </script>