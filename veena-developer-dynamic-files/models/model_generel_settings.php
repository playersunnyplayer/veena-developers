<?php
	class model_generel_settings{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_generel_settings($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["about"]="text";
			$this->nullable["about"]="NO";
			$this->default_value["about"]="";
			$this->fields["menu_bg_image"]="varchar(255)";
			$this->nullable["menu_bg_image"]="NO";
			$this->default_value["menu_bg_image"]="";
			$this->fields["facebook_link"]="varchar(255)";
			$this->nullable["facebook_link"]="NO";
			$this->default_value["facebook_link"]="";
			$this->fields["twitter_link"]="varchar(255)";
			$this->nullable["twitter_link"]="NO";
			$this->default_value["twitter_link"]="";
			$this->fields["youtube_link"]="varchar(255)";
			$this->nullable["youtube_link"]="NO";
			$this->default_value["youtube_link"]="";
			$this->fields["google_plus"]="varchar(250)";
			$this->nullable["google_plus"]="NO";
			$this->default_value["google_plus"]="";
			$this->fields["contact_number"]="varchar(50)";
			$this->nullable["contact_number"]="NO";
			$this->default_value["contact_number"]="";
			$this->fields["contact_number1"]="varchar(50)";
			$this->nullable["contact_number1"]="NO";
			$this->default_value["contact_number1"]="";
			$this->fields["contact_email"]="varchar(50)";
			$this->nullable["contact_email"]="NO";
			$this->default_value["contact_email"]="";
			$this->fields["contact_email1"]="varchar(50)";
			$this->nullable["contact_email1"]="NO";
			$this->default_value["contact_email1"]="";
			$this->fields["linkedin_link"]="varchar(255)";
			$this->nullable["linkedin_link"]="NO";
			$this->default_value["linkedin_link"]="";
			$this->fields["pinterest_link"]="varchar(255)";
			$this->nullable["pinterest_link"]="NO";
			$this->default_value["pinterest_link"]="";
			$this->fields["instagram_link"]="varchar(255)";
			$this->nullable["instagram_link"]="NO";
			$this->default_value["instagram_link"]="";
			$this->fields["footer_text"]="text";
			$this->nullable["footer_text"]="NO";
			$this->default_value["footer_text"]="";
			$this->fields["address"]="text";
			$this->nullable["address"]="NO";
			$this->default_value["address"]="";
			$this->fields["logo_file"]="varchar(255)";
			$this->nullable["logo_file"]="NO";
			$this->default_value["logo_file"]="";
			$this->fields["loder_file"]="varchar(255)";
			$this->nullable["loder_file"]="NO";
			$this->default_value["loder_file"]="";
			$this->fields["loder_icon"]="varchar(255)";
			$this->nullable["loder_icon"]="NO";
			$this->default_value["loder_icon"]="";
			$this->fields["to_emails"]="varchar(255)";
			$this->nullable["to_emails"]="NO";
			$this->default_value["to_emails"]="";
			$this->fields["cc_emails"]="text";
			$this->nullable["cc_emails"]="NO";
			$this->default_value["cc_emails"]="";
			$this->fields["career_to_emails"]="varchar(255)";
			$this->nullable["career_to_emails"]="NO";
			$this->default_value["career_to_emails"]="";
			$this->fields["career_cc_emails"]="varchar(255)";
			$this->nullable["career_cc_emails"]="NO";
			$this->default_value["career_cc_emails"]="";
			$this->fields["project_to_emails"]="varchar(255)";
			$this->nullable["project_to_emails"]="NO";
			$this->default_value["project_to_emails"]="";
			$this->fields["project_cc_emails"]="varchar(255)";
			$this->nullable["project_cc_emails"]="NO";
			$this->default_value["project_cc_emails"]="";
		}
	}
?>