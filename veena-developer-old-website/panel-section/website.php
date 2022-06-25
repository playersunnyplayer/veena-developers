<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
  if (isset($_GET["mode"]))
  {
      if ($_GET["mode"] == "delete_item")
      {
          $item_id = $_GET["item_id"];
          $page = $_GET["page"];
          $Query = "delete from msp_website where websiteid = '$item_id'";
          $Website->dbquery($Query);
          
          header("Location: website.php?action=remove");
          exit();
      }
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
<title><?=$AdminLoggedUserSitename;?> - admin</title>
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
          <h2>Ongoing Projects </h2>
          <ol class="breadcrumb">
            <li> <a href="index.php">Home</a> </li>
            <li> <a><?=$sitename;?></a> </li>
            <li class="active"> <strong>Ongoing Projects</strong> </li>
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
                <h5>Ongoing Projects Manegments</h5>
                <div class="ibox-tools" > <a class="btn aqua btn-xs" href="#" onclick="window.location='add_website.php'" >Add new Ongoing Project</a> </div>
              </div>
            
              <div class="ibox-content collapse in">
                <div class="widgets-container">
                  
                    <table id="example6" class="display nowrap table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="10%">Logo</th>
                          <th width="10%">Image</th>
                          <th>Sitename</th>
                          <th width="20%">Location</th>  
                          <th width="10%">Mobile</th>
                            <th>Type</th>
                          <th width="10%">Status</th>
                           <th width="10%">Show</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th>Sitename</th>
                          <th>Location</th>
                          <th>Mobile</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Show</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody  id="showdata">
                     
                      <?php
                      $WebsiteNum = $Website->GetWebsiteNum();
                      $WebsiteRes = $Website->GetWebsiteRes();
                      
                      if ($WebsiteNum > 0)
                      {
                        while ($WebsiteData = $Website->dbfetch($WebsiteRes))
                        {
                          $WebsiteID = $WebsiteData["websiteid"];
                          $WebsiteName = $WebsiteData["website_sitename"];
                          $WebsiteLogo = $WebsiteData["website_sitelogo"];
                          $WebsiteImage = $WebsiteData["website_image"];
                          $WebsiteMobile = $WebsiteData["website_mobile"];
                          $WebsitePhone = $WebsiteData["website_phone"];
                          $WebsiteLocationID = $WebsiteData["website_location_id"];
                          $WebsiteAddress = $WebsiteData["website_address"];
                          $Websiteshort_Address = $WebsiteData["website_short_address"];
                          $WebsiteColor = $WebsiteData["website_sitecolor"];
                          $WebsiteStatus = $WebsiteData["website_status"];
                          $type = $WebsiteData["website_type_id"];
                          $show = $WebsiteData["website_show_project"];

                          $LocationData = $CMS->GetPageInfoDetails("msp_location", "locationid", $WebsiteLocationID);
                          $LocationTitle = $LocationData['msp_title'];
                          if($type=='1'){$wtype='Residential';}else{$wtype='Commercial';}
                        ?>
                        <tr>
                          <td><a href="index_project.php?wb=<?=$WebsiteID;?>" target="_blank"><img src="../images/sitelogo_images/<?=$WebsiteLogo;?>"></a></td>
                          <td><a href="index_project.php?wb=<?=$WebsiteID;?>" target="_blank"><img src="../images/sitelogo_images/project/<?=$WebsiteImage;?> " width="100%"></a></td>
                          <td><?=$WebsiteName;?></td>
                          <td><?=$LocationTitle;?> <Br> <Br><?=$Websiteshort_Address;?></td>
                          <td><?=$WebsiteMobile;?></td>
                          <td><?=$wtype;?></td>
                          <td style="background-color: <?=$WebsiteColor;?>;"><?=$WebsiteStatus;?></td>
                          <td><?=$show;?></td>
                       
                          <td class="project-actions">
                          <a class="green btn btn-outline btn-xs" href="edit_website.php?WebsiteID=<?=$WebsiteID;?>" data-toggle="modal" ><i class="fa fa-pencil"></i> Edit </a> 
                          <a class="red btn btn-outline btn-xs" href="#" onClick="javascript:DeleteItem('<?=$WebsiteID;?>', 'website', '<?=$page;?>');"  ><i class="fa fa-trash-o"></i> Delete </a> </td>
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
