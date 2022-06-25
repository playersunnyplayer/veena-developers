<?php

$json_class = $app->load_module("JSON");

$obj_json = new $json_class(JSON_LOOSE_TYPE);



//get action

$get_actionType=$app->getGetVar("actionType");

$actionType=$app->getPostVar("actionType");


$project_id=$app->getGetVar("project_id");



//Function for active projects_gallery datatbale loading

if($get_actionType=="projects_gallery_list")

{

	$table_name='projects_gallery';



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

		".$table_name.".status like '%".$searchValue."%'

		) 

		";

	}

	

	## Total number of records without filtering

	$obj_table = $app->load_model($table_name);

	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".status!='Trash' and projects_id='".$project_id."'");

	$totalRecords = $result[0]['allcount'];

	

	

	## Total number of records with filtering

	$obj_table = $app->load_model($table_name);

	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where ".$table_name.".status!='Trash' and projects_id='".$project_id."' ".$searchQuery);

	$totalRecordwithFilter = $result[0]['allcount'];

	

	## Fetch records

	$obj_brand = $app->load_model($table_name);
	$obj_brand->join_table("projects_gallery_category", "left", array( "name"), array("projects_gallery_category_id"=>"id"));	

	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".status!='Trash' and projects_id='".$project_id."'  ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");

	

	$folder='projects_gallery';

	

	$data = array();

	for($i=0;$i<count($result);$i++)

	{

		



			$sr=$i+1+$row;
			

			//Mobile

			$image=$result[$i]["image"];

			$projects_gallery_img=$app->utility->get_image_path($image,$folder,"");






			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'projects_gallery\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="right" title="Tooltip on right" title="'.$result[$i]['status'].'" />';

					

			$edit_btn='<button type="button" class="btn btn-xs btn-primary btn-icon projects_gallery_addedit_onclick" data-id="'.$result[$i]['id'].'"><i class="fas fa-edit"></i></button>';	

			

			$delete_btn='<button type="button" class="btn btn-xs btn-danger btn-icon projects_gallery_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';				

			

			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn.'</div></div>';

			

			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';

		

		//data

		$data[] = array

		(

			"checkbox"=>$checkbox,

			"id"=>$sr,

			"image"=>'<a href="'.$projects_gallery_img['medium_image'].'" class="image-popup"><img src="'.$projects_gallery_img['thumb_image'].'" class="up_img"></a>',
			
			"title"=>$result[$i]['title'],
			
			"projects_gallery_category_id"=>$result[$i]['projects_gallery_category_name'],

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





//Function for projects_gallery addedit

if($actionType=="projects_galleryAddEdit")

{

$projects_gallery_category_id=$app->getPostVar('projects_gallery_category_id');
$title=$app->getPostVar('title');

$status=$app->getPostVar('status');

	$id=$app->getPostVar('id');


	if($projects_gallery_category_id!='' && $title!='')

	{

		$update_field = array();

		if(!empty($_FILES['projects_gallery_image']['name']))
		{
			$upload_dir='projects_gallery';
			//Image Edit
			if($id!='')
			{
				$obj_model_record = $app->load_model("projects_gallery");
				$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");
				
				if($result[0]["image"]!=NULL)
				{
					@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									
				}	
			}

			$projects_gallery_img11=$app->utility->resize_multi_image_2020($_FILES['projects_gallery_image']['name'],$_FILES['projects_gallery_image']['tmp_name'],'../../../uploads/'.$upload_dir.'/','1000','500','350');	
			$update_field['image']=$projects_gallery_img11;
		}			
		
		
		if(!empty($_FILES['mobile_projects_gallery']['name']))
		{
			$upload_dir='projects_gallery';
			//Image Edit
			if($id!='')
			{
				$obj_model_record = $app->load_model("projects_gallery");
				$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");
				
				if($result[0]["mobile_image"]!=NULL)
				{
					@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["mobile_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["mobile_image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["mobile_image"]);									
				}	
			}

			$mobile_image=$app->utility->resize_multi_image_2020($_FILES['mobile_projects_gallery']['name'],$_FILES['mobile_projects_gallery']['tmp_name'],'../../../uploads/'.$upload_dir.'/','1000','500','350');	
			$update_field['mobile_image']=$mobile_image;
		}			

		


		//Insert Update Record

		$update_field['status'] = $status;

	

		$obj_model_user = $app->load_model("projects_gallery");

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



//Function for single projects_gallery delete

if($actionType=="projects_galleryDelete")

{

	$getid=$app->getPostVar('getid');

	

	if($getid!= NULL && $getid>0)

	{

		

		$obj_model_record = $app->load_model("projects_gallery");

		$result=$obj_model_record->execute("SELECT",false,"","id='".$getid."'");

	

		if($result[0]["image"]!=NULL)

		{

			$upload_dir='projects_gallery';

			@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

		}	

		
		

		$obj_change_table = $app->load_model('projects_gallery');

		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");

		

		if($update_id>0)

		{

			$msg='Sucess';

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





//Function for multiple projects_gallery delete

if($actionType=="projects_galleryMultiDelete")

{

	$ids=$app->getPostVar('ids');

	$temp_ids=explode(',',$ids);

	if($ids != NULL && $ids!='')

	{

		for($i=0;$i<count($temp_ids);$i++)

		{

			$obj_model_record = $app->load_model("projects_gallery");

			$result=$obj_model_record->execute("SELECT",false,"","id=".$temp_ids[$i]."");

			if($result[0]["image"]!=NULL)

			{

				$upload_dir='projects_gallery';

				@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

			}	
	

			$obj_change_table = $app->load_model('projects_gallery');

			$update_id = $obj_change_table->execute("DELETE",false,"","id=".$temp_ids[$i]."");

		}

		

		if($update_id>0)

		{

			$msg='Sucess';

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