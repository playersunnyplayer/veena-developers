<?php 
	$jsonclass = $app->load_module("Services_JSON");
	$obj_JSON = new $jsonclass(SERVICES_JSON_LOOSE_TYPE);
	$jobId=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("jobId"));
	$name=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("name"));
	$email=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("email"));
	$phone=mysqli_real_escape_string($app->set_db_conn(),$app->getPostVar("phone"));



	$ip=$_SERVER['REMOTE_ADDR'];
	
	if($jobId!='' && $name!='' && $email!='' && $phone!='')
	{
		
		$obj_model_career_jobs=$app->load_model('career_jobs');
		$result=$obj_model_career_jobs->execute("SELECT",false,"","id='".$jobId."'");

		$job_title=$result[0]['title'];
		
		
		
		
		
		
		
		
		if($_FILES['file1']['name']!='')
					{
							
						
						
						
						
								$file_name1 = basename($_FILES['file1']['name']);
								$file_info1 = $app->utility->get_file_info($file_name1);
								
								
								
								
								if(strtolower($file_info1->extension)=='pdf' || strtolower($file_info1->extension)=='doc')
								{
									
									
									
									
									
									
									if($_FILES['file1']['size']>5000000)
									{
										echo $obj_JSON->encode(array("RESULT"=>"1", "MSG"=>"Please upload a file smaller than 5MB."));
										
										
										exit;
																	
									}
									
									
									
									
							
								$file_names=explode('.',$file_name1);
			
								$pre_name=$app->utility->seo_url($file_names[0]);
								$new_name1=$pre_name.'.'.$file_info1->extension;
							
							
							
									if($app->utility->upload_file($_FILES['file1']))
									{
										
										  if($app->utility->store_uploaded_file($app->get_user_config("files"), $new_name1))
											{	
												//$update_field['image']= $new_name1;
												
												
										
											}
											else
											{
												
												echo $obj_JSON->encode(array("RESULT"=>"1", "MSG"=>"Try Again."));
												exit;
												
											}
					
			
									}
									else
									{
										echo $obj_JSON->encode(array("RESULT"=>"1", "MSG"=>"Try Again."));
												exit;
										
									}
								}
								else
								{
									
									
									
									
									
									
									
									echo $obj_JSON->encode(array("RESULT"=>"1", "MSG"=>"Please Upload pdf or doc file."));
										
										
										exit;
									
								
								
									
									
									
								}
						
							
							
					}
					else
					{
						echo $obj_json->encode(array("RESULT"=>"1", "MSG"=>"Please Upload pdf or doc file ."));
						exit;
						
					}
		
		
		
		
	
	
		

		$fields_map = array();	
		$fields_map['email'] = $email;
		$fields_map['phone'] = $phone;
		$fields_map['job_id'] = $jobId;
		$fields_map['name'] = $name;
		$fields_map['added_date'] =  date('d-m-Y H:i:s');
		$fields_map['ip'] = $ip;
		$fields_map['resume_file'] = $new_name1;
		


		$obj_model_help=$app->load_model('career_enquiry');
		$obj_model_help->map_fields($fields_map);
		$insID=$obj_model_help->execute("INSERT");
		
		
		


		//Google Sheet Entry Data
		require '../../modules/googlesheet/vendor/autoload.php';
		$client = new \Google_Client();
		$client->setApplicationName('Venna Contact Data');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		$client->setAuthConfig('../../modules/googlesheet/venna-contact-data-ba332c415370.json');
		$service = new Google_Service_Sheets($client);
						   
		$spreadsheetId = "1g2lrOeVxRrYtpKo6EYvYQICTf5A30inJG60jHsfPs2U"; 	
		$update_range = "Careers";   
		$Date=date('d-m-Y H:i');


		$values = [[$Date, $name, $email,$phone,$job_title]]; 
		$body = new Google_Service_Sheets_ValueRange([
			  'values' => $values
			]);
		
			$params = [
			  'valueInputOption' => 'RAW'
			];

		$update_sheet = $service->spreadsheets_values->append($spreadsheetId, $update_range, $body, $params);
		
		
		
		
		
		
							$sma_new_name=$new_name1;
                        
              			    $filepath=ABS_PATH.'/uploads/files/'.$new_name1;

		
		
							$template_name="career_admin.html";
							$subject="New Career Inquiry #".$insID;
							$heading="New Career Inquiry #".$insID;
							$body_parameters=array("name"=>$name,"email"=>$email,"phone"=>$phone,"job_name"=>$job_title,"SERVER_ROOT"=>SERVER_ROOT,"heading"=>$heading);	
							
							$mail_data=array();	
							$mail_data['email']=$email;
							$mail_data['template_name']=$template_name;
							$mail_data['subject']=$subject;
							$mail_data['body_parameters']=$body_parameters;		
							
							$mail_data['file_name']=$sma_new_name;	
							$mail_data['filepath']=$filepath;	
							
																
							$app->utility->send_email_data($mail_data);	
							
							
							
		
		
		
		
		
		
		
		echo $obj_JSON->encode(array("RESULT"=>"0","discount"=>0,"min_order"=>0));
	}
	else
	{
		echo $obj_JSON->encode(array("RESULT"=>"1","discount"=>0,"min_order"=>0));
	}	 	
?>