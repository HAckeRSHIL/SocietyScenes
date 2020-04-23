<?php include("header.php"); ?>
<div id="main">

    <div class="formclass">
        <div class="jumbotron" style="background-color: #C1C8E4;">
            <div class="container-fluid">
                <h2>
                    <center>Event Form</center>
                </h2>
                <form action="event.php" class="needs-validation" novalidate method="POST">
                    <div class="form-group">
                        <label for="name"><b>Full name:</b></label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="Event name"><b>Event name:</b></label>
                        <input type="text" class="form-control" id="ename" placeholder="Enter event name" name="ename" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="ComplaintDetails"><b>Event Description:</b></label>
                        <textarea class="form-control" rows="5" id="eventDetail" placeholder="Eg. navratri celebration " name="edes"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date"><b>Starting Date of the event:</b></label>
                        <input type="date" class="form-control" placeholder="dd-mm-yy" required name="sdate">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="time"><b>Starting time of the event:</b></label>
                        <input type="time" class="form-control" placeholder="enter starting time" required name="estime">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="date"><b>Ending Date of the event:</b></label>
                        <input type="date" class="form-control" placeholder="dd-mm-yy" required name="edate">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="time"><b>Ending time of the event:</b></label>
                        <input type="time" class="form-control" placeholder="enter ending time" required name="eetime">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="vehicle type"><b>Location:</b></label>
                        <select class="form-control" name="incidentLocation">
                            <option value="Clubhouse">Clubhouse</option>
                            <option value="Garden">Garden</option>
                            <option value="Common Plot">Common Plot</option>
                            <option value="Terrace">Terrace</option>
                            <option value="Temple">Temple</option>
                            <option value="A block hall">A block hall</option>
                            <option value="B block hall">B block hall</option>
                            <option value="C block hall">C block hall</option>
                        </select>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <center><button type="submit" class="btn btn-primary" name="submit">Submit</button></center>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
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

if (isset($_SESSION['ownerId'])) {
    $id = $_SESSION['ownerId'];
    $type = "Owner";
}

if (isset($_SESSION['rentId'])) {
    $id = $_SESSION['rentId'];
    $type = "Rent";
}
if (isset($_POST['submit'])) {
    $name = $_POST['uname'];
    $title = $_POST['ename'];
    $desc = $_POST['edes'];
    $start_date1 = $_POST['sdate'];
    $end_date1 = $_POST['edate'];
    $start_time1 = $_POST['estime'];
    $end_time1 = $_POST['eetime'];
    $location = $_POST['incidentLocation'];
    echo $location;
    date_default_timezone_set("Asia/Calcutta");
    $start_time = date('H:i:s', strtotime($start_time1));
    $end_time = date('H:i:s', strtotime($end_time1));
    $start_date = date("Y-m-d", strtotime($start_date1));
    $end_date = date("Y-m-d", strtotime($end_date1));

    $query = "select * from tblevent where isApproved=1";
    $get = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($get)) {
        $event_date1 = $row['event_date'];
        $end_date1 = $row['end_date'];
        $start_time1 = $row['start_time'];
        $complete_time = $row['complete_time'];
        $location1 = $row['location'];
        $client_date = $start_date . " " . $start_time;
        $client_end_time = $end_date . " " . $end_time;

        $admin_date = $event_date1 . " " . $start_time1;
        $admin_end_time = $end_date1 . " " . $complete_time;

        
        if ($location1 == $location) {
            if ($client_date > $admin_date) {
                if ($client_end_time < $admin_end_time) {
                    echo "<script>alert('Location Not Available For Given Date and Time')</script>";
                    echo "<script>window.location='event.php'</script>";
                }
            }
        }
    }

    $query = "insert into tblevent (`owner_id`, `event_name`, `desceiption`, `event_date`, `end_date`, `start_time`, `complete_time`, `name`, `location`,`type`) values ($id,'$title','$desc','$start_date','$end_date','$start_time','$end_time','$name','$location','$type')";
    echo $query;
    $get = mysqli_query($conn, $query);
    if ($get) {
        echo "<script>alert('Event Successfully Send to the Admin')</script>";
        echo "<script>window.location='event.php'</script>";
    } else {
        echo "<script>alert('Event Not Successfully Send to the Admin')</script>";
    }
}
?>