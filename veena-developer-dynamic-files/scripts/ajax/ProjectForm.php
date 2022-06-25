<?php 
	$jsonclass = $app->load_module("Services_JSON");
	$obj_JSON = new $jsonclass(SERVICES_JSON_LOOSE_TYPE);
	
	
	$name=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("name"));
	$email=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("email"));
	$phone=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("phone"));

	$data_id=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("data_id"));
	$data_value=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("data_value"));
	$data_type=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("data_type"));

	$project_id=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("project_id"));

	$ip=$_SERVER['REMOTE_ADDR'];
	
	if($project_id!='' && $name!='' && $email!='' && $phone!='')
	{
		
		$obj_model_projects=$app->load_model('projects');
		$result=$obj_model_projects->execute("SELECT",false,"","id='".$project_id."'");
		$project_name=$result[0]['name'];

		
		$fields_map = array();	
		$fields_map['email'] = $email;
		$fields_map['phone'] = $phone;
		$fields_map['project_id'] = $project_id;
		$fields_map['name'] = $name;
		$fields_map['added_date'] =  date('d-m-Y H:i:s');
		$fields_map['ip'] = $ip;


		$obj_model_help=$app->load_model('project_enquiry');
		$obj_model_help->map_fields($fields_map);
		$insID=$obj_model_help->execute("INSERT");

		if($data_type=='Project Enquiry')
		{
			$form_type='Quick Enquiry Popup';
		}
		elseif($data_value=='Download Brochure')
		{
			$form_type='Download Brochure';
		}
		elseif($data_value=='Download Floor Plan')
		{
			$form_type='Floor Plan';
		}

		//Google Sheet Entry Data
		require '../../modules/googlesheet/vendor/autoload.php';
		$client = new \Google_Client();
		$client->setApplicationName('Venna Contact Data');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		$client->setAuthConfig('../../modules/googlesheet/venna-contact-data-ba332c415370.json');
		$service = new Google_Service_Sheets($client);
						   
		$spreadsheetId = "1JcknZHI_LE7PXhLJ2A1XhhkA11BCpTGaU6iSxQhEkqU"; 	
		$update_range = "Project";   
		$Date=date('d-m-Y H:i');


		$values = [[$Date, $project_name, $form_type, $name, $phone, $email]]; 
		$body = new Google_Service_Sheets_ValueRange([
			  'values' => $values
			]);
		
			$params = [
			  'valueInputOption' => 'RAW'
			];

		$update_sheet = $service->spreadsheets_values->append($spreadsheetId, $update_range, $body, $params);
		
		
		
		
		
		
							$template_name="project_admin.html";
							$subject="New Project Inquiry #".$insID;
							$heading="New Project Inquiry #".$insID;
							$body_parameters=array("name"=>$name,"email"=>$email,"phone"=>$phone,"form_type"=>$form_type,"project_name"=>$project_name,"SERVER_ROOT"=>SERVER_ROOT,"heading"=>$heading);	
							
							$mail_data=array();	
							$mail_data['email']=$email;
							$mail_data['template_name']=$template_name;
							$mail_data['subject']=$subject;
							$mail_data['body_parameters']=$body_parameters;											
							$app->utility->send_email_data($mail_data);	
		
		
		
		
		
		
		
		echo $obj_JSON->encode(array("RESULT"=>"0","discount"=>0,"min_order"=>0));
	}
	else
	{
		echo $obj_JSON->encode(array("RESULT"=>"1","discount"=>0,"min_order"=>0));
	}	 	
?>