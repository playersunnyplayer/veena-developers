<!-- vendor css -->
<link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/typicons.font/typicons.css" rel="stylesheet">
<link href="lib/prismjs/themes/prism-vs.css" rel="stylesheet">

<link href="lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="lib/select2/css/select2.min.css" rel="stylesheet">

<!-- DashForge CSS -->
<link rel="stylesheet" href="assets/css/dashforge.css">
<link rel="stylesheet" href="assets/css/dashforge.demo.css">

<!-- Skin CSS -->
<link rel="stylesheet" href="assets/css/skin.cool.css">
<!--<link rel="stylesheet" href="assets/css/skin.charcoal.css">-->

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/custom.css">


<!-- file upload  --> 
<link href="lib/bootstrap-file/css/fileupload.css" rel="stylesheet" type="text/css" />

<!--image popup -->
<link href="lib/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />

<!--Sweet Alert CSS & JS -->
<link href="lib/alert/css/sweet-alert.css" rel="stylesheet" type="text/css" />
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
.amenities-row .select2-container
{
	width:100% !important;
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
                  <li class="breadcrumb-item"><a href="#">Manage Project</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <?=$this->to_do?>
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
            <? $this->htmlBuilder->buildTag("form", array("action"=>"","data-parsley-validate"=>"","class"=>"form-horizontal form-bordered form-validate"), "frm_project_addedit");?>
              <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>$this->rscat['id']), "id");?>
                <? $this->htmlBuilder->buildTag("input", array("type"=>"hidden", "value"=>"update_data"), "act");?>
                  <div class="row">
                    <div class="col-lg-12">
                    
                    <?php
					
					$tag_ids=$this->rscat['tag_ids'];
					
					$explodeData=explode(',',$tag_ids);
					
					$ongoingAll='';
					$OtherDivs='';
					
					
					if (in_array(1, $explodeData))
  					{

						
					}
					else
					{
						
						
						$OtherDivs='style="display:none"';
						
					}
					
					
					?>
                    
                    
                      <div data-label="Project Detail" class="df-example demo-forms" >
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Project Name <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>""), "name") ;?>
                          </div>


                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Project Slug <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>""), "slug") ;?>
                            <span class="tx-danger" style="font-size: 11px;"><strong>Note :</strong> Do not use space and special characters (%,* etc)</span>
                          </div>


                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Location <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input",array("class"=>"form-control","type"=>"text","required"=>""),"subtitle") ;?>
                          </div>
                          
                          
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Rera Reg No.</label>
                            <? $this->htmlBuilder->buildTag("input",array("class"=>"form-control","type"=>"text"),"rera_reg_no") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Category  <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("select", array("class"=>"form-control ", "values"=>$this->cat_data,"required"=>""), "category_ids") ;?>
         
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Tags</label>
                            <select class="form-control select2 tag_idsVal" multiple="multiple" name="tag_ids1[]" onchange="checkMasterTagValue()">
          
                              <? for($i=0;$i<count($this->rs_tag);$i++)
                                {
                                $micro_items=explode(',',$this->rscat['tag_ids']);
                                ?>
                                <option value="<?=$this->rs_tag[$i]['id']; ?>" <? for($j=0;$j<count($micro_items);$j++) {if($this->rs_tag[$i]['id']==trim($micro_items[$j])){echo 'selected';}} ?>>
                                  <?=$this->rs_tag[$i]['name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                          </div>
                          
                           <?php 
                          $folder='project';
                          $image=$this->rscat["image"];
                          $image_img=$this->utility->get_image_path($image,$folder,'large');

                           if($image!='')
                            {
                              $file_class="fileupload-exists";
                            }
                            else
                            {
                              $file_class="fileupload-new";
                            }
                          ?>
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Header Image <span class="tx-danger">*</span></label>

                            <div class="fileupload <?=$file_class;?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$image_img;?>" class="up_img"/></div>
                              <div> 
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "image") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                              <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 1920 x 340 px</span>
                            </div>

                          </div>
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Email <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>""), "email") ;?>
                         <br/>
                            <label for="inputEmail4">Phone <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input",array("class"=>"form-control","type"=>"text","required"=>""),"phone") ;?>
                          </div>
                         
                          

                          

                        </div>

                        <div  class="projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Micro Web</label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text"), "micro_web") ;?>
                          </div>
                         
                         
                          
                        </div>
                      </div>

                      </div>
                      
                      
                      
                      
                      
                      <div data-label="Other Infromation" class="df-example demo-forms " >
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="inputEmail4">No Of Buildings <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","required"=>"","value"=>$this->rs_info['no_of_building']), "no_of_building") ;?>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputEmail4">No Of Storey <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input",array("class"=>"form-control","type"=>"text","required"=>"","value"=>$this->rs_info['no_of_storey']),"no_of_storey") ;?>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputEmail4">Type Of Units  <span class="tx-danger">*</span></label>
                             <? $this->htmlBuilder->buildTag("input",array("class"=>"form-control","type"=>"text","required"=>"","value"=>$this->rs_info['type_of_unit']),"type_of_unit") ;?>
         
                          </div>
                          
                         
                         
                          
                        </div>
                      </div>
                      
                      
                      <div data-label="Project Highlights" class="df-example demo-forms projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                      <div class="form-row">
            <div class="col-md-12">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th  >Highlights Type </th>
                    <th  >Value </th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody id="use_rows">
                  <?php
				  
				  $rs_tab_data=$this->rs_tab_data;


		 for($i=0;$i<count($rs_tab_data);$i++)
		 {
			 $pa=$rs_tab_data[$i];
			 $final_price=$pa["highlights_id"];
			 $points=$pa["value_data"];
			 
			
			
			 $table_id=$pa["id"];
			 
			 
			  ?>
                  <tr class="rowd_<?=$table_id?>">
                  
                  
                    <input type="hidden" name="table_id[]" value="<?=$pa["id"]?>">
                    
                  <td><? $this->htmlBuilder->buildTag("select", array("values"=>$this->rs_highlights,"class"=>"span12 masterSelection form-control","id"=>"final_price_p_1","name"=>"final_price_p[]","selected"=>$final_price), "") ?></td>
                    
                    <td><? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"span12 form-control","id"=>"points_p_1","name"=>"points_p[]","value"=>$points), "") ?></td>
   
                    <td><a style="color:#fff;<?=$display_none?>" class="btn btn-xs btn-danger record_delete_attribute_onclick"  data-id="<?=$pa['id'];?>" data-tableid="<?=$pa['id'];?>" data-tablename="projects_highlights"  rel="tooltip" title="Delete"> <i class="fa fa-trash"></i></a></td>
                  </tr>
                  <?php } ?>
              <?php if(count($rs_tab_data)==0){?>    
                  <tr>
                    <input type="hidden" name="table_id[]" value="0" />
                  
                  
                    
                    <td><? $this->htmlBuilder->buildTag("select", array("values"=>$this->rs_highlights,"class"=>"span12 form-control masterSelection","id"=>"final_price_p_1","name"=>"final_price_p[]"), "") ?></td>
                    
                    <td><? $this->htmlBuilder->buildTag("input", array("type"=>"text","class"=>"span12 form-control","id"=>"points_p_1","name"=>"points_p[]"), "") ?></td>
                    
                    <td></td>
                    <td>&nbsp;</td>
                  </tr>
               <?php }?> 
                </tbody>
              </table>
              <div class="padding-7" style="text-align:right;"> <a class="btn btn-sm btn-success" href="javascript:add_attr_fields();"> <i class="icon-plus "></i> <strong>+ </strong></a></div>
            </div>
          </div>
                      
                      
                      </div>
                      
                      
                      
                      
                     
                      
                      
                      <div data-label="Information" class="df-example demo-forms projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4"> Section Heading<span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['about_heading']), "about_heading") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Title</label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['about_title']), "about_title") ;?>
                              <br/>
                              <label for="inputEmail4">Video</label>
                              <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","placeholder"=>"https://www.youtube.com/watch?v=NFTzd2Kt6Zk&t=10s","value"=>$this->rs_info['about_video']), "about_video") ;?>
                          </div>

                          <?php 
                          $folder='project';
                          $about_image=$this->rs_info["about_image"];
                          $about_img=$this->utility->get_image_path($about_image,$folder,'large');
                          $id=$this->rscat["id"];

                          if($about_image!='')
                            {
                              $file_class1="fileupload-exists";
                            }
                            else
                            {
                              $file_class1="fileupload-new";
                            }
                          ?>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Image</label>
                            <div class="fileupload <?=$file_class1?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$about_img;?>" class="up_img"> </div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "about_image") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                                <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 550 x 400 px</span>
                            </div>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Description</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['about_desc']), "about_desc") ;?>
                          </div>



                           <?php 
                          $folder='project';
                          $banner=$this->rscat["banner"];
                          $banner_img=$this->utility->get_image_path($banner,$folder,'large');
                          $id=$this->rscat["id"];

                            if($banner!='')
                            {
                              $file_class2="fileupload-exists";
                            }
                            else
                            {
                              $file_class2="fileupload-new";
                            }
                          ?>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Web Banner</label>
                            <div class="fileupload <?=$file_class2?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$banner_img;?>" class="up_img"></div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "banner") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                                <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 1400 x 400 px</span>
                            </div>
                          </div>
                          
                          
                          
                            <?php 
                          $folder='project';
                          $banner=$this->rscat["mobile_banner"];
                          $banner_img=$this->utility->get_image_path($banner,$folder,'large');
                          $id=$this->rscat["id"];
                          if($banner!='')
                            {
                              $file_class3="fileupload-exists";
                            }
                            else
                            {
                              $file_class3="fileupload-new";
                            }
                          ?>
                          
                          
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Mobile Banner</label>
                            <div class="fileupload <?=$file_class3?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$banner_img;?>" class="up_img"></div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class="fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "mobile_banner") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                                <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 767 x 640 px</span>
                            </div>
                          </div>


                        </div>



                      </div>
                      <div data-label="Amenities" class="df-example demo-forms  projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row amenities-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Section Heading <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['amenities_heading']), "amenities_heading") ;?>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Amenities</label>
                            <select class="form-control select3" multiple="multiple" name="projects_amenities_master_ids1[]">
                            
                            
                            
                            
                            
                            
                            
                            
                              <? for($i=0;$i<count($this->rs_amenities_master);$i++)
                                  {
                                  $micro_items=explode(',',$this->rs_info['projects_amenities_master_ids']);
                                  ?>
                                <option value="<?=$this->rs_amenities_master[$i]['id']; ?>" <? for($j=0;$j<count($micro_items);$j++) {if($this->rs_amenities_master[$i]['id']==trim($micro_items[$j])){echo 'selected';}} ?>>
                                  <?=$this->rs_amenities_master[$i]['name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                          </div>
                          
                           <?php 
                          $folder='project';
                          $amenities_bg_image=$this->rs_info["amenities_bg"];
                          $amenities_bg_img=$this->utility->get_image_path($amenities_bg_image,$folder,'large');
                          $id=$this->rscat["id"];
                          if($amenities_bg_image!='')
                            {
                              $file_class4="fileupload-exists";
                            }
                            else
                            {
                              $file_class4="fileupload-new";
                            }
                          ?>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Background</label>
                            <div class="fileupload <?=$file_class4?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$amenities_bg_img;?>" class="up_img"></div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                  <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                  <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "amenities_bg") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                                <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 1920 x 800 px</span>
                            </div>
                          </div>
                          <?php 
                          $folder='project';
                          $amenities_image=$this->rs_info["amenities_image"];
                          $amenities_img=$this->utility->get_image_path($amenities_image,$folder,'large');
                          $id=$this->rscat["id"];
                          if($amenities_image!='')
                            {
                              $file_class5="fileupload-exists";
                            }
                            else
                            {
                              $file_class5="fileupload-new";
                            }
                          ?>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Image</label>
                            <div class="fileupload <?=$file_class5?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><img src="<?=$amenities_img;?>" class="up_img"></div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                <span class=" fileupload-new btn btn-white btn-xs">Select image</span>
                                <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "amenities_image") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                               <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 2400 x 1080 px</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div data-label="Floor Plans" class="df-example demo-forms  projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Section Heading <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['floor_heading']), "floor_heading") ;?>
                              <br/>
                              <label for="inputEmail4"> Title</label>
                              <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['floor_title']), "floor_title") ;?>
                          </div>
                          <?php 
                          $folder='project';
                          $floor_img=$this->rs_info["floor_img"];
                          $floor_img1=$this->utility->get_image_path($floor_img,$folder,'large');
                          $id=$this->rscat["id"];
                          if($floor_img!='')
                            {
                              $file_class6="fileupload-exists";
                            }
                            else
                            {
                              $file_class6="fileupload-new";
                            }
                          ?>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Image</label>
                            <div class="fileupload <?=$file_class6?>" data-provides="fileupload">
                              <div class="fileupload-new"> <img src="images/img_upl.gif" class="up_img"> </div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"> <img src="<?=$floor_img1;?>" class="up_img"> </div>
                              <div>
                                <span class="pl-0 btn btn-file btn-default">
                                <span class="fileupload-new btn btn-white btn-xs">Select image</span>
                                <span class="fileupload-exists btn btn-white btn-xs">Change</span>
                                <? $this->htmlBuilder->buildTag("input", array("type"=>"file","class"=>""), "floor_img") ?>
                                  </span> <a href="#" class="btn btn-xs fileupload-exists btn-white" data-dismiss="fileupload">Remove</a>
                              </div>
                              
                               <span class="tx-11-f tx-danger"><strong>Dimension :</strong> 840 x 640 px</span>
                            </div>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Description</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['floor_desc']), "floor_desc") ;?>
                          </div>


                           <?php if($this->rs_info['floor_link1_file']!='' && file_exists(ABS_PATH."/uploads/project/".$this->rs_info['floor_link1_file']))
                              {
                                $floor_link1_file='<a href="../uploads/project/'.$this->rs_info['floor_link1_file'].'" target="_blank">'.$this->rs_info['floor_link1_file'].'</a>';
                              }

                              if($this->rs_info['floor_link1_icon']!='' && file_exists(ABS_PATH."/uploads/project/".$this->rs_info['floor_link1_icon']))
                              {
                                $floor_link1_icon='<a href="../uploads/project/'.$this->rs_info['floor_link1_icon'].'" target="_blank">'.$this->rs_info['floor_link1_icon'].'</a>';
                              }

                              ?>
                          <div class="form-group col-md-6">
                            <div data-label="Brochure" class="df-example demo-forms">
                              <div class="form-row">
                    
                                <div class="form-group col-md-12">
                                  <label for="inputEmail4">File (Only PDF)</label>
                                  <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"file","accept"=>"application/pdf"), "floor_link1_file") ;?>
                                  <?=$floor_link1_file?>
                                </div>
                       
                              </div>
                            </div>
                          </div>

                            <div class="form-group col-md-6">
                            <?php if($this->rs_info['floor_link2_file']!='' && file_exists(ABS_PATH."/uploads/project/".$this->rs_info['floor_link2_file']))
                              {
                                $floor_link2_file='<a href="../uploads/project/'.$this->rs_info['floor_link2_file'].'" target="_blank">'.$this->rs_info['floor_link2_file'].'</a>';
                              }

                              if($this->rs_info['floor_link2_icon']!='' && file_exists(ABS_PATH."/uploads/project/".$this->rs_info['floor_link2_icon']))
                              {
                                $floor_link2_icon='<a href="../uploads/project/'.$this->rs_info['floor_link2_icon'].'" target="_blank">'.$this->rs_info['floor_link2_icon'].'</a>';
                              }

                              ?>
                              
                            <div data-label="Floor Plans" class="df-example demo-forms">
                              <div class="form-row">

                                <div class="form-group col-md-12">
                                  <label for="inputEmail4">File (Only PDF)</label>
                                  <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"file","accept"=>"application/pdf"), "floor_link2_file") ;?>
                                  <?=$floor_link2_file?>
                                </div>
        
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div data-label="Project Location" class="df-example demo-forms projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Section Heading <span class="tx-danger">*</span></label>
                            <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['location_heading']), "location_heading") ;?>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Map Link</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control","type"=>"text","rows"=>"4","value"=>$this->rs_info['location_map']), "location_map") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Site Office</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['location_p1']), "location_p1") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Location Highlights</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['location_p2']), "location_p2") ;?>
                          </div>
                        </div>
                      </div>
                      

                      <div data-label="SEO Information" class="df-example demo-forms projectsAll OtherDivs" <?=$projectsAll?> <?=$OtherDivs?>>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Title</label>
                           <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['meta_title']), "meta_title") ;?>
                          </div>
                          
                          
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Keywords</label>
                           <? $this->htmlBuilder->buildTag("input", array("class"=>"form-control ","type"=>"text","value"=>$this->rs_info['meta_keyword']), "meta_keyword") ;?>
                          </div>
                          
                          
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Meta Descriptions</label>
                           <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ","rows"=>"3","value"=>$this->rs_info['meta_description']), "meta_description") ;?>
                          </div>
 
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Head Code</label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['head_code']), "head_code") ;?>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Body Code </label>
                            <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ckeditor","type"=>"text","value"=>$this->rs_info['body_code']), "body_code") ;?>
                          </div>


                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Chat Code</label>
                           <? $this->htmlBuilder->buildTag("textarea", array("class"=>"form-control ","value"=>$this->rs_info['chat_code']), "chat_code") ;?>
                          </div>
 
                          
                        </div>
                      </div>
                      
                      
                      
                    </div>
                  </div>
                  <div class="row mg-t-15">
                    <div class="col-lg-12">
                      <button class="btn btn-primary" id="product_btn" type="submit">Submit</button> <a class="btn btn-secondary" href="index.php?view=project_list">Cancel</a> </div>
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

