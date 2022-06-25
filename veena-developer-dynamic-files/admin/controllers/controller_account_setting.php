<?

	class _account_setting extends controller{

		

		function init(){

			//$this->app->enable_cache("home.html");

		}

		

		function onload(){

			$this->assign("manage_for", "Account Setting");

			$this->assign("to_do", "");

			$obj_model_admin = $this->app->load_model("admin",$_SESSION['admin']);

			$rs = $obj_model_admin->execute("SELECT");
			
			
			$this->app->assign_form_data("frm_profile",$rs[0]);

			$this->app->assign("rscat",$rs[0]);

			

			$data = $this->app->compile();

			$this->load_parser($data);

			$this->parser->assign("MESSAGE", $this->app->utility->get_message());

			$this->parser->parse('main');			

			$this->update_ouput($this->parser->text('main'));

			$this->unload_parser();

			

		}

		

		function update_data(){
			
			
			
			
				$name=$this->app->getPostVar("name");
			

				$update_field = array();
	

				if(!empty($_FILES['image']['name']))
				{
					
					
					$product_image=$this->app->utility->resize_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("staff"),'800','251','148');
					
					
					$update_field["image"] = $product_image;

					
				
				}



			$obj_model_admin = $this->app->load_model("admin");
			$obj_model_admin->map_fields($update_field);

			$update_id = $obj_model_admin->execute("UPDATE", false, "", "id=".$_SESSION['admin']);		

			if($update_id!=NULL){

				$this->app->utility->set_message("Admin record updated successfull...", "SUCCESS");

				$this->app->redirect("index.php?view=account_setting");

			}else{

				$this->app->utility->set_message("Record not updated...", "ERROR");

				$this->app->redirect("index.php?view=account_setting");

			}

		}	

		

	}	

?>