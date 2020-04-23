<?php
include('header.php');
?>

<?php
    if(isset($_GET['id'])){
        $getid=$_GET['id'];
        $query="select * from tblnotice where notice_id=$getid";
        $result=mysqli_query($conn,$query);
        while($rows=mysqli_fetch_array($result)){
?>

<div id="main">

    <div class="formclass">
        <div class="jumbotron" style="background-color: #C1C8E4;">
            <div class="container-fluid">



                <center><h2>Notice Form</h2></center>
                <form action="./editnotice.php?id=<?php echo $getid;?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                        <input type="text" class="form-control" name="Title" value="<?php echo $rows['notice_title'];?>" placeholder="NoticeTitle" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="Noticedate"><b>Notice Date:</b></label>
                        <input type="date" class="form-control" name="date" placeholder="dd-mm-yy" value="<?php echo $rows['date'];?>" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="noticeDescription"><b>Notice Description:</b></label>
                        <textarea class="form-control" rows="5" id="ComplDetail" placeholder="Enter Notice Description " name="comment"><?php echo $rows['notice_details'];?></textarea>
                    </div>
                    <div class="file-field">
                        <div class="btn blue-gradient btn-sm float-left">
                            <span><i class="fas fa-cloud-upload-alt mr-2" aria-hidden="true"></i><b>Choose files</b></span>
                            <input type="file" name="profilephoto" accept="image/*" multiple />
                        </div>
                        <input type="hidden" name="photo"  value="<?php echo $rows['notice_photo'];?>">
                        <div class="form-group"></div>
                        <div class="form-group"></div>

                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                </form>
            </div>
        </div>

    </div>
</div>


</html>


<?php
        }
    }
    else{
        echo "<script>window.location='noticeboard.php'</script>";
    }

    if(isset($_POST['submit'])){
        $title=$_POST['Title'];
        $description=$_POST['comment'];
        $date=$_POST['date'];
        $timedate=strtotime($date);
        $new_date=date("Y-m-d",$timedate);
        $photo=$_POST['photo'];
        if($_FILES['profilephoto']['name']==""){
            $query="update tblnotice set notice_title='$title',notice_details='$description',date='$new_date',notice_photo='$photo' where notice_id=$getid";
            $getresult=mysqli_query($conn,$query);
            if($getresult){
                echo "<script>alert('Record Successfully Updated')</script>";
                echo "<script>window.location='noticeboard.php'</script>";
            }
            else{
                echo "<script>alert('Record Successfully Not Inserted')</script>";
                echo "<script>window.location='noticeboard.php'</script>";
            }
        }
        else{
            if ($_FILES['profilephoto']['size'] <= 5000000) {
                $filename = rand(10, 1000) . "-" . $_FILES["profilephoto"]["name"];
                echo $filename;
                move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "../images/noticephoto/" . $filename);
            } else {
                echo "<script>alert('File Size Up to 5 MB')</script>";
                echo "<script>window.location='editnotice.php?id=$getid'</script>";
            }

            $query="update tblnotice set notice_title='$title',notice_details='$description',date='$new_date',notice_photo='$filename' where notice_id=$getid";
            $getresult=mysqli_query($conn,$query);
            if($getresult){
                echo "<script>alert('Record Successfully Updated')</script>";
                echo "<script>window.location='noticeboard.php'</script>";
            }
            else{
                echo "<script>alert('Record Successfully Not Updated')</script>";
                echo "<script>window.location='noticeboard.php'</script>";
            }
            
        }
    }
?>
