<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);

					$obj_model_tmp_cartmini = $app->load_model("customer_cart");
					$obj_model_tmp_cartmini->join_table("product_price", "left", array(), array("cart_product_price_id"=>"id"));
					$obj_model_tmp_cartmini->join_table("product", "left", array(), array("cart_product_id"=>"id"));
					$rs_cartmini = $obj_model_tmp_cartmini->execute("SELECT", false, "", "customer_cart.customer_id='".$_SESSION['MarwadiCustID']."'","customer_cart.id DESC");


					$orderSummeryHtml='<span class="nav_link_icon ml__5 ">2</span>
										<span class="txt_h_tab  mr-auto "> <span class="tu">Order Summary</span> <i class="las la-check fs__16 ml-2 text-red"></i><br>
										<span class="fwb4 fs__13"><b>'.count($rs_cartmini).' Items</b></span>
										</span><br>
										<span class="border p-2 pl-4 pr-4 mr-3 tu d-inline-block fs__12 bg-white text-red" onclick="showCartSummery()">Change</span>
										
										';	
					
									
	
	
	
	


	$RESULT=0;
	
	$distance_error_msg='';


		


	
									

											
																			
                                       
echo $obj_json->encode(array("RESULT"=>$RESULT,"error_msg"=>$distance_error_msg,"orderSummeryHtml"=>$orderSummeryHtml));	

?>