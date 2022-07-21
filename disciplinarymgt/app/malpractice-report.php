<?php
session_start();
include 'includes/connection.php';
include 'includes/functions.php';
$role = isset($_SESSION["urole"]) ? $_SESSION["urole"] : "";
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$repid = base64_decode($_GET["r"]);

if ($role != "invigilator") {
    header("location:login");
}

$alert = "";

$result = mysqli_query($conn, "select * from reports where rid='$repid'") or die("Go Back!");
$a = 1;
$row = mysqli_fetch_array($result);
$fullname = $row["fullname"];
$email = $row["email"];
$level = $row["level"];
$report_id = $row["rid"];
$invigilator_id = $row["inv_id"];
$status = $row["status"];
$student_department = $row["dept"];
$student_faculty = $row["faculty"];
$malpractice_course = $row["course"];
$phone = $row["phone"];
$mat_no = $row["mat_no"];
$exhibit = isset($row["exhibit"]) ? $row["exhibit"] : "";
$invigilator_comment = $row["inv_comment"];
$student_comment = isset($row["std_comment"]) ? $row["std_comment"] : "";
$emc_findings = isset($row["emc_findings"]) ? $row["emc_findings"] : "";
$emc_comment = isset($row["emc_comment"]) ? $row["emc_comment"] : "";
$chairmain_resolution_file = isset($row["chairman_resolution"]) ? $row["chairman_resolution"] : "";
$chairmain_comment = isset($row["chm_comment"]) ? $row["chm_comment"] : "";
$report_status = $row["status"];
$report_date = date_format(date_create($row["date"]), "d, M Y H:iA");
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


        <title> MISCONDUCT REPORT | <?php echo $sitename; ?> </title>

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
                                    <h3 class="box-title"> Misconduct/Malpractice Report</h3>
                                    <h5 style="color:greenyellow;"><?php echo $alert; ?></h5>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input value="<?php echo $fullname; ?>" readonly="" name="fullname" type="text" class="form-control" placeholder="Student Fullname"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Mat. NO.</label>
                                            <input value="<?php echo $mat_no; ?>" readonly="" required="" name="matno" type="text" class="form-control" placeholder="Student Mat. NO."/>
                                        </div>

                                        <div class="form-group">
                                            <label>Student Faculty</label>
                                            <input value="<?php echo $student_faculty; ?>" readonly="" name="faculty" type="text" class="form-control" placeholder="Student Faculty"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Student Department</label>
                                            <input value="<?php echo $student_department; ?>" readonly="" name="dept" type="text" class="form-control" placeholder="Student Department"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Student Level</label>
                                            <input value="<?php echo $level; ?>" readonly="" name="level" type="text" class="form-control" placeholder="Level"/>
                                        </div>


                                        <div class="form-group">
                                            <label>Malpractice Course</label>
                                            <input value="<?php echo $malpractice_course; ?>" readonly="" name="course" type="text" class="form-control" placeholder="Malpractice Course"/>
                                        </div>                                      


                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input value="<?php echo $phone; ?>" readonly="" name="phone" type="text" class="form-control" placeholder="Student Phone"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="<?php echo $email; ?>" readonly="" name="email" type="email" class="form-control" placeholder="Student Email"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Exhibit/Evidence</label><br>
                                            <a  target="_blank" href="exhibit/<?php echo $exhibit; ?>"> VIEW-<i style="width:200px;" class="ti-image"></i></a>
                                        </div>

                                        <div class="form-group">
                                            <label>Witness(es)/Staff Comment</label>
                                            <textarea readonly="" name="comment" class="form-control" rows="3" placeholder="Enter comment on exhibit"><?php echo $invigilator_comment ?></textarea>
                                        </div>

                                        <!--  <div class="form-group">
                                           <label>Student Response Comment</label>
                                           <textarea readonly="" name="comment" class="form-control" rows="3" placeholder="Student yet to respond"><?php echo $student_comment ?></textarea>
                                       </div> -->

                                        <div class="form-group">
                                            <label>Committee Findings</label><br>
                                            <?php
                                            if ($emc_findings == "") {
                                                echo "PENDING...";
                                            } else {
                                                ?>
                                                <a target="_blank" href="exhibit/<?php echo $emc_findings; ?>">VIEW-<i class="ti-file"></i></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label><b>Committee Comment</b></label>
                                            <textarea readonly="" name="comment" class="form-control" rows="3" placeholder="Committee yet to respond"><?php echo $emc_comment; ?></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label><b>Chairman Resolution</b></label><br>
                                            <?php
                                            if ($chairmain_resolution_file == "") {
                                                echo "PENDING...";
                                            } else {
                                                ?>
                                                <a target="_blank" href="exhibit/<?php echo $chairmain_resolution_file; ?>">VIEW-<i class="ti-file"></i></a>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Chairman Comment</label>
                                            <textarea readonly="" name="comment" class="form-control" rows="3" placeholder="Chairman pending comment"><?php echo $chairmain_comment; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label><b>CASE STATUS:</b></label>
                                            <?php
                                            if ($report_status == "no") {
                                                echo "IN PROCESS...";
                                            } else {
                                                ?>
                                                <input value="<?php echo "COMPLETED"; ?>" readonly="" name="email" type="email" class="form-control" placeholder="Pending"/>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label><b>REPORT DATE: </b></label>
                                            <label><?php echo $report_date; ?></label>
                                        </div>

                                </div>
                                </form> 

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
