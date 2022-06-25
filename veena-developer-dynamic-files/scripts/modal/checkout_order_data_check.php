<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);


$RESULT=0;
$error_msg='';

if($_SESSION['selected_addressID']=='')
{
	$RESULT=1;
	$error_msg='Please Select Address';
	
}	
else if($_SESSION['payment_type']=='')	
{
	$RESULT=1;
	
	$error_msg='Please Select Payment Method.';
	
}			
																			
                                       
echo $obj_json->encode(array("RESULT"=>$RESULT,"error_msg"=>$error_msg));	

?>