<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
 $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqlii servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');

$PageName = "project_heading";
$TableName = "msp_project_heading";
$TableIDName = "typeid";
$PageTitle = "Project Heading";


  if (isset($_GET["did"]))
  {
     
          $item_id = $_GET["did"];
          $Query = "DELETE FROM `msp_project_heading` where  heading_id = '$item_id'";
          $abc=mysqli_query($con,$Query);
          if($abc){
          header("Location: project_heading.php?action=remove&tid=$item_id");
          }
         else{
            header("Location: project_heading.php?action=prb&tid=$item_id");  
         }
      
  }
    if(isset($_GET["action"])){$msg=$_GET["action"];}
  
  ?>
<!DOCTYPE html>
<html lang="en">
<title>Admin - <?=$AdminLoggedUserSitename;?></title>
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
          <h2> <?=$PageTitle;?> </h2>
          <ol class="breadcrumb">
            <li> <a href="index.php">Home</a> </li>
            <li> <a><?=$sitename;?></a> </li>
            <li class="active"> <strong><?=$PageTitle;?></strong> </li>
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
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Successfully removed details.
            </div>
            <?php
            }
            ?>
            <div class="ibox float-e-margins">
            <div id="showpopup"></div>
              <div class="ibox-title">
                <h5><?=$PageTitle;?> Manegments</h5>
                <div class="ibox-tools" > <a class="btn aqua btn-xs" href="#" onclick="window.location='add_<?=$PageName;?>.php'" >Add new <?=$PageTitle;?></a> </div>
              </div>
            
              <div class="ibox-content collapse in">
                <div class="widgets-container">
                  
                    <table id="example6" class="display nowrap table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th >Heading</th>
                          <th>Project Type</th>
                          <th >Heading Type</th>  
                          <th >Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                   
                      <tbody  id="showdata">
                     
                      <?php
                      $i=0;
                     $qry=mysqli_query($con,"SELECT * FROM `msp_project_heading` order by heading_id  desc");
                      $numrows=mysqli_num_rows($qry);
                      if ($numrows > 0)
                      {
                        while ($fetch=mysqli_fetch_row($qry))
                        {
                    $i++;
                    $tid=$fetch[0];
                    $position=90; 

                    $message=$fetch[3];
                    $post = substr($message, 0, $position);
                    $ptyp=$fetch[1];if($ptyp=='1'){$p_type='Residential';}else{$p_type='Commercial';}
                    $htype=$fetch[2];if($htype=='1'){$h_type='Ongoing';}if($htype=='2'){$h_type='Upcoming';}if($htype=='3'){$h_type='Completed';}
                    
                    ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$post?></td>
                           <td><?=$p_type;?></td>
                           <td><?=$h_type;?></td>
                        <td><?=$fetch[4]?></td>
                          <td class="project-actions">
                          <a class="green btn btn-outline btn-xs" href="edit_project_heading.php?eid=<?=$tid;?>" data-toggle="modal" ><i class="fa fa-pencil"></i> Edit </a> 
                          <a class="red btn btn-outline btn-xs" href="project_heading.php?did=<?= $tid ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')">
                          <i class="fa fa-trash-o"></i> Delete </a> </td>
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
