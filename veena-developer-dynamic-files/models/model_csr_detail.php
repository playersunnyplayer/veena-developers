<?php
	class model_csr_detail{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_csr_detail($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["career_heading"]="text";
			$this->nullable["career_heading"]="NO";
			$this->default_value["career_heading"]="";
			$this->fields["career_desc"]="text";
			$this->nullable["career_desc"]="NO";
			$this->default_value["career_desc"]="";
			$this->fields["image"]="varchar(255)";
			$this->nullable["image"]="NO";
			$this->default_value["image"]="";
			$this->fields["job_heading"]="text";
			$this->nullable["job_heading"]="NO";
			$this->default_value["job_heading"]="";
			$this->fields["page_image"]="varchar(255)";
			$this->nullable["page_image"]="NO";
			$this->default_value["page_image"]="";
			$this->fields["meta_title"]="varchar(255)";
			$this->nullable["meta_title"]="NO";
			$this->default_value["meta_title"]="";
			$this->fields["meta_keywords"]="varchar(255)";
			$this->nullable["meta_keywords"]="NO";
			$this->default_value["meta_keywords"]="";
			$this->fields["meta_desc"]="text";
			$this->nullable["meta_desc"]="NO";
			$this->default_value["meta_desc"]="";
			$this->fields["chat_code"]="text";
			$this->nullable["chat_code"]="NO";
			$this->default_value["chat_code"]="";
		}
	}
?>