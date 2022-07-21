<?php
session_start();
include 'includes/connection.php';
include 'includes/functions.php';

$error = "";
if (isset($_POST["login"])) {
    $email = secure($conn, $_POST["username"]);
    $password = secure($conn, $_POST["password"]);

    $get_rc = mysqli_query($conn, "select * from login where username='$email' and password='$password'");
    $num_rows = mysqli_num_rows($get_rc);
    if ($num_rows > 0) {
        $row = mysqli_fetch_array($get_rc);
        $_SESSION["userid"] = $row["username"];
        $_SESSION["urole"] = $row["role"];
        if ($row["role"] == "student") {
            //$get_dept_id = mysqli_fetch_array(mysqli_query($conn, "select dept_id from student where email='$email'")) or die(mysqli_error($conn));
            $_SESSION["userid"] = $row["username"];
            $_SESSION["urole"] = $row["role"];
            //  $_SESSION["dept_id"] = $get_dept_id["dept_id"];
            $_SESSION["status"] = $row["status"];
            header("location:student-dashboard");
        } elseif ($row["role"] == "admin") {
            $_SESSION["userid"] = $row["username"];
            $_SESSION["urole"] = $row["role"];
            $_SESSION["status"] = $row["status"];
            header("location:index");
        } elseif ($row["role"] == "invigilator") {
            $_SESSION["userid"] = $row["username"];
            $_SESSION["urole"] = $row["role"];
            $_SESSION["status"] = $row["status"];
            header("location:invigilator-dashboard");
        } elseif ($row["role"] = "emc") {
            $_SESSION["userid"] = $row["username"];
            $_SESSION["urole"] = $row["role"];
            $_SESSION["status"] = $row["status"];
            header("location:emc-dashboard");
        }
    } else {
        echo " <div class='alert alert-info alert-dismissible'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h4><i class='icon fa fa-warning'></i> Alert!</h4>
                                           <p style=color:'red';> Incorrect username or password, please check and try again.</p>
                                        </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="favicon.png" sizes="16x16">


        <title><?php echo $sitename; ?> - Log in </title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="css/vendors_css.css">

        <!-- Style-->  
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/skin_color.css">	

    </head>
    <body style=" background-image: url(../images/std.ng)" class="hold-transition bg-white">


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="navId">
        <li class="nav-item">
            <a href="#tab1Id" class="nav-link active">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Logins</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#tab2Id">New Staff Sign up</a>
                <a class="dropdown-item" href="#tab3Id">Staff Login</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#tab4Id">Comitee Member Login</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="#tab5Id" class="nav-link">Another link</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">Disabled</a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1Id" role="tabpanel"></div>
        <div class="tab-pane fade" id="tab2Id" role="tabpanel"></div>
        <div class="tab-pane fade" id="tab3Id" role="tabpanel"></div>
        <div class="tab-pane fade" id="tab4Id" role="tabpanel"></div>
        <div class="tab-pane fade" id="tab5Id" role="tabpanel"></div>
    </div>
    
<!--screen division -->

<div class="row">
    <div class="col-4 bg-black" s>

    <div id="carouselId" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
        <li data-target="#carouselId" data-slide-to="1"></li>
        <li data-target="#carouselId" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="../images/std.png" alt="First slide" width="500rem"  height="333">
            <div class="carousel-caption d-none d-md-block">
                <h3>Title</h3>
                <p>Description</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../images/iso.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>Title</h3>
                <p>Description</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../images/img3.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>Title</h3>
                <p>Description</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

</div>

    

    <div class="col-8">

    
    <script>
        $('#navId a').click(e => {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>

        <div class="container h-p100">
            <div class="row align-items-center justify-content-md-center h-p100">	

                <div class="col-12">
                    <div class="row justify-content-center no-gutters">
                        <div class="col-lg-4 col-md-5 col-12">
                            <div class="content-top-agile p-10">
                                <h2 class="text" style="color:black; font-size: 40px"><?php echo $sitename; ?></h2>
                                <p class="text"  style="color:black; font-size: 20px">Sign in to start your session</p>
                                <p class="text-warning"><?php echo $error; ?></p>
                            </div>
                            <div class="p-40 rounded40 box-shadowed b-3 b-dashed">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" name="username" required="" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  bg-transparent text" style="color:black"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" name="password" required="" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="checkbox text-white">
                                                <input type="checkbox" id="basic_checkbox_1" >
                                                <label for ="basic_checkbox_1">Remind Me</label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="fog-pwd text-right">
                                               <!-- <a href="registration" class="text-white hover-info"><i class="ion ion-record"></i> Not Registered?</a><br> -->
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 text-center">
                                            <button style="background-color:brown;" type="submit" name="login" class="btn btn-info btn-rounded mt-10">SIGN IN</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>														


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
    
</div>



<!--screen division  3end -->







        <!-- Vendor JS -->
        <script src="js/vendors.min.js"></script>
         <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>

    <!-- Mirrored from html.psdtohtmlexpert.com/admin/famosa-admin/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Dec 2020 08:43:51 GMT -->
</html>
