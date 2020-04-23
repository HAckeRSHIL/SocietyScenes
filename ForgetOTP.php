<?php 
  session_start();
  include('Connection.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Forget Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">

    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">

    <link href="./assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <link href="./assets/css/testing.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!--  <script>
document.getElementById("sendOTP").addEventListener("click", myFunction);

function myFunction() {
  document.getElementById("sendOTP").innerHTML = "YOU CLICKED ME!";
}-->
    </script>


    <style>
    </style>
</head>

<?php
      if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $query = "select * from tblregistration where email_id = '$email' ";
        $getquery = mysqli_query($conn, $query);
        $count = mysqli_num_rows($getquery);
        if ($count > 0) {
            function random_strings($length_of_string)
            {
                $str_result = '1234567890';
                return substr(str_shuffle($str_result), 0, $length_of_string);
            }
            $transaction = random_strings(4);
            $to_email = $email;
            $subject = "OTP";
            $message = "Your OTP is ".$transaction;
            $header = "From:Society Management@gmail.com";

            $retval = mail($to_email, $subject, $message, $header);
            $_SESSION['email'] = $email;
            $_SESSION['otp1'] = $transaction;
            if ($retval == true) {
                echo "<script>alert('OTP Send into Your Email')</script>";
                echo "<script>window.location='confirmOTP.php'</script>";
            } else {
                echo "<script>Email could not be sent...</script>";
            }
        }
        else{
            echo "<script>alert('Please Enter Valid Email Address')</script>";
        }
     }
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style=" height:60px; background-color: #9900cc">
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
            <div class="col-sm-4" style="background-color:lightgrey; height:1000px;">
                <center>
                    <div class="card bg-info text-white">
                        <div class="card-body">


                            <pre> <a >  <b style="font-size:22px;  font-family:verdana;">Forget your password?</b></a>   </pre>

                            <form action="" method="POST"> 
                                <p>
                                    <input class="form-control" type="text" name="email" placeholder="Enter your User name" style="width: 345px;" required></p>
                                <p><input type="submit" value="Send-OTP »" name="submit" class="btn btn-primary" style="width: 345px;"></p>
                        </div>
                    </div>
                </center>
                </form>
            </div>
            <div class="col-sm-4" style="background-color:lightgrey; "></div>
        </div>
    </div>
</body>

</html>
