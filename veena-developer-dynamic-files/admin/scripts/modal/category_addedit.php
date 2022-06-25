<?php
$id=$app->getGetVar('id');

if($id!='')
{
	//Edit category
	$obj_category= $app->load_model("category");
	$result = $obj_category->execute("SELECT", false, "", "id='".$id."'");			
	$category_name=$result[0]['category_name'];
	$sort_id=$result[0]['sort_order'];
  $meta_keyword=$result[0]['meta_keyword'];
  $meta_description=$result[0]['meta_description'];
  $meta_title=$result[0]['meta_title'];
  $chat_code=$result[0]['chat_code'];
  $category_slug=$result[0]['category_slug'];

}


?>

<div class="modal fade" id="modal_category_addedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Category Form</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form method="post" name="category_form" id="category_form"  data-parsley-validate>
        <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","class"=>"form-control","value"=>$id), "id") ?>
        <div class="modal-body">
          <div class="form-row">

            <div class="form-group col-md-8">
              <label for="inputEmail4">Category Name</label>
              <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control required","required"=>"","value"=>$category_name), "category_name") ?>
            </div>

            <div class="form-group col-md-4">
              <label for="inputEmail4">Sort Id</label>
              <? $app->htmlBuilder->buildTag("select", array("class"=>"form-control ","selected"=>$sort_id, "values"=>$app->utility->sort_order('category'),"required"=>""), "sort_order") ;?>
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">meta_title</label>
              <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control","value"=>$meta_title), "meta_title") ?>
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">Meta Keyword</label>
              <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control","value"=>$meta_keyword), "meta_keyword") ?>
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">Meta Description</label>
              <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control","value"=>$meta_description), "meta_description") ?>
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">Chat Code</label>
              <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control","value"=>$chat_code), "chat_code") ?>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary tx-13 submit_btn category_modal_submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
