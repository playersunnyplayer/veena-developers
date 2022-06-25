<?
class _team_addedit extends controller
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
		$this->app->assign("to_do","Team");
	}
	
	function load_data()
	{
		$id=$this->app->getGetVar('id');
		$obj_model_product = $this->app->load_model("team", $id);
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
			
			
			$obj_model_record = $this->app->load_model("team");
			$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");

			$update_field = array();
			
			if($result[0]["image"]!=NULL && $_FILES['image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("team").'/'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("team").'/mediumthumb'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("team").'/thumb'.$result[0]["image"]);
				$update_field['image']='';									
			}	

			if(!empty($_FILES['image']['name']))
			{
				if($result[0]["image"]!=NULL)
				{
					@unlink('../'.$this->app->get_user_config("team").'/'.$result[0]["image"]);
					@unlink('../'.$this->app->get_user_config("team").'/mediumthumb'.$result[0]["image"]);
					@unlink('../'.$this->app->get_user_config("team").'/thumb'.$result[0]["image"]);

				}
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("team"),'412');	
				$update_field['image']=$image;
			}

			
			
			
			
			$update_field['title'] = $title;
			
			
			

			$obj_model_product = $this->app->load_model("team", $id);
			$obj_model_product->map_fields($update_field);
			if($obj_model_product->execute("UPDATE")>0)
			{	
				
				
				
				
				
			
				$this->app->utility->set_message("Record updated successfully", "SUCCESS");
				$this->app->redirect("index.php?view=team_list");
			}
			else
			{
				$this->app->utility->set_message("Ooops... There was a problem in update records", "ERROR");
				$this->app->redirect("index.php?view=team_list");
			}
		}
		else
		{
			//INSERT RECORDS
			
			
			$update_field = array();
			
			
			$update_field['title'] = $title;
			
			
			if(!empty($_FILES['image']['name']))
			{
				
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("team"),'412');	
				$update_field['image']=$image;
			}
			
			
			$obj_model_product = $this->app->load_model("team");
			$obj_model_product->map_fields($update_field);
			$ins=$obj_model_product->execute("INSERT");
			if($ins>0)
			{
							
				

				$this->app->utility->set_message("Record added successfully", "SUCCESS");
				$this->app->redirect("index.php?view=team_list");
			}
			else
			{
				$this->app->utility->set_message("Try Again.", "ERROR");
				$this->app->redirect("index.php?view=team_list");
			}
		}
	}
}
?>