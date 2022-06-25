<?php



$json_class = $app->load_module("JSON");



$obj_json = new $json_class(JSON_LOOSE_TYPE);







//get action



$get_actionType=$app->getGetVar("actionType");



$actionType=$app->getPostVar("actionType");







//Function for Admin Logins datatbale loading



if($get_actionType=="contact_enquiry_list")



{



	$table_name='contact_enquiry';
	
	
	
	$current_status=$app->getGetVar("current_status");

	if($current_status=='Today')
	{
		
		
			$s_date=date('d-m-Y');
		
		
		
			$status_cond=" and (STR_TO_DATE(`added_date`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$s_date."', '%d-%m-%Y') AND STR_TO_DATE('".$s_date."', '%d-%m-%Y'))";
			
		
		
		
	}
	else
	{
		$status_cond="";
	}



	## Read value



	$draw = $app->getPostVar('draw');



	$row = $app->getPostVar('start');



	$rowperpage = $app->getPostVar('length'); // Rows display per page



	$orderArray = $app->getPostVar('order');



	$columnIndex = $orderArray[0]['column']; // Column index



	



	$columnArray = $app->getPostVar('columns');



	$columnName = $columnArray[$columnIndex]['data']; // Column name



	



	if($columnName=='checkbox' || $columnName=='btn' || $columnName=='image')



	{



		$columnName='id';



	}



	



	$columnSortOrder = $orderArray[0]['dir']; // asc or desc



	



	$searchArray=$app->getPostVar('search');



	$searchValue = $searchArray['value']; // Search value



	



	## Search 



	$searchQuery = " ";



	if($searchValue != '')



	{



		$searchQuery = " and (	



		
		



		contact_enquiry.name like '%".$searchValue."%' or



		contact_enquiry.email like '%".$searchValue."%' or



		contact_enquiry.phone like '%".$searchValue."%' or

		

		contact_enquiry.msg like '%".$searchValue."%' 



		) 



		";



	}



	



	## Total number of records without filtering



	$obj_table = $app->load_model($table_name);

	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 ".$status_cond."");

	$totalRecords = $result[0]['allcount'];



	



	



	## Total number of records with filtering



	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 ".$status_cond." ".$searchQuery);	







	$totalRecordwithFilter = $result[0]['allcount'];



	



	## Fetch records



	$obj_brand = $app->load_model($table_name);
	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".id!=0 ".$status_cond." ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");





	



	





	$data = array();



	for($i=0;$i<count($result);$i++)



	{



		

		//data
		
		
		$sr=$i+1+$row;
		
		
		
		$delete_btn='<button type="button" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-xs btn-danger btn-icon contact_enquiry_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';	
			
			
			
			
			$option='<div class="btn-toolbar"><div>'.$delete_btn.'</div></div>';
			



		$data[] = array



		(



			"checkbox"=>$checkbox,



			"id"=>$sr,


			"name"=>$result[$i]['name'].'<br/>'.$result[$i]['phone']."<br/>".$result[$i]['email'],


			

			"msg"=>$result[$i]['msg'],

			

			"added_date"=>$result[$i]['added_date'],
			"action"=>$option


		);



	}



	



	## Response



	$response = array(



		"draw" => $draw,



		"iTotalRecords" => $totalRecords,



		"iTotalDisplayRecords" => $totalRecordwithFilter,



		"aaData" => $data



	);



		



	echo json_encode($response);



	exit;



}


//Function for single project_enquiry delete
if($actionType=="project_enquiryDelete")
{
	$getid=$app->getPostVar('getid');
	
	if($getid!= NULL && $getid>0)
	{
		$obj_change_table = $app->load_model('contact_enquiry');
		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");
		
		if($update_id>0)
		{
			$msg='Contact Enquiry Delete Successfully';
			$msgcode=0;
		}
		else
		{
			$msg='Please Try Again.';
			$msgcode=1;
		}
	}
	else
	{
		$msg='Please Try Again.';
		$msgcode=1;	
	}
}


//Function for multiple project_enquiry delete
if($actionType=="project_enquiryMultiDelete")
{
	$ids=$app->getPostVar('ids');
	
	if($ids != NULL && $ids!='')
	{
		
		$obj_change_table = $app->load_model('contact_enquiry');
		$update_id = $obj_change_table->execute("DELETE",false,"","id IN (".$ids.")");
		
		if($update_id>0)
		{
			$msg='Contact Enquiry Delete Successfully';
			$msgcode=0;
		}
		else
		{
			$msg='Please Try Again.';
			$msgcode=1;
		}
	}
	else
	{
		$msg='Please Try Again.';
		$msgcode=1;
	}		
}





		



echo $obj_json->encode(array("RESULT"=>$msgcode,"url"=>"","msg"=>$msg));



?>