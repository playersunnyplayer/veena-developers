<?php

$json_class = $app->load_module("JSON");

$obj_json = new $json_class(JSON_LOOSE_TYPE);



//get action

$get_actionType=$app->getGetVar("actionType");

$actionType=$app->getPostVar("actionType");



//Function for active blog_tag datatbale loading

if($get_actionType=="blog_tag_list")

{

	$table_name='blog_tag';



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

		
		

		sort_order like '%".$searchValue."%' or 	

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

	

	$folder='blog_tag';

	

	$data = array();

	for($i=0;$i<count($result);$i++)

	{

		

			
			
			$sr=$i+1+$row;

			//Mobile

			$image=$result[$i]["image"];

			$blog_tag_img=$app->utility->get_image_path($image,$folder,"");






			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'blog_tag\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="top" title="Status" title="'.$result[$i]['status'].'" />';

					

			$edit_btn='<button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-xs btn-primary btn-icon blog_tag_addedit_onclick" data-id="'.$result[$i]['id'].'"><i class="fas fa-edit"></i></button>';	

			

			$delete_btn='<button type="button" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-xs btn-danger btn-icon blog_tag_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';				

			

			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn.'</div></div>';

			

			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';

		

		//data

		$data[] = array

		(

			"checkbox"=>$checkbox,

			"id"=>$sr,

			"image"=>'<a href="'.$blog_tag_img['large_image'].'" class="image-popup" ><img src="'.$blog_tag_img['large_image'].'" class="up_img" style="background: #eae9e8;"></a>',
			"name"=>$result[$i]['name'],

			"sort_order"=>$result[$i]['sort_order'],

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





//Function for blog_tag addedit

if($actionType=="blog_tagAddEdit")

{

	$status=$app->getPostVar('status');

	$id=$app->getPostVar('id');
	$name=$app->getPostVar('name');
	
	$slug=$app->getPostVar('slug');


	if($status!='' && $name!='')

	{
		
		
		
		
		
		if($id>0)
		{
		
			$idsql_cond=" and id!='".$id."'";	
			
		}
		else
		{
			$idsql_cond="";	
		}
		
		$obj_model_check = $app->load_model("blog_tag");
		$rs_check=$obj_model_check->execute("SELECT",false,"","slug='".$slug."' ".$idsql_cond."");
		
		if(count($rs_check)>0)
		{
			$msg='Duplicate Slug Found!';
			$msgcode=1;
			
			echo $obj_json->encode(array("RESULT"=>$msgcode,"url"=>"","msg"=>$msg));
			exit;
				
		}
		
		

		$update_field = array();

		/*if(!empty($_FILES['blog_tag_image']['name']))
		{
			$upload_dir='blog_tag';
			//Image Edit
			if($id!='')
			{
				$obj_model_record = $app->load_model("blog_tag");
				$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");
				
				if($result[0]["image"]!=NULL)
				{
					@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);
					@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									
				}	
			}

			$blog_tag_img11=$app->utility->resize_multi_image_2020($_FILES['blog_tag_image']['name'],$_FILES['blog_tag_image']['tmp_name'],'../../../uploads/'.$upload_dir.'/','1920','750','350');	
			$update_field['image']=$blog_tag_img11;
		}			
		*/
		
		
		
		
		
		


		//Insert Update Record

		$update_field['status'] = $status;

	

		$obj_model_user = $app->load_model("blog_tag");

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



//Function for single blog_tag delete

if($actionType=="blog_tagDelete")

{

	$getid=$app->getPostVar('getid');

	

	if($getid!= NULL && $getid>0)

	{

		

		$obj_model_record = $app->load_model("blog_tag");

		$result=$obj_model_record->execute("SELECT",false,"","id='".$getid."'");

	

		if($result[0]["image"]!=NULL)

		{

			$upload_dir='blog_tag';

			@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

			@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

		}	

		
		

		$obj_change_table = $app->load_model('blog_tag');

		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");

		

		if($update_id>0)

		{

			$msg='Record Delete Successfully';

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





//Function for multiple blog_tag delete

if($actionType=="blog_tagMultiDelete")

{

	$ids=$app->getPostVar('ids');

	$temp_ids=explode(',',$ids);

	if($ids != NULL && $ids!='')

	{

		for($i=0;$i<count($temp_ids);$i++)

		{

			$obj_model_record = $app->load_model("blog_tag");

			$result=$obj_model_record->execute("SELECT",false,"","id=".$temp_ids[$i]."");

			if($result[0]["image"]!=NULL)

			{

				$upload_dir='blog_tag';

				@unlink('../../../uploads/'.$upload_dir.'/'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'mediumthumb'.$result[0]["image"]);

				@unlink('../../../uploads/'.$upload_dir.'/'.'thumb'.$result[0]["image"]);									

			}	
	

			$obj_change_table = $app->load_model('blog_tag');

			$update_id = $obj_change_table->execute("DELETE",false,"","id=".$temp_ids[$i]."");

		}

		

		if($update_id>0)

		{

			$msg='Highlight Delete Successfully';

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