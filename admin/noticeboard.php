<?php
include('header.php');
?>
<?php
    if(isset($_GET['id'])){
        $getid=$_GET['id'];
        $dquery="update tblnotice set status=1 where notice_id=$getid";
        $result=mysqli_query($conn,$dquery);

        if($result){
            echo "<script>alert('Notice Deleted')</script>";
            echo "<script>window.location='noticeboard.php'</script>";
        }
        else{
            echo "<script>alert('Notice Not Deleted')</script>";
        }

    }
?>

<div class="container">
    <h2 style="text-align: center;margin: 10px;">Notice Board</h2>
    <br>
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <?php
            $query = "select * from `tblnotice` where `status`=0 order by `notice_id` desc";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                $title = $row['notice_title'];
                $details = $row['notice_details'];
                $date = $row['date'];
                $id = $row['notice_id'];
                $type=$row['type'];
                $notice_photo = $row['notice_photo'];
                $time = strtotime($date);
            ?>
                <div class="container">
                    <div class="jumbotron">
                        <?php if ($notice_photo != '' || $notice_photo != null) { ?>
                            <div class="img" style="height: auto;">
                                <p><img src="../images/noticephoto/<?php echo $notice_photo ?>" style="width: 200px; height:150px; float:right;"></p>
                            </div>
                        <?php } ?>
                        <div class="card-block">
                            <h4 class="card-title">(<?php echo $type ?>) <?php echo $title ?></h4>
                            <p class="card-text"><?php echo $details ?></p>
                            <p class="card-text">Notice Date:<b><?php echo $date ?></b></p>
                            <a href="editnotice.php?id=<?php echo $id ;?>"><button class="btn btn-outline-primary" name="important">Edit</button></a>
                            <a href="noticeboard.php?id=<?php echo $id ;?>"><button class="btn btn-outline-primary" name="important">Delete</button></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>