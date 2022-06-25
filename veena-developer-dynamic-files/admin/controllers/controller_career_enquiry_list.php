<?php
class _career_enquiry_list extends controller
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
		$obj_change_table = $this->app->load_model('career_enquiry');
		$obj_change_table->execute("DELETE",false,"","(STR_TO_DATE(`added_date`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$s_date."', '%d-%m-%Y') AND STR_TO_DATE('".$d_date."', '%d-%m-%Y'))");
	}	
		
	function load_data()
	{
	}

	function export_data()
	{
		$this->app->no_html=true;
		$obj_excel = $this->app->load_module("PHPExcel");
		$ExeclHeads=array("Sr","Title","Name","Phone","Email","Date");

		$obj_model_project_enquiry= $this->app->load_model("career_enquiry");
		$obj_model_project_enquiry->join_table("career_jobs", "left", array( "title"), array("job_id"=>"id"));	
		$rs_user=$obj_model_project_enquiry->execute("SELECT", false, "","career_enquiry.id!=0","career_enquiry.id ASC");

		$ucount=1;
		foreach($rs_user as $user)
		{	
			$user_array[]=array("Sr"=>$ucount,"Title"=>$user['career_jobs_title'],"Name"=>$user['name'],"Phone"=>$user['phone'],"Email"=>$user['email'],"Date"=>$user['added_date']);
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
		$fields=array("Sr","Title","Name","Phone","Email","Date");
		$filename="Career_Enquiry-".date('d-m-Y H:i:s');
		$this->app->utility->export_excel($ExeclHeads,$data_array,$fields,$filename,$array_field);
	}

}	
?>