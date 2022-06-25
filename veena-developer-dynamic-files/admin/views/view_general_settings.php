<link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/typicons.font/typicons.css" rel="stylesheet">
<link href="lib/prismjs/themes/prism-vs.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/dashforge.auth.css">
<link href="lib/select2/css/select2.min.css" rel="stylesheet">
<!-- DashForge CSS -->
<link rel="stylesheet" href="assets/css/dashforge.css">
<link rel="stylesheet" href="assets/css/dashforge.demo.css">
<!-- Skin CSS -->
<link rel="stylesheet" href="assets/css/skin.cool.css">
<!--<link rel="stylesheet" href="assets/css/skin.charcoal.css">-->
<!--Sweet Alert CSS & JS -->
<link href="lib/alert/css/sweet-alert.css" rel="stylesheet" type="text/css" />
<!-- file upload  -->
<link href="lib/bootstrap-file/css/fileupload.css" rel="stylesheet" type="text/css" />
<!--image popup -->
<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
<!-- new added by developer -->
<link rel="stylesheet" href="assets/css/custom.css">
<style>
.scrollbox {
	overflow-y: scroll;
	max-height: 220px;
	border: 1px solid #dae0e8;
}
.even {
	margin-left: 20px;
}
.price_varient {
	padding: 0;
	margin: 0;
}
</style>
<?php include('includes/menu.php');?>
<div class="content ht-100v pd-0">
  <?php include('includes/header.php');?>
  <!-- content-header -->
  <div class="content-body">
    <div class="container pd-x-0">
      <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">System Settings</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                <?=$this->manage_for?>
              </li>
            </ol>
          </nav>
          <h4 class="mg-b-0 tx-spacing--1">
            <?=$this->to_do?>
            <?=$this->manage_for?>
          </h4>
        </div>
        <div class="d-none d-md-block"> </div>
      </div>
      <?=$this->utility->get_message()?>
      <? $this->htmlBuilder->buildTag("form", array("action"=>"","data-parsley-validate"=>"","class"=>"form-horizontal form-bordered form-validate"), "frm_generel_settings");?>
      <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>$this->id), "id");?>
      <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>"update_data"), "act");?>
      <div class="row">
        <div class="col-lg-12">


        <?php if($this->rs_data['loder_file']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->rs_data['loder_file']))
        {
          $loder='<a href="../uploads/logo/'.$this->rs_data['loder_file'].'" target="_blank">'.$this->rs_data['loder_file'].'</a>';
        }
        
        if($this->rs_data['loder_icon']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->gs['loder_icon']))
        {
          $loder_icon='<a href="../uploads/logo/'.$this->rs_data['loder_icon'].'" target="_blank">'.$this->rs_data['loder_icon'].'</a>';
        }
        
        if($this->rs_data['logo_file']!='' && file_exists(ABS_PATH."/uploads/logo/".$this->rs_data['logo_file']))
        {
          $logo='<a href="../uploads/logo/'.$this->rs_data['logo_file'].'" target="_blank">'.$this->rs_data['logo_file'].'</a>';
        }

        ?>


          <div data-label="Contact Details" class="df-example demo-forms">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="control-label" for="example-email">Primary Logo</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>"form-control"), "logo_file") ?>
                  <?=$logo?>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="control-label" for="example-email">Loader Logo</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>"form-control"), "loder_file") ?>
                  <?=$loder?>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="control-label" for="example-email">Loader Icon Logo</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>"form-control"), "loder_icon") ?>
                  <?=$loder_icon?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="" for="example-email">Address</label>
                  <? $this->htmlBuilder->buildTag("textarea", array("type"=>"text","class"=>"form-control","value"=>$this->rs_data['address']), "address") ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="example-email">Contact number </label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control numbersOnly number"), "contact_number") ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="example-email">Whatsapp number </label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control numbersOnly number"), "contact_number1") ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="example-email">Email </label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control"), "contact_email") ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label" for="example-email">Email 2 </label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control"), "contact_email1") ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="" for="example-email">Copyright</label>
                  <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor"), "footer_text") ?>
                </div>
              </div>
            </div>
          </div>
          
          
          
          
          
          
          
          
          
          
          <div data-label="Receive Enquiry Emails" class="df-example demo-forms">
            <div class="row">
             
             
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="" for="example-email">Contact Email (To)</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","placeholder"=>"xyz@gmail.com"), "to_emails") ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label" for="example-email">Contact Emails (CC) </label>
                  <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ","placeholder"=>"xyz@gmail.com,abc@gmail.com"), "cc_emails") ?>
                </div>
              </div>
              
              
              
              
               <div class="col-lg-12">
                <div class="form-group">
                  <label class="" for="example-email">Career Email (To)</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","placeholder"=>"xyz@gmail.com"), "career_to_emails") ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label" for="example-email">Career Emails (CC) </label>
                  <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ","placeholder"=>"xyz@gmail.com,abc@gmail.com"), "career_cc_emails") ?>
                </div>
              </div>
              
              
              
               <div class="col-lg-12">
                <div class="form-group">
                  <label class="" for="example-email">Project Email (To)</label>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control","placeholder"=>"xyz@gmail.com"), "project_to_emails") ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label" for="example-email">Project Emails (CC) </label>
                  <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ","placeholder"=>"xyz@gmail.com,abc@gmail.com"), "project_cc_emails") ?>
                </div>
              </div>
              
              
              
              
              
              
              
              
            </div>
          </div>
          
          
          
          
          
          
          <div data-label="Menu Image" class="df-example demo-forms">
            <div class="row">
              
              
              <div class="col-lg-3">
                <div class="form-group ">
                  <?php 
				  $folder='logo';
				  $image=$this->rs_data["menu_bg_image"];
				  $about_img=$this->utility->get_image_path($image,$folder,'large');
				  $id=$this->rs_data["id"];
            if($image!='')
          {
            $file_class="fileupload-exists";
          }
          else
          {
            $file_class="fileupload-new";
          }
				  ?>
                  <label for="inputEmail4">Image</label>
                  <div class="fileupload <?=$file_class?>" data-provides="fileupload">
                    <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"> <img src="<?=$about_img;?>" class="up_img"></div>
                    <div> <span class="pl-0 btn btn-file btn-default"> <span class="mg-t-5 fileupload-new btn btn-white btn-xs">Select image</span> <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                      <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "menu_bg_image") ?>
                      </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                    </div>
                    
                    <span class="help-block"><strong>Size :</strong> 476 x 1088 px</span>
                  </div>
                </div>
              </div>
              
              
              
              
              
              
              
              
              
            </div>
          </div>
        </div>
      </div>
      <div class="row mg-t-15">
        <div class="col-lg-12">
          <button class="btn btn-primary" type="submit">Submit</button>
          <button class="btn btn-secondary" type="reset">Cancel</button>
        </div>
      </div>
      </form>
      <?php include('includes/footer.php');?>
    </div>
    <!-- container --> 
  </div>
