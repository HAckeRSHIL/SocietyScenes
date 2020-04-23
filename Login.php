<?php
require('Connection.php');

@session_start();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="./assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
        <link href="./assets/css/testing.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>  
    </head>

    <body>
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12" style=" height:60px; background-color: #9900cc" >
                    <h3 style="margin-left:100px; margin-top:10px; color:white;">
                        MySociety
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="border:0.5px solid black;"></div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgrey;height:50px;"></div>
            </div>
            <div class="row">
                <div class="col-sm-4" style="background-color:lightgrey;">
                </div>
                <div class="col-sm-4" style="background-color:lightgrey; height:500px;">
                    <center>
                            <div class="card bg-info text-white">
                                <div class="card-body">


                                    <pre><a ><b style="font-size:27px; font-family:verdana;">Login</b></a>   <a  href="signup.php"><b style="font-family:verdana; color:#9900cc ;">Signup</b></a> </pre>
                                    <form action="Login.php" method="POST">
                                        <p><input type="text" class="form-control" name="uname" placeholder="Username" style="width: 275px;"></p>
                                        <p>
                                            <input type="password" name="pw" class="form-control" placeholder="Password" style="width: 275px;"></p>
                                        <input type="submit" class="btn btn-primary" name="submit" style="width: 275px;" value="Sign In »">
                                        <br />
                                        <p style="font-size: 12px;">Forgot your password?
                                            <a style="color:black;" name="Frgt" href="ForgetOTP.php">Recover my Account</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </center>
                <div class="col-sm-4" style="background-color:lightgrey; ">
                </div>

            </div>    
        </div>
    </body>

</html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['pw'];
    $query = "select * from tblregistration where email_id='$username' and password='$password'";
    $getquery = mysqli_query($conn, $query);
    $count = mysqli_num_rows($getquery);
    if ($count > 0) {
        $rows = mysqli_fetch_array($getquery);
        $id = $rows['owner_id'];

        $query = "select * from tblsecretary where owner_id='$id' and status=0";
        $getquery = mysqli_query($conn, $query);
        $count = mysqli_num_rows($getquery);

        if ($count > 0) {
            $rows = mysqli_fetch_array($getquery);
            $id1 = $rows['secretary_id'];
            $_SESSION['adminId'] = $id1;
            echo "<script>window.location='./admin/dashboard.php'</script>";
        } else {
            $_SESSION['ownerId'] = $id;
            echo "<script>window.location='payment.php'</script>";
        }
    } else {
        $query = "select * from tblrenttable where email_id='$username' and password='$password'";
        $getquery = mysqli_query($conn, $query);
        $count = mysqli_num_rows($getquery);
        if ($count > 0) {
            $rows = mysqli_fetch_array($getquery);
            $id1 = $rows['rent_id'];
            $_SESSION['rentId'] = $id1;
            echo "<script>window.location='noticeboard.php'</script>";
        } else {
            echo "<script>alert('Email Id or Password is Not Correct')</script>";
        }
    }
}
?>