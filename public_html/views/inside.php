<?php

global $controller_name, $action;

$controller_name = strtolower(get_class($this));
$action = $this->action;

function menu($menu_controller)
{
    global $controller_name;
    return $menu_controller == $controller_name ? "open" : "";
}

?>

<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="StokedPlus">
	<meta name="author" content="StokedPlus">

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="shortcut icon" href="/ico/favicon.png">
    
        <script src="/js/jquery-2.1.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/modernizr.js"></script>
        <script src="/js/bootstrap-tour.custom.js"></script>
        <script src="/js/king-common.js"></script>
        <script src="/js/jquery.form.min.js"></script> 
        <script src="/js/global.js"></script>     
        <script src="/js/stat/jquery.easypiechart.min.js"></script>      
        <script src="/js/raphael-2.1.0.min.js"></script>
        <script src="/js/stat/flot/jquery.flot.min.js"></script>
        <script src="/js/stat/flot/jquery.flot.resize.min.js"></script>
        <script src="/js/stat/flot/jquery.flot.time.min.js"></script>
        <script src="/js/stat/flot/jquery.flot.pie.min.js"></script>
        <script src="/js/stat/flot/jquery.flot.tooltip.min.js"></script>   
        <script src="/js/jquery.sparkline.min.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
        <script src="/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/js/jquery.mapael.js"></script>
    </head>

    <body class="dashboard">
        <!-- WRAPPER -->
        <div class="wrapper">
            <!-- TOP BAR -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <!-- logo -->
                        <div class="col-md-2 logo">
                            <a href="/user/dashboard"><img src="/img/logoBW.png" /></a>
                        </div>
                        <!-- end logo -->
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- search box -->
                                    <div id="tour-searchbox" class="input-group searchbox">
                                        <input type="search" class="form-control" placeholder="Search for student, events, and reports">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    <!-- end search box -->
                                </div>
                                <div class="col-md-9">
                                    <div class="top-bar-right">									
                                        <a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
                                        <!-- logged user and the menu -->
                                        <div class="logged-user">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                                    <img class="img-circle" id="nav-profile-picture" src="<?php echo $_SESSION["USER"]['PROFILE_PICTURE_FILENAME'] == null ? "/img/no_profile.jpg" : "/" . $GLOBALS["user_files_path"] . User::getUserID() . "/" .  $_SESSION["USER"]['PROFILE_PICTURE_FILENAME'] ;?>" />
                                                    <span class="name"><?php echo $_SESSION["USER"]["NAME"];?></span> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <span class="text"><a href="/user/show/<?php echo User::getUserID(); ?>">Profile</a></span>
                                                        </a>
                                                    </li>
