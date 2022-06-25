<?php
	class model_csr_category{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_csr_category($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["title"]="varchar(255)";
			$this->nullable["title"]="NO";
			$this->default_value["title"]="";
			$this->fields["short_desc"]="text";
			$this->nullable["short_desc"]="NO";
			$this->default_value["short_desc"]="";
			$this->fields["sort_id"]="int(11)";
			$this->nullable["sort_id"]="NO";
			$this->default_value["sort_id"]="";
			$this->fields["status"]="enum('Active','Inactive','Trash')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
		}
	}
?>