<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
  if (isset($_GET["mode"]))
  {
      if ($_GET["mode"] == "delete_item")
      {
          $item_id = $_GET["item_id"];
          $page = $_GET["page"];
          $Query = "delete from msp_award where awardid = '$item_id'";
          $Award->dbquery($Query);
          
          header("Location: award.php?action=remove");
          exit();
      }
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
<? include 'includes-class/files/head_file.php';?>
<body class="page-header-fixed ">
  <? include 'header_file_msp.php';?>
<div class="clearfix"> </div>
<div class="page-container">
  <!-- Start page sidebar wrapper -->
  <? include 'sidebar_file_msp.php'; ?>
  <!-- End page sidebar wrapper -->
  <!-- Start page content wrapper -->
  <div class="page-content-wrapper animated fadeInRight">
    <div class="page-content" >
      <div class="row wrapper border-bottom page-heading">
        <div class="col-lg-12">
          <h2> Award </h2>
          <ol class="breadcrumb">
            <li> <a href="index.php">Home</a> </li>
            <li> <a><?=$sitename;?></a> </li>
            <li class="active"> <strong>Award</strong> </li>
          </ol>
        </div>
      </div>
      <div class="wrapper-content ">
        
        <div class="row">
          <div class="col-lg-12">
          
            <?php
            if ($_GET["action"] == "add") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully added details.
            </div>
            <?php
            }
      if ($_GET["action"] == "update") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully updated details.
            </div>
            <?php
            }
      if ($_GET["action"] == "remove") {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully removed details.
            </div>
            <?php
            }
            ?>
            <div class="ibox float-e-margins">
            <div id="showpopup"></div>
              <div class="ibox-title">
                <h5>Award Manegments</h5>
                <div class="ibox-tools" > <a class="btn aqua btn-xs" href="#" onclick="window.location='add_award.php'" >Add new award</a> </div>
              </div>
            
              <div class="ibox-content collapse in">
                <div class="widgets-container">
                  
                    <table id="example6" class="display nowrap table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="10%">Image</th>
                          <th>Title</th>
                          <th width="10%">Status</th>
                          <th width="15%">Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th>Title</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody  id="showdata">
                     
                      <?php
                      $AwardNum = $Award->GetAwardNum();
                      $AwardRes = $Award->GetAwardRes();
                      
                      if ($AwardNum > 0)
                      {
                        while ($AwardData = $Award->dbfetch($AwardRes))
                        {
                          $AwardID = $AwardData["awardid"];
                          $AwardTitle = $AwardData["msp_title"];
                          $AwardImages = $AwardData["msp_image"];
                          $AwardImages2 = $AwardData["msp_image2"];
                          $AwardStatus = $AwardData["msp_status"];
                        ?>
                        <tr>
                          <td><img src="../images/award_images/resize/<?=$AwardImages2;?>" width="100%"></td>
                          <td><?=$AwardTitle;?></td>
                          <td><?=$AwardStatus;?></td>
                          <td class="project-actions">
                          <a class="green btn btn-outline btn-xs" href="edit_award.php?AwardID=<?=$AwardID;?>" data-toggle="modal" ><i class="fa fa-pencil"></i> Edit </a> 
                          <a class="red btn btn-outline btn-xs" href="#" onClick="javascript:DeleteItem('<?=$AwardID;?>', 'award', '<?=$page;?>');"  ><i class="fa fa-trash-o"></i> Delete </a> </td>
                        </tr>
                        <? }
                        } ?>
                        
                      </tbody>
                    </table>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
      <!-- start footer -->
        <? include 'footer_file_msp.php';?>
        </div>
    </div>
  </div>
<!-- Go top -->
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<!-- Go top -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<? include 'includes-class/files/foot_file.php';?>
<script>
        var dataSet = [
        ];
        $(document).ready(function() {
           
            // Individual column searching
            // Setup - add a text input to each footer cell
            $('#example6 tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input class="form-control dataSearch" type="text" placeholder="Search ' + title + '" />');
            });
            // DataTable
            var table = $('#example6').DataTable();
            // Apply the search
            table.columns().every(function() {
                var that = this;
                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
           
        });
    </script>
   
  </body>
</html>
