<?
	class _home_page extends controller
	{
		function init()
		{	
		}
		
		function onload()
		{		
			$obj_model_generel_settings = $this->app->load_model("home_detail");
			$rs = $obj_model_generel_settings->execute("SELECT", true);
			
			$this->app->assign("rscat",$rs[0]);
			$this->app->assign_form_data("frm_generel_settings",$rs[0]);
			
			$p_type='';
			$this->app->assign("p_type",$p_type);
			
			$data = $this->app->compile();
			$this->load_parser($data);
			$this->parser->assign("MESSAGE", $this->app->utility->get_message());
			$this->parser->parse('main');			
			$this->update_ouput($this->parser->text('main'));
			$this->unload_parser();
		}
		
		
		function update_data()
		{
				
			$update_field = array();

			$obj_model_record = $this->app->load_model("home_detail");
			$result=$obj_model_record->execute("SELECT", true);
			
			if(!empty($_FILES['about_image']['name']))
			{
				$image=$this->app->utility->resize_single_image($_FILES['about_image']['name'],$_FILES['about_image']['tmp_name'],$this->app->get_user_config("home"),'550');
				$update_field["image"] = $image;
			}

			
			if(!empty($_FILES['career_page_image']['name']))
			{
				$career_page_image=$this->app->utility->resize_single_image($_FILES['career_page_image']['name'],$_FILES['career_page_image']['tmp_name'],$this->app->get_user_config("home"),'1920');
				$update_field["page_image"] = $career_page_image;
			}
			
			
			if($result[0]["ch_image"]!=NULL && $_FILES['ch_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("home").'/'.$result[0]["ch_image"]);
				$update_field['ch_image']='';									
			}	

			if(!empty($_FILES['ch_image']['name']))
			{
				$ch_image=$this->app->utility->resize_single_image($_FILES['ch_image']['name'],$_FILES['ch_image']['tmp_name'],$this->app->get_user_config("home"),'205');
				$update_field["ch_image"] = $ch_image;
			}

			if($result[0]["ch_bg_image"]!=NULL && $_FILES['ch_bg_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("home").'/'.$result[0]["ch_bg_image"]);
				$update_field['ch_bg_image']='';									
			}	
			
			if(!empty($_FILES['ch_bg_image']['name']))
			{
				$ch_bg_image=$this->app->utility->resize_single_image($_FILES['ch_bg_image']['name'],$_FILES['ch_bg_image']['tmp_name'],$this->app->get_user_config("home"),'375');
				$update_field["ch_bg_image"] = $ch_bg_image;
			}

			
			
			$obj_model_generel_settings = $this->app->load_model("home_detail");
			$obj_model_generel_settings->map_fields($update_field);
			$update_id = $obj_model_generel_settings->execute("UPDATE", false, "", "id=1");		
			if($update_id!=NULL)
			{
				$this->app->utility->set_message("Content updated successfully.", "SUCCESS");
				$this->app->redirect("index.php?view=home_page");
			}
			else
			{
				$this->app->utility->set_message("Record not updated...", "ERROR");
				$this->app->redirect("index.php?view=home_page");
			}
		}	
		
	}	
?>