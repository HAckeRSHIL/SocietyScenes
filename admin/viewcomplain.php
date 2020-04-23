<?php include("header.php"); ?>

<?php

if (isset($_POST['accept'])) {
    $cid1 = $_POST['id'];
    $replymsg = $_POST['replymsg'];
    $current = date("Y-m-d", time());
    $iquery = "INSERT INTO `tblreply`(`complaint_id`, `reply`, `reply_date`) VALUES ($cid1,'$replymsg','$current')";
    $igetquery = mysqli_query($conn, $iquery);

    $query = "update tblcomplaint set status='Processing' where complaint_id=$cid1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Complain Processing.....')</script>";
        echo "<script>window.location='viewcomplain.php'</script>";
    }
}

if (isset($_POST['Solved'])) {
    $cid1 = $_POST['id'];
    $replymsg = $_POST['replymsg'];
    $current = date("Y-m-d", time());
    $iquery = "INSERT INTO `tblreply`(`complaint_id`, `reply`, `reply_date`) VALUES ($cid1,'$replymsg','$current')";
    $igetquery = mysqli_query($conn, $iquery);

    $query = "update tblcomplaint set status='Completed' where complaint_id=$cid1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Complain Completed')</script>";
        echo "<script>window.location='viewcomplain.php'</script>";
    }
}

if (isset($_POST['reject'])) {
    $cid1 = $_POST['id'];
    $replymsg = $_POST['replymsg'];
    $current = date("Y-m-d", time());
    $iquery = "INSERT INTO `tblreply`(`complaint_id`, `reply`, `reply_date`) VALUES ($cid1,'$replymsg','$current')";
    $igetquery = mysqli_query($conn, $iquery);

    $query = "update tblcomplaint set status='Rejected' where complaint_id=$cid1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Complain Rejected')</script>";
        echo "<script>window.location='viewcomplain.php'</script>";
    }
}

