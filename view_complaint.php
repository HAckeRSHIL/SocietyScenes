<?php include("header.php"); ?>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "delete from tblcomplaint where complaint_id=$id";
    $getid = mysqli_query($conn, $query);
}

if (isset($_GET['id1'])) {
    $id = $_GET['id1'];
    $query = "update tblcomplaint set status='Pending' where complaint_id=$id";
    $getid = mysqli_query($conn, $query);
}

if (isset($_SESSION['ownerId'])) {
    $type = "Owner";
    $getid = $_SESSION['ownerId'];
}

if (isset($_SESSION['rentId'])) {
    $type = "Rent";
    $getid = $_SESSION['rentId'];
}



?>
<div class="container">
    <h2 style="text-align: center;margin: 10px;">Complain History</h2>
    <br>
    <div class="jumbotron">
        <center>
            <table id="example1" class="row-border hover order-column" style="width:100%">
                <thead>
                    <tr>
                        <th>Complaint Title</th>
                        <th>Reported Date</th>
                        <th>Location</th>
                        <th>Date of incident</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Remove</th>
                        <th>Reopen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tblcomplaint where owner_id=$getid and owner_type='$type' order by complaint_id desc";
                    $getquery = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($getquery)) {
                        $cid = $row['complaint_id'];
                        $id = $row['owner_id'];
                        $status = $row['status'];
                        $cdate = $row['complaint_date'];
                        $idate = $row['incident_date'];
                        $location = $row['location'];
                        $subject = $row['subject'];
                        $name = $row['name'];
                        $desc = $row['description'];
                        $photo1 = $row['photo1'];
                        $photo2 = $row['photo2'];
                        $status1=$row['status1'];

                        $cddate=$row['complaint_date'];
                        $current = date("Y-m-d", time());
                        $time = strtotime($cddate);
                        $final = date("Y-m-d", strtotime("+2 month", $time));

                        if($current>$final){
                            $query3="update tblcomplaint set status1 = 1 where complaint_id=$cid and status='Completed' or status='Rejected' ";
                            $get1=mysqli_query($conn,$query3);
                        }

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
                            <td><?php echo $subject; ?></td>
                            <td><?php echo $cdate; ?></td>
                            <td><?php echo $location; ?></td>
                            <td><?php echo $idate; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewoldcomplain<?php echo $cid; ?>"> View
                                </button></td>
                            <td>
                                <a href="view_complaint.php?id=<?php echo $cid; ?>"><button type="button" class="btn btn-danger"><i class="material-icons">delete_forever</i></button></a>
                            </td>
                            <?php if($status1!=1){ ?>
                            <td>
                                <a href="view_complaint.php?id1=<?php echo $cid; ?>"><button type="button" class="btn btn-danger">Reopen</button></a>
                            </td>
                            <?php }else{ ?>
                                <td>
                                <button type="button" class="btn btn-danger" disabled>Reopen</button>
                            </td>
                            <?php }?>
                        </tr>
                        <div class="modal" id="viewoldcomplain<?php echo $cid; ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="text-align: left;">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Complaint Description</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body" style="font-family: verdana;">
                                        <div class="table1">
                                            <div class="table1-row">
                                                <div class="table3-col">
                                                    <p><b style="font-family:Verdana;">Name</b>
                                                </div>
                                                <div class="table2-col">
                                                    <p style="font-size: 13px;margin-top: 2px;">: <?php echo $name; ?>
                                                </div>

                                            </div>
                                            <div class="table1-row">
                                                <div class="table3-col">
                                                    <p><b style="font-family:Verdana;">Block No.</b></p>
                                                </div>
                                                <div class="table3-col">
                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $plot; ?></p>
                                                </div>
                                            </div>
                                            <div class="table1-row">
                                                <div class="table3-col">
                                                    <p><b style="font-family:Verdana;">Complain Title</b></p>
                                                </div>
                                                <div class="table3-col">
                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $subject; ?></p>
                                                </div>
                                            </div>
                                            <div class="table1-row">
                                                <div class="table3-col">
                                                    <p><b style="font-family:Verdana;">Date of Incident</b></p>
                                                </div>
                                                <div class="table3-col">
                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $idate; ?></p>
                                                </div>
                                            </div>
                                            <div class="table1-row">
                                                <div class="table3-col">
                                                    <p><b style="font-family:Verdana;">Incident Location</b></p>
                                                </div>
                                                <div class="table3-col">
                                                    <p style="font-size: 13px;margin-top: 3px;">: <?php echo $location; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr><b>Description</b> <br>
                                        <?php echo $desc; ?>
                                        <hr> <b>Desired Outcome</b> <br>
                                        <?php echo $row['outcomes']; ?>
                                        <?php if ($photo1 != null && $photo2 != null) { ?>
                                            <hr> <b>Photos</b> <br>

                                            &nbsp;<img src="./images/complaint/<?php echo $photo1; ?>" style="width: 330px;">&nbsp;&nbsp;<img src="./images/complaint/<?php echo $photo2; ?>" style="width: 330px;">
                                        <?php } else if ($photo1 != null && $photo2 == null) { ?>
                                            <hr> <b>Photos</b> <br>

                                            &nbsp;<img src="./images/complaint/<?php echo $photo1; ?>" style="width: 330px;">
                                        <?php } ?>
                                        <hr><b>Chat</b><br>
                                        <!-- this is admin comment-->
                                        <?php
                                        $query1 = "select * from tblreply where complaint_id=$cid";
                                        $getquery1 = mysqli_query($conn, $query1);
                                        while ($row1 = mysqli_fetch_array($getquery1)) {
                                            $reply = $row1['reply'];
                                            $date = $row1['reply_date'];
                                        ?>
                                        <div class="card">
                                            <div class="card-body">
                                                Admin<br><br>
                                                <blockquote class="blockquote mb-0">
                                                    <p style="font-size: 13px;"><?php echo $reply;?></p>
                                                    <div class="blockquote-footer" style="font-size: 10px; text-align: right;"><?php echo $date;?></div>
                                                </blockquote>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                        <th>Complaint Title</th>
                        <th>Reported Date</th>
                        <th>Location</th>
                        <th>Date of incident</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Remove</th>
                        <th>Reopen</th>
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
<!-- The Modal -->
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