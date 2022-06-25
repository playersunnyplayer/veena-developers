<?php

$id=$app->getGetVar('id');


if($id!='')

{

	//Edit amenities_master

	$obj_brand = $app->load_model("amenities_master");

	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			



	$link=$result[0]['link'];

	$sort_order=$result[0]['sort_order'];

	$amenities_master_link=$result[0]['amenities_master_link'];
	$status=$result[0]['status'];
	$name=$result[0]['name'];

	

	$folder='amenities_master';

	




	//Mobile

	$image=$result[0]["image"];

	$amenities_master_img=$app->utility->get_image_path($image,$folder,'thumb');

	

	

	//image		

	$img_name=$result[0]["mobile_image"];

	$log_img=$app->utility->get_image_path($img_name,$folder,'thumb');
	
							 if($result[0]['image']!='' && file_exists(ABS_PATH."/uploads/amenities_master/".$result[0]['image']))
                              {
                                $floor_link1_icon='../uploads/amenities_master/'.$result[0]['image'];
                              }

}

else

{

	//Add amenities_master

	$log_img='images/img_upl.gif';

	$amenities_master_img='images/img_upl.gif';	
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

<div class="modal fade" id="modal_amenities_master_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Amenities Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="amenities_master_form" id="amenities_master_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
          <div class="form-row">
          
          
           <div class="form-group col-md-12">
              <label for="inputEmail4">Name <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","required"=>"","value"=>$name), "name") ?>
            </div>
          

            <div class="form-group col-md-6" >
              <label for="inputEmail4">Image File <span class="tx-danger">*</span></label>
              
              <?php if($image==''){?>
              
              <? $app->htmlBuilder->buildTag("input", array("type"=>"file","class"=>"form-control","required"=>""), "file1") ?>
              <?php }else
			  {?>
              
               <? $app->htmlBuilder->buildTag("input", array("type"=>"file","class"=>"form-control"), "file1") ?>
               
              
              
              
              <?php }?>

             <span class="tx-11-f tx-danger"><strong>File Type : </strong> SVG only</span>
            </div>

            <?php if($floor_link1_icon!=''){?>
            <div class="form-group col-md-6">
              <div class="text-center">
                <a href="<?=$floor_link1_icon?>" target="_blank" >
                <img src="<?=$floor_link1_icon?>" class="up_img">
                  </a>
              </div>
            </div>
          <?php }?>
      
           
            
           <!--  <div class="form-group col-md-6">
              <label for="inputEmail4">Sort Id</label>
              <? //$app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('amenities_master'),"required"=>""), "sort_order") ;?>
            </div> -->
            <div class="form-group col-md-6">
              <label for="inputEmail4">Status <span class="tx-danger">*</span></label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn amenities_master_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
