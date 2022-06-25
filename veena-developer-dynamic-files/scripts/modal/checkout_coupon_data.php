<?php
$id=$app->getGetVar('id');

$getType=$app->getGetVar('getType');


$obj_model_coupon =$app->load_model("coupon");
$rs_coupon = $obj_model_coupon->execute("SELECT",false,"","status='Active' and display_list='Yes'","id DESC");		
		
		
		

?>



<!-- The Modal -->

<div class="modal show" id="coupon-modal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title tu">Apply Coupons</h4>
        <button type="button" class="close " data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body pb-0 pt-0">
		
			<div class="row">
            <form class="" id="promo_code_form" name="promo_code_form" method="post" action="">
				<div class="col-lg-12 pt-2 pl-4 pr-4 pb-2 mt-3 mb-3 col-12">
					<div class="col-lg-12 p-0 col-12 position-relative">
						<input class="rounded required" type="text" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
						<button type="submit" class="check-coupon" id="appyCouponBtn">CHECK</button>
						<small class="text-danger error_div" id="CustomCouponDiv"></small>
					</div>
				</div>
                </form>
			</div>
			<div class="row bg-f4f4f5" style="padding-top: 2px; padding-bottom: 2px;">
				<div class="col-lg-12  pl-0 pr-0  col-12">
                <?php if(count($rs_coupon)>0){?>
                
                
                <?php for($i=0;$i<count($rs_coupon);$i++)
				{?>
                
                
                <div class="col-lg-12 pt-3 pb-3 pl-4 pr-4 col-12 position-relative bg-white">
						<label class=" wallet-check coupon-code position-relative">
							<input class="mr-2" type="radio" name="coupon-check" value="<?=$rs_coupon[$i]['coupon_code']?>">
							<svg class="dn scl_selected" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M9 20l-7-7 3-3 4 4L19 4l3 3z"></path>
							</svg>
							<span class="d-inline-block c-bdr text-dark rounded fwsb"><?=$rs_coupon[$i]['coupon_code']?></span>
							<span class="d-block mt-2 text-dark fs__13"><?=nl2br($rs_coupon[$i]['msg'])?></span>
							
                            
						</label>
					</div>
                    
                    <?php }?>
                
                
                <?php }else{?>
                <div class="col-lg-12 p-0 text-center col-12">
						<p class="fs__12">No other coupons available</p>						
					</div>
                
                <?php }?>
                
					
					
				</div>
			</div>
            
          
             <?php if(count($rs_coupon)>0){?>
             
               <div class="row bg-white">
               <div class="col-lg-12 pt-2 pb-2 col-12 error_div" id="ListCouponDiv">
               
               </div>
            
            </div>
            
            
			<div class="row bg-white">
				<div class="col-lg-12 pt-2 pb-2 col-12">
					<div class="row">
						<div class="col-lg-6 col-6 pl-4">
							
                            
						</div>
						<div class="col-lg-6 col-6">
							<button type="button" class="button button_primary w__100 pt-2 pb-2 tu rounded appyCouponBtn" id="appyCouponBtn">Apply</button>
						</div>
					</div>
				</div>
			</div>
            
            <?php }?>
		
        
      </div>


    </div>
  </div>
</div>

