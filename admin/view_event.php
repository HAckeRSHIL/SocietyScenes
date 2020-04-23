<?php include("header.php"); 

if (isset($_POST['reject'])) {
    $sid1 = $_POST['id'];
    $query = "update tblevent set isApproved=-1 where event_id=$sid1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Event Rejected')</script>";
        echo "<script>window.location='view_event.php'</script>";
    }
}

if (isset($_POST['accept'])) {
    $sid1 = $_POST['id'];
    $amount=$_POST['amount'];
    $query = "update tblevent set isApproved=1,amount='$amount' where event_id=$sid1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Event Accepted')</script>";
        echo "<script>window.location='view_event.php'</script>";
    }
}

?>

<div class="row">
    <div class="col-sm-12" style=" height:50px; ">



    </div>

</div>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Block No</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "select * from tblevent where isApproved=0 order by event_id desc";
                $get = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($get)) {
                    $eid=$row['event_id'];
                    $id = $row['owner_id'];
                    $type = $row['type'];
                    $event_title = $row['event_name'];
                    $desc = $row['desceiption'];
                    $start_date=$row['event_date'];
                    $end_date=$row['end_date'];
                    $name=$row['name'];
                    $location=$row['location'];
                    $start_time=$row['start_time'];
                    $end_time=$row['complete_time'];

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
                        <td><?php echo $event_title; ?></td>
                        <td><?php echo $start_date; ?></td>

                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventviewmodal<?php echo $eid;?>"> View </button></td>

                    </tr>

                    <div class="modal" id="eventviewmodal<?php echo $eid;?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Event Request</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body" style="font-family: verdana;">
                                    <b style="font-size: 20px;">Title</b> <br>
                                    <span style="font-size: 18px;"> <?php echo $event_title;?></span>
                                    <hr>
                                    <div class="table1">
                                        <div class="table1-row">
                                            <div class="table1-col">
                                                <p><b style="font-family:Verdana;">Name</b>
                                            </div>
                                            <div class="table2-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $name; ?>
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
                                                <p><b style="font-family:Verdana;">Starting date</b></p>
                                            </div>
                                            <div class="table1-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $start_date; ?></p>
                                            </div>
                                        </div>
                                        <div class="table1-row">
                                            <div class="table1-col">
                                                <p><b style="font-family:Verdana;">Start Time</b></p>
                                            </div>
                                            <div class="table1-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $start_time; ?></p>
                                            </div>
                                        </div>
                                        <div class="table1-row">
                                            <div class="table1-col">
                                                <p><b style="font-family:Verdana;">Ending date</b></p>
                                            </div>
                                            <div class="table1-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $end_date; ?></p>
                                            </div>
                                        </div>
                                        <div class="table1-row">
                                            <div class="table1-col">
                                                <p><b style="font-family:Verdana;">End Time</b></p>
                                            </div>
                                            <div class="table1-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $end_time; ?></p>
                                            </div>
                                        </div>
                                        <div class="table1-row">
                                            <div class="table1-col">
                                                <p><b style="font-family:Verdana;">Location</b></p>
                                            </div>
                                            <div class="table1-col">
                                                <p style="font-size: 13px;margin-top: 3px;">: <?php echo $location; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr><b>Description</b> <br>
                                    <?php echo $desc;?>
                                    <hr>
                                    <b>Amount</b><br>
                                    <form action="view_event.php" method="POST">
                                        <input type="hidden" value="<?php echo $eid; ?>" name="id" />
                                        <input type="number" class="form-control" name="amount" placeholder="Rs. 1000" required/>
                                        <br>
                                        <input type="submit" class="btn btn-success" name="accept" value="Accept" style="float:right; margin-right:5px;"/>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form action="view_event.php" method="POST">
                                        <input type="hidden" value="<?php echo $eid;?>" name="id"/> 
                                        <input type="submit" class="btn btn-danger" name="reject" value="Reject"/>
                                    </form>
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
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>View</th>

                </tr>
            </tfoot>
        </table>



    </div>
    <div class="col-sm-2"></div>
</div>

<div id="main">
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $('#example tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#button').click(function() {
                table.row('.selected').remove().draw(false);
            });
        });
    </script>
</div>
</body>

</html>