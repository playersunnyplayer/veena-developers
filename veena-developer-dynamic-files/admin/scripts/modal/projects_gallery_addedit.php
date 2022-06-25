<?php

$id=$app->getGetVar('id');

$projects_id=$app->getGetVar('project_id');


$obj_model_table = $app->load_model("projects");
$rs_data = $obj_model_table->execute("SELECT", false,"","id='".$projects_id."'");


if($id!='')

{

	//Edit projects_gallery

	$obj_brand = $app->load_model("projects_gallery");

	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			



	$link=$result[0]['link'];

	$sort_id=$result[0]['sort_id'];

	$projects_gallery_category_id=$result[0]['projects_gallery_category_id'];
	$status=$result[0]['status'];
	$title=$result[0]['title'];

	

	$folder='projects_gallery';

	




	//Mobile

	$image=$result[0]["image"];

	$projects_gallery_img=$app->utility->get_image_path($image,$folder,'thumb');

	

	

	//image		

	$img_name=$result[0]["mobile_image"];

	$log_img=$app->utility->get_image_path($img_name,$folder,'thumb');

}

else

{

	//Add projects_gallery

	$log_img='images/img_upl.gif';

	$projects_gallery_img='images/img_upl.gif';	

}




$obj_model_brand = $app->load_model("projects_gallery_category");
$rs = $obj_model_brand->execute("SELECT", false,"","status='Active'");
$records1 = array();
$records1[''] = " Select";
for($i=0;$i<count($rs);$i++){
$records1[$rs[$i]['id']] = $rs[$i]['name'];
}



?>

<div class="modal fade" id="modal_projects_gallery_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Gallery - <?=$rs_data[0]['name']?></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="projects_gallery_form" id="projects_gallery_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$projects_id), "projects_id") ?>
        
        
        <div class="modal-body">
          <div class="form-row">
          
          
          
          <div class="form-group col-md-6">
              <label for="inputEmail4">Category <span class="tx-danger">*</span></label>
               <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$projects_gallery_category_id, "values"=>$records1,"required"=>""), "projects_gallery_category_id") ;?>
            </div>
            
              <div class="form-group col-md-6">
              
              <label for="inputEmail4">Sort Id <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('projects_gallery'),"required"=>""), "sort_id") ;?>
         
         
              
              </div>
          
          
            <div class="form-group col-md-12">
              <label for="inputEmail4">Title <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","value"=>$title,"required"=>"required"), "title") ?>
            </div>
          

            <div class="form-group col-md-6">
              <label for="inputEmail4">Image <span class="tx-danger">*</span></label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new" > <img src="<?=$projects_gallery_img;?>" class="up_img"> </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                <div> <span class="btn btn-file btn-default"> <span class="mg-t-5 fileupload-new btn btn-white btn-xs">Select image</span><span class="fileupload-exists btn btn-white btn-xs">Change</span>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "projects_gallery_image") ?>
                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a> </div>
              </div>
              
              <span class="help-block"><strong>Size :</strong> 1000 x 1000 px</span>
            </div>

            
            

          
            
            <div class="form-group col-md-6">
              
              <label for="inputEmail4">Status</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn projects_gallery_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
