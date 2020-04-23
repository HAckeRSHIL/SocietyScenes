<?php include('Connection.php') ?>
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
    <style>
    </style>
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
            <div class="col-sm-4" style="background-color:lightgrey; height:1000px;">
                <center>
                   <div class="card bg-info text-white">
                   <div class="card-body">

                    
                    <pre> <a  href="Login.php"><b style="font-family:verdana; color:#9900cc ;">Login</b></a><a >  <b style="font-size:27px;  font-family:verdana;">Signup</b></a>   </pre>

                    <form action="signup.php" method="POST" enctype="multipart/form-data">
                        <p>
                            <input class="form-control" type="text" name="Blockno" placeholder="Block No." style="width: 345px;" pattern="[A-Za-z]{1}" required></p>
                        <p> <input type="text" name="plotno" class="form-control" placeholder="House No." style="width: 345px" required></p>
                        <p><input type="text" class="form-control" name="fname" placeholder="First Name" style="width: 345px;" required></p>
                        </p> <input type="text" class="form-control" name="lname" placeholder="Last name" style="width: 345px;" required></p>
                        <p><input type="text" class="form-control" name="Mno1" placeholder="Mobile No." style="width: 345px;" pattern="[0-9]{10}" required></p>
                        <p><input type="text" class="form-control" name="Mno2" placeholder="Mobile No. (optional)" pattern="[0-9]{10}" style="width: 345px;"></p>
                        <p><input type="email" class="form-control" name="email" placeholder="Email-Id" style="width: 345px;" required></p>
                        <p><input type="password" class="form-control" name="pw" placeholder="Password" style="width: 345px;" required></p>
                        <p><input type="password" class="form-control" name="pw1" placeholder="Confirm Password" style="width: 345px;" required></p>
                        <p><input type="number" min="1" class="form-control" name="persons" placeholder="Number of Residents" style="width: 345px;" required></p>
                        <pre><b>Id Proof:</b><input type="file" name="idproof" accept="application/pdf" required></pre>

                        <pre><b>Add photo:</b><input type="file" name="profilephoto" accept="image/*" required></pre>

                        <p style="float: center; margin-right: 90px;">Type of Resident :
                            <input type="radio" name="original" value="Owner" checked>Owner
                            <input type="radio" name="original" value="Tenant">Tenant
                        </p>
                        <p><input type="submit" value="Sign Up »" class="btn btn-primary " name="submit" style="width: 345px;"></p>
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


<?php
if (isset($_POST['submit'])) {
    $blockname = strtoupper($_POST['Blockno']);
    $housenumber = $_POST['plotno'];
    $email = $_POST['email'];
    $plat = $blockname . "-" . $housenumber;
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $name = $firstname . " " . $lastname;
    $mobile = $_POST['Mno1'];
    $type = $_POST['original'];
    $person = $_POST['persons'];
    if ($_POST['Mno2'] != "") {
        $mobile2 = $_POST['Mno2'];
    } else {
        $mobile2 = "";
    }
    $cpassword = $_POST['pw1'];
    $password = $_POST['pw'];

    if ($cpassword == $password) {
        if ($type == "Owner") {
            $query = "select * from `tblregistration` where `plot_no`='$plat'";
            $getquery = mysqli_query($conn, $query);
            $row = mysqli_num_rows($getquery);
            if ($row > 0) {
                echo "<script>alert('Flot Number Account Exits')</script>";
            } else {

                if ($_FILES['idproof']['size'] <= 5000000) {
                    $filename = rand(10, 1000) . "-" . $_FILES["idproof"]["name"];;
                    move_uploaded_file($_FILES["idproof"]["tmp_name"], "images/idproofs/" . $filename);
                } else {
                    echo "<script>alert('File Size Up to 5 MB')</script>";
                    echo "<script>window.location='signup.php'</script>";
                }
            
                if ($_FILES['profilephoto']['size'] <= 5000000) {
                    $filename1 = rand(10, 1000) . "-" . $_FILES["profilephoto"]["name"];;
                    move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "images/profile/" . $filename1);
                } else {
                    echo "<script>alert('File Size Up to 5 MB')</script>";
                    echo "<script>window.location='signup.php'</script>";
                } 

                $query = "INSERT INTO `tblregistration`(`plot_no`, `owner_name`, `mobile_no`, `mobile_no_2`, `email_id`, `password`, `owner_photo`, `owner_identity`, `no_of_person`) VALUES ('$plat','$name','$mobile','$mobile2','$email','$password','$filename1','$filename',$person)";
                echo "$query";
                $getquery = mysqli_query($conn, $query);

                if ($getquery) {
                    echo "<script>alert('Record Successfully Inserted')</script>";
                    echo "<script>window.location='signup.php'</script>";
                } else {
                    echo "<script>alert('Record Not Successfully Inserted')</script>";
                }
            }
        } else if ($type == "Tenant") {

            $query = "select * from `tblregistration` where `plot_no`='$plat'";
            $getquery = mysqli_query($conn, $query);
            $row = mysqli_num_rows($getquery);
            if ($row > 0) {
                $rows = mysqli_fetch_array($getquery);
                $owner_Id = $rows['owner_id'];

                if ($_FILES['idproof']['size'] <= 5000000) {
                    $filename = rand(10, 1000) . "-" . $_FILES["idproof"]["name"];;
                    move_uploaded_file($_FILES["idproof"]["tmp_name"], "images/idproofs/" . $filename);
                } else {
                    echo "<script>alert('File Size Up to 5 MB')</script>";
                    echo "<script>window.location='signup.php'</script>";
                }
            
                if ($_FILES['profilephoto']['size'] <= 5000000) {
                    $filename1 = rand(10, 1000) . "-" . $_FILES["profilephoto"]["name"];;
                    move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "images/profile/" . $filename1);
                } else {
                    echo "<script>alert('File Size Up to 5 MB')</script>";
                    echo "<script>window.location='signup.php'</script>";
                }

                $query2 = "INSERT INTO `tblrenttable`(`owner_id`, `tenant_name`, `mobile_no`, `email_id`, `password`, `identity_photo`, `tenant_photo`, `no_of_persons`) VALUES ($owner_Id,'$name','$mobile','$email','$password','$filename','$filename1',$person)";
                $getquery2 = mysqli_query($conn, $query2);

                if ($getquery2) {
                    echo "<script>alert('Record Successfully Inserted')</script>";
                    echo "<script>window.location='signup.php'</script>";
                } else {
                    echo "<script>alert('Record Not Successfully Inserted')</script>";
                }
            } else {
                echo "<script>alert('Owner Account Not Found.Please Contact Owner')</script>";
            }
        }
    } else {
        echo "<script>alert('Password Not Match')</script>";
    }
}

?>