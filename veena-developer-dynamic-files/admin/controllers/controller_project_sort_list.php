<?php
class _project_sort_list extends controller
{
	function init()
	{
	
	}

	function onload()
	{
		
		
		
		$obj_model_brand = $this->app->load_model("category");
		$rs = $obj_model_brand->execute("SELECT", false,"","status='Active'");
		$records1 = array();
		$records1[''] = " Select";
		for($i=0;$i<count($rs);$i++)
		{
			$records1[$rs[$i]['id']] = $rs[$i]['category_name'];
		}
		$this->assign("rs_cats",$records1);
		
		
		
		
		$obj_model_brand = $this->app->load_model("tags");
		$rs = $obj_model_brand->execute("SELECT", false,"","status='Active'");
		$records1 = array();
		$records1[''] = " Select";
		for($i=0;$i<count($rs);$i++)
		{
			$records1[$rs[$i]['id']] = $rs[$i]['name'];
		}
		$this->assign("rs_tags",$records1);
		
		
		if($this->app->getGetVar("category_id")!='')
		{
			$catCond=" and category_ids='".$this->app->getGetVar("category_id")."' ";
			
		}
		else
		{
			$catCond=" and projects.id=0";
			
		}
		
		if($this->app->getGetVar("tag_id")!='')
		{
			$tagCond=" and tag_ids='".$this->app->getGetVar("tag_id")."' ";
			
		}
		else
		{
			$tagCond=" and projects.id=0";
			
		}
		
		
		
		$obj_model_projects= $this->app->load_model("projects");
		$rs_projects = $obj_model_projects->execute("SELECT", false,"","status='Active' ".$catCond." ".$tagCond."","sort_order ASC");
		
		$this->assign("rs_projects",$rs_projects);
		
		

	}	
		
	
		
	
}	
?>