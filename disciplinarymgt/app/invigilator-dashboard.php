<?php
session_start();
include 'includes/connection.php';
include 'includes/functions.php';

$role = isset($_SESSION["urole"]) ? $_SESSION["urole"] : "";
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($role != "invigilator") {
    header("location:login");
}
?>

﻿<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="favicon.png" sizes="16x16">

        <title><?php echo $sitename; ?></title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="css/vendors_css.css">

        <!-- Style-->  
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/skin_color.css">

    </head>

    <body class="hold-transition light-skin sidebar-mini theme-primary">

        <div class="wrapper">

            <?php
            include 'includes/header.php';
            ?>

            <!-- Left side column. contains the logo and sidebar -->
            <?php
            include 'includes/sidebar.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container-full">
                    <!-- Content Header (Page header) -->	  
                    <div class="content-header">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="page-title br-0">Welcome <?php echo "STAFF ---- ".$userid; ?></h3>
                            </div>

                        </div>
                    </div>

                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block text-dark font-weight-500">My Total Report</span>
                                            </div>
                                            <div>
                                                <span class="badge badge-primary badge-sm">+..%</span>
                                            </div>
                                        </div>
                                        <div>
                                            <?php
                                            $num_feed_backs = mysqli_num_rows(mysqli_query($conn, "select * from reports where inv_id='$userid'"));
                                            ?>
                                            <span class="d-block text-dark mb-5 font-size-30"><?php echo $num_feed_backs ?></span>
                                            <small class="d-block">Total Reports</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <span class="d-block text-dark font-weight-500">Concluded Report</span>
                                            </div>
                                            <?php
                                            $num_members = mysqli_num_rows(mysqli_query($conn, "select * from reports where inv_id='$userid' and status='YES'"));
                                            ?>
                                            <div>
                                                <span class="badge badge-pill badge-sm">+..%</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-dark mb-5 font-size-30"><?php echo $num_members; ?></span>
                                            <small class="d-block">Finish Reports</small>
                                        </div>
                                    </div>
                                </div>
                            </div>                          



                        </div>
                        <div class="blog-details-wrapper">
                        </div><!-- blog-details-wrapper end -->
                    </section>


                    <!-- /.content -->
                </div>
            </div>
            <!-- /.content-wrapper -->
            <?php
            include 'includes/footer.php';
            ?>
            <!-- Control Sidebar -->

            <!-- /.control-sidebar -->

            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->


        <!-- Vendor JS -->
        <script src="js/vendors.min.js"></script>

        <script src="../assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
        <script src="../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
        <script src="../assets/vendor_components/echarts/dist/echarts-en.min.js"></script>

        <!-- Famosa Admin App -->
        <script src="js/template.js"></script>
        <script src="js/pages/dashboard.js"></script>


    </body>

    <!-- Mirrored from html.psdtohtmlexpert.com/admin/famosa-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Dec 2020 08:41:47 GMT -->
</html>
