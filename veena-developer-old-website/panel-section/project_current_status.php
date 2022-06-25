<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'sessions_file_project.php';

 if (isset($_GET["mode"]))
 {
   if ($_GET["mode"] == "delete_item")
   {
      
    $wb = $_GET["wb"];
    $item_id = $_GET["item_id"];
    $page = $_GET["page"];
    $Query = "delete from msp_project_current_status where project_current_statusid = '$item_id'";
    $ProjectCurrentStatus->dbquery($Query);
    
    header("Location: project_current_status.php?wb=$wb&action=remove");
    exit();
   }
 }
 



?>

<!DOCTYPE html>

<html lang="en">



<? include 'includes-class/files/head_file.php';?>

<body class="page-header-fixed ">
  <? include 'header_file_msp_project.php';?>
<div class="clearfix"> </div>

<div class="page-container">
 <!-- Start page sidebar wrapper -->
 <? include 'sidebar_file_msp_project.php'; ?>
 <!-- End page sidebar wrapper -->
 <!-- Start page content wrapper -->
 <div class="page-content-wrapper animated fadeInRight">
   <div class="page-content" >
     <div class="row wrapper border-bottom page-heading">
       <div class="col-lg-12">
         <h2> Current Status </h2>
         <ol class="breadcrumb">
           <li> <a href="index.php">Home</a> </li>
           <li> <a><?=$AdminLoggedUserSitename;?></a> </li>
           <li> <a><?=$SessionWebsiteName;?></a> </li>
           <li class="active"> <strong>Current Status</strong> </li>
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
               <h5>Current Status Manegments</h5>
               <div class="ibox-tools" ><b>Title: </b> <?
              $TableName ="msp_project_current_status_title";
               $PageInfo = $CMS->GetWebPageInfo($TableName, $SessionWebsiteID);
               echo $title = $PageInfo["title"];
               ?>

                <a class="btn aqua btn-xs" href="#" onclick="window.location='project_current_status_title.php?wb=<?=$SessionWebsiteID;?>'" >Edit Title</a> <a class="btn aqua btn-xs" href="#" onclick="window.location='add_project_current_status.php?wb=<?=$SessionWebsiteID;?>'" >Add New Current Status</a> </div>
             </div>
           
             <div class="ibox-content collapse in">
               <div class="widgets-container">


                 
                   <table id="example6" class="display nowrap table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                     <thead>
                       <tr>
                         <th width="15%">Image</th>
                         <th>Title</th>
                         <th width="10%">Date</th>
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
                    
                     <?
                     $ProjectCurrentStatusNum = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteNum($SessionWebsiteID);
                     $ProjectCurrentStatusRes = $ProjectCurrentStatus->GetProjectCurrentStatusByWebsiteRes($SessionWebsiteID);
                     
                     if ($ProjectCurrentStatusNum > 0)
                     {
                       while ($ProjectCurrentStatusData = $ProjectCurrentStatus->dbfetch($ProjectCurrentStatusRes))
                       {
                         $ProjectCurrentStatusID = $ProjectCurrentStatusData["project_current_statusid"];
                         $ProjectCurrentStatusTitle = $ProjectCurrentStatusData["msp_title"];
                         $ProjectCurrentStatusImages = $ProjectCurrentStatusData["msp_image"];
                         $ProjectCurrentStatusImages2 = $ProjectCurrentStatusData["msp_image2"];
                         $ProjectCurrentStatusmonth_year = $ProjectCurrentStatusData["msp_month_year"];
                         $ProjectCurrentStatusStatus = $ProjectCurrentStatusData["msp_status"];
                       ?>
                       <tr>
                         <td><img src="../images/current_status_images/resize/<?=$ProjectCurrentStatusImages2;?>" width="100%"></td>
                         <td><?=$ProjectCurrentStatusTitle;?></td>
                         <td><?=$ProjectCurrentStatusmonth_year;?></td>
                         <td><?=$ProjectCurrentStatusStatus;?></td>
                         <td class="project-actions">
                         <a class="green btn btn-outline btn-xs" href="edit_project_current_status.php?wb=<?=$SessionWebsiteID;?>&ProjectCurrentStatusID=<?=$ProjectCurrentStatusID;?>" data-toggle="modal" ><i class="fa fa-pencil"></i> Edit </a> 
                         <a class="red btn btn-outline btn-xs" href="#" onClick="javascript:DeleteParentImage('<?=$ProjectCurrentStatusID;?>', 'project_current_status', '<?=$SessionWebsiteID;?>');"  ><i class="fa fa-trash-o"></i> Delete </a> </td>
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

</div><!-- Go top -->

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
                      // Advanced
           $('#example7').DataTable({
               dom: 'Bfrtip',
               buttons: [{
                   text: 'copy',
                   extend: "copy",
                   className: 'btn dark btn-outline'
               }, {
                   text: 'csv',
                   extend: "csv",
                   className: 'btn aqua btn-outline'
               }, {
                   text: 'excel',
                   extend: "excel",
                   className: 'btn aqua btn-outline'
               }, {
                   text: 'pdf',
                   extend: "pdf",
                   className: 'btn yellow  btn-outline'
               }, {
                   text: 'print',
                   extend: "print",
                   className: 'btn purple  btn-outline'
               }]
           });
                  });
   </script>


  
  </body>

</html>