<!--                                                    <li>
                                                        <a href="#">
                                                            <span class="text"><a href="settings.html">Settings</a></span>
                                                        </a>
                                                    </li>-->
                                                    <li>
                                                        <a href="#">
                                                            <span class="text"><a href="/user/signout">Logout</a></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end logged user and the menu -->
                                    </div><!-- /top-bar-right -->
                                </div>
                            </div><!-- /row -->
                        </div>
                    </div><!-- /row -->
                </div><!-- /container -->
            </div><!-- /top -->


            <!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
            <div class="bottom">
                <div class="container">
                    <div class="row">
                        <!-- left sidebar -->
                        <div class="col-md-2 left-sidebar">
                            <!-- main-nav -->
                            <nav class="main-nav">							
                                <ul class="main-menu">
                                    <?php if (User::isUserAdmin()) { ?>
                                    <li class=""><a href="/user/dashboard/"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a></li>
                                    <li class=""><a href="/stokedstaff/index/"><i class="fa fa-attendence fa-fw"></i><span class="text">Staff</span></a></li>								
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-attendence fa-fw"></i><span class="text">Programs</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("program"); ?>">
                                            <li class="" ><a href="/program/index"><span class="text">View Programs</span></a></li>
                                            <li ><a href="/program/add"><span class="text">Add Programs</span></a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a href="#" class="js-sub-menu-toggle"><i class="fa fa-coaches fa-fw"></i><span class="text">Coaches</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("coach"); ?>">
                                            <li class=''><a href="/coach/index"><span class="text">View Coaches</span></a></li>
                                            <li ><a href="/coach/add"><span class="text">Add Coaches</span></a></li>
                                        </ul>
                                    </li>
<!--                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-supercoaches fa-fw"></i><span class="text">Super Coaches</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("supercoach"); ?>">
                                            <li ><a href="/supercoach/index"><span class="text">View Super Coaches</span></a></li>
                                            <li ><a href="/supercoach/add"><span class="text">Add Super Coaches</span></a></li>
                                        </ul>
                                    </li>-->
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-admin fa-fw"></i><span class="text">School Administrators</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("schoolstaff"); ?>">
                                            <li ><a href="/schoolstaff/index"><span class="text">View School Administrators</span></a></li>
                                            <li ><a href="/schoolstaff/add"><span class="text">Add School Administrators</span></a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-schools fa-fw"></i><span class="text">Schools</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("school"); ?>">
                                            <li ><a href="/school/index"><span class="text">View Schools</span></a></li>
                                            <li ><a href="/school/add"><span class="text">Add Schools</span></a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-students fa-fw"></i><span class="text">Students</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("student"); ?>">
                                            <li ><a href="/student/index"><span class="text">View Students</span></a></li>
                                            <li ><a href="/student/add"><span class="text">Add Students</span></a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-category fa-fw"></i><span class="text">Activity Type  Category</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("activitytypecategory"); ?>">
                                            <li ><a href="/activitytypecategory/index"><span class="text">View Activity Type Category</span></a></li>
                                            <li ><a href="/activitytypecategory/add"><span class="text">Add Activity Type Category</span></a></li>
                                        </ul>
                                    </li>                                    
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-activity fa-fw"></i><span class="text">Activity Type</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("activitytype"); ?>">
                                            <li ><a href="/activitytype/index"><span class="text">View Activity Type</span></a></li>
                                            <li ><a href="/activitytype/add"><span class="text">Add Activity Type</span></a></li>
                                        </ul>
                                    </li>
                                    <li ><a href="/user/reports/"><i class="fa fa-reports fw"></i><span class="text">Reports</span></a></li>	
                                    <?php } else if (User::isUserCoach ()) { ?>
                                    <li class=""><a href="/user/dashboard/"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a></li>
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-attendence fa-fw"></i><span class="text">Check-ins</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("checkin"); ?>">
                                            <li class="" ><a href="/checkin/index"><span class="text">View check-ins</span></a></li>
                                            <li ><a href="/checkin/add"><span class="text">Add check-ins</span></a></li>
                                        </ul>
                                        <li class=""><a href="/user/calendar"><i class="fa fa-clipboard fa-fw"></i><span class="text">Calendar</span></a></li>
                                    </li>                                    
                                    <?php } else if (User::isUserSchoolStaff ()) { ?>
                                    <li class=""><a href="/user/dashboard/"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a></li>
                                    <li ><a href="#" class="js-sub-menu-toggle"><i class="fa fa-students fa-fw"></i><span class="text">Students</span><i class="toggle-icon fa fa-angle-left"></i></a>
                                        <ul class="sub-menu <?php echo menu("student"); ?>">
                                            <li ><a href="/student/roster"><span class="text">Roster</span></a></li>
                                            <li ><a href="/"><span class="text">Photos</span></a></li>
                                        </ul>
                                    </li>      
                                    <li class=""><a href="/user/reports"><i class="fa fa-reports fa-fw"></i><span class="text">Reports</span></a></li>
                                    <li class=""><a href="/user/calendar"><i class="fa fa-clipboard fa-fw"></i><span class="text">Calendar</span></a></li>
                                    <?php } ?>                                    
                                </ul>
                            </nav><!-- /main-nav -->						
                        </div>
                        <!-- end left sidebar -->

                        <!-- content-wrapper -->

                        <div class="col-md-10 content-wrapper">	
                            <div id="error-banner" class="alert alert-danger">
                                <strong>Error: </strong>
                                <span id="error-message"></span>
                            </div>

                            <!-- main -->
                            <div class="content">
                                <?php require($viewloc); ?>
                            </div><!-- /main -->
                        </div><!-- /content-wrapper -->
                    </div><!-- /row -->
                </div><!-- /container -->
            </div>
                
            <!-- END BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
            <div class="push-sticky-footer"></div>
        </div><!-- /wrapper -->

    </body>

</html>