?>
<div id="main">
    <div class="container">
        <h2 style="text-align: center;margin: 10px;">Complaint Box</h2>
        <br>
        <!-- Nav pills -->
        <div style="padding-left: 3%">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#latest">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#processing">Processing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#completed">Completed</a>
                </li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="latest" class="container tab-pane active"><br>
                <div class="container">
                    <div class="jumbotron">

                        <center>
                            <table id="example" class="row-border hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Complaint Date</th>
                                        <th>Location</th>
                                        <th>View</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from tblcomplaint where status='Pending' order by complaint_id desc";
                                    $getquery = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($getquery)) {
                                        $cid = $row['complaint_id'];
                                        $type = $row['owner_type'];
                                        $id = $row['owner_id'];
                                        $name = $row['name'];
                                        $title = $row['subject'];
                                        $id = $row['owner_id'];
                                        $date = $row['complaint_date'];
                                        $location = $row['location'];
                                        $photo1 = $row['photo1'];
                                        $photo2 = $row['photo2'];
                                        $description = $row['description'];
                                        $incident_date = $row['incident_date'];
                                        $outcomes = $row['outcomes'];

                                        if ($type == "Owner") {
                                            $ownerquery = "select * from tblregistration where owner_id=$id";
                                            $getownerquery = mysqli_query($conn, $ownerquery);
                                            $ownerrow = mysqli_fetch_array($getownerquery);
                                            $plot = $ownerrow['plot_no'];
                                        } else if ($type == "Rent") {
                                            $rentquery = "select  tr.plot_no from tblrenttable trt,tblregistration tr where tr.owner_id=trt.owner_id and trt.rent_id=$id";
                                            $getrent = mysqli_query($conn, $rentquery);
                                            $rentrow = mysqli_fetch_array($getrent);
                                            $plot = $rentrow['plot_no'];
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $plot; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $location; ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pendingmodal<?php echo $cid; ?>"> View </button></td>
                                        </tr>

                                        <div class="modal" id="pendingmodal<?php echo $cid; ?>">
                                            <div class="modal-dialog modal-lg" style="text-align: left;">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Complaint Description</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="font-family: verdana;">
                                                        <div class="table1">
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Name</b>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 2px;">: <?php echo $name; ?>
                                                                </div>

                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Block No.</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $plot; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Complain Title</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $title; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Date of Incident</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $incident_date; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Incident Location</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $location; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr><b>Description</b> <br>
                                                        <?php echo $description; ?>
                                                        <hr> <b>Desired Outcome</b> <br>
                                                        <?php echo $outcomes; ?>


                                                        <?php if ($photo1 != null && $photo2 != null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">&nbsp;&nbsp;<img src="../images/complaint/<?php echo $photo2; ?>" style="width: 330px;">
                                                        <?php } else if ($photo1 != null && $photo2 == null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">
                                                        <?php } ?>
                                                        <hr>
                                                        <b>Reply</b><br>
                                                        <form action="viewcomplain.php" method="POST">
                                                            <input type="hidden" value="<?php echo $cid; ?>" name="id" />
                                                            <textarea class="form-control" name="replymsg" rows="5" col="20" required></textarea>
                                                            <br>
                                                            <input type="hidden" value="<?php echo $cid; ?>" name="id" />
                                                            <input type="submit" class="btn btn-danger" name="reject" value="Reject" style="float:right;"/>
                                                            <input type="submit" class="btn btn-success" name="accept" value="Accept" style="float:right; margin-right:5px;"/>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>View</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </center>

                    </div>

                </div>
            </div>
            <div id="processing" class="container tab-pane fade"><br>
                <div class="container">
                    <div class="jumbotron">

                        <center>
                            <table id="example1" class="row-border hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>View</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from tblcomplaint where status='Processing' order by complaint_id desc";
                                    $getquery = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($getquery)) {
                                        $cid = $row['complaint_id'];
                                        $type = $row['owner_type'];
                                        $id = $row['owner_id'];
                                        $name = $row['name'];
                                        $title = $row['subject'];
                                        $id = $row['owner_id'];
                                        $date = $row['complaint_date'];
                                        $location = $row['location'];
                                        $photo1 = $row['photo1'];
                                        $photo2 = $row['photo2'];
                                        $description = $row['description'];
                                        $incident_date = $row['incident_date'];
                                        $outcomes = $row['outcomes'];

                                        if ($type == "Owner") {
                                            $ownerquery = "select * from tblregistration where owner_id=$id";
                                            $getownerquery = mysqli_query($conn, $ownerquery);
                                            $ownerrow = mysqli_fetch_array($getownerquery);
                                            $plot = $ownerrow['plot_no'];
                                        } else if ($type == "Rent") {
                                            $rentquery = "select  tr.plot_no from tblrenttable trt,tblregistration tr where tr.owner_id=trt.owner_id and trt.rent_id=$id";
                                            $getrent = mysqli_query($conn, $rentquery);
                                            $rentrow = mysqli_fetch_array($getrent);
                                            $plot = $rentrow['plot_no'];
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $plot; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $location; ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#processingmodal<?php echo $cid; ?>"> View </button></td>
                                        </tr>

                                        <div class="modal" id="processingmodal<?php echo $cid; ?>">
                                            <div class="modal-dialog modal-lg" style="text-align: left;">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Complaint Description</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="font-family: verdana;">
                                                        <div class="table1">
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Name</b>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 2px;">: <?php echo $name; ?>
                                                                </div>

                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Block No.</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $plot; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Complain Title</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $title; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Date of Incident</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $incident_date; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Incident Location</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $location; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr><b>Description</b> <br>
                                                        <?php echo $description; ?>
                                                        <hr> <b>Desired Outcome</b> <br>
                                                        <?php echo $outcomes; ?>


                                                        <?php if ($photo1 != null && $photo2 != null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">&nbsp;&nbsp;<img src="../images/complaint/<?php echo $photo2; ?>" style="width: 330px;">
                                                        <?php } else if ($photo1 != null && $photo2 == null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">
                                                        <?php } ?>
                                                        <hr>
                                                        <b>Reply</b><br>
                                                        <form action="viewcomplain.php" method="POST">
                                                            <input type="hidden" value="<?php echo $cid; ?>" name="id" />
                                                            <textarea class="form-control" name="replymsg" rows="5" col="20" required></textarea>
                                                            <br>
                                                            <input type="hidden" value="<?php echo $cid; ?>" name="id" />
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="float:right;">Close</button>
                                                            <input type="submit" class="btn btn-success" name="Solved" value="Solved" style="float:right; margin-right:5px;"/>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>View</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </center>

                    </div>

                </div>

            </div>

            <div id="completed" class="container tab-pane fade"><br>
                <div class="container">
                    <div class="jumbotron">

                        <center>
                            <table id="example2" class="row-border hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from tblcomplaint where status='Completed' or status='Rejected' order by complaint_id desc";
                                    $getquery = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($getquery)) {
                                        $cid = $row['complaint_id'];
                                        $status = $row['status'];
                                        $type = $row['owner_type'];
                                        $id = $row['owner_id'];
                                        $name = $row['name'];
                                        $title = $row['subject'];
                                        $id = $row['owner_id'];
                                        $date = $row['complaint_date'];
                                        $location = $row['location'];
                                        $photo1 = $row['photo1'];
                                        $photo2 = $row['photo2'];
                                        $description = $row['description'];
                                        $incident_date = $row['incident_date'];
                                        $outcomes = $row['outcomes'];

                                        if ($type == "Owner") {
                                            $ownerquery = "select * from tblregistration where owner_id=$id";
                                            $getownerquery = mysqli_query($conn, $ownerquery);
                                            $ownerrow = mysqli_fetch_array($getownerquery);
                                            $plot = $ownerrow['plot_no'];
                                        } else if ($type == "Rent") {
                                            $rentquery = "select  tr.plot_no from tblrenttable trt,tblregistration tr where tr.owner_id=trt.owner_id and trt.rent_id=$id";
                                            $getrent = mysqli_query($conn, $rentquery);
                                            $rentrow = mysqli_fetch_array($getrent);
                                            $plot = $rentrow['plot_no'];
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $plot; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $location; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completedmodal<?php echo $cid; ?>"> View </button></td>
                                        </tr>

                                        <div class="modal" id="completedmodal<?php echo $cid; ?>">
                                            <div class="modal-dialog modal-lg" style="text-align: left;">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Complaint Description</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="font-family: verdana;">
                                                        <div class="table1">
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Name</b>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 2px;">: <?php echo $name; ?>
                                                                </div>

                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Block No.</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $plot; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Complain Title</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $title; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Date of Incident</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $incident_date; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="table1-row">
                                                                <div class="table1-col">
                                                                    <p><b style="font-family:Verdana;">Incident Location</b></p>
                                                                </div>
                                                                <div class="table1-col">
                                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $location; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr><b>Description</b> <br>
                                                        <?php echo $description; ?>
                                                        <hr> <b>Desired Outcome</b> <br>
                                                        <?php echo $outcomes; ?>


                                                        <?php if ($photo1 != null && $photo2 != null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">&nbsp;&nbsp;<img src="../images/complaint/<?php echo $photo2; ?>" style="width: 330px;">
                                                        <?php } else if ($photo1 != null && $photo2 == null) { ?>
                                                            <hr> <b>Photos</b> <br>

                                                            &nbsp;<img src="../images/complaint/<?php echo $photo1; ?>" style="width: 330px;">
                                                        <?php } ?>
                                                        <hr>
                                                        <b>Reply</b><br>
                                                        <form action="viewcomplain.php" method="POST">
                                                            <input type="hidden" value="<?php echo $cid; ?>" name="id" />
                                                            <textarea class="form-control" name="replymsg" rows="5" col="20" required></textarea>
                                                            <br>
                                                            <input type="submit" class="btn btn-primary float-right" name="send" value="Send">
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Block No</th>
                                        <th>Name</th>
                                        <th>Complaint Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </center>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable();

        $('#example tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
    });

    $(document).ready(function() {
        var table = $('#example2').DataTable();

        $('#example tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
    });

    $(document).ready(function() {
        var table = $('#example').DataTable();

        $('#example tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
    });
</script>
</body>

</html>