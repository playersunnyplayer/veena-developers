<?php
$id=$app->getGetVar('id');

if($id!='')
{
	//Edit Banner
	$obj_brand = $app->load_model("banner");
	$result = $obj_brand->execute("SELECT", false, "", "id='".$id."'");			
	$link=$result[0]['link'];
	$sort_id=$result[0]['sort_id'];
	$banner_link=$result[0]['banner_link'];
	$status=$result[0]['status'];
	$name=$result[0]['name'];
	$image_alt=$result[0]['image_alt'];

	$folder='banner';

	//Mobile
	$image=$result[0]["banner_image"];
	$banner_img=$app->utility->get_image_path($image,$folder,'thumb');

	//image		
	$img_name=$result[0]["mobile_image"];
	$log_img=$app->utility->get_image_path($img_name,$folder,'thumb');
}
else
{
	//Add Banner
	$log_img='images/img_upl.gif';
	$banner_img='images/img_upl.gif';	
}

if($image!='')
{
	$file_class="fileupload-exists";
}
else
{
	$file_class="fileupload-new";
}

if($img_name!='')
{
  $file_class1="fileupload-exists";
}
else
{
  $file_class1="fileupload-new";
}
?>

<div class="modal fade" id="modal_banner_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Banner Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="banner_form" id="banner_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Web Banner Image <span class="tx-danger">*</span></label>
              
              <div class="fileupload <?=$file_class;?>" data-provides="fileupload">
                <div class="fileupload-new" > <img src="images/img_upl.gif" class="up_img"> </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"> <img src="<?=$banner_img;?>" />  </div>
                <div>
                	<span class="btn btn-file btn-default"> 
                    	<span class="fileupload-new btn btn-white btn-xs">Select image</span>
                    	<span class="fileupload-exists btn btn-white btn-xs">Change</span>
                    	<? $app->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "banner_image") ?>
                    </span> 
                    <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a> 
                </div>
              </div>
              
              <span class="tx-11-f tx-danger"><strong>Dimensions :</strong> 1920 x 730 px</span> 
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Mobile Banner Image <span class="tx-danger">*</span></label>

              <div class="fileupload <?=$file_class;?>" data-provides="fileupload">
                <div class="fileupload-new" > <img src="images/img_upl.gif" class="up_img"> </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><img src="<?=$log_img;?>" /> </div>
                <div> <span class="btn btn-file btn-default"> <span class="mg-t-5 fileupload-new btn btn-white btn-xs">Select image</span><span class="fileupload-exists btn btn-white btn-xs">Change</span>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "mobile_banner") ?>
                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a> </div>
              </div>

              <span class="tx-11-f tx-danger"><strong>Dimensions :</strong> 760 x 640 px</span> </div>
              
              <div class="form-group col-md-12">
              <label for="inputEmail4">Image Alt</label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","value"=>$image_alt), "image_alt") ?>
            </div>
              
            <div class="form-group col-md-12">
              <label for="inputEmail4">Link</label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","value"=>$banner_link), "banner_link") ?>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Sort Id</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('banner'),"required"=>""), "sort_id") ;?>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Status</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control","selected"=>$status, "values"=>array("Active"=>"Active","Inactive"=>"Inactive"),"required"=>""), "status") ;?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn banner_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
