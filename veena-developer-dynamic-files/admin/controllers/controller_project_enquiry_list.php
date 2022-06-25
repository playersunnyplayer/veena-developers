<?php
class _project_enquiry_list extends controller
{
	function init()
	{
		if($this->app->getCurrentAction()=="")
		{
			$this->load_data();
		}
	}

	function onload()
	{
		$s_date='01-01-2021';
		$d_date=date('d-m-Y', strtotime('-90 days'));
		$obj_change_table = $this->app->load_model('project_enquiry');
		$obj_change_table->execute("DELETE",false,"","(STR_TO_DATE(`added_date`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$s_date."', '%d-%m-%Y') AND STR_TO_DATE('".$d_date."', '%d-%m-%Y'))");
	}	
		
	function load_data()
	{
	}	

	function export_data()
	{
		$data_type=$this->app->getGetVar("type");
		$type_cond="";
		if($data_type!='')
		{	
			if($data_type=='Enquiry')
			{
				$type='Project Enquiry';
				$type_cond="and project_enquiry.data_type='".$type."'";
			}
			elseif($data_type=='Brochure')
			{
				$type='Download Brochure';
				$type_cond="and project_enquiry.data_value='".$type."'";
			}
			else if($data_type=='Floor')
			{
				$type='Download Floor Plan';
				$type_cond="and project_enquiry.data_value='".$type."'";
			}
		}

		$this->app->no_html=true;
		$obj_excel = $this->app->load_module("PHPExcel");
		$ExeclHeads=array("Sr","Project","Type","Value","Name","Phone","Email","Date");

		$obj_model_project_enquiry= $this->app->load_model("project_enquiry");
		$obj_model_project_enquiry->join_table("projects","left",array("name"), array("project_id"=>"id"));	
		$rs_user=$obj_model_project_enquiry->execute("SELECT", false, "","project_enquiry.id!=0 ".$type_cond."","project_enquiry.id ASC");

		$ucount=1;
		foreach($rs_user as $user)
		{	
			$user_array[]=array("Sr"=>$ucount,"Project"=>$user['projects_name'],"Type"=>$user['data_type'],"Value"=>$user['data_value'],"Name"=>$user['name'],"Phone"=>$user['phone'],"Email"=>$user['email'],"Date"=>$user['added_date']);
			$ucount++;
		}

		$ftype_prompt_title="";
		$ftype_prompt="";

		$array_field=array(
			"block_name"=>array("options"=>$block_options,"prompt_title"=>$block_prompt_title,"prompt"=>$block_prompt),
			"flat_type"=>array("options"=>"","prompt_title"=>"","prompt"=>""),
			"resident_type"=>array("options"=>'',"prompt_title"=>"","prompt"=>"")
		);

		$data_array=$user_array;
		$fields=array("Sr","Project","Type","Value","Name","Phone","Email","Date");
		$filename="Project_Enquiry-".date('d-m-Y H:i:s');
		$this->app->utility->export_excel($ExeclHeads,$data_array,$fields,$filename,$array_field);
	}
}	
?>