<?php
include('header.php');
?>

<div id="main">

    <div class="formclass">
        <div class="jumbotron" style="background-color: #C1C8E4;">
            <div class="container-fluid">



                <center><h2>Notice Form</h2></center>
                <form action="./addnotice.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="noticeType"><b>Notice Type:</b></label>
                        <!--           Sudharo      Dropdown ni style navi vapro -->

                        <select class="form-control" name="type">
                            <option value="Maintenance break">Maintenance break</option>
                            <option value="New Event">New Event/Program</option>
                            <option value="Meeting">Meeting</option>
                            <option value="Alert">Alert</option>
                            <option value="Inspection/Checking">Inspection/Checking</option>
                            <option value="Policy/Rule Changes">Policy/Rule Changes</option>
                            <option value="Requirements (Volunteering)">Requirements (Volunteering)</option>
                            <option value="Others">Others</option>
                        </select>



                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="IncidentLocation"><b>Notice Title:</b></label>
                        <br>
                        <input type="text" class="form-control" name="Title" placeholder="NoticeTitle" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="Noticedate"><b>Notice Date:</b></label>
                        <input type="date" class="form-control" name="date" placeholder="dd-mm-yy" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="noticeDescription"><b>Notice Description:</b></label>
                        <textarea class="form-control" rows="5" id="ComplDetail" placeholder="Enter Notice Description " name="comment"></textarea>
                    </div>
                    <div class="file-field">
                        <div class="btn blue-gradient btn-sm float-left">
                            <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i><b>Choose files</b></span>
                            <input type="file" name="profilephoto" accept="image/*" multiple />
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div>

                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                </form>
            </div>
        </div>

    </div>
</div>

</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $title = $_POST['Title'];
    $type=$_POST['type'];
    $description = $_POST['comment'];
    $date = $_POST['date'];
    $timedate = strtotime($date);
    $new_date = date("Y-m-d", $timedate);
    if ($_FILES['profilephoto']['name'] == "") {
        $query = "insert into tblnotice (notice_title,notice_details,date,type) values ('$title','$description','$new_date','$type')";
        $getresult = mysqli_query($conn, $query);
        if ($getresult) {
            echo "<script>alert('Record Successfully Inserted')</script>";
            echo "<script>window.location='addnotice.php'</script>";
        } else {
            echo "<script>alert('Record Successfully Not Inserted')</script>";
            echo "<script>window.location='addnotice.php'</script>";
        }
    } else {
        if ($_FILES['profilephoto']['size'] <= 5000000) {
            $filename = rand(10, 100000) . "-" . $_FILES["profilephoto"]["name"];
            echo $filename;
            move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "../images/noticephoto/" . $filename);
        } else {
            echo "<script>alert('File Size Up to 5 MB')</script>";
            echo "<script>window.location='addnotice.php'</script>";
        }

        $query = "insert into tblnotice (notice_title,notice_details,date,notice_photo,type) values ('$title','$description','$new_date','$filename','$type')";
        $getresult = mysqli_query($conn, $query);
        if ($getresult) {
            echo "<script>alert('Record Successfully Inserted')</script>";
            echo "<script>window.location='addnotice.php'</script>";
        } else {
            echo "<script>alert('Record Successfully Not Inserted')</script>";
            echo "<script>window.location='addnotice.php'</script>";
        }
    }
}
?>