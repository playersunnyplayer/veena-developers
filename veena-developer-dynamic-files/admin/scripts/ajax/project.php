<?php

$json_class = $app->load_module("JSON");

$obj_json = new $json_class(JSON_LOOSE_TYPE);



//get action

$get_actionType=$app->getGetVar("actionType");

$actionType=$app->getPostVar("actionType");



//Function for Admin Logins datatbale loading

if($get_actionType=="project_list")

{

	$table_name='projects';
	$current_status=$app->getGetVar("current_status");

	if($current_status!='')
	{
		
		if($current_status=='Residential')
		{
			$status_cond=" AND projects.category_ids='1'";
			
		}
		else if($current_status=='Commercial')
		{
			$status_cond=" AND projects.category_ids='2'";
		}
		else
		
		{
			$status_cond="";
			
		}
		
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

		
		

		projects.name like '%".$searchValue."%' or

		projects.status like '%".$searchValue."%'

		) 

		";

	}
	
	
	$tag_id=$_SESSION['search_p_cat_id'];
	
	if($tag_id!='')
	{
		$tagCond=" and  FIND_IN_SET (".$tag_id.",tag_ids)";
	}
	else
	{
		$tagCond="";
		
	}
	
	

	## Total number of records without filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 ".$status_cond." ".$tagCond."");
	$totalRecords = $result[0]['allcount'];

	## Total number of records with filtering
	$obj_table = $app->load_model($table_name);
	$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 ".$status_cond." ".$tagCond." ".$searchQuery);	

	$totalRecordwithFilter = $result[0]['allcount'];

	## Fetch records
	$obj_brand = $app->load_model($table_name);
	$result = $obj_brand->execute("SELECT", false, "", "".$table_name.".id!=0 ".$status_cond." ".$tagCond." ".$searchQuery.""," ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage." ");
	$folder='project';

	$data = array();
	for($i=0;$i<count($result);$i++)
	{


			$sr=$i+1+$row;


			$edit_btn='<a data-toggle="tooltip" data-placement="top" title="Edit" href="index.php?view=project_addedit&id='.$result[$i]['id'].'" type="button" class="btn btn-xs btn-primary btn-icon mg-r-5"><i class="fas fa-edit"></i></a>';	

						

			$delete_btn='<button data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-xs btn-danger btn-icon project_delete_onclick" data-id="'.$result[$i]['id'].'" ><i class="fas fa-trash"></i></button>';
			
			
			$img_btn='<a data-toggle="tooltip" data-placement="top" title="Gallery" href="index.php?view=projects_gallery_list&project_id='.$result[$i]['id'].'" type="button" class="btn btn-xs btn-success btn-icon mg-r-5"><i class="fas fa-image"></i></a>';					

			

			$option='<div class="btn-toolbar"><div>'.$edit_btn.' '.$delete_btn.' '.$img_btn.'</div></div>';
			
			
			$tag_ids=$app->utility->get_tag_names($result[$i]['tag_ids']);
			
			
			
			if($result[$i]['category_ids']=='1')
			{
				$res_type='<br/><span class="badge badge-success">Residential</span>';	
			}
			else if($result[$i]['category_ids']=='2')
			{
				$res_type='<br/><span class="badge badge-primary">Commercial</span>';	
			}
			else
			{
				$res_type='';	
			}

			
			
			
			

			$checkbox='<div class="custom-control custom-checkbox"><input type="checkbox" name="del[]" id="del'.$result[$i]['id'].'"  value="'.$result[$i]['id'].'" class="custom-control-input delAll" ><label class="custom-control-label" for="del'.$result[$i]['id'].'"></label></div>';



			
			$status='<img src="assets/img/status/'.$result[$i]['status'].'.png" onclick="javascript:change_status(\''.$result[$i]['id'].'\', \'projects\', \''.$result[$i]['status'].'\')" border="0" id="status_'.$result[$i]['id'].'" style="cursor:pointer" alt="'.$result[$i]['status'].'" data-toggle="tooltip" data-placement="top" title="Status" title="'.$result[$i]['status'].'" />';
			
		

		//data

		$data[] = array

		(

			"checkbox"=>$checkbox,

			"id"=>$sr,

			"name"=>$result[$i]['name'].$res_type,
			"tag_ids"=>$tag_ids,
			

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



if($actionType=="projectSort")
{
	
	$position = $app->getPostVar("position");
	
	$position_data=explode(',',$position);

    $i=1;

    // Update Orting Data 
    foreach($position_data as $v){
		
		
		$obj_change_table = $app->load_model('projects');
		$update_id = $obj_change_table->execute("UPDATE",false,"Update projects SET sort_order=".$i." WHERE id=".trim($v)."","");
		
		
		
		

        
		

        $i++;
    }
	
	
			$msg='Sort Project Successfully';
			$msgcode=0;
		
		
}





if($actionType=="projectHighlightsDelete")
{
	$getid=$app->getPostVar('getid');	
	if($getid!= NULL && $getid>0)
	{
		$obj_change_table = $app->load_model('projects_highlights');
		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");
		
		if($update_id>0)
		{
			$msg='Project Highlights Delete Successfully';
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


//Function for single Admin Logins delete

if($actionType=="projectDelete")

{

	$getid=$app->getPostVar('getid');

	

	if($getid!= NULL && $getid>0)

	{

		$obj_change_table = $app->load_model('projects');

		$update_id = $obj_change_table->execute("DELETE",false,"","id='".$getid."'");

		

		if($update_id>0)

		{

			$msg='Project Delete Successfully';

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








//Function for multiple Admin Logins delete

if($actionType=="projectMultiDelete")

{

	$ids=$app->getPostVar('ids');

	

	if($ids != NULL && $ids!='')

	{

		

		$obj_change_table = $app->load_model('projects');

		$update_id = $obj_change_table->execute("DELETE",false,"","id IN (".$ids.")");

		

		if($update_id>0)

		{

			$msg='Project Delete Successfully';

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