<?php

$id=$app->getGetVar('id');


if($id!='')

{

	//Edit projects_gallery_category

	$obj_brand = $app->load_model("projects_gallery_category");

	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			



	$link=$result[0]['link'];

	$sort_id=$result[0]['sort_id'];

	
	
	$status=$result[0]['status'];
	$name=$result[0]['name'];
	$heading=$result[0]['heading'];

	

	$folder='projects_gallery_category';

	




	//Mobile

	$image=$result[0]["projects_gallery_category_image"];

	$projects_gallery_category_img=$app->utility->get_image_path($image,$folder,'thumb');

	

	

	//image		

	$img_name=$result[0]["mobile_image"];

	$log_img=$app->utility->get_image_path($img_name,$folder,'thumb');

}

else

{

	//Add projects_gallery_category

	$log_img='images/img_upl.gif';

	$projects_gallery_category_img='images/img_upl.gif';	

}




$obj_model_brand = $app->load_model("category");

$rs = $obj_model_brand->execute("SELECT", false,"","status='Active'");

$records1 = array();

$records1[''] = " Select Category";

for($i=0;$i<count($rs);$i++){

$records1[$rs[$i]['id']] = $rs[$i]['category_name'];

}



?>

<div class="modal fade" id="modal_projects_gallery_category_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Category Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="projects_gallery_category_form" id="projects_gallery_category_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
          <div class="form-row">
          

            
            

            
            

            <div class="form-group col-md-12">
              <label for="inputEmail4">Name <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","value"=>$name,"required"=>"required"), "name") ?>
            </div>
            
             <div class="form-group col-md-12">
              <label for="inputEmail4">Display Name <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("textarea", array("rows"=>"3","class"=>"form-control","value"=>$heading,"required"=>"required"), "heading") ?>
            </div>
            
            <div class="form-group col-md-6">
              <label for="inputEmail4">Sort Id</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('projects_gallery_category'),"required"=>""), "sort_id") ;?>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Status</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn projects_gallery_category_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
