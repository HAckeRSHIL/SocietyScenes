<?php
include('Connection.php');
session_start();

if (!isset($_SESSION['ownerId']) && !isset($_SESSION['rentId'])) {
    echo "<script>window.location='Login.php'</script>";
}

if (isset($_SESSION['ownerId'])) {
    $id=$_SESSION['ownerId'];
    $ownerquery = "select * from tblregistration where owner_id=$id";
    $getownerquery = mysqli_query($conn, $ownerquery);
    $ownerrow = mysqli_fetch_array($getownerquery);
    $name = $ownerrow['owner_name'];
    $photo=$ownerrow['owner_photo'];
    $type="Owner";
} else if (isset($_SESSION['rentId'])) {
    $id=$_SESSION['rentId'];
    $rentquery = "select * from tblrenttable where rent_id=$id";
    $getrent = mysqli_query($conn, $rentquery);
    $rentrow = mysqli_fetch_array($getrent);
    $name = $rentrow['tenant_name'];
    $photo=$rentrow['tenant_photo'];
    $type="Tenant";
}

?>
<!DOCTYPE html>
<html>

<head>
    
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
    <link href='https://fonts.googleapis.com/css?family=Gurajada' rel='stylesheet'>
    <link href="./assets/css/testing.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <style>
        .btnDownload {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 9px 10px;
            cursor: pointer;
            font-size: 13px;
            border-radius: 5px;
        }

        .chat_window {
                position: absolute;
                width: calc(100% - 20px);
                max-width: 900px;
                height: 500px;
                border-radius: 10px;
                background-color: #fff;
                left: 50%;
                top: 50%;
                transform: translateX(-50%) translateY(-45%);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
                background-color: #f8f8f8;
                overflow: hidden;
            }

            .top_menu {
                background-color: #fff;
                width: 100%;
                padding: 20px 0 15px;
                box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
            }
            .top_menu .buttons {
                margin: 3px 0 0 20px;
                position: absolute;
            }
            .top_menu .buttons .button {
                width: 16px;
                height: 16px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 10px;
                position: relative;
            }
            .top_menu .buttons .button.close {
                background-color: #f5886e;
            }
            .top_menu .buttons .button.minimize {
                background-color: #fdbf68;
            }
            .top_menu .buttons .button.maximize {
                background-color: #a3d063;
            }
            .top_menu .title {
                text-align: center;
                color: #bcbdc0;
                font-size: 20px;
            }

            .messages {
                position: relative;
                list-style: none;
                padding: 20px 10px 0 10px;
                margin: 0;
                height: 347px;
                overflow: scroll;
            }
            .messages .message {
                clear: both;
                overflow: hidden;
                margin-bottom: 20px;
                transition: all 0.5s linear;
                opacity: 0;
            }
            .messages .message.left .avatar {
                background-color: #f5886e;
                float: left;
            }
            .messages .message.left .text_wrapper {
                background-color: #ffe6cb;
                margin-left: 20px;
            }
            .messages .message.left .text_wrapper::after, .messages .message.left .text_wrapper::before {
                right: 100%;
                border-right-color: #ffe6cb;
            }
            .messages .message.left .text {
                color: #c48843;
            }
            .messages .message.right .avatar {
                background-color: #fdbf68;
                float: right;
            }
            .messages .message.right .text_wrapper {
                background-color: #c7eafc;
                margin-right: 20px;
                float: right;
            }
            .messages .message.right .text_wrapper::after, .messages .message.right .text_wrapper::before {
                left: 100%;
                border-left-color: #c7eafc;
            }
            .messages .message.right .text {
                color: #45829b;
            }
            .messages .message.appeared {
                opacity: 1;
            }
            .messages .message .avatar {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: inline-block;
            }
            .messages .message .text_wrapper {
                display: inline-block;
                padding: 20px;
                border-radius: 6px;
                width: calc(100% - 85px);
                min-width: 100px;
                position: relative;
            }
            .messages .message .text_wrapper::after, .messages .message .text_wrapper:before {
                top: 18px;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
            }
            .messages .message .text_wrapper::after {
                border-width: 13px;
                margin-top: 0px;
            }
            .messages .message .text_wrapper::before {
                border-width: 15px;
                margin-top: -2px;
            }
            .messages .message .text_wrapper .text {
                font-size: 18px;
                font-weight: 300;
            }

            .bottom_wrapper {
                position: relative;
                width: 100%;
                background-color: #fff;
                padding: 20px 20px;
                position: absolute;
                bottom: 0;
            }
            .bottom_wrapper .message_input_wrapper {
                display: inline-block;
                height: 50px;
                border-radius: 25px;
                border: 1px solid #bcbdc0;
                width: calc(100% - 160px);
                position: relative;
                padding: 0 20px;
            }
            .bottom_wrapper .message_input_wrapper .message_input {
                border: none;
                height: 100%;
                box-sizing: border-box;
                width: calc(100% - 40px);
                position: absolute;
                outline-width: 0;
                color: gray;
            }
            .bottom_wrapper .send_message {
                width: 140px;
                height: 50px;
                display: inline-block;
                border-radius: 50px;
                background-color: 	#800080;
                border: 2px solid 	#800080;
                color: #fff;
                cursor: pointer;
                transition: all 0.2s linear;
                text-align: center;
                float: right;
            }
            .bottom_wrapper .send_message:hover {
                color: #a3d063;
                background-color: 	#800080;
            }
            .bottom_wrapper .send_message .text {
                font-size: 18px;
                font-weight: 300;
                display: inline-block;
                line-height: 48px;
            }

            .message_template {
                display: none;
            }

        

        /* Darker background on mouse-over DownLoad Button */
        .btnDownload:hover {
            background-color: RoyalBlue;
        }

        .btn-info {
            background-color: MediumSeaGreen;
            border: none;
            color: white;
            padding: 9px 10px;
            cursor: pointer;
            font-size: 13px;
            border-radius: 5px;
        }

        .btn-info:hover {
            background-color: SeaGreen;
        }

        .formclass{
            align-content: center;
            align-items: center;
            margin-left: 15%;
            margin-right: 10%;
            margin-top: 5%;
            width: 70%;
            opacity: 90%;
        }

        .chip {
		  display: inline-block;
		  
		  padding: 0 20px;
		 
		  height: 50px;
		  font-size: 16px;
		  margin-right:20px;
		  
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

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 450px) {
            #pa {
                padding-left: 10%;
            }

            .c1 {
                width: 300px !important;
            }

            .form-control {
                width: 300px !important;
            }

            .a1 {
                width: 300px !important;
            }
        }


        @media screen and (max-width: 450px) {
            .c2 {
                width: 145% !important;
            }
        }

        .table1 {
            display: table;
            width: auto;

        }

        .table1-row {
            display: table-row;
            width: auto;
            clear: both;
        }

        .table1-col {
            float: left;
            display: table-column;
            width: 225px;
        }

        .table3-col {
            float: left;
            display: table-column;
            width: 180px;
        }

        .table2-col {
            float: left;
            display: table-column;
            width: 250px;
        }

        @media screen and (max-width: 450px) {
            .table-col {
                width: 160px !important;
            }

            .c3 {
                float: left !important;
            }
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-sm bg- navbar-dark" style="background-color: #2F4F4F; ">
        <!-- Brand/logo -->


        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <a href="payment.php"><i class="material-icons">payment</i> Pay Bills</a>
            <a href="noticeboard.php"><i class="material-icons">calendar_today</i> Notice Board</a>
            <a href="event.php"><i class="material-icons">event_available</i> Request Events</a>
            <a href="show_event.php"><i class="material-icons">event</i> Show Events</a>
            <a href="Chatbox.php"><i class="material-icons">question_answer</i> Chat/Forum</a>
            <a href="view_complaint.php"><i class="material-icons">how_to_vote</i> Complaint Box</a>
            <a href="complaint.php"><i class="material-icons">rate_review</i> Register Complaint</a>
            <a href="lost_found.php"><i class="material-icons">find_in_page</i> Lost & Found</a>
            <a href="visitors.php"><i class="material-icons">contacts</i> Visitors Entry</a>
            <a href="view_visitors.php"><i class="material-icons">meeting_room</i> Visitors History</a>
            <a href="view_maids.php"><i class="material-icons">account_circle</i> Maids Details</a>
        </div>

        <span style="font-size:30px;cursor:pointer;color: white" onclick="openNav()">&#9776;</span>

        <div class="container-fluid">
            <div class="row" id="heading">
                <div class="col-sm-3"></div>
                <div class="col-sm-3 col-sm-offset-6">
                <a class="navbar-brand" href="#"><b style="font-family:Gurajada; font-size:40px;">My Society</b></a>

                </div>
            </div>
            <div >
            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" style="float: right; margin-top:6px;">Logout</button>
				<div class="chip">
				  <img src="images/profile/<?php echo $photo;?>" alt="Person" width="50" height="50">
				 <b> <?php echo $name;?></b><br>
				  <a style="font-family:calibre; font-size:13px; text-align:center; padding-top:5px;">    <?php echo $type;?></a>
				</div>
                <!-- <p style="float: right; color:white; font-size: 15px; margin-right: 10px; margin-top: 10px;"><?php echo $name;?></p> -->
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