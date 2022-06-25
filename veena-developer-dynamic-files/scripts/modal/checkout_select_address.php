<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);

$_SESSION['selected_addressID']='';	
$html='';
$distance_error_msg='';

$_SESSION['total_ship_charge']=0;


$addressID=$app->getGetVar("addressID");	

$obj_model_customer_address=$app->load_model("customer_address");
$obj_model_customer_address->join_table("state", "left", array("name"), array("state_id"=>"id"));
$rs_customer_address= $obj_model_customer_address->execute("SELECT", false, "", "customer_id='".$_SESSION['MarwadiCustID']."' and customer_address.id='".$addressID."'","customer_address.id DESC");		

if(count($rs_customer_address)>0)
{
	
	
	
	
	
	
											
	
											$addressID=$rs_customer_address[0]['id'];
											$first_name=$rs_customer_address[0]['first_name'];
											$phone=$rs_customer_address[0]['phone'];
											
											$line1=$rs_customer_address[0]['line1'];
											$line2=$rs_customer_address[0]['line2'];
											$zipcode=$rs_customer_address[0]['zipcode'];
											$city=$rs_customer_address[0]['city'];
											$state=$rs_customer_address[0]['state_name'];
											
											
											$display_address=$line1.', '.$line2.', '.$city.', '.$state;
	
		
				$obj_model_zipcode=$app->load_model("zipcode");
		    	$rs_ship_charge= $obj_model_zipcode->execute("SELECT",false,"","name='".$rs_customer_address[0]['zipcode']."' and status='Active'","");
				
				if(count($rs_ship_charge)<=0)
				{
					$RESULT=1;
					$distance_error_msg="Delivery not available for pincode <b>".$rs_customer_address[0]['zipcode']."</b>";
					                                       
					echo $obj_json->encode(array("RESULT"=>$RESULT,"error_msg"=>$distance_error_msg));	
					exit;
						
				}
				
				
				
				
					
					
					$total_kg=$_SESSION['cart_weight'];
					$total_ship_charge=$total_kg*$rs_ship_charge[0]['ship_charge_per_kg'];
					
					
					$_SESSION['total_ship_charge']=$total_ship_charge;
					$distance_error_msg='';
						
					
					
					$n='';
					$selectedAddressHtml='<span class="nav_link_icon ml__5 ">1</span>
										<span class="txt_h_tab  mr-auto "> <span class="tu">Delivery Address</span> <i class="las la-check fs__16 ml-2 text-red"></i><br>
										<span class="fwb4 fs__13"><b>'.$first_name.'</b> '.$display_address.' <b>'.$zipcode.'</b></span>
										</span><br>
										<span class="border p-2 pl-4 pr-4 mr-3 tu d-inline-block fs__12 bg-white text-red" onclick="show_address_data('.$n.')">Change</span>';	
					
									
	
	
	
	
}
else
{
	$RESULT=1;
	$distance_error_msg="Please Select Address.";
}						
	
	
if($distance_error_msg=='')
{
	$RESULT=0;
	$_SESSION['selected_addressID']=$rs_customer_address[0]['id'];	
		
}
	
									

											
																			
                                       
echo $obj_json->encode(array("RESULT"=>$RESULT,"error_msg"=>$distance_error_msg,"selectedAddressHtml"=>$selectedAddressHtml));	

?>