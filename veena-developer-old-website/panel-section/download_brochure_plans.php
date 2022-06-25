<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
 $con=mysqli_connect('127.0.0.1','veena3oh_dbuser','igD*]e!vYC{y','veena3oh_demo')or die('can\'t establish connection with mysqli servver');
            $mySelectDB=mysqli_select_db($con,'veena3oh_demo') or die('could not connect to the database');

	
	
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
          <h2> Project </h2>
          <ol class="breadcrumb">
            <li> <a href="index.php">Home</a> </li>
            <li> <a><?=$sitename;?></a> </li>
            <li class="active"> <strong> Download Brochure + Floor Plans Form</strong> </li>
          </ol>
        </div>
      </div>
      <div class="wrapper-content ">
        
        <div class="row">
          <div class="col-lg-12">
          
            
            <div class="ibox float-e-margins">
            <div id="showpopup"></div>
              <div class="ibox-title">
                <h5>Forms</h5>
            <div class="ibox-tools" > <div class="btn">
            <form method="post" action="export4.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
        </div> </div>
              </div>
            
              <div class="ibox-content collapse in">
                <div class="widgets-container">
                  
                    <table id="example6" class="display nowrap table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th width="10%">Project Name</th>
                          <th width="10%">Name</th>
                          
                          <th width="15%">E-mail</th>
                          <th width="10%">Phone</th>
                          <th width="10%">Download Project</th>
                          <th width="10%">Date</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>Project Name</th>
                          <th>Name</th>
                          <th>E-mail</th>
                          <th>Phone</th>
                          <th>Download Project</th>
                          <th>Date</th>
                        </tr>
                      </tfoot>
                      <tbody  id="showdata">
                     
                      <?php
                      
                      $result = mysqli_query($con,"SELECT * FROM msp_enquiry_download ORDER BY enquiryDate DESC");

while ($row = mysqli_fetch_array($result)) {
    

                                                      ?>
                        <tr>
                          <td><?=$row[1];?></td>
                          <td><?=$row[3];?></td>
                          <td><?=$row[5];?></td>
                          <td><?=$row[4];?></td>
                          <td><?=$row[2];?></td>
                          <td><?=$row[6];?></td>
                        </tr>
                        <?php
}    
                       
                        
                        
                        ?>
                        
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
           
            // Advanced
           
        });
    </script>
   
  </body>
</html>
