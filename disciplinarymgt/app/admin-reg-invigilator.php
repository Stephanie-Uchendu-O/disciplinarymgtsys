<?php
session_start();
include 'includes/connection.php';
include 'includes/functions.php';
$role = isset($_SESSION["urole"]) ? $_SESSION["urole"] : "";
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($role != "admin") {
    header("location:login");
}

$alert = "";
if (isset($_POST["add"])) {
    $iname = htmlentities(mysqli_escape_string($conn, $_POST["fullname"]));
    $iemail = htmlentities(mysqli_escape_string($conn, $_POST["email"]));
    $iphone = htmlentities(mysqli_escape_string($conn, $_POST["phone"]));
    $id = "UAM-" . date("HiYs");
    $status = "yes";
    $password = $iemail;


    $insert_art = mysqli_query($conn, "insert into  invigilator values ('$id','$iname','$iemail','$iphone','$status')") or die(mysqli_error($conn));
    if ($insert_art) {
        $insert_login_details = mysqli_query($conn, "insert into login values ('$iemail','$password','invigilator','$status')") or die(mysqli_error($conn));
        if ($insert_login_details) {
            $alert = 'Invigilator Added Successfully!';
        } else {
            $alert = 'Operations Failed, Please Try after some minutes --- error 502!';
        }
    } else {
        $alert = 'Operations Failed, Please Try after some minutes!';
    }
}

//Deleting department
if (isset($_GET['d'])) {
    $dids = base64_decode($_GET['d']);

    $hide = mysqli_query($conn, "delete from  invigilator where email='$dids'");
    if ($hide) {
        $del_log_details = mysqli_query($conn, "delete from login where username='$dids'");
        if ($del_log_details) {
            echo "<script>alert('Invigilator deleted successfully!'); window.location.href='admin-reg-invigilator'</script>";
        } else {
            echo "<script>alert('Operations Failed, Please try again after some minutes 501!')</script>";
        }
    } else {
        echo "<script>alert('Operations Failed, Please try again after some minutes!')</script>";
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


        <title>ADD STAFF | <?php echo $sitename; ?> </title>

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
                        <div class="col-lg-4 col-md-6 col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Add  Staff</h3>
                                    <h5 style="color:greenyellow;"><?php echo $alert; ?></h5>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input required="" name="fullname" type="text" class="form-control" placeholder="Staff Name"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input required="" name="email" type="email" class="form-control" placeholder="Staff Email"/>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Phone</label>
                                            <input required="" name="phone" type="text" class="form-control" placeholder="Staff Phone"/>
                                        </div>
                                        
                                        <div class="row box-body">
                                            <div class="col-xs-8">    
                                                <div class="checkbox icheck">
                                                    <label>
                                                    </label>
                                                </div>                        
                                            </div><!-- /.col -->
                                            <div class="col-xs-4">
                                                <input type="submit" name="add" value="ADD STAFF" class="btn btn-primary btn-group-toggle btn-info btn-block btn-flat"> 
                                            </div><!-- /.col -->
                                        </div>
                                    </form> 

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-6 col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">STAFF</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>   
                                                     <th>ID</th> 
                                                    <th>FULLNAME</th>  
                                                    <th>EMAIL</th> 
                                                    <th>PHONE</th>  
                                                   <!-- <th>ACTION</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysqli_query($conn, "select * from  invigilator");
                                                $a = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $fullname = $row["fullname"];
                                                    $email = $row["email"];
                                                    $i_id = $row["id"];
                                                    $status = $row["status"];
                                                    $phone = $row["phone"];                                             
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td><?php echo $i_id; ?></td>
                                                        <td><?php echo $fullname; ?></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php echo $phone; ?></td>                                                        
                                                       <!-- <td><a onclick="return confirm('press ok to delete Invigilator')" href="admin-reg-invigilator?d=<?php //echo base64_encode($email); ?>" title="Delete"> <i class="ti-eraser"></i></a> -->
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
            <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Add  parent or gua</h3>
                                    <h5 style="color:greenyellow;"><?php echo $alert; ?></h5>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input required="" name="fullname" type="text" class="form-control" placeholder="Staff Name"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input required="" name="email" type="email" class="form-control" placeholder="Staff Email"/>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Phone</label>
                                            <input required="" name="phone" type="text" class="form-control" placeholder="Staff Phone"/>
                                        </div>
                                        
                                        <div class="row box-body">
                                            <div class="col-xs-8">    
                                                <div class="checkbox icheck">
                                                    <label>
                                                    </label>
                                                </div>                        
                                            </div><!-- /.col -->
                                            <div class="col-xs-4">
                                                <input type="submit" name="add" value="ADD STAFF" class="btn btn-primary btn-group-toggle btn-info btn-block btn-flat"> 
                                            </div><!-- /.col -->
                                        </div>
                                    </form> 

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-6 col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">PARENTS</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>   
                                                     <th>ID</th> 
                                                    <th>FULLNAME</th>  
                                                    <th>EMAIL</th> 
                                                    <th>PHONE</th>  
                                                   <!-- <th>ACTION</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysqli_query($conn, "select * from  invigilator");
                                                $a = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $fullname = $row["fullname"];
                                                    $email = $row["email"];
                                                    $i_id = $row["id"];
                                                    $status = $row["status"];
                                                    $phone = $row["phone"];                                             
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td><?php echo $i_id; ?></td>
                                                        <td><?php echo $fullname; ?></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php echo $phone; ?></td>                                                        
                                                       <!-- <td><a onclick="return confirm('press ok to delete Invigilator')" href="admin-reg-invigilator?d=<?php //echo base64_encode($email); ?>" title="Delete"> <i class="ti-eraser"></i></a> -->
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
 <!-- Main content -->





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
