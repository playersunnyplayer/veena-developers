<?php
	class model_blog_content{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_blog_content($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["header_image"]="varchar(255)";
			$this->nullable["header_image"]="NO";
			$this->default_value["header_image"]="";
			$this->fields["meta_title"]="text";
			$this->nullable["meta_title"]="NO";
			$this->default_value["meta_title"]="";
			$this->fields["meta_keywords"]="text";
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