<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора -SIMINTA</title>
    <?php foreach($css_files as $files=>$css):?>
    <link type="text/css" rel="stylesheet" href="<?=$css?>">
    <?php endforeach;?>
    <!-- Core CSS - Include with every page -->
    <link href="/assets/admin/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/assets/admin/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="/assets/admin/css/style.css" rel="stylesheet" />
    <link href="/assets/admin/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="/assets/admin/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://vinnitsa.volia.com" target="blank">
                    <img src="http://volia.com/user/img/logo/logo.png?1454069191" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            
            <ul class="nav navbar-top-links navbar-right">
                <a href="#" class="btn btn-primary btn-circle"><i class="fa fa-user fa-fw"></i></a>
                <a href="#" class="btn btn-primary btn-circle"><i class="fa fa-gear fa-fw"></i></a>
                <a href="/admin/auth/logout" class="btn btn-primary btn-circle"><i class="fa fa-sign-out fa-fw"></i></a>
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="/assets/admin/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div><small><?=$user['first_name']?> <strong><?=$user['last_name']?></strong></small></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!--end search section-->
                    </li>
                    <?php foreach($menu as $k=>$val):?>
                    <li class="<?php echo $val==$current_section ? 'selected' : NULL;?>">
                        <a href="/<?=  $k?>"><i class="fa fa-dashboard fa-fw"></i><?php echo $val?></a>
                    </li>
                    <?php endforeach;?>
                    
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$current_section?></h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="content">
            <?php echo $output?>
            </div>
            
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="/assets/admin/plugins/jquery-1.10.2.js"></script>
    <script src="/assets/admin/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/admin/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/admin/plugins/pace/pace.js"></script>
    <script src="/assets/admin/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="/assets/admin/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="/assets/admin/plugins/morris/morris.js"></script>
    <script src="/assets/admin/scripts/dashboard-demo.js"></script>
    <?php foreach($js_files as $file):?>
    <script src="<?=$file?>"></script>
    <?php endforeach;?>
</body>

</html>
