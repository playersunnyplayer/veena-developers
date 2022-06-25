

<script>

    setTimeout(function(){jQuery(MessageID).fadeOut()},4000);

    </script>

<div class="page-header navbar navbar-fixed-top">

        <!-- BEGIN HEADER INNER -->

        <div class="page-header-inner ">

            <!-- BEGIN LOGO -->

            <div class="page-logo">

                <a href="index.php"> <img class="logo-default" alt="logo" src="../images/sitelogo_images/<?=$SessionWebsiteLogo;?>"> </a>

            </div>

            <div class="library-menu"> <span class="one">-</span> <span class="two">-</span> <span class="three">-</span> </div><div class="top-nev-mobile-togal"><i class="glyphicon glyphicon-cog"></i></div>

            <!-- END LOGO -->

            <div class="top-menu">

<!--  TOP NAVIGATION MENU -->

                <div class="hor-menu  hor-menu-light hidden-sm hidden-xs">

                    <ul class="nav navbar-nav">

                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->

                        <li class="classic-menu-dropdown active"> <a href="index_project.php?wb=<?=$SessionWebsiteID;?>"><i class="icon-home fa-fw"></i></a> </li>
                        <li class="classic-menu-dropdown"> <a href="index_project.php?wb=<?=$SessionWebsiteID;?>"><?=$SessionWebsiteName;?></a>  </li>





                       

                    </ul>



                    

                </div>

                <!--  TOP NAVIGATION MENU -->

               

                <ul class="nav navbar-nav pull-right">

                   

                    <!-- START USER LOGIN DROPDOWN -->

                    <li class="dropdown dropdown-user">

                        <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"> <img src="assets/images/teem/a10.jpg" class="img-circle" alt=""> <span class="username username-hide-on-mobile"> <?=$AdminLoggedUserFullName;?></span> <i class="fa fa-angle-down"></i> </a>

                        <ul class="dropdown-menu dropdown-menu-default">

                            <li>

                                <a href="admin_setting_file.php"> <i class="fa fa-cog fa-spin "></i> My Profile </a>



                            </li>

                            <li><a href="change_password.php"> <i class="icon-user"></i> Change Password </a></li>

                            <li><a href="upload_logo.php"> <i class="icon-user"></i> Upload Logo </a></li>

                            

                            <li class="divider"> </li>

                            

                            <li>

                                <a href="logout.php"> <i class="icon-key"></i> Log Out </a>

                            </li>

                        </ul>

                    </li>

                    <!-- END USER LOGIN DROPDOWN -->

                </ul>

            </div>

            <!-- END TOP NAVIGATION MENU -->

        </div>

        <!-- END HEADER INNER -->

    </div>