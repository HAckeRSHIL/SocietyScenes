<?php
include('Connection.php');
session_start();

if (!isset($_SESSION['adminId'])) {
    echo "<script>window.location='../Login.php'</script>";
}

if (isset($_SESSION['adminId'])) {
    $id = $_SESSION['adminId'];
    $query = "select tr.* from tblsecretary ts,tblregistration tr where tr.owner_id=ts.owner_id and ts.secretary_id=$id and ts.status=0";
    $getquery = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($getquery);
    $name = $row['owner_name'];
    $photo = $row['owner_photo'];
    $type = "Admin";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <link href="../assets/css/testing.css" rel="stylesheet" />

    <link href='https://fonts.googleapis.com/css?family=Gurajada' rel='stylesheet'>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        .table1 {
            display: table;
            width: auto;

        }

        .chip {
            display: inline-block;

            padding: 0 20px;

            height: 50px;
            font-size: 16px;
            margin-right: 20px;

            border-radius: 0px;
            background-color: #f1f1f1;
        }

        .chip img {
            float: left;
            margin: 0 10px 0 -25px;
            height: 50px;
            width: 50px;
            border-radius: 0;
        }


        .table1-row {
            display: table-row;
            width: auto;
            clear: both;
        }

        .table1-col {
            float: left;
            display: table-column;
            width: 180px;
        }

        .table2-col {
            float: left;
            display: table-column;
            width: 250px;
        }

        .formclass {
            align-content: center;
            align-items: center;
            margin-left: 15%;
            margin-right: 10%;
            margin-top: 5%;
            width: 70%;
            opacity: 90%;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-sm bg- navbar-dark" style="background-color: #2F4F4F; ">
        <!-- Brand/logo -->


        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="./dashboard.php"><i class="material-icons">important_devices</i> Dashboard</a>
            <a href="./Graphical.php"><i class="material-icons">poll</i> Statistics</a>
            <a href="./view-funds.php"><i class="material-icons">account_circle</i> Funds History</a>
            <a href="./paymentadd.php"><i class="material-icons">payment</i> Add New Payment</a>
            <a href="./addnotice.php"><i class="material-icons">calendar_today</i> Add New Notice</a>
            <a href="./noticeboard.php"><i class="material-icons">pageview</i> View Notice</a>
            <a href="./view_event.php"><i class="material-icons">event</i> Events Approval</a>
            <a href="./payment_history.php"><i class="material-icons">content_paste</i> Payment History</a>
            <a href="./viewcomplain.php"><i class="material-icons">feedback</i> Complain Box</a>
        </div>

        <span style="font-size:30px;cursor:pointer;color: white" onclick="openNav()">&#9776;</span>

        <div class="container-fluid">
            <div class="row" id="heading">
                <div class="col-sm-3"></div>
                <div class="col-sm-3 col-sm-offset-6">
                    <a class="navbar-brand" href="#"><b style="font-family:Gurajada; font-size:40px;">My Society</b></a>

                </div>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" style="float: right; margin-top:6px;">Logout</button>
                <div class="chip">
                    <img src="../images/profile/<?php echo $photo; ?>" alt="Person" width="50" height="50">
                    <b> <?php echo $name; ?></b><br>
                    <a style="font-family:calibre; font-size:13px; text-align:center; padding-top:5px;"> <?php echo $type; ?></a>
                </div>
                <!-- <p style="float: right; color:white; font-size: 15px; margin-right: 10px; margin-top: 10px;"><?php echo $name; ?></p> -->
            </div>
            <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Logout <i class="fa fa-sign-out"></i></h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to log-off?</div>
                        <div class="modal-footer"><a href="logout.php" class="btn btn-primary">Logout</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            

            <!-- Links -->
    </nav>
    <div id="main">

        <script>
            function openNav() {
                document.getElementById("heading").style.marginLeft = "200px";
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                document.getElementById("main2").style.marginLeft = "250px";
                document.getElementById("mySidebar").style.display = "block";
                document.getElementById("openNav").style.display = 'none';
            }

            function closeNav() {
                document.getElementById("heading").style.marginLeft = "0";
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0%";
                document.getElementById("mySidebar").style.display = "none";
                document.getElementById("openNav").style.display = "inline-block";
            }
        </script>