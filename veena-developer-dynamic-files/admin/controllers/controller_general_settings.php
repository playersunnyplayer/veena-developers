<?
	class _general_settings extends controller{
		
		function init(){
			//$this->app->enable_cache("home.html");
		}
		
		function onload(){
			
			
			$this->assign("manage_for", "About Veena");
			$this->assign("to_do", "");
			
			$obj_model_generel_settings = $this->app->load_model("generel_settings");
			$rs = $obj_model_generel_settings->execute("SELECT", true);
			
			$this->app->assign("rs_data",$rs[0]);
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


			if(!empty($_FILES['logo_file']['name']))
			{
				$logo_image=$this->app->utility->FileUpload([filename=>$_FILES['logo_file']['name'],filetmpname=>$_FILES['logo_file']['tmp_name'],folder=>"logo"]);
				$update_field["logo_file"] = $logo_image;
			}


			if(!empty($_FILES['loder_file']['name']))
			{
				$loder_file=$this->app->utility->FileUpload([filename=>$_FILES['loder_file']['name'],filetmpname=>$_FILES['loder_file']['tmp_name'],folder=>"logo"]);
				$update_field["loder_file"] = $loder_file;
			}

			if(!empty($_FILES['loder_icon']['name']))
			{
				$loder_icon=$this->app->utility->FileUpload([filename=>$_FILES['loder_icon']['name'],filetmpname=>$_FILES['loder_icon']['tmp_name'],folder=>"logo"]);
				$update_field["loder_icon"] = $loder_icon;
			}
			
			
			
			if($result[0]["menu_bg_image"]!=NULL && $_FILES['menu_bg_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("logo").'/'.$result[0]["menu_bg_image"]);
				$update_field['menu_bg_image']='';									
			}	
			if(!empty($_FILES['menu_bg_image']['name']))
			{
				$menu_bg_image=$this->app->utility->resize_single_image($_FILES['menu_bg_image']['name'],$_FILES['menu_bg_image']['tmp_name'],$this->app->get_user_config("logo"),'476');
				$update_field["menu_bg_image"] = $menu_bg_image;
			}

			
			$obj_model_generel_settings = $this->app->load_model("generel_settings");
			$obj_model_generel_settings->map_fields($update_field);
			$update_id = $obj_model_generel_settings->execute("UPDATE", false, "", "id=1");		
			if($update_id!=NULL)
			{
				$this->app->utility->set_message("Generel Settings updated successfully.", "SUCCESS");
				$this->app->redirect("index.php?view=general_settings");
			}
			else
			{
				$this->app->utility->set_message("Record not updated...", "ERROR");
				$this->app->redirect("index.php?view=general_settings");
			}
		}	
		
	}	
?>