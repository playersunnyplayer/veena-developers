<?php
$id=$app->getGetVar('id');

$getType=$app->getGetVar('getType');

if($id=='')
{
	$id=0;
}

$obj_model_user = $app->load_model("customer_address");
$rs_adderess = $obj_model_user->execute("SELECT",false,"","customer_id=".$_SESSION['MarwadiCustID']." and id='".$id."'","id DESC limit 0,1");

$first_name=$rs_adderess[0]['first_name'];
$last_name=$rs_adderess[0]['last_name'];
$phone=$rs_adderess[0]['phone'];
$email=$rs_adderess[0]['email'];
$line1=$rs_adderess[0]['line1'];
$line2=$rs_adderess[0]['line2'];
$zipcode=$rs_adderess[0]['zipcode'];
$city=$rs_adderess[0]['city'];
$state_id=$rs_adderess[0]['state_id'];
$address_type=$rs_adderess[0]['address_type'];
$note=$rs_adderess[0]['note'];
$latitude=$rs_adderess[0]['latitude'];
$longitude=$rs_adderess[0]['longitude'];
$google_address=$rs_adderess[0]['google_address'];
$customer_address_register_date=$rs_adderess[0]['default_address'];
$id=$rs_adderess[0]['id'];

if($id>0)
{
	$add_title='Edit';
}
else
{
	$add_title='Add New';
}


$obj_model_state= $app->load_model("state");
$rs = $obj_model_state->execute("SELECT", false,"","status='Active'");
$records1 = array();
$records1[''] = " Select State";
for($i=0;$i<count($rs);$i++){
$records1[$rs[$i]['id']] = $rs[$i]['name'];
}


?>



<!-- The Modal -->
<div class="modal" id="address-modal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title tu"><?=$add_title?> Address</h4>
        <button type="button" class="close " data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body pr-4 pl-4">
      <div class="checkout-section">
         <form method="post" id="add_customer_address" name="add_customer_address">
            <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","value"=>$id), "id") ?>
            <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","value"=>$_SESSION['MarwadiCustID']), "customer_id") ?>

            
            <div class="row">
               <p class="checkout-section__field col-lg-6 col-12">
                  <label for="f-name">First Name</label>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded required","value"=>$first_name), "first_name") ?>
               </p>

               <p class="checkout-section__field col-lg-6 col-12">
                  <label for="f-name">Last Name</label>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded required","value"=>$last_name), "last_name") ?>
               </p>

               <p class="checkout-section__field col-lg-6 col-12">
                  <label for="address_phone">Mobile Number</label>
                   <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"numbersOnly numbers rounded required","value"=>$phone), "phone") ?>
               </p>
               
               <p class="checkout-section__field col-lg-6 col-12">
                  <label for="locality">Locality</label>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded","value"=>$line2), "line2") ?>
               </p>
               <p class="checkout-section__field col-12">
                  <label for="address_03">Address (Area and Street)</label>
               <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"rounded","rows"=>"1","cols"=>"5","value"=>$line1), "line1") ?>
               </p>

               <p class="checkout-section__field col-lg-4 col-12">
                  <label for="pincode">Pincode</label>
                <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded","value"=>$zipcode), "zipcode") ?>
               </p>

               <p class="checkout-section__field col-lg-4 col-12">
                  <label for="locality">City/District/Town</label>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded","value"=>$city), "city") ?>
               </p>
               <p class="checkout-section__field col-lg-4">
                  <label for="address_province_ship" id="address_province_label">State</label>
                  <? $app->htmlBuilder->buildTag("select", array("class"=>"rounded","selected"=>$state_id, "values"=>$records1,"required"=>""), "state_id") ;?>
               </p>
               <div class="col-lg-12 mb-3 radi-btn col-12">
                  <label><input type="radio" name="address_type" value="Home" 
                     <?php if($address_type==''){?>checked=""<?php }else{ if($address_type=='Home'){?>checked=""<?php } }?>><span>Home</span></label>
                  <label><input type="radio" name="address_type" value="Office" <?php if($address_type=='Office'){?>checked=""<?php }?>><span>Office</span></label>
                  <label><input type="radio" value="Other" name="address_type" <?php if($address_type=='Other'){?>checked=""<?php }?>><span>Other</span></label>
               </div>
               <div class="col-lg-12 mb-3 mt-2 col-12">

                  <button type="submit" class="ajax_modal_submit button button_primary fs__14 btn lh_36 pl-3 pr-3 font-weight-bold mr-3">Save and Deliver Here</button>
                 
               </div>
            </div>
         </form>
      </div>
      </div>


    </div>
  </div>
</div>
<script type="text/javascript">
   $('.numbersOnly').keyup(function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
});

$("input.numbers").keypress(function(event) {

   return /\d/.test(String.fromCharCode(event.keyCode));

});
</script>