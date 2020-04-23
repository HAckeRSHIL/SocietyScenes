<?php include("header.php"); ?>
<div class="container-fluid">
    <div id="main">

        <div class="formclass">
            <div class="jumbotron" style="background-color: #C1C8E4;">
                <div class="container-fluid">

                    <h2><center>Complaint Form</center></h2>
                    <br>
                    <form action="complaint.php" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-group">
                            <label for="name"><b>Full name:</b></label>
                            <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="date"><b>Date of the reported incident:</b></label>
                            <input type="date" class="form-control" placeholder="dd-mm-yy" name="incident_name" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="IncidentLocation"><b>Incident Location:</b></label>
                            <br>
                            <input type="text" class="form-control" name="incidentLocation" placeholder="Eg. Near A block" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="title"><b>Complaint Title:</b></label>
                            <br>
                            <input type="text" class="form-control" name="title" placeholder="Eg. Pipe Broke" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="ComplaintDetails"><b>Complaint Details:</b></label>
                            <textarea class="form-control" rows="5" id="ComplDetail" name="details" placeholder="Eg. Pipe is broke in A-block. "></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Desired Outcomes"><b>Desired Outcomes:</b></label>
                            <textarea class="form-control" rows="5" id="DesiredOutcomes" name="outcomes" placeholder="Eg. Pipe should be repaired in 5 minutes. XD"></textarea>
                        </div>
                        <div class="file-field">
                        <div class="btn blue-gradient btn-sm float-left">
                            <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i><b>Upload Photo 1</b></span>
                            <input type="file" name="file1" accept="image/*" multiple />
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                        <div class="file-field">
                        <div class="btn blue-gradient btn-sm float-left">
                            <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i><b>Upload Photo 2</b></span>
                            <input type="file" name="file2" accept="image/*" multiple />
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
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
        $date = $_POST['incident_name'];
        $timedate = strtotime($date);
        $incident_date = date("Y-m-d", $timedate);
        $location = $_POST['incidentLocation'];
        $title = $_POST['title'];
        $details = $_POST['details'];
        $outcomes = $_POST['outcomes'];
        $current = date("Y-m-d", time());

        if ($_FILES['file1']['name'] == "" && $_FILES['file2']['name'] == "") {
            $query = "insert into tblcomplaint (`owner_id`,`subject`,`description`,`complaint_date`,`name`,`incident_date`,`location`,`outcomes`,`owner_type`) values ($id,'$title','$details','$current','$name','$incident_date','$location','$outcomes','$type')";
            $get = mysqli_query($conn, $query);
            if ($get) {
                echo "<script>alert('Complaint Successfully Send to the Admin')</script>";
                echo "<script>window.location='complaint.php'</script>";
            } else {
                echo "<script>alert('Complaint Not Successfully Send to the Admin')</script>";
            }
        } else if (($_FILES['file1']['name'] == "" && $_FILES['file2']['name'] != "") || ($_FILES['file1']['name'] != "" && $_FILES['file2']['name'] == "")) {
            if ($_FILES['file2']['name'] != "") {
                $file = $_FILES['file2'];
            } else if ($_FILES['file1']['name'] != "") {
                $file = $_FILES['file1'];
            }

            if ($file['size'] <= 5000000) {
                $filename = rand(10, 100000) . "-" . $file["name"];
                move_uploaded_file($file["tmp_name"], "./images/complaint/" . $filename);

                $query = "insert into tblcomplaint (`owner_id`,`photo1`,`subject`,`description`,`complaint_date`,`name`,`incident_date`,`location`,`outcomes`,`owner_type`) values ($id,'$filename','$title','$details','$current','$name','$incident_date','$location','$outcomes','$type')";
                $get = mysqli_query($conn, $query);
                if ($get) {
                    echo "<script>alert('Complaint Successfully Send to the Admin')</script>";
                    echo "<script>window.location='complaint.php'</script>";
                } else {
                    echo "<script>alert('Complaint Not Successfully Send to the Admin')</script>";
                }
            } else {
                echo "<script>alert('File Size Up to 5 MB')</script>";
                echo "<script>window.location='complaint.php'</script>";
            }
        }
        else if($_FILES['file1']['name'] != "" && $_FILES['file2']['name'] != ""){
            if ($_FILES['file1']['size'] <= 5000000) {
                $filename1 = rand(10, 100000) . "-" . $_FILES["file1"]["name"];
                move_uploaded_file($_FILES["file1"]["tmp_name"], "./images/complaint/" . $filename1);

                if ($_FILES['file2']['size'] <= 5000000) {
                    $filename = rand(10, 100000) . "-" . $_FILES["file2"]["name"];
                    move_uploaded_file($_FILES["file2"]["tmp_name"], "./images/complaint/" . $filename);

                    
                $query = "insert into tblcomplaint (`owner_id`,`photo1`,`photo2`,`subject`,`description`,`complaint_date`,`name`,`incident_date`,`location`,`outcomes`,`owner_type`) values ($id,'$filename1','$filename','$title','$details','$current','$name','$incident_date','$location','$outcomes','$type')";
                $get = mysqli_query($conn, $query);
                if ($get) {
                    echo "<script>alert('Complaint Successfully Send to the Admin')</script>";
                    echo "<script>window.location='complaint.php'</script>";
                } else {
                    echo "<script>alert('Complaint Not Successfully Send to the Admin')</script>";
                }

                } else {
                    echo "<script>alert('File Size Up to 5 MB')</script>";
                    echo "<script>window.location='complaint.php'</script>";
                }
    
            } else {
                echo "<script>alert('File Size Up to 5 MB')</script>";
                echo "<script>window.location='complaint.php'</script>";
            }

        }
    }
    ?>