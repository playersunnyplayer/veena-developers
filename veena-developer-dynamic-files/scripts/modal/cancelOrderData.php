<?php
$id=$app->getGetVar('id');

$getType=$app->getGetVar('getType');

if($id=='')
{
	$id=0;
}

$obj_model_order= $app->load_model("customer_order_master");
$rs_order= $obj_model_order->execute("SELECT",false,"","id='".$id."'","id DESC limit 0,1");



?>



<!-- The Modal -->
<div class="modal" id="cancel-modal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title tu">Cancel Order #<?=$rs_order[0]['display_order_no']?></h4>
        <button type="button" class="close " data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body pr-4 pl-4">
      <div class="checkout-section">
         <form method="post" id="cancelOrderForm" name="cancelOrderForm">
            <? $app->htmlBuilder->buildTag("input", array("type"=>"hidden","value"=>$id), "orderID") ?>
           
           

            
            <div class="row">
            
            
               <p class="checkout-section__field col-12">
                  <label for="address_03">Cancel Remark</label>
               <? $app->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"rounded required","style"=>"height:100px","cols"=>"5","value"=>""), "remark_data") ?>
               </p>

               
               
               <div class="col-lg-12 mb-3 mt-2 col-12">

                  <button type="submit" class="cancelOrderBtn button button_primary fs__14 btn lh_36 pl-3 pr-3 font-weight-bold mr-3">Submit</button>
                 
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