<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';
include 'resize.php';

$PageName = "csr_gallery";
$TableName = "msp_csr_gallery";
$TableIDName = "csr_galleryid";
$PageTitle = "CSR Gallery";

if (isset($_POST["mode"]))
{
  if($_POST["mode"]=='add')
  {
    
    $title = prepare_input($_POST["title"]);
    $video_code = prepare_input($_POST["video_code"]);
    $status = prepare_input($_POST["status"]);

    

    $image = $_FILES['image']['name'];
    if ($image)
    {
        $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        
        if ($extension != "jpg" AND $extension != "gif" AND $extension != "png")
        {
            $action = "extension";
        }
        else
        {           
          $directoryName = '../images/'.$PageName.'_images/';
          if(!is_dir($directoryName)){ //Check if the directory already exists.
              mkdir($directoryName, 0755, true); //Directory does not exist, so lets create it.
          }   

          $filetitle = _prepare_url_text($title);
          $filetitle = strtolower($filetitle);
          $filetitle = substr($filetitle, 0, 80);

          $size=filesize($_FILES['image']['tmp_name']);   
          $image_name=time().'.'.$extension;
          $upload_path = $directoryName;
          $imagename = $filetitle."-".$image_name;
          $copied = copy($_FILES['image']['tmp_name'], $upload_path.$imagename);
          
          $image_name =  $directoryName."".$imagename; 
          $size = getimagesize($image_name);
          $height = $size[1];
          $width = $size[0];
      
          if ($width > 800)
          {
              $image = new SimpleImage();
              $image->load($image_name);
              $image->resizeToWidth(800);
              $image->save($image_name);
          }

          // resize/
          $directoryName2 = '../images/'.$PageName.'_images/resize/';
          if(!is_dir($directoryName2)){ //Check if the directory already exists.
              mkdir($directoryName2, 0755, true); //Directory does not exist, so lets create it.
          }   
          
          $size=filesize($_FILES['image']['tmp_name']);   
          $image_name2=time().'.'.$extension;
          $upload_path2 = $directoryName2;
          $imagename2 = $filetitle."-resize-".$image_name2;
          $copied = copy($_FILES['image']['tmp_name'], $upload_path2.$imagename2);
          
          $image_name2 =  $directoryName2."".$imagename2; 
          $size = getimagesize($image_name2);
          $height = $size[1];
          $width = $size[0];
      
          if ($width > 300)
          {
              $image = new SimpleImage();
              $image->load($image_name2);
              $image->resizeToWidth(300);
              $image->save($image_name2);
          }
          
          
        }
    }
    else
    {
        $action = "empty";
    }

    $sqlQueryAdd = "INSERT INTO `$TableName` (`msp_title`,`msp_image`,`msp_image2`,`msp_status`)VALUES ('$title','$imagename','$imagename2','$status')";

    $sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ");
    header("Location: $PageName.php?action=add");
    exit();
       
  }
}
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
<? include 'sidebar_file_msp.php';?>
<!-- End page sidebar wrapper -->
<!-- Start page content wrapper -->
<div class="page-content-wrapper animated fadeInRight">
  <div class="page-content" >
    <div class="row wrapper border-bottom page-heading">
      <div class="col-lg-12">
        <h2> Add <?=$PageTitle;?> </h2>
        <ol class="breadcrumb">
          <li> <a href="index.php">Home</a> </li>
          <li class="active"> <strong> Add <?=$PageTitle;?>  </strong> </li>
        </ol>
      </div>
    </div>
      
          <div class="ibox float-e-margins">
            <div class="widgets-container">
              
              <form id="<?=$PageName;?>Form" name="<?=$PageName;?>Form" method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']; ?>">
              <input name="mode" id="mode" value="add" type="hidden">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  name="title" id="title" value="<?=$title;?>" placeholder="Title" required  type="text">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="image">Upload Image </label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*" >
                        <label for=""><b>Image size : </b>800px / 700px</label>
                  </div>
                </div>
               
              </div>
               
             
                <hr>
                <button type="submit" class="btn aqua m-t-xs bottom15-xs">Submit</button>
                <button type="button" class="btn aqua m-t-xs bottom15-xs" onclick="window.location='<?=$PageName;?>.php'">Cancel</button>
              </form>
            </div>
          </div>
    
          <!-- start footer -->
<?  include 'footer_file_msp.php'; ?>
  </div>
</div>
<!-- Go top -->
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<!-- Go top -->
<? include 'includes-class/files/foot_file.php';?>
</body>
</html>