<script src="lib/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script> 
<script src="lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script> 
<script src="lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script> 

<script src="lib/select2/js/select2.min.js"></script> 
<script src="assets/js/dashforge.aside.js"></script>
<script src="assets/js/dashforge.js"></script>

<!-- other include --> 
<script src="lib/alert/js/sweet-alert.min.js"></script> 
<script src="lib/alert/js/jquery.sweet-alert.init.js"></script> 
<script src="lib/validate/js/jquery.validate.min.js"></script> 



<!-- file upload  --> 
<script src="lib/bootstrap-file/js/fileupload.js"></script> 

<!-- image popup --> 
<script src="lib/magnific-popup/js/jquery.magnific-popup.js"></script> 

<!-- Custom --> 
<script src="scripts/js/grocery.js"></script> 

 <script src="lib/jqueryui/jquery-ui.min.js"></script>
  <script src="lib/editor/ckeditor/ckeditor.js"></script>
  <script>
  
  
  function checkMasterTagValue()
  {
	  
	 var myarray=$(".tag_idsVal").val();
	 
	
	if(jQuery.inArray("1", myarray))
	{
		
		$(".OtherDivs").hide();
		
		
	}
	else
	{
		$(".OtherDivs").show();
				
		
	}
	
	
	  
	 }
  
