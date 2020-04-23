<?php include("header.php"); ?>
<div id="main">
    <div class="formclass">
        <div class="jumbotron">
            <div class="container-fluid">
                <h2>
                    <center>Maid Registration</center>
                </h2>
                <form action="add_maid.php" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"><b>Full name:</b></label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter name" name="name" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="contact"><b>Contact Number</b></label>
                        <input type="number" class="form-control" id="ename" placeholder="Enter Contact number" name="contact" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="Service Types"><b>Service Types</b></label>
                        <select class="form-control" name="service" required>
                            <option value="Maid">Maid</option>
                            <option value="Milkman">Milkman</option>
                            <option value="Newspaper Distributor">Newspaper Distributor</option>
                            <option value="Vegetable Vendor">Vegetable Vendor</option>
                            <option value="Personal Servant">Personal Servant</option>
                            <option value="Baby Sitter">Baby Sitter</option>
                            <option value="Bill Collector">Bill Collector</option>
                            <option value="Postman">Postman</option>
                            <option value="Others">Others</option>
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="speciality"><b>Speciality</b></label>
                        <input type="text" class="form-control" id="speciality" placeholder="Enter Speciality" name="speciality" required>
                    </div>

                    <div class="file-field">
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                        <div class="file-field">
                            <div class="btn blue-gradient btn-sm float-left">
                                <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i>Upload Photo</span>
                                <input type="file" name="file1" accept="image/*" required>
                            </div>
                            <div class="form-group"></div>
                            <div class="form-group"></div>
                            <center><button type="submit" class="btn btn-primary" name="submit_md">Submit</button></center>
                        </div>
                    </div>
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

<?php
if (isset($_POST['submit_md'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $service = $_POST['service'];
    $speciality = $_POST['speciality'];

    if ($_FILES['file1']['size'] <= 5000000) {

        $filename = rand(10, 1000) . "-" . $_FILES["file1"]["name"];;
        move_uploaded_file($_FILES["file1"]["tmp_name"], "images/maids/" . $filename);
    } else {
        echo "<script>alert('File Size Up to 5 MB')</script>";
        echo "<script>window.location='add_maid.php'</script>";
    }

    $query = "INSERT INTO `tblmaid`(`maid_name`, `maid_contact`, `maid_service`, `maid_photo`, `maid_speciality`) VALUES ('$name','$contact','$service','$filename','$speciality')";
    $getquery = mysqli_query($conn, $query);

    if ($getquery) {
        echo "<script>alert('Record Successfully Inserted')</script>";
        echo "<script>window.location='view_maids.php'</script>";
    } else {
        echo "<script>alert('Record Not Successfully Inserted')</script>";
    }
}
?>

</html>