<?php
$id=$app->getGetVar('id');

if($id!='')
{
	$obj_brand = $app->load_model("career_jobs");
	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			
	
	$title=$result[0]['title'];
	$experience=$result[0]['experience'];
	$qualification=$result[0]['qualification'];
	$sort_id=$result[0]['sort_id'];
	$status=$result[0]['status'];
	

	
	
}


?>

<div class="modal fade" id="modal_career_jobs_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Jobs Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="career_jobs_form" id="career_jobs_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
        
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputEmail4">Title <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control ","value"=>$title,"required"=>""), "title");?>
            </div>

             <div class="form-group col-md-12">
              <label for="inputEmail4">Experience <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control ","value"=>$experience,"required"=>""), "experience");?>
            </div>

          </div>
          
          
           <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Qualification <span class="tx-danger">*</span></label>
             <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control  required","value"=>$qualification,"required"=>""), "qualification") ;?>
            </div>
            </div>
            

           <div class="form-row">
           
           
            <div class="form-group col-md-6">
               <label for="inputEmail4">Sort Id</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('career_jobs'),"required"=>""), "sort_id") ;?>
              </div>
              
            <div class="form-group col-md-6">
               <label for="inputEmail4">Status</label>
             <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
           
            </div>

  
  
            
            
            
            
          </div>
          
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn career_jobs_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