</div>
<script src="lib/jquery/jquery.min.js"></script> 
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="lib/feather-icons/feather.min.js"></script> 
<script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
<script src="lib/prismjs/prism.js"></script> 
<script src="lib/parsleyjs/parsley.min.js"></script> 
<script src="lib/select2/js/select2.min.js"></script> 
<script>
      // Adding placeholder for search input
      (function($) {
        'use strict'
        var Defaults = $.fn.select2.amd.require('select2/defaults');
        $.extend(Defaults.defaults, {
          searchInputPlaceholder: ''
        });
        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');
        var _renderSearchDropdown = SearchDropdown.prototype.render;
        SearchDropdown.prototype.render = function(decorated) {
          // invoke parent method
          var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));
          this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));
          return $rendered;
        };
      })(window.jQuery);
      $(function(){
        'use strict'
        // Basic with search
        $('.select2').select2({
          placeholder: 'Choose one',
          searchInputPlaceholder: 'Search options'
        });
      });
    </script> 
<script src="assets/js/dashforge.aside.js"></script> 
<script src="assets/js/dashforge.js"></script> 
<!-- other include --> 
<script src="lib/alert/js/sweet-alert.min.js"></script> 
<script src="lib/alert/js/jquery.sweet-alert.init.js"></script> 
<!-- file upload  --> 
<script src="lib/bootstrap-file/js/fileupload.js"></script> 
<!-- image popup --> 
<script src="lib/magnific-popup/js/jquery.magnific-popup.js"></script> 
<script src="lib/validate/js/jquery.validate.min.js"></script> 
<!-- Custom --> 
<script src="scripts/js/grocery.js"></script>

  <script src="lib/editor/ckeditor/ckeditor.js"></script>

