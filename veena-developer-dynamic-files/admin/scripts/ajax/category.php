<?php

$json_class = $app->load_module("JSON");

$obj_json = new $json_class(JSON_LOOSE_TYPE);



//get action

$get_actionType=$app->getGetVar("actionType");

$actionType=$app->getPostVar("actionType");



//Function for active category datatbale loading

if($get_actionType=="category_list")

{

	$table_name='category';



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

		
		

		category_name like '%".$searchValue."%' or 	

		".$table_name.".status like '%".$searchValue."%'

		) 

		";

	}

	

	## Total number of records without filtering

	$obj_table = $app->load_model($table_name);

	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".id!='0'");

	$totalRecords = $result[0]['allcount'];

	

	

	## Total number of records with filtering

	$obj_table = $app->load_model($table_name);

	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".id!='0' ".$searchQuery);

	$totalRecordwithFilter = $result[0]['allcount'];

	

	## Fetch records

	$obj_brand = $app->load_model($table_name);

	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".id!='0'  ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");

	

	

	$data = array();

	for($i=0;$i<count($result);$i++)

	{

		


			$sr=$i+1+$row;
			


			//$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'banner\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="top" title="Status" title="'.$result[$i]['status'].'" />';

					

			$edit_btn='<button data-toggle="tooltip" data-placement="top" title="Edit"  type="button" class="btn btn-xs btn-primary btn-icon category_addedit_onclick" data-id="'.$result[$i]['id'].'"><i class="fas fa-edit"></i></button>';	

			

			//$delete_btn='<button data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-xs btn-danger btn-icon banner_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';				

			

			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn.'</div></div>';

			

			//$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';

		

		//data

		$data[] = array

		(

			"id"=>$sr,

			"category_name"=>$result[$i]['category_name'],

			"sort_order"=>$result[$i]['sort_order'],

			"btn"=>$option

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





//Function for category addedit

if($actionType=="categoryAddEdit")
{
	$chat_code=$app->getPostVar('chat_code');
	$id=$app->getPostVar('id');

	

		$update_field = array();

		


		$update_field['chat_code'] = $chat_code;

	

		$obj_model_user = $app->load_model("category");

		$obj_model_user->map_fields($update_field);

		if($id!='')

		{

			$rs=$obj_model_user->execute("UPDATE",false,"","id='".$id."'");

		}

		else

		{

			$rs=$obj_model_user->execute("INSERT",false,"","");

		}

		if($rs>0)

		{

			$msg="Category ".$update_title." Successfully.";

			$msgcode=0;

		 }

		 else

		 {

			$msg='Please Try Again.';

			$msgcode=1;

		 }

	

}



//Function for single category delete

if($actionType=="categoryDelete")

{

	$getid=$app->getPostVar('getid');

	

	if($getid!= NULL && $getid>0)

	{

		

		$obj_model_record = $app->load_model("category");


		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");

		

		if($update_id>0)

		{

			$msg='Category Delete Successfully.';

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