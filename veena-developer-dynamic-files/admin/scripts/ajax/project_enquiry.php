<?php
$json_class = $app->load_module("JSON");
$obj_json = new $json_class(JSON_LOOSE_TYPE);

//get action
$get_actionType=$app->getGetVar("actionType");
$actionType=$app->getPostVar("actionType");

//Function for active project_enquiry datatbale loading
if($get_actionType=="project_enquiry_list")
{
	$table_name='project_enquiry';

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
		
		
		
		
		".$table_name.".name like '%".$searchValue."%' or
		".$table_name.".email like '%".$searchValue."%' or
		".$table_name.".phone like '%".$searchValue."%' or
		
		".$table_name.".data_type like '%".$searchValue."%' or
		".$table_name.".data_value like '%".$searchValue."%' or
		
		
		".$table_name.".added_date like '%".$searchValue."%' or 	
		".$table_name.".status like '%".$searchValue."%'
		) 
		";
	}

	$data_type=$app->getGetVar("data_type");
	
	$type_cond="";
	if($data_type!='')
	{	
		if($data_type=='Enquiry')
		{
			$type='Project Enquiry';
			$type_cond="and ".$table_name.".data_type='".$type."'";
		}
		elseif($data_type=='Brochure')
		{
			$type='Download Brochure';
			$type_cond="and ".$table_name.".data_value='".$type."'";
		}
		else if($data_type=='Floor')
		{
			$type='Download Floor Plan';
			$type_cond="and ".$table_name.".data_value='".$type."'";
		}
	}
	
	## Total number of records without filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".id!='0' ".$type_cond."");
	$totalRecords = $result[0]['allcount'];
	
	
	## Total number of records with filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".id!='0' ".$type_cond." ".$searchQuery);
	$totalRecordwithFilter = $result[0]['allcount'];
	
	## Fetch records
	$obj_brand = $app->load_model($table_name);
	$obj_brand->join_table("projects", "left", array( "name"), array("project_id"=>"id"));	
	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".id!='0' ".$type_cond." ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");
	$data = array();
	for($i=0;$i<count($result);$i++)
	{
		
		
		
		$sr=$i+1+$row;
		
			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'project_enquiry\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="right" title="Tooltip on right" title="'.$result[$i]['status'].'" />';
					
			
			
			$delete_btn='<button data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-xs btn-danger btn-icon project_enquiry_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';	
			
			
			
			
			$option='<div class="btn-toolbar"><div>'.$delete_btn.'</div></div>';
			
			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';
		
		//data
		$data[] = array
		(
			"checkbox"=>$checkbox,
			"id"=>$sr,
			"project_id"=>$result[$i]['projects_name'],
			"data_type"=>'<b>'.$result[$i]['data_type'].'</b><br/>'.$result[$i]['data_value'],
			"name"=>$result[$i]['name'],
			"email"=>$result[$i]['email'],
			"phone"=>$result[$i]['phone'],
			"added_date"=>$result[$i]['added_date'],	
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



//Function for project_enquiry addedit
if($actionType=="project_enquiryAddEdit")
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
		
		$upload_dir='project_enquiry';

		 //Insert Update Record
		$update_field = array();
		
		
		$banner_img11=$app->utility->resize_multi_image($_FILES['banner_image']['name'],$_FILES['banner_image']['tmp_name'],'../../../uploads/'.$upload_dir.'/','800','400','200');	
			
		$update_field['image']=$banner_img11;
		
		
		$update_field['status'] = $status;
		$update_field['added_on'] = date('d-m-Y H:i:s');
		$obj_model_user = $app->load_model("project_enquiry");
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
			$msg="Record ".$update_title." Successfully.";
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

//Function for single project_enquiry delete
if($actionType=="project_enquiryDelete")
{
	$getid=$app->getPostVar('getid');
	
	if($getid!= NULL && $getid>0)
	{
		$obj_change_table = $app->load_model('project_enquiry');
		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");
		
		if($update_id>0)
		{
			$msg='Project Enquiry Delete Successfully';
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
		
		$obj_change_table = $app->load_model('project_enquiry');
		$update_id = $obj_change_table->execute("DELETE",false,"","id IN (".$ids.")");
		
		if($update_id>0)
		{
			$msg='Project Enquiry Delete Successfully';
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