<?php
class _projects_gallery_list extends controller
{
	function init()
	{
		if($this->app->getCurrentAction()=="")
		{
			$this->load_data();
		}
		
		
		
		$project_id=$this->app->getGetVar("project_id");
		
		$obj_model_table = $this->app->load_model("projects");
		$rs_data = $obj_model_table->execute("SELECT", false,"","id='".$project_id."'");
		
		$this->app->assign("rs_data",$rs_data[0]);
		
		
		if(count($rs_data)<=0)
		{
			$this->app->redirect("index.php?view=project_list");	
			exit;
		}
		
		
		
	}

	function onload()
	{
	}	
		
	function load_data()
	{
	}	
}	
?>