
<?php 
$obj_model_user =$app->load_model("customer");
$obj_model_user->set_fields_to_get(array("phone","id"));
$rs_user = $obj_model_user->execute("SELECT",false,"","id='".$_SESSION['MarwadiCustID']."' and status!='Trash'","");

$lastdigits = substr($rs_user[0]['phone'], -4); 
$signup_login_phone='+91******'.$lastdigits;
?>


<!-- The Modal -->
<div class="modal" id="otp-modal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title tu">Enter OTP</h4>
        <button type="button" class="close " data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body pr-4 pl-4">
      <div class="checkout-section">
         <form method="post" id="customer_otp" name="customer_otp">
             
            <div class="row">
               <p class="checkout-section__field col-lg-12 col-12">
                  <span class=" fs__12 d-block w-100 ">We've sent an OTP to your phone</span>
                  <span class="font-weight-bold text-dark fs__15"><?=$signup_login_phone?></span>
               </p>

               <p class="checkout-section__field col-lg-12 col-12">
                  <label for="f-name">Enter OTP</label>
                  <? $app->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"rounded required numbersOnly numbers"), "cust_otp") ?>
               </p>

               <div class="col-lg-12 mb-3 mt-2 col-12">
                  <button type="submit" class="otp_submit btn btn-success fs__14 btn lh_36 pl-3 pr-3 font-weight-bold mr-3">Verify</button>
               </div>
            </div>
         </form>
      </div>
      </div>


    </div>
  </div>
</div>
