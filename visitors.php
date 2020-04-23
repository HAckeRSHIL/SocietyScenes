<?php include("header.php"); ?>

<div id="main">

    <div class="formclass">
        <div class="jumbotron" style="background-color:#C1C8E4">
            <div class="container-fluid">

                <h2>
                    <center>Visitors Form</center>
                </h2>
                <form action="visitors.php" class="needs-validation" novalidate method="POST">
                    <div class="form-group">
                        <label for="name"><b>Visitor Full name:</b></label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter Name" name="uname" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="name"><b>Visitor Email ID:</b></label>
                        <input type="email" class="form-control" id="ename" placeholder="Enter Email ID" name="ename" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="number"><b> Visitor Mobile number:</b></label>
                        <input type="text" class="form-control" id="num" placeholder="Enter mobile number" name="num" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <label for="bno"><b>Block number</b></label>
                    <select class="form-control" name="utype">
                        <?php
                        $query = "select * from tblregistration";
                        $get = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($get)) {
                            $plot = $row['plot_no'];
                        ?>
                            <option value="<?php echo $plot ?>"><?php echo $plot ?></option>
                        <?php } ?>
                    </select>

                    <div class="form-group">
                        <label for="number"><b> Owner Name:</b></label>
                        <input type="text" class="form-control" id="num" placeholder="Enter Name" name="ownername" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="relation"><b>Relation:</b></label>
                        <input type="text" class="form-control" id=u"rel" placeholder="Enter relation with owner" name="rel" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="visitreason"><b>Reason for visit:</b></label>
                        <textarea class="form-control" rows="5" id="visitreason" placeholder="Eg. birthday celebration " name="reason"></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <label for="vehicle type"><b>Vehicle Type:</b></label>
                    <select class="form-control" name="vtype" value="Select option" style="width:300px;">
                        <option value="2">2-Wheeler</option>
                        <option value="4">4-Wheeler</option>
                    </select>

                    <div class="form-group">
                        <label for="name"><b>Vehicle Number:</b></label>
                        <input type="text" class="form-control" id="hnum" placeholder="Enter vehicle number:" name="hnum" required>
                    </div>

                    <div class="form-group">
                        <label for="numbervis"> <b>Number of visitors:</b></label>
                        <input type="number" class="form-control" placeholder="Total number of visitors" required name="vnum">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <center><button type="submit" name="submit" class="btn btn-primary">Submit</button></center>
                </form>
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

    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $vname = $_POST['uname'];
    $email = $_POST['ename'];
    $mobile = $_POST['num'];
    $plot_no = $_POST['utype'];
    $relation = $_POST['rel'];
    $reason = $_POST['reason'];
    $type = $_POST['vtype'];
    $ve_number = $_POST['hnum'];
    $visitor = $_POST['vnum'];
    $onwername = $_POST['ownername'];

    date_default_timezone_set("Asia/Calcutta");
    $time = date("Y-m-d H:i:s");

    if ($type == 2) {
        $query = "select * from tblparking_plot where status=0 and vechicle_type=$type and parking_type='Visitor'";
    } else if ($type == 4) {
        $query = "select * from tblparking_plot where status=0 and vechicle_type=$type and parking_type='Visitor'";
    }
    $get = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($get);
    $id = $row['plot_id'];
    $plot_name = $row['plot_name'];
    $plot_no1 = $row['plot_no'];

    $plot = $plot_name . "-" . $plot_no1;
    $query1 = "update tblparking_plot set status=1 where plot_id=$id";
    $getquery = mysqli_query($conn, $query1);

    $query = "INSERT INTO `tblvisitors`(`visitor_name`, `mobile_no`, `entry_time`, `relation`, `reason`, `plot_no`, `total_visitors`, `vehicle_no`, `parking_number`, `email_id`, `owner_name`, `vehicle_type`) VALUES ('$vname','$mobile','$date','$relation','$reason','$plot_no',$visitor,'$ve_number','$plot','$email','$onwername',$type)";
    $getquery = mysqli_query($conn, $query);
    echo "<script>alert('Parking Slot Alloted: $plot')</script>";
    echo "<script>window.location='view_visitors.php'</script>";
}
?>