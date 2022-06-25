<?php
class _contact_enquiry_list extends controller
{
	function init()
	{
	
	}

	function onload()
	{
		
		$s_date='01-01-2021';
		$d_date=date('d-m-Y', strtotime('-90 days'));
		$obj_change_table = $this->app->load_model('contact_enquiry');
		$obj_change_table->execute("DELETE",false,"","(STR_TO_DATE(`added_date`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$s_date."', '%d-%m-%Y') AND STR_TO_DATE('".$d_date."', '%d-%m-%Y'))");
			
	}	
		
	
	function export_data()
	{
		$this->app->no_html=true;
		$obj_excel = $this->app->load_module("PHPExcel");
		$ExeclHeads=array("Sr","Name","Phone","Email","Message","Date");

		$obj_model_project_enquiry= $this->app->load_model("contact_enquiry");
		$rs_user=$obj_model_project_enquiry->execute("SELECT", false, "","id!=0","id ASC");

		$ucount=1;
		foreach($rs_user as $user)
		{	
			$user_array[]=array("Sr"=>$ucount,"Name"=>$user['name'],"Phone"=>$user['phone'],"Email"=>$user['email'],"Message"=>$user['msg'],"Date"=>$user['added_date']);
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
		$fields=array("Sr","Name","Phone","Email","Message","Date");
		$filename="Contact_Enquiry-".date('d-m-Y H:i:s');
		$this->app->utility->export_excel($ExeclHeads,$data_array,$fields,$filename,$array_field);
	}
}	
?>