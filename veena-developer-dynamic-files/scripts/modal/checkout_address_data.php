<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);

$_SESSION['selected_addressID']='';	
$html='';	


$selectedID=$app->getGetVar('selectedID');


$obj_model_state =$app->load_model("state");
$rs_state= $obj_model_state->execute("SELECT",false,"","status='Active'","name ASC");		
	
	
	
	
$obj_model_customer=$app->load_model("customer");
$rs_customer= $obj_model_customer->execute("SELECT", false, "", "id='".$_SESSION['MarwadiCustID']."'","");			

$email=$rs_customer[0]['email'];
		

$obj_model_customer_address=$app->load_model("customer_address");
$obj_model_customer_address->join_table("state", "left", array("name"), array("state_id"=>"id"));
$rs_customer_address= $obj_model_customer_address->execute("SELECT", false, "", "customer_id='".$_SESSION['MarwadiCustID']."'","customer_address.id DESC");								
										
$html.='<div class="js_ck_view"></div>';


									$html.='<div class="heading bgbl dn ">
										<a class="tab-heading flex al_center fl_between pr cd chp fwm selectedAddressHtml" href="javascript:void(0)">
											<span class="nav_link_icon ml__5 ">1</span>
										<span class="txt_h_tab  mr-auto tu"> Delivery Address</span></a>
									</div>';
									
									
									
									if(count($rs_customer_address)==0)
									{
									
									
									
									$html.='<div class="sp-tab-content selectedAddressDiv">
										<div class="checkout-section">
											<form name="checkoutAddressForm" id="checkoutAddressForm" method="post" action="">
											<input type="hidden" name="addressID" id="addressID" value="">
												<div class="row">
													<p class="checkout-section__field col-lg-6 col-12">
														<label for="f-name">First Name</label>
														<input type="text" id="first_name" value="" name="first_name" class="required">
													</p>
													<p class="checkout-section__field col-lg-6 col-12">
														<label for="address_phone">Last Name</label>
														<input type="text" id="last_name" value="" name="last_name" class="required">
													</p>
													
													<p class="checkout-section__field col-lg-6 col-12">
														<label for="f-name">Mobile Number</label>
														<input type="text" id="phone" value="" name="phone" class="required number numbers">
													</p>
													<p class="checkout-section__field col-lg-6 col-12">
														<label for="address_phone">Locality</label>
														<input type="text" id="line2" value="" name="line2" class="required">
													</p>
													
													<p class="checkout-section__field col-lg-12 col-12">
														<label for="pincode">Address (Area and Street)</label>
														<textarea name="line1" id="line1" type="text" class="rounded required" rows="1" cols="5"></textarea>
													</p>
													
													
														<p class="checkout-section__field col-lg-4 col-12">
														<label for="locality">Pincode</label>
														<input type="text" id="zipcode" name="zipcode" class="required number" value="">
													</p>
													
													<p class="checkout-section__field col-lg-4 col-12">
														<label for="locality">City/District/Town</label>
														<input type="text" id="city" name="city" class="required" value="">
													</p>
													<p class="checkout-section__field col-lg-4">
														<label for="address_province_ship" id="address_province_label">State</label>
														<select id="state_id" name="state_id" class="required">';
														
														$html.='<option value="">Select</option>';
														
														for($i=0;$i<count($rs_state);$i++)
														{
															
															$html.='<option value="'.$rs_state[$i]['id'].'">'.$rs_state[$i]['name'].'</option>';
															
														}
															
															
														$html.='</select>
													</p>
													<div class="col-lg-12 mb-3 radi-btn col-12">
														<label><input type="radio" name="address_type" value="Home" checked/><span>Home</span></label>
														<label><input type="radio" name="address_type"  value="Office"/><span>Office</span></label>
														<label><input type="radio" name="address_type"  value="Other"/><span>Other</span></label>
													</div>
													<div class="col-lg-12 mb-3 mt-2 col-12">
														<button type="submit" class="button button_primary fs__14 btn lh_36 pl-3 pr-3 font-weight-bold mr-3 addEditAddress">Save and Deliver Here</button>
														
														
													</div>
												</div>
											</form>
										</div>
									</div>';
									
									}
									else
									{
										$html.='<div class="sp-tab-content selectedAddressDiv">
										<div class="checkout-section">';
										
										
										for($i=0;$i<count($rs_customer_address);$i++)
										{
											
											
											
											$addressID=$rs_customer_address[$i]['id'];
											$first_name=$rs_customer_address[$i]['first_name'];
											$phone=$rs_customer_address[$i]['phone'];
											
											$line1=$rs_customer_address[$i]['line1'];
											$line2=$rs_customer_address[$i]['line2'];
											$zipcode=$rs_customer_address[$i]['zipcode'];
											$city=$rs_customer_address[$i]['city'];
											$state=$rs_customer_address[$i]['state_name'];
											
											
											$display_address=$line1.', '.$line2.', '.$city.', '.$state;
											
											
											
											
											if($selectedID>0)
											{
												
												if($selectedID==$addressID)
												{
													
													$checked='checked="checked"';
														$display='';
														
												}
												else
												{
													
													$checked='';
													$display='style="display:none"';
												}
												
											}
											else
											{
											
												if($i==0)
												{
													
													$checked='checked="checked"';
													$display='';
												}
												else
												{
													
													$checked='';
													$display='style="display:none"';
												}
											
											}
										
										
											
												$html.='<div class="row">
													<p class="checkout-section__field address-label col-lg-12 col-12 mb-0">
														<label>
															<input class="mr-2" type="radio" name="addressi" '.$checked.' onchange="showDeliBtn('.$addressID.')"> '.$first_name.'
															<span class="ml-3">'.$phone.'</span>
															<a class="float-right text-red  tu custAddressAddedit"  data-id="'.$addressID.'">Edit</a><br>
															<span class="fwb4 mt-2 d-inline-block ">'.$display_address.'</span> '.$zipcode.'<br>
															<button type="button" onclick="select_address('.$addressID.')" class="masterDeliverBtn AddDel_'.$addressID.' button button_primary fs__12 btn  mt-3  lh_36 pt-0 pb-0 pl-3 pr-3 tu font-weight-bold mr-3" '.$display.'>Deliver Here</button>
														</label>
													</p>
												</div>';
												
												
												if($i<count($rs_customer_address))
												{
												
												$html.='<div class="row">
													<div class="col-12 col-md-12">
														<hr class="mt-3 mb-3"> 
													</div>
												</div>';
												
												}
												
												
										}
												
												
											
											
										$html.='</div>
									</div>';
									
									
									
									if($email!='')
									{
										
									$html.='<div class="bg-white p-3 pl-4 pr-1 shadow-sm border border-light selectedAddressDivOther">
									<form>
										<p class="text-dark m-0 fs_12 MasterEmail">	
											Order confirmation email will be sent to <strong>'.$email.'</strong>
										</p>
									</form>
								</div>';
										
									}
									
									else
									{
										$html.='<div class="bg-white p-3 pl-4 pr-1 shadow-sm border border-light selectedAddressDivOther">
									<form name="ConfEmailForm" id="ConfEmailForm" method="post" action="">
										<p class="text-dark m-0 fs_12 MasterEmail">	
											<input type="email" class="order-email d-inline-block" name="email" id="email" placeholder="Enter your email ID" value="">
											<button type="submit" class="button button_primary bg-white border fwb4 ml-2 border-red text-red w__100 sub tu js_add_ld rounded SaveEmailBtn">Save</button>
											
											
										</p>
										<span class="error_div1" id="MasterEmailErrorID" style="color:red"></span>
									</form>
								</div>';
											
									}
									
									
									$html.='<div class="col-12 p-0 text-start selectedAddressDivOther">
									<a href="javascript:void(0)" data-id=""  class="button button_primary bg-white text-red rounded-0 border-0 w-100 text-left shadow-sm fs__11 btn  mt-1 mb-3  lh_36 pt-2 pb-2 pl-3 pr-3 custAddressAddedit"><i class="la la-plus fs__18 mr__10"></i> Add New Address</a>
								</div>';
											
									}
									
									
											
											
											
											
											
																			
                                       
echo $obj_json->encode(array("RESULT"=>$html));	

?>