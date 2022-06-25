<?php

$json_class = $app->load_module("JSON");

$obj_json = new $json_class(JSON_LOOSE_TYPE);



//get action

$get_actionType=$app->getGetVar("actionType");

$actionType=$app->getPostVar("actionType");



//Function for active projects_gallery_category datatbale loading

if($get_actionType=="projects_gallery_category_list")

{

	$table_name='projects_gallery_category';



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

		
		

		sort_id like '%".$searchValue."%' or 	
		name like '%".$searchValue."%' or 	

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

	

	$folder='projects_gallery_category';

	

	$data = array();

	for($i=0;$i<count($result);$i++)

	{

		


			$sr=$i+1+$row;
			

			//Mobile

			$image=$result[$i]["projects_gallery_category_image"];

			$projects_gallery_category_img=$app->utility->get_image_path($image,$folder,"");






			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'projects_gallery_category\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="top" title="Status" title="'.$result[$i]['status'].'" />';

					

			$edit_btn='<button data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-xs btn-primary btn-icon projects_gallery_category_addedit_onclick" data-id="'.$result[$i]['id'].'"><i class="fas fa-edit"></i></button>';	

			

			$delete_btn='<button data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-xs btn-danger btn-icon projects_gallery_category_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';				

			

			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn11.'</div></div>';

			

			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';

		

		//data

		$data[] = array

		(

			"checkbox"=>$checkbox,

			"id"=>$sr,

			"name"=>$result[$i]['name'],

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





//Function for projects_gallery_category addedit

if($actionType=="projects_gallery_categoryAddEdit")

{
	
	$name=$app->getPostVar('name');

	$status=$app->getPostVar('status');

	$id=$app->getPostVar('id');


	if($name!='')

	{

		$update_field = array();

		if(!empty($_FILES['projects_gallery_category_image']['name']))
		{
			$upload_dir='projects_gallery_category';
			//Image Edit
			if($id!='')
			{
				$obj_model_record = $app->load_model("projects_gallery_category");
				$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");
				
				if($result[0]["projects_gallery_category_image"]!=NULL)
				{
					@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["projects_gallery_category_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["projects_gallery_category_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["projects_gallery_category_image"]);									
				}	
			}

			$projects_gallery_category_img11=$app->utility->resize_multi_image_2020($_FILES['projects_gallery_category_image']['name'],$_FILES['projects_gallery_category_image']['tmp_name'],'../../../uploads/'.$upload_dir.'/','1920','750','350');	
			$update_field['projects_gallery_category_image']=$projects_gallery_category_img11;
		}			
		
		
		if(!empty($_FILES['mobile_projects_gallery_category']['name']))
		{
			$upload_dir='projects_gallery_category';
			//Image Edit
			if($id!='')
			{
				$obj_model_record = $app->load_model("projects_gallery_category");
				$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");
				
				if($result[0]["mobile_image"]!=NULL)
				{
					@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["mobile_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["mobile_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["mobile_image"]);									
				}	
			}

			$mobile_image=$app->utility->resize_multi_image_2020($_FILES['mobile_projects_gallery_category']['name'],$_FILES['mobile_projects_gallery_category']['tmp_name'],'../../../uploads/'.$upload_dir.'/','1920','750','350');	
			$update_field['mobile_image']=$mobile_image;
		}			

		


		//Insert Update Record

		$update_field['status'] = $status;

	

		$obj_model_user = $app->load_model("projects_gallery_category");

		$obj_model_user->map_fields($update_field);

		if($id!='')

		{

			$rs=$obj_model_user->execute("UPDATE",false,"","id='".$id."'");
			$update_title="Update";
		}

		else

		{

			$rs=$obj_model_user->execute("INSERT",false,"","");
			$update_title="Insert";
		}

		if($rs>0)

		{

			$msg="Category Record ".$update_title." Successfully.";

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



//Function for single projects_gallery_category delete

if($actionType=="projects_gallery_categoryDelete")

{

	$getid=$app->getPostVar('getid');

	

	if($getid!= NULL && $getid>0)

	{

		

		$obj_model_record = $app->load_model("projects_gallery_category");

		$result=$obj_model_record->execute("SELECT",false,"","id='".$getid."'");

	

		if($result[0]["image"]!=NULL)

		{

			$upload_dir='projects_gallery_category';

			@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

		}	

		
		

		$obj_change_table = $app->load_model('projects_gallery_category');

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





//Function for multiple projects_gallery_category delete

if($actionType=="projects_gallery_categoryMultiDelete")

{

	$ids=$app->getPostVar('ids');

	$temp_ids=explode(',',$ids);

	if($ids != NULL && $ids!='')

	{

		for($i=0;$i<count($temp_ids);$i++)

		{

			$obj_model_record = $app->load_model("projects_gallery_category");

			$result=$obj_model_record->execute("SELECT",false,"","id=".$temp_ids[$i]."");

			if($result[0]["image"]!=NULL)

			{

				$upload_dir='projects_gallery_category';

				@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

			}	
	

			$obj_change_table = $app->load_model('projects_gallery_category');

			$update_id = $obj_change_table->execute("DELETE",false,"","id=".$temp_ids[$i]."");

		}

		

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