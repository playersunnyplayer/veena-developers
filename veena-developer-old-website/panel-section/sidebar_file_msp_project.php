 <div class="page-sidebar-wrapper">

            <div class="page-sidebar">

                <ul class="page-sidebar-menu  page-header-fixed ">

                    <li class="sidebar-search-wrapper">

                        <!-- START RESPONSIVE SEARCH FORM -->

                        <form class="sidebar-search  " action="#" method="POST">

                            <a href="javascript:;" class="remove"> <i class="icon-close"></i> </a>

                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="Search...">

                                <span class="input-group-btn"> <a href="javascript:;" class="btn submit"> <i class="icon-magnifier"></i> </a> </span> </div>

                        </form>

                        <!-- END RESPONSIVE SEARCH FORM -->

                    </li>

                   

                    <li class="nav-item">
                        <a class="nav-link" href="index.php"> <i class="fa fa-th-large"></i> <span class="title">Dashboard</span> </a>
                    </li>

                    <li class="heading">

                        <h3 class="uppercase">Website</h3>

                    </li>

                   
                    <li class="nav-item">
                        <a class="nav-link" href="project_slider.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-picture-o"></i> <span class="title">Slider</span> </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="project_about_us.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-user"></i> <span class="title">Overview</span> </a>
                    </li>

                    <? if($SessionWebsiteTypeID==1){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="project_amenities.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-user-o"></i> <span class="title">Amenities</span> </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="icon-layers"></i> <span class="title">Gallery</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="project_gallery.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Gallery</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_video.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Video</span> </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="project_plan.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-picture-o"></i> <span class="title">Plan</span> </a>
                    </li>
                   
                   
                    <!-- <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="icon-layers"></i> <span class="title">Location</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="project_location_advantage.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Location Advantage</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_site_address.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Site Address</span> </a></li>
                        </ul>
                    </li> -->
                    
                    <li class="nav-item">
                        <a class="nav-link" href="project_current_status.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-picture-o"></i> <span class="title">Current Status</span> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="project_walkthrough.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-picture-o"></i> <span class="title">Walkthrough</span> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="project_download.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-download"></i> <span class="title">Download</span> </a>
                    </li>
                    <? }else{
                    	?>
                    	<li class="nav-item">
	                        <a class="nav-link" href="project_highlights.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-user"></i> <span class="title">Project Highlights</span> </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="project_area.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-user"></i> <span class="title">Project Area</span> </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="project_brands_associated.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-user"></i> <span class="title">Brands Presence</span> </a>
	                    </li>
                    	<?
                    } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="project_site_address.php?wb=<?=$SessionWebsiteID;?>"> <i class="fa fa-map"></i> <span class="title">Location</span> </a>
                    </li>

                    <li class="nav-item hidden">

                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="icon-layers"></i> <span class="title">CMS Page</span> <span class="arrow"></span> </a>

                        <ul class="sub-menu">

                            <li class="nav-item"> <a class="nav-link" href="project_home.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Home</span> </a></li>

                            <li class="nav-item"> <a class="nav-link" href="project_amenities_contents.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Amenities Home page</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_disclaimer.php?wb=<?=$SessionWebsiteID;?>"> <span class="title">Disclaimer</span> </a></li>

                            

                        </ul>

                    </li>

                    

                   

                </ul>

            </div>

        </div>