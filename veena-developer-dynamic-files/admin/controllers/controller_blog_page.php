<?
	class _blog_page extends controller
	{
		function init()
		{	
		}
		
		function onload()
		{		
			$obj_model_generel_settings = $this->app->load_model("blog_content");
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
			$obj_model_record = $this->app->load_model("blog_content");
			$result=$obj_model_record->execute("SELECT", true);
			

			$update_field = array();

			if($result[0]["header_image"]!=NULL && $_FILES['header_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("blog").'/'.$result[0]["header_image"]);
				$update_field['header_image']='';									
			}	
			if(!empty($_FILES['header_image']['name']))
			{
				$image=$this->app->utility->resize_single_image($_FILES['header_image']['name'],$_FILES['header_image']['tmp_name'],$this->app->get_user_config("blog"),'550');
				$update_field["header_image"] = $image;
			}
			
			
			$obj_model_generel_settings = $this->app->load_model("blog_content");
			$obj_model_generel_settings->map_fields($update_field);
			$update_id = $obj_model_generel_settings->execute("UPDATE", false, "", "id=1");		
			if($update_id!=NULL)
			{
				$this->app->utility->set_message("Blog Content updated successfull...", "SUCCESS");
				$this->app->redirect("index.php?view=blog_page");
			}
			else
			{
				$this->app->utility->set_message("Record not updated...", "ERROR");
				$this->app->redirect("index.php?view=blog_page");
			}
		}	
		
	}	
?>