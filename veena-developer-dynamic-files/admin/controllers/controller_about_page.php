<?
	class _about_page extends controller
	{
		function init()
		{	
		}
		
		function onload()
		{		
			$obj_model_generel_settings = $this->app->load_model("about_detail");
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
			$obj_model_record = $this->app->load_model("about_detail");
			$result=$obj_model_record->execute("SELECT", true);
			

			$update_field = array();

			if($result[0]["image"]!=NULL && $_FILES['about_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("about").'/'.$result[0]["image"]);
				$update_field['image']='';									
			}	
			if(!empty($_FILES['about_image']['name']))
			{
				$image=$this->app->utility->resize_single_image($_FILES['about_image']['name'],$_FILES['about_image']['tmp_name'],$this->app->get_user_config("about"),'550');
				$update_field["image"] = $image;
			}
			
			if($result[0]["page_image"]!=NULL && $_FILES['career_page_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("about").'/'.$result[0]["page_image"]);
				$update_field['page_image']='';									
			}	
			if(!empty($_FILES['career_page_image']['name']))
			{
				$career_page_image=$this->app->utility->resize_single_image($_FILES['career_page_image']['name'],$_FILES['career_page_image']['tmp_name'],$this->app->get_user_config("about"),'1920');
				$update_field["page_image"] = $career_page_image;
			}
			
			
			if($result[0]["ch_image"]!=NULL && $_FILES['ch_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("about").'/'.$result[0]["ch_image"]);
				$update_field['ch_image']='';									
			}	
			if(!empty($_FILES['ch_image']['name']))
			{
				$ch_image=$this->app->utility->resize_single_image($_FILES['ch_image']['name'],$_FILES['ch_image']['tmp_name'],$this->app->get_user_config("about"),'770');
				$update_field["ch_image"] = $ch_image;
			}
			
			if($result[0]["ch_bg_image"]!=NULL && $_FILES['ch_bg_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("about").'/'.$result[0]["ch_bg_image"]);
				$update_field['ch_bg_image']='';									
			}

			if(!empty($_FILES['ch_bg_image']['name']))
			{
				$ch_bg_image=$this->app->utility->resize_single_image($_FILES['ch_bg_image']['name'],$_FILES['ch_bg_image']['tmp_name'],$this->app->get_user_config("about"),'1920');
				$update_field["ch_bg_image"] = $ch_bg_image;
			}
			

			if($result[0]["philo_image"]!=NULL && $_FILES['philo_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("about").'/'.$result[0]["philo_image"]);
				$update_field['philo_image']='';									
			}
			
				if(!empty($_FILES['philo_image']['name']))
			{
				$philo_image=$this->app->utility->resize_single_image($_FILES['philo_image']['name'],$_FILES['philo_image']['tmp_name'],$this->app->get_user_config("about"),'550');
				$update_field["philo_image"] = $philo_image;
			}
			
			

			
			$obj_model_generel_settings = $this->app->load_model("about_detail");
			$obj_model_generel_settings->map_fields($update_field);
			$update_id = $obj_model_generel_settings->execute("UPDATE", false, "", "id=1");		
			if($update_id!=NULL)
			{
				$this->app->utility->set_message("About Content updated successfull...", "SUCCESS");
				$this->app->redirect("index.php?view=about_page");
			}
			else
			{
				$this->app->utility->set_message("Record not updated...", "ERROR");
				$this->app->redirect("index.php?view=about_page");
			}
		}	
		
	}	
?>