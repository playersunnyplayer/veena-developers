<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);

//get action
$get_actionType=$app->getGetVar("actionType");
$actionType=$app->getPostVar("actionType");

//Function for active career_jobs datatbale loading
if($get_actionType=="career_jobs_list")
{
	$table_name='career_jobs';

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
		
		
		title like '%".$searchValue."%' or
		
		
		sort_id like '%".$searchValue."%' or 	
		".$table_name.".status like '%".$searchValue."%'
		) 
		";
	}
	
	## Total number of records without filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".status!='Trash'");
	$totalRecords = $result[0]['allcount'];
	
	
	## Total number of records with filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".status!='Trash' ".$searchQuery);
	$totalRecordwithFilter = $result[0]['allcount'];
	
	## Fetch records
	$obj_brand = $app->load_model($table_name);
	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".status!='Trash'  ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");
	$data = array();
	for($i=0;$i<count($result);$i++)
	{
		
		
			$sr=$i+1+$row;
		
			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'career_jobs\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="top" title="Status" title="'.$result[$i]['status'].'" />';
					
			$edit_btn='<button data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-xs btn-primary btn-icon career_jobs_addedit_onclick" data-id="'.$result[$i]['id'].'"><i class="fas fa-edit"></i></button>';	
			
			$delete_btn='<button  data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-xs btn-danger btn-icon career_jobs_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';				
			
			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn.'</div></div>';
			
			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';
		
		//data
		$data[] = array
		(
			"checkbox"=>$checkbox,
			"id"=>$sr,
			"title"=>$result[$i]['title'],
			"sort_id"=>$result[$i]['sort_id'],
			"status"=>$status,		
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



//Function for career_jobs addedit
if($actionType=="career_jobsAddEdit")
{

$title=$app->getPostVar('title');
	$status=$app->getPostVar('status');
	$id=$app->getPostVar('id');
	
	if($title!='')
	{
		if($id!='')
		{
			$cond=" and id!='".$id."'";
			$update_title='Updated';
		}
		else
		{
			$cond="";
			$update_title='Added';
		}
		
		$upload_dir='career_jobs';

		 //Insert Update Record
		$update_field = array();
		
		
		$banner_img11=$app->utility->resize_multi_image($_FILES['banner_image']['name'],$_FILES['banner_image']['tmp_name'],'../../../uploads/'.$upload_dir.'/','800','400','200');	
			
		$update_field['image']=$banner_img11;
		
		
		$update_field['status'] = $status;
		$update_field['added_on'] = date('d-m-Y H:i:s');
		$obj_model_user = $app->load_model("career_jobs");
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
			$msg="Job Record ".$update_title." Successfully.";
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
			$msg='Please Fill Require Data';
			$msgcode=1;
	}
}

//Function for single career_jobs delete
if($actionType=="career_jobsDelete")
{
	$getid=$app->getPostVar('getid');
	
	if($getid!= NULL && $getid>0)
	{
		$obj_change_table = $app->load_model('career_jobs');
		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");
		
		if($update_id>0)
		{
			$msg='Job Delete Successfully';
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


//Function for multiple career_jobs delete
if($actionType=="career_jobsMultiDelete")
{
	$ids=$app->getPostVar('ids');
	
	if($ids != NULL && $ids!='')
	{
		
		$obj_change_table = $app->load_model('career_jobs');
		$update_id = $obj_change_table->execute("DELETE",false,"","id IN (".$ids.")");
		
		if($update_id>0)
		{
			$msg='Job Delete Successfully';
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