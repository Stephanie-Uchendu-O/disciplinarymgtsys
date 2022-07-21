<?php
session_start();
include 'includes/connection.php';
include 'includes/functions.php';
$role = isset($_SESSION["urole"]) ? $_SESSION["urole"] : "";
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($role != "emc") {
    header("location:login");
}

$alert = "";
if (isset($_POST["add"])) {
    $sname = htmlentities(mysqli_escape_string($conn, $_POST["fullname"]));
    $semail = htmlentities(mysqli_escape_string($conn, $_POST["email"]));
    $sphone = htmlentities(mysqli_escape_string($conn, $_POST["phone"]));
    $smat_no = $_POST["matno"];
    $slevel = $_POST["level"];
    $sicomment = htmlentities(mysqli_escape_string($conn, $_POST["comment"]));
    $sdept = htmlentities(mysqli_escape_string($conn, $_POST["dept"]));
    $sfaculty = htmlentities(mysqli_escape_string($conn, $_POST["faculty"]));
    $scourse = htmlentities(mysqli_escape_string($conn, $_POST["course"]));
    $sinvigilator_id = $userid;
    $sstd_comment = "";
    $semc_comment = "";
    $semc_findings = "";
    $schairman_comment = "";
    $schairman_resolution = "";
    $rid = "RPT-" . date("HiYs");
    $status = "no";
    $date = date("Y-m-d H:i:s");
    $password = $smat_no;

    $exhibit = $_FILES["exhibit"]["name"];

    $img_ext = pathinfo($exhibit, PATHINFO_EXTENSION);
    $sexhibit = upload_student_exhibit($_FILES["exhibit"]["tmp_name"], $img_ext);


    if ($sexhibit != "") {
        $insert_report = mysqli_query($conn, "insert into  reports values ('$rid','$sname','$smat_no','$sinvigilator_id','$sdept','$sfaculty','$scourse','$slevel','$sphone','$semail','$sexhibit','$sicomment','$sstd_comment','$semc_findings','$semc_comment','$schairman_resolution','$schairman_comment','$status','$date')") or die(mysqli_error($conn));
        if ($insert_report) {
            $check_login_table = mysqli_num_rows(mysqli_query($conn, "select * from login where username='$smat_no'"));
            if ($check_login_table > 0) {
                $alert = 'Report submitted successfully!';
            } else {
                $insert_login_details = mysqli_query($conn, "insert into login values ('$smat_no','$smat_no','student','$status')") or die(mysqli_error($conn));
                if ($insert_login_details) {
                    $alert = 'Report submitted successfully!';
                } else {
                    $alert = 'Operations Failed, Please Try after some minutes --- error 502!';
                }
            }
        } else {
            $alert = 'Operations Failed, Please Try after some minutes!';
        }
    } else {
        echo "<script>alert('Exhibit image upload failed! pls try after some minutes');</script>";
    }
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


        <title>REPORTS MISCONDUCT | <?php echo $sitename; ?> </title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="css/vendors_css.css">

        <!-- CK-EDITOR -->
        <script src="ckeditor/ckeditor.js"></script>
        <script src="ckeditor/samples/js/sample.js"></script>

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


                    <!-- Main content -->


                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">MISCONDUCT/MALPRACTICE REPORTS</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>   
                                                    <th>MAT. NO.</th> 
                                                    <th>FULLNAME</th>  
                                                    <th>STATUS</th>  
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysqli_query($conn, "select * from reports");
                                                $a = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $fullname = $row["fullname"];
                                                    $email = $row["email"];
                                                    $report_id = $row["rid"];
                                                    $invigilator_id = $row["inv_id"];
                                                    $status = $row["status"];
                                                    $student_department = $row["dept"];
                                                    $student_faculty = $row["faculty"];
                                                    $malpractice_course = $row["course"];
                                                    $phone = $row["phone"];
                                                    $level = $row["level"];
                                                    $mat_no = $row["mat_no"];
                                                    $exhibit = $row["exhibit"];
                                                    $invigilator_comment = $row["inv_comment"];
                                                    $student_comment = $row["std_comment"];
                                                    $emc_findings = $row["emc_findings"];
                                                    $emc_comment = $row["emc_comment"];
                                                    $chairmain_resolution_file = $row["chairman_resolution"];
                                                    $chairmain_comment = $row["chm_comment"];
                                                    $report_status = $row["status"];
                                                    $report_date = $row["date"];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td><?php echo $mat_no; ?></td>
                                                        <td><?php echo $fullname; ?></td>
                                                        <td><?php if($report_status=="no"){ echo "PROCESSING"; }else{ echo "COMPLETED";} ?></td>
                                                        <td><a href="emc-malpractice-findings?r=<?php echo base64_encode($report_id); ?>" title="Report Details"> <i class="ti-dropbox">DETAILS</i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $a++;
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

        <script src="../assets/vendor_components/datatable/datatables.min.js"></script>
        <script src="js/pages/data-table.js"></script>





        <script src="../assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
        <script src="../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
        <script src="../assets/vendor_components/echarts/dist/echarts-en.min.js"></script>

        <!-- Famosa Admin App -->
        <script src="js/template.js"></script>
        <script src="js/pages/dashboard.js"></script>


    </body>

    <!-- Mirrored from html.psdtohtmlexpert.com/admin/famosa-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Dec 2020 08:41:47 GMT -->
</html>
