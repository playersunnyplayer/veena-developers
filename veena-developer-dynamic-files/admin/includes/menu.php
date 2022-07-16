<style>
.aside-body 
{
    height: calc(100%) !important;
}
.content.ht-100v.pd-0
{
	height: auto !important;
}
</style>
<aside class="aside aside-fixed">
  <div class="aside-header" style="display:none"> <a href="index.php" class="aside-logo">
   
    </a> <a href="" class="aside-menu-link"> <i data-feather="menu"></i> <i data-feather="x"></i> </a> </div>
  <div class="aside-body">
    <div class="aside-loggedin">
      <div class="d-flex align-items-center justify-content-start"> <a href="" class="avatar"><img src="../images/short_icon.png" class="rounded-circle" alt=""></a>
        <div class="aside-alert-link"> <a style="display:none" onclick="userLogout()" class="userLogout"><i data-feather="log-out"></i></a> 
          <!--<a onclick="userLogout()" data-toggle="tooltip" title="Sign out" class="userLogout"><i data-feather="log-out"></i></a>-->
        </div>
      </div>
      <div class="aside-loggedin-user"> <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
        <h6 class="tx-semibold mg-b-0">
          <?=$_SESSION['adminName'];?>
        </h6>
        <i data-feather="chevron-down"></i> </a>
        <p class="tx-color-03 tx-12 mg-b-0">Administrator</p>
      </div>
      <div class="collapse" id="loggedinMenu">
        <ul class="nav nav-aside mg-b-0">
          <li class="nav-item"><a href="index.php?view=account_setting" class="nav-link"><i data-feather="edit"></i> <span>Edit Profile</span></a></li>
          <li style="display:none" class="nav-item"><a onclick="userLogout()" class="nav-link userLogout"><i data-feather="log-out"></i> <span>Sign Out</span></a></li>
        </ul>
      </div>
    </div>
    
    <!-- aside-loggedin -->
    
    <ul class="nav nav-aside sidebar-nav">
      <li class="nav-label">Dashboard</li>
      <li class="nav-item mysub" data-main="home"><a href="index.php?view=home" class="nav-link"><i data-feather="shopping-bag"></i> <span>Dashboard</span></a></li>
      <li class="nav-label mg-t-25">Home</li>
      <li class="nav-item with-sub mysub" data-main="banner_list,testimonial_list,pages,pages_addedit,home_page"> <a href="" class="nav-link"><i data-feather="monitor"></i> <span>Home Page</span></a>
        <ul class="sub_main1">
          <li  data-sub="home_page" class=""><a href="index.php?view=home_page">Content</a></li>
        
          <li data-sub="banner_list" class=""><a href="index.php?view=banner_list">Slider Banners</a></li>
          <li data-sub="testimonial_list" class=""><a href="index.php?view=testimonial_list">Testimonials</a></li>
        </ul>
      </li>
      <li class="nav-label mg-t-25">Projects</li>
      <li class="nav-item with-sub mysub" data-main="category_list,projects_gallery_list,project_list,projects_gallery_category_list,project_addedit,amenities_master_list,highlights_list,project_sort_list,projectmeta_list,projectmeta_addedit"> <a href="" class="nav-link"><i data-feather="layers"></i> <span>Manage Project</span></a>
        <ul class="sub_main1">
          

          <li data-sub="category_list" class=""><a href="index.php?view=category_list">Category</a></li>
          <li data-sub="project_list" class=""><a href="index.php?view=project_list">All Projects</a></li>
          <li data-sub="project_addedit" class=""><a href="index.php?view=project_addedit">Add Project</a></li>
          <li data-sub="highlights_list" class="" ><a href="index.php?view=highlights_list">Highlights</a></li>
          <li data-sub="amenities_master_list" class="" ><a href="index.php?view=amenities_master_list">Amenities</a></li>
          <li data-sub="projects_gallery_category_list" class=""><a href="index.php?view=projects_gallery_category_list">Gallery Categories</a></li>
        
          <li data-sub="project_sort_list" class=""><a href="index.php?view=project_sort_list">Sort Projects</a></li>
         <li data-sub="projectmeta_list" class=""><a href="index.php?view=projectmeta_list">Project Meta</a></li>
        </ul>
      </li>
      <li class="nav-label mg-t-25">Careers</li>
      <li class="nav-item with-sub mysub" data-main="careers_page,careers_jobs,meta,careers_jobs_enquiry,career_jobs_list"> <a href="javascript:void(0)" class="nav-link"><i data-feather="briefcase"></i> <span> Careers Page</span></a>
        <ul class="sub_main1">
          <li  data-sub="careers_page" class=""><a href="index.php?view=careers_page">Content</a></li>
          <li  data-sub="career_jobs_list" class=""><a href="index.php?view=career_jobs_list">Jobs</a></li>
        </ul>
      </li>
      <li class="nav-label mg-t-25">About Us</li>
      <li class="nav-item with-sub mysub" data-main="about_page,team_list,team_addedit"> <a href="javascript:void(0)" class="nav-link"><i data-feather="pie-chart"></i> <span> About Page</span></a>
        <ul class="sub_main1">
          <li  data-sub="about_page" class=""><a href="index.php?view=about_page">Content</a></li>
          <li  data-sub="team_list" class=""><a href="index.php?view=team_list">Team</a></li>
        </ul>
      </li>


       


      <li class="nav-label mg-t-25">CSR</li>
      <li class="nav-item with-sub mysub" data-main="csr_page,csr_category_list,multi_image_upload,csr_category_addedit"> <a href="javascript:void(0)" class="nav-link"><i data-feather="check-square"></i> <span> CSR Page</span></a>
        <ul class="sub_main1">
          <li  data-sub="csr_page" class=""><a href="index.php?view=csr_page">Content</a></li>
          <li  data-sub="csr_category_list" class=""><a href="index.php?view=csr_category_list">CSR Category</a></li>
        </ul>
      </li>
      <li class="nav-label  mg-t-25">Enquiries</li>

      <li class="nav-item with-sub mysub" data-main="contact_enquiry_list,project_enquiry_list,career_enquiry_list"> <a href="javascript:void(0)" class="nav-link"><i data-feather="phone-incoming"></i> <span> Enquiries</span></a>
        <ul class="sub_main1">
          
          <li  data-sub="project_enquiry_list" class=""><a href="index.php?view=project_enquiry_list">Project Enquiry</a></li>
          <li  data-sub="career_enquiry_list" class=""><a href="index.php?view=career_enquiry_list">Jobs Enquiry</a></li>
          <li  data-sub="contact_enquiry_list" class=""><a href="index.php?view=contact_enquiry_list">Quick Enquiry</a></li>
        </ul>
      </li>



      <li class="nav-label mg-t-25">About Veena</li>
      <li class="nav-item with-sub mysub" data-main="common_code,social_settings,general_settings,meta,admin_logins_list,general_settings"> <a href="javascript:void(0)" class="nav-link"><i data-feather="settings"></i> <span> About Veena</span></a>
        <ul class="sub_main1">
          <li  data-sub="social_settings" class=""><a href="index.php?view=social_settings">Social Details</a></li>

          <li  data-sub="general_settings" class=""><a href="index.php?view=general_settings">Company Details</a></li>

          <li  data-sub="common_code" class=""><a href="index.php?view=common_code">Head/Body Code</a></li>
        </ul>
      </li>
      
      
       <li class="nav-label mg-t-25">Pages</li>
      <li class="nav-item mysub" data-main="privacy_page"><a href="index.php?view=privacy_page" class="nav-link"><i data-feather="shopping-bag"></i> <span>Privacy Policy</span></a></li>
       <li class="nav-item mysub" data-main="terms_page"><a href="index.php?view=terms_page" class="nav-link"><i data-feather="shopping-bag"></i> <span>Terms & Conditions</span></a></li>


      <li class="nav-label mg-t-25">Blog</li>
      <li class="nav-item with-sub mysub" data-main="blog_page,blog_list,blog_addedit,blog_category_list,blog_tag_list"> <a href="javascript:void(0)" class="nav-link"><i data-feather="award"></i> <span> Blog Page</span></a>
        <ul class="sub_main1">
          <li  data-sub="blog_page" class=""><a href="index.php?view=blog_page">Content</a></li>
           <li  data-sub="blog_category_list" class=""><a href="index.php?view=blog_category_list">Category</a></li>
           <li  data-sub="blog_tag_list" class=""><a href="index.php?view=blog_tag_list">Tag</a></li>
          <li  data-sub="blog_list" class=""><a href="index.php?view=blog_list">Blog</a></li>
        </ul>
      </li>
      
    </ul>
  </div>
</aside>
