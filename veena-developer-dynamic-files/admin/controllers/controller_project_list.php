<?php
class _project_list extends controller
{
	function init()
	{
	
	}

	function onload()
	{
		
			$obj_model_tags= $this->app->load_model("tags");
			$rs_sup = $obj_model_tags->execute("SELECT", false,"","status='Active'");
			$records12 = array();
			$records12[''] = "All";
			for($i=0;$i<count($rs_sup);$i++){
				$records12[$rs_sup[$i]['id']] = $rs_sup[$i]['name'];
			}
			$this->assign("category",$records12);

	}	
		
	
		
	
}	
?>