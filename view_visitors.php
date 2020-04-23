<?php include("header.php"); ?>
<?php

if(isset($_GET['id'])){
    $id=$_GET['id'];

    $query="select parking_number from tblvisitors where visitor_id=$id";
    $get=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($get);
    $parking_number=$row['parking_number'];
    date_default_timezone_set("Asia/Calcutta");
    $time=date("Y-m-d H:i:s");
    $array=explode('-',$parking_number);

    //echo "<script>alert('$time');</script>";
    $query="update tblparking_plot set status=0 where plot_name='$array[0]' and plot_no=$array[1]";
    $get=mysqli_query($conn,$query);

    $query="update tblvisitors set exit_time='$time' where visitor_id=$id";
    $get=mysqli_query($conn,$query);
    echo "<script>window.location='view_visitors.php'</script>";
}
?>

<div id="main">
    <div class="container">
        <h2 style="text-align: center;margin: 10px;">Visitor Details</h2>
        <br>
        <!-- Nav pills -->
        <div style="padding-left: 3%">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#latest">Parked</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#processing">Exited</a>
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
                                        <th>Visitor Name</th>
                                        <th>Contact number</th>
                                        <th>Owner block number</th>
                                        <th>Vehicle Number</th>
                                        <th>Parking Slot</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from tblvisitors where exit_time is null";
                                    $get = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($get)) {
                                        $vid = $row['visitor_id'];
                                        $vname = $row['visitor_name'];
                                        $vmob = $row['mobile_no'];
                                        $vrel = $row['relation'];
                                        $vreason = $row['reason'];
                                        $vplot = $row['plot_no'];
                                        $vcount = $row['total_visitors'];
                                        $vnum = $row['vehicle_no'];
                                        $vpnum = $row['parking_number'];
                                        $vemail = $row['email_id'];
                                        $vtype = $row['vehicle_type'];
                                    ?>
                                        <tr>
                                            <td><?php echo $vname; ?></td>
                                            <td><?php echo $vmob; ?></td>
                                            <td><?php echo $vplot; ?></td>
                                            <td><?php echo $vnum; ?></td>
                                            <td><?php echo $vpnum; ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#parkmodal<?php echo $vid; ?>"> View </button></td>
                                        </tr>
                                        <div class="modal" id="parkmodal<?php echo $vid; ?>">
                                            <div class="modal-dialog modal-lg" style="text-align: left;">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Visitors Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="font-family: verdana;">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Name</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vname; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Mobile number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vmob; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Email ID</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vemail; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Block Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vplot; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Relation</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vrel; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Vehicle Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vnum; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Vehicle Type</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vtype; ?>-Wheeler</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Parking Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vpnum; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Total Number Of Visitor</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vcount; ?></p>
                                                            </div>
                                                        </div>
                                                        <h6>
                                                            <hr><b>Reason for visit</b> <br></h6>
                                                            <?php echo $vreason; ?>


                                                        <br>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <a href="view_visitors.php?id=<?php echo $vid;?>"><button type="submit" class="btn btn-info float-right">Free The Spot</button></a>
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Visitor Name</th>
                                        <th>Contact number</th>
                                        <th>Owner block number</th>
                                        <th>Vehicle Number</th>
                                        <th>Parking Slot</th>
                                        <th></th>
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
                                        <th>Visitor Name</th>
                                        <th>Contact number</th>
                                        <th>Owner block number</th>
                                        <th>Vehicle Number</th>
                                        <th>Exit Time</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query = "select * from tblvisitors where exit_time is not null and status=0";
                                    $get = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($get)) {
                                        $vid = $row['visitor_id'];
                                        $vname = $row['visitor_name'];
                                        $vmob = $row['mobile_no'];
                                        $vrel = $row['relation'];
                                        $vreason = $row['reason'];
                                        $vplot = $row['plot_no'];
                                        $vcount = $row['total_visitors'];
                                        $vnum = $row['vehicle_no'];
                                        $vpnum = $row['parking_number'];
                                        $vemail = $row['email_id'];
                                        $vtype = $row['vehicle_type'];
                                        $date=$row['exit_time'];
                                        $current = date("Y-m-d", time());
                                        $time = strtotime($date);
                                        $final = date("Y-m-d", strtotime("+6 month", $time));
                                        
                                            if($current>$final){
                                                $query3="update tblvisitors set status=1 where visitor_id=$vid";
                                                $get1=mysqli_query($conn,$query3);
                                            }     
                                    ?>
                                    <tr>
                                    <td><?php echo $vname; ?></td>
                                            <td><?php echo $vmob; ?></td>
                                            <td><?php echo $vplot; ?></td>
                                            <td><?php echo $vnum; ?></td>
                                            <td><?php echo $row['exit_time']; ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exitmodal<?php echo $vid; ?>"> View </button></td>
                                    </tr>
                                    <div class="modal" id="exitmodal<?php echo $vid; ?>">
                                            <div class="modal-dialog modal-lg" style="text-align: left;">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Visitors Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body" style="font-family: verdana;">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Name</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vname; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Mobile number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vmob; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Visitor Email ID</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vemail; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Block Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vplot; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Relation</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vrel; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Vehicle Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vnum; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Vehicle Type</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vtype; ?>-Wheeler</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Parking Number</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vpnum; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6>Total Number Of Visitor</h6>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p>: <?php echo $vcount; ?></p>
                                                            </div>
                                                        </div>
                                                        <h6>
                                                            <hr><b>Reason for visit</b> <br></h6>
                                                            <?php echo $vreason; ?>


                                                        <br>
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
                                        <th>Visitor Name</th>
                                        <th>Contact number</th>
                                        <th>Owner block number</th>
                                        <th>Vehicle Number</th>
                                        <th>Exit Time</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </center>

                    </div>

                </div>

            </div>


            <!-- The Modal -->


            <!-- The Modal -->
            <div class="modal" id="exitmodal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Visitors Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" style="font-family: verdana;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Visitor Name</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: Harshillllll</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Visitor Mobile number</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: 9191919191</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Visitor Email ID</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: Harshil@gmail.com</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Block Number</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: A-101</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Relation</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: Brother</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Vehicle Number</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: GJ-01-SJ-1999</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Vehicle Type</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: 2-Wheeler</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Parking Number</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: AV-10</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <h6>Total Number Of Visitor</h6>
                                </div>
                                <div class="col-sm-4">
                                    <p>: 4</p>
                                </div>
                            </div>
                            <h6>
                                <hr><b>Reason for visit</b> <br></h6>
                            Living in a housing society is akin to being in a committed relationship, except it gets murkier when things go awry as they sometimes do. We’ve all been in catch 22 situations where if a problem persists, we are damned if we try to solve it and damned if we don’t. After all, it is better to resolve a conflict or dispute peacefully in a way that is acceptable to both parties. This post covers the different problems that may arise for members in a housing society and various ways for redressal.


                            <br>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>



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