function add_attr_fields()
{
	var tabname_rows=$("#tabname_1").html();
	var tabqty_rows=$("#tabqty_1").html();
	var opt_data=$(".masterSelection").html();
	
	var max_length=<?=count($this->rs_highlights)-1?>;
  	
	var total_rows=$("#use_rows tr").length;


  if(max_length==total_rows)
  { 
      $.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>You can add max 4 highlights.</p>', {type:'danger',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
  }
  else
  {
    	var row_id=parseInt(total_rows)+1;
    	var html_table_row='<tr id="row_'+row_id+'">';
    	html_table_row+='<input type="hidden" name="table_id[]" value="0">';
    	
    	html_table_row+='<td> <select class="span12 form-control"  id="final_price_p_'+row_id+'" name="final_price_p[]">'+opt_data+'</select></td>';
    	html_table_row+='<td> <input type="text"id="points_p_'+row_id+'" name="points_p[]" class="form-control span12"  /> </td>';
    	html_table_row+='<td> <a class="btn btn-sm btn-danger" href="javascript:remove_user_row('+row_id+')"> <i class="icon-remove"></i>  <strong>X</strong> </a></td>';
    	html_table_row+='</tr>';
    	$('#use_rows tr:last').after(html_table_row);
    	  jQuery(document).ready(function($) {
    	});
    	$("input.numbers").keypress(function(event) {
      return /\d/.test(String.fromCharCode(event.keyCode));
    });
    	 $('.numbersOnly').keyup(function ()
    {
        if (this.value != this.value.replace(/[^0-9\.]/g, ''))
    	{
           this.value = this.value.replace(/[^0-9\.]/g, '');
        }
    });
    	 remove_error_class();

  }
}
function remove_user_row(del_id)
	{
	var row_id="row_"+del_id;
	$("#"+row_id).remove();
	get_total();
    }
	function remove_user_row1(del_id)
	{
	var row_id="row_"+del_id;
	$("#"+row_id).remove();
	 get_total();
    }
	
	
	
	$(document).on("click",".record_delete_attribute_onclick", function ()
{
	var getid=$(this).data('id');
	if(getid!='')
	{
		 swal({
                title: "Are you sure?",
                text: "You will not be able to undo after this action!",
                type: "warning",
                showCancelButton: true,
				cancelButtonClass: 'btn-primary',
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Yes, delete it!",
				confirmButtonClass: "confirm btn btn-lg btn-warning xyz",
                closeOnConfirm: true
            }, function (r)
			{
				if(r == true)
				{
					$.ajax({
						  type: "POST",
						  dataType: 'json',
						  url: "scripts/ajax/index.php",
						  data: "method=project&actionType=projectHighlightsDelete&getid="+getid,
						  success: function(responseData)
						  {
								  if(responseData.RESULT==0)
								  {
									$(".rowd_"+getid).remove();
									$.bootstrapGrowl('<h4><strong>Notification</strong></h4> <p>Record Deleted Successfully.</p>', {type:'warning',delay: 3000,allow_dismiss: true,offset: {from: 'top', amount: 20} });
									  
 									return false;
								  }
								  else
								  {
									  swal({ title: "Try Again...",
									  text: data.msg,
									  type: "warning",
									   timer: 1000
									  });
									  return false;
								  }
							  }
						  });
				}
				else
				{
					return false;
				}
            });
	}
	else
	{
		swal({ title: "Try Again...",
                text: "Oops Something gone wrong...",
                type: "warning",
				 timer: 1500
            });
			return false;
	}
});
  </script>


  <script type="text/javascript">
    //select 2 reload
  $(".select2").select2();
  
  
   // $(".select3").select2();
	
	
	
	
  $('.select3').select2({
    placeholder: 'select a value',
    width: '100%'
  });

  //set select order
  $(".select3").on("select2:select", function(evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });

  //Drap and drop
  $.fn.extend({
    select2_sortable: function() {
      var select = $(this);
      var ul = $(select).next(".select2-container").first("ul.select2-selection__rendered");
      ul.sortable({
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        items: "li:not(.select2-search__field)",
        tolerance: "pointer",
        stop: function() {
          $($(ul).find(".select2-selection__choice").get().reverse()).each(function() {
            var title = $(this).attr("title");
            var option = $(select).find("option:contains(" + title + ")");
            $(select).prepend(option);
          });
        }
      });
    }
  });

  $(".select3").each(function() {
    $(this).select2_sortable();
  });



  </script>