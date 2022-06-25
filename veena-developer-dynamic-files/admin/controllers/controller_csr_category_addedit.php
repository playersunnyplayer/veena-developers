<?
class _csr_category_addedit extends controller
{

	function init()
	{
	}

	function onload()
	{
		
		

		$id=$this->app->getGetVar('id');
		if($id!='')
		{
			$this->app->assign("manage_for","Edit");
			$this->load_data();
		}
		else
		{
			$this->app->assign("manage_for","Add");
		}
		$this->app->assign("to_do","CSR Category");
	}
	
	function load_data()
	{
		$id=$this->app->getGetVar('id');
		$obj_model_product = $this->app->load_model("csr_category", $id);
		$rscat = $obj_model_product->execute("SELECT");
		if(count($rscat)>0)
		{
			
			

			$this->app->assign_form_data("frm_project_addedit", $rscat[0]);
			$this->app->assign("rscat", $rscat[0]);
			$this->app->assign("rs_info", $rs_info[0]);
			
			
			
			
			
			
		}
		else
		{
			$this->app->redirect("index.php?view=project_list");
		}
	}

	
	function update_data()
	{
		$title=$this->app->getPostVar('title');		
		
		
	
	$id=$this->app->getPostVar('id');		
		
		
		
		
		if($id!="")
		{
			
			
			$obj_model_record = $this->app->load_model("csr_category");
			$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");

			$update_field = array();
			
			
			
			
			$update_field['title'] = $title;
			
			
			

			$obj_model_product = $this->app->load_model("csr_category", $id);
			$obj_model_product->map_fields($update_field);
			if($obj_model_product->execute("UPDATE")>0)
			{	
				
				
				
				
				
			
				$this->app->utility->set_message("Records updated successfully", "SUCCESS");
				$this->app->redirect("index.php?view=csr_category_list");
			}
			else
			{
				$this->app->utility->set_message("Ooops... There was a problem in update records", "ERROR");
				$this->app->redirect("index.php?view=csr_category_list");
			}
		}
		else
		{
			//INSERT RECORDS
			
			
			$update_field = array();
			
			
			$update_field['title'] = $title;
			
			
			$obj_model_product = $this->app->load_model("csr_category");
			$obj_model_product->map_fields($update_field);
			$ins=$obj_model_product->execute("INSERT");
			if($ins>0)
			{
				
				

				$this->app->utility->set_message("Records added successfull", "SUCCESS");
				$this->app->redirect("index.php?view=csr_category_list");
			}
			else
			{
				$this->app->utility->set_message("Try Again.", "ERROR");
				$this->app->redirect("index.php?view=csr_category_list");
			}
		}
	}
}
?>