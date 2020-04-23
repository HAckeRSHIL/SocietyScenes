<?php
  session_start();
  include('Connection.php') 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>SignUp</title>
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

</head>


<?php
  if(isset($_POST['changepw'])){
      $email = $_SESSION['email'];
      $otp_old = $_SESSION['otp1'];
      $newpw1 = $_POST['newpw1'];
      $otp = $_POST['otp'];
      if($otp_old == $otp){
        if($_POST['newpw1'] == $_POST['newpw2']){
            $query = "update tblregistration set password='$newpw1' where email_id='$email' ";
            $getquery = mysqli_query($conn, $query);
            session_destroy();
            echo "<script>alert('Password Change Successfully.')</script> ";
            echo "<script>window.location='Login.php'</script>";

        }else{
            echo "<script>alert('Both Password not same!')</script> ";
        }   
      }else{
          echo "<script>alert('OTP not valid!')</script>"; 
      }
  }
?>




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
            <div class="col-sm-4" style="background-color:lightgrey; height:1000px;">
                <center>
                   <div class="card bg-info text-white">
                   <div class="card-body">

                    
                    <pre> <a >  <b style="font-size:22px;  font-family:verdana;">Set new password.</b></a>   </pre>

                    <form action="" method="POST">
                            <input class="form-control" type="text" name="otp" placeholder="Enter OTP" style="width: 345px;"  required></p>
                            <input class="form-control" type="password" name="newpw1" placeholder="New Password" style="width: 345px;"  required></p>
                            <input class="form-control" type="password" name="newpw2" placeholder="Confirm your password" style="width: 345px;" required></p>      
                            <input type="submit" value="Change-Password »" class="btn btn-primary " name="changepw" style="width: 345px;"></a>
                    </form>    
                        
                    </div>
                    </div>
                       </center>
            </div>
            <div class="col-sm-4" style="background-color:lightgrey; "></div>
        </div>
    </div>
</body>

</html>
