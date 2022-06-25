<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);



$html='';	



$MainWallet=$app->getGetVar("MainWallet");
$PromoWallet=$app->getGetVar("PromoWallet");

$_SESSION['promo_wallet_use']=0;
$_SESSION['wallet_use']=0;

if($_SESSION['selected_addressID']>0)
{
	
}
else
{
	$_SESSION['fix_charge_per_order']=0;
	$_SESSION['total_ship_charge']=0;
	$_SESSION['weight_charge']=0;
	$_SESSION['bag_charge']=0;
	//$_SESSION['discount']=0;
	$_SESSION['bag_label']='';
	
		
}







							$total1=$_SESSION['sub_total']+$_SESSION['fix_charge_per_order']+$_SESSION['total_ship_charge']+$_SESSION['weight_charge']+$_SESSION['bag_charge']-$_SESSION['discount'];
							
							
							if($PromoWallet=='Yes' && $total1>0)
							{
								if($total1>$_SESSION['MarwadiCust_promoWallet'])
								{
									$_SESSION['promo_wallet_use']=$_SESSION['MarwadiCust_promoWallet'];
								}
								else
								{
									$_SESSION['promo_wallet_use']=$total1;
								}
								
								$_SESSION['promo_wallet_check']='Yes';
								
							}
							else
							{
								$_SESSION['promo_wallet_check']='No';
								
								
							}
							
							$total2=$_SESSION['sub_total']+$_SESSION['fix_charge_per_order']+$_SESSION['total_ship_charge']+$_SESSION['weight_charge']+$_SESSION['bag_charge']-$_SESSION['discount']-$_SESSION['promo_wallet_use'];
							
							
							if($MainWallet=='Yes' && $total2>0)
							{
								if($total2>$_SESSION['MarwadiCust_wallet'])
								{
									$_SESSION['wallet_use']=$_SESSION['MarwadiCust_wallet'];
								}
								else
								{
									$_SESSION['wallet_use']=$total2;
								}
								
								$_SESSION['wallet_check']='Yes';
								
							}
							else
							{
								$_SESSION['wallet_check']='No';
								
								
							}
							
						
								


							
							$_SESSION['total']=$_SESSION['sub_total']+$_SESSION['fix_charge_per_order']+$_SESSION['total_ship_charge']+$_SESSION['weight_charge']+$_SESSION['bag_charge']-$_SESSION['discount']-$_SESSION['promo_wallet_use']-$_SESSION['wallet_use'];
							
							
							
							
							
							
							$display_sub_total=$app->utility->moneyFormatIndia($_SESSION['sub_total']);
							
							$display_total_ship_charge=$app->utility->moneyFormatIndia($_SESSION['total_ship_charge']);
							$display_discount=$app->utility->moneyFormatIndia($_SESSION['discount']);
							$display_promo_wallet_use=$app->utility->moneyFormatIndia($_SESSION['promo_wallet_use']);
							$display_wallet_use=$app->utility->moneyFormatIndia($_SESSION['wallet_use']);
							
							$display_total=$app->utility->moneyFormatIndia($_SESSION['total']);
					
							
							
							$html.='<table class="checkout-review-order-table mt-2 ">
									
                                    
									<tfoot class="" >
									<tr class="cart-subtotal border-top cart_item ">
										<th class="pt-2">Subtotal</th>
										<td class="pt-2"><span class="cart_price">'.$display_sub_total.'</span></td>
									</tr>';
									
									if($_SESSION['total_ship_charge']>0)
								{
									$html.='<tr class="cart_item">
										<th class="pb-2">Shipping</th>
										<td class="pb-2"><span class="cart_price">'.$display_total_ship_charge.'</span></td>
									</tr>';
									
									
								}
								
								
									if($_SESSION['discount']>0)
								{
									$html.='<tr class="cart_item">
										<th class="pb-2">Discount</th>
										<td class="pb-2"><span class="cart_price">-'.$display_discount.'</span></td>
									</tr>';
									
									
								}
								
								
								
									if($_SESSION['promo_wallet_use']>0)
								{
									$html.='<tr class="cart_item">
										<th class="pb-2">Promo Wallet</th>
										<td class="pb-2"><span class="cart_price">-'.$display_promo_wallet_use.'</span></td>
									</tr>';
									
									
								}
								
								if($_SESSION['wallet_use']>0)
								{
									$html.='<tr class="cart_item">
										<th class="pb-2">Wallet</th>
										<td class="pb-2"><span class="cart_price">-'.$display_wallet_use.'</span></td>
									</tr>';
									
									
								}
									$html.='<tr class="order-total border-top cart_item">
										<th class="pt-2 tot">Total Payable</th>
										<td class="pt-2 tot"><strong><span class="cart_price amount">'.$display_total.'</span></strong></td>
									</tr>';
										$html.='</tfoot>
								</table>';
											
																			
                                       
echo $obj_json->encode(array("RESULT"=>$html));	

?>