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

                        <h3 class="uppercase">Projects</h3>

                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-building"></i> <span class="title">Projects</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="website.php"> <span class="title">Ongoing Projects</span> <span class="badge badge-danger"><?=$Website->GetWebsiteNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="project.php"> <span class="title">Complete/Ongoing Projects</span> <span class="badge badge-danger"><?=$Project->GetProjectNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_type.php"> <span class="title">Project Type</span> <span class="badge badge-danger"><?=$CMS->GetProjectTypeNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_typology.php"> <span class="title">Typology</span> <span class="badge badge-danger"><?=$CMS->GetProjectTypologyNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="city.php"> <span class="title">City</span> <span class="badge badge-danger"><?=$CMS->GetCityNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="location.php"> <span class="title">Location</span> <span class="badge badge-danger"><?=$CMS->GetLocationNum(); ?></span></a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_heading.php"> <span class="title">Heading Text</span> </a></li>
                        </ul>
                    </li>
                   
                    </li>

                    
                    <li class="heading">

                        <h3 class="uppercase">CMS</h3>

                    </li>

                    

                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-picture-o"></i> <span class="title">Slider</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="slider.php"> <span class="title">Slider</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="add_slider.php"> <span class="title">Add Slider</span> </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-diamond"></i> <span class="title">About Us</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="about_us.php"> <span class="title">About Us</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="team.php"> <span class="title">Team</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="journey_of_years.php"> <span class="title">Journey of Years</span> </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-diamond"></i> <span class="title">News Room</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="event.php"> <span class="title">Event</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="press_releases.php"> <span class="title">Press Releases</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="media_appearance.php"> <span class="title">Media Appearance</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="award.php"> <span class="title">Award</span> </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="partner_with_us.php"> <i class="fa fa-graduation-cap"></i> <span class="title">Partner With Us</span> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-diamond"></i> <span class="title">CSR</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="csr.php"> <span class="title">CSR</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="csr_gallery.php"> <span class="title">CSR Gallery</span> </a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="careers.php"> <i class="fa fa-graduation-cap"></i> <span class="title">Careers</span> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-diamond"></i> <span class="title">Buyers Guide</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="buyers_guide_contents.php"> <span class="title">Buyers Guide Contents</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="buyers_guide.php"> <span class="title">Buyers Guide</span> </a></li>
                            
                        </ul>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="icon-layers"></i> <span class="title">CMS Page</span> <span class="arrow"></span> </a>

                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="home.php"> <span class="title">Home</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="contact_us.php"> <span class="title">Contact Us</span> </a></li>
                        </ul>

                    </li>

                     <li class="nav-item">

                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-wpforms"></i> <span class="title">Enquiry Form</span> <span class="arrow"></span> </a>

                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="schedule_visit.php"> <span class="title">Schedule a Visit</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="quick_enqiry.php"> <span class="title">Quick Enquiry</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="project_enquiry_form.php"> <span class="title">Project Inquiry form </span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="download_brochure_plans.php"> <span class="title">Download Brochure and Floor Plans Form</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="career_form.php"> <span class="title">Career Form</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="partner_form.php"> <span class="title">Partner Form</span> </a></li>
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;"> <i class="fa fa-pencil"></i> <span class="title">Testimonial</span><span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="testimonial.php"> <span class="title">Testimonial</span> </a></li>
                            <li class="nav-item"> <a class="nav-link" href="add_testimonial.php"> <span class="title">Add Testimonial</span> </a></li>
                          
                        </ul>
                    </li>
                   

                </ul>

            </div>

        </div>