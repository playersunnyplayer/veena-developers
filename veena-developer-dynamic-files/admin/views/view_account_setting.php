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
	padding:0;
	margin:0;
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
              <li class="breadcrumb-item"><a href="#">Page</a></li>
              <li class="breadcrumb-item active" aria-current="page"> Account Settings </li>
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
      <? $this->htmlBuilder->buildTag("form", array("action"=>"","data-parsley-validate"=>"","class"=>"form-horizontal form-bordered form-validate"), "frm_profile");?>
      <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>$this->id), "id");?>
      <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>"update_data"), "act");?>
      <div class="row">
        <div class="col-lg-12">
          <div data-label="" class="df-example demo-forms">
            <div class="form-group">
              <label class="d-block">Name <span class="tx-danger">*</span></label>
              <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control ","required"=>""), "login_username") ?>
            </div>

            <div class="form-group">
              <label class="d-block">Email <span class="tx-danger">*</span></label>
               <div class="input-group">
              <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control required","required"=>""), "email") ?>
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-envelope"></i> </div>
                </div>
            </div>
            </div>
            <div class="form-group">
              <label class="d-block">Phone <span class="tx-danger">*</span></label>
              <div class="input-group">
              <? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"form-control required","required"=>""), "phone") ?>
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-phone"></i> </div>
                </div>
            </div>
            </div>
            
            <div class="form-group">
            
              <label class="d-block">Password <span class="tx-danger">*</span></label>
              <div class="input-group">
              <? if($this->id!=""){?>
              <? $this->htmlBuilder->buildTag("input", array("type"=>"password","value"=>$this->login_password,"class"=>"form-control required","required"=>""), "login_password") ?>
              <? } else{?>
              <? $this->htmlBuilder->buildTag("input", array("type"=>"password","class"=>"form-control required","required"=>"required"), "login_password") ?>
              <?php } ?>
              <div class="input-group-prepend">
                  <div class="input-group-text"> <i toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></i> </div>
                </div>
            </div>
            </div>
            
          </div>
          
        </div>
        <div class="col-lg-4" style="display:none">
          <div data-label="" class="df-example demo-forms">
            <div class="form-group">
              <label class="d-block">Image</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new" >
                  <?php $img='../uploads/staff/'.$this->rscat['image']; ?>
                  <img src="<?=$img;?>" class="up_img"> </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                <div> <span class="btn btn-file btn-default"> <span class="mg-t-5 fileupload-new btn btn-white btn-xs">Select image</span><span class="fileupload-exists btn btn-white btn-xs">Change</span>
                  <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "image") ?>
                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mg-t-15">
        <div class="col-lg-12">
          <button class="btn btn-primary" type="submit">Submit</button>
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
<!-- ckeditor -->

<script>
  $(document).on("click", ".toggle-password", function () {

    $(this).toggleClass("fa-eye fa-eye-slash");

    var input = $("#login_password");

    input.attr("type") === "password"

      ? input.attr("type", "text")

      : input.attr("type", "password");

  });
</script>

