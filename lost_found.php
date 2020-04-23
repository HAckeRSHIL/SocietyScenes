<?php include("header.php"); ?>

<?php
if (isset($_SESSION['ownerId'])) {
    $id = $_SESSION['ownerId'];
    $type = "Owner";
}

if (isset($_SESSION['rentId'])) {
    $id = $_SESSION['rentId'];
    $type = "Rent";
}

?>
<div id="main">

    <div class="formclass">
        <div class="jumbotron">
            <div class="container-fluid">
                <h2>
                    <center>Submit Detail About Lost item.</center>
                </h2>
                <form action="lost_found.php" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="vehicle type"><b>Category:</b></label>
                        <select class="form-control" name="category" value="Select option">
                            <option value="Lost">Lost</option>
                            <option value="Found">Found</option>
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="Event name"><b>Item name:</b></label>
                        <input type="text" class="form-control" id="ename" placeholder="Lost item name" name="ename" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="ComplaintDetails"><b>Description</b></label>
                        <textarea class="form-control" rows="5" id="eventDetail" placeholder="Details about lost items.. " name="edes"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Bno"><b>Loctaion:</b></label>
                        <input type="text" class="form-control" id="uname" placeholder="Ex. A Block" name="flocation" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="date"><b>Contact Person Name:</b></label>
                        <textarea class="form-control" rows="1" id="eventDetail" placeholder="Ex. Dhruvil Shah " name="cpname"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date"><b>Contact details:</b></label>
                        <textarea class="form-control" rows="1" id="eventDetail" placeholder="Ex. 7043399933 " name="cdes"></textarea>
                    </div>

                    <pre><b>Photo Of Item:</b><input type="file" name="profilephoto" accept="image/*" required></pre>

                    <center><button type="submit" class="btn btn-primary" name="submitreq">Post</button></center>
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

if (isset($_POST['submitreq'])) {
    $title = $_POST['ename'];
    $desc = $_POST['edes'];
    $location = $_POST['flocation'];
    $cdname = $_POST['cpname'];
    $cdes = $_POST['cdes'];
    $category=$_POST['category'];
    date_default_timezone_set("Asia/Calcutta");
    $time = date("Y-m-d H:i:s");

    if ($_FILES['profilephot1']['size'] <= 5000000) {
        $filename = rand(10, 1000) . "-" . $_FILES["profilephoto"]["name"];;
        move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "images/lost_found/" . $filename);
    } else {
        echo "<script>alert('File Size Up to 5 MB')</script>";
        echo "<script>window.location='lost_found.php'</script>";
    }

    $query = "insert into tbllostandfound (`owner_id`, `name`, `description`, `photo`, `contact_person`, `contact_mobile`, `type`, `date`,`location`,`category`) values ($id,'$title','$desc','$filename','$cdname','$cdes','$type','$time','$location','$category')";
    $get = mysqli_query($conn, $query);
    if ($get) {
        echo "<script>alert('Lost Item Successfully Added')</script>";
        echo "<script>window.location='lost_found.php'</script>";
    } else {
        echo "<script>alert('Lost Item Not Added')</script>";
    }
}
?>