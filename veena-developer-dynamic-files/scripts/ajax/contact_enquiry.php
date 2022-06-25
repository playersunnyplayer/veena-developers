<?php



	
	
	$name = $app->getPostVar("name");
	$email = $app->getPostVar("email");
	$phone = $app->getPostVar("mobile");
	$msg = $app->getPostVar("message");
	$ip=$_SERVER['REMOTE_ADDR'];
	
	
	
	$fno = $app->getPostVar("fno");
	$sno = $app->getPostVar("sno");
	
	
	$total=$fno+$sno;
	$UserCaptchaCode = $app->getPostVar("UserCaptchaCode");
	
	
	
	
	if($name!='' && $phone!='' && $total==$UserCaptchaCode)
	{
		
       	$fields_map = array();	
		$fields_map['email'] = $email;
		$fields_map['phone'] = $phone;
		$fields_map['msg'] = $msg;
		$fields_map['name'] = $name;
		$fields_map['added_date'] =  date('d-m-Y H:i:s');
		$fields_map['ip'] = $ip;


		$obj_model_help=$app->load_model('contact_enquiry');
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
							   
			$spreadsheetId = "1JvrDF2RUszFWyBb5kgwzVZnEdiZPcs4N0qafTZ84aXs"; 	
			$update_range = "Veena";   
			
			
			$values = [[$name, $email, $phone, $msg]]; 
			$body = new Google_Service_Sheets_ValueRange([
			
				  'values' => $values
			
				]);
			
				$params = [
			
				  'valueInputOption' => 'RAW'
			
				];
				
				
			$update_sheet = $service->spreadsheets_values->append($spreadsheetId, $update_range, $body, $params);




			//Other  Entry Data

			$curl = curl_init();
            $name = $name;
            $email = $email;
            $phone = $phone;
            $message = $msg;
    
			$exid=date('Ymdhms');
			$ldate=date('Y-m-d H:m:s');
			$data=array(
			 "firstName"=>$name, 
			 "lastName" => ".", 
			 "email" => $email, 
			 "mobilePhone" => $phone, 
			 "leadDate"=> $ldate,
			 "comments" => "Website - Quick Enquiry", 
			 "originFrom" => "Auto Source", 
			 "product" => "", 
			 "campaign" => "VD Website", 
			 "isUpdatefromUIDate" => false,
			 "isImported" => true, 
			 "DumpdataObjectId" => '010520211446', 
			 "tenantId" => 219
			);
			
			
			
			$data2=json_encode($data);
			
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://farvisioncloud.com/sfasync/api/syncleads/website",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $data2,
			  CURLOPT_HTTPHEADER => array(
				"content-type: Application/json",
			  ),
			));
			
			$response = curl_exec($curl);
			$err = curl_error($curl);
			
			curl_close($curl);
			
			
			
			
							
							
							
							
														
							$template_name="contact_admin.html";
							$subject="New Contact Inquiry #".$insID;
							$heading="New Contact Inquiry #".$insID;
							$body_parameters=array("name"=>$name,"email"=>$email,"phone"=>$phone,"message"=>$message,"SERVER_ROOT"=>SERVER_ROOT,"heading"=>$heading);	
							
							$mail_data=array();	
							$mail_data['email']=$email;
							$mail_data['template_name']=$template_name;
							$mail_data['subject']=$subject;
							$mail_data['body_parameters']=$body_parameters;											
							$app->utility->send_email_data($mail_data);	
			
			
			
			
						
						
						
						
						
			
			
			






		echo "0";
		exit;
		

	}
	else
	{
		
		echo "1";
		exit;
	}
?>