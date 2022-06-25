<?php

$id=$app->getGetVar('id');


if($id!='')

{

	//Edit blog_category

	$obj_brand = $app->load_model("blog_category");

	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			



	$link=$result[0]['link'];

	$sort_order=$result[0]['sort_order'];

	$slug=$result[0]['slug'];
	$status=$result[0]['status'];
	$name=$result[0]['name'];

	

	$folder='blog_category';

	




	//Mobile

	$image=$result[0]["image"];

	$blog_category_img=$app->utility->get_image_path($image,$folder,'thumb');

	

	

	//image		

	$img_name=$result[0]["mobile_image"];

	$log_img=$app->utility->get_image_path($img_name,$folder,'thumb');
	
							 if($result[0]['image']!='' && file_exists(ABS_PATH."/uploads/blog_category/".$result[0]['image']))
                              {
                                $floor_link1_icon='../uploads/blog_category/'.$result[0]['image'];
                              }

}

else

{

	//Add blog_category

	$log_img='images/img_upl.gif';

	$blog_category_img='images/img_upl.gif';	
	$image='';
	
	
	$floor_link1_icon='';

}




$obj_model_brand = $app->load_model("category");

$rs = $obj_model_brand->execute("SELECT", false,"","status='Active'");

$records1 = array();

$records1[''] = " Select Category";

for($i=0;$i<count($rs);$i++){

$records1[$rs[$i]['id']] = $rs[$i]['category_name'];

}



?>

<div class="modal fade" id="modal_blog_category_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Category Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="blog_category_form" id="blog_category_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
          <div class="form-row">
          
          
           <div class="form-group col-md-12">
              <label for="inputEmail4">Name <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","required"=>"","value"=>$name), "name") ?>
            </div>
          



 
           <div class="form-group col-md-12">
              <label for="inputEmail4">Slug <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","required"=>"","value"=>$slug), "slug") ?>
              <span class="tx-danger" style="font-size: 11px;"><strong>Note :</strong> Do not use space and special characters (%,* etc)</span>
            </div>
          
            

           
            
            <div class="form-group col-md-6">
              <label for="inputEmail4">Sort Id <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('blog_category'),"required"=>""), "sort_order") ;?>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Status <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn blog_category_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
