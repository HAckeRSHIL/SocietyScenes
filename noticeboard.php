<?php
include('header.php');
if (isset($_SESSION['ownerId'])) {
    $type = "Owner";
    $sid = $_SESSION['ownerId'];
} else if (isset($_SESSION['rentId'])) {
    $type = "Rent";
    $sid = $_SESSION['rentId'];
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="update tbllostandfound set status=1 where item_id=$id";
    $get=mysqli_query($conn,$query);
    echo "<script>window.location='noticeboard.php'</script>";
}

?>
<div class="container">
    <h2 style="text-align: center;margin: 10px;">Notice Board</h2>
    <br>
    <!-- Nav pills -->
    <div style="padding-left: 3%">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">Latest Notices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#home1">Lost or Found Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu1">Favourites <i class="material-icons">star</i></a>
            </li>
        </ul>
    </div>
    <!-- Tab panes -->
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
                $notice_photo = $row['notice_photo'];
                $type1=$row['type'];
                $time = strtotime($date);
                $final = date("Y-m-d", strtotime("+2 month", $time));
                $current = date("Y-m-d", time());
                if ($date < $current) {
                    if ($current <  $final) {
            ?>
                        <div class="container">
                            <div class="jumbotron">
                                <?php if ($notice_photo != '' || $notice_photo != null) { ?>
                                    <div class="img" style="height: auto;">
                                        <p><img src="images/noticephoto/<?php echo $notice_photo ?>" style="width: 200px; height:150px;float:right;"></p>
                                    </div>
                                <?php } ?>
                                <div class="card-block">
                                    <h4 class="card-title">(<?php echo $type1; ?>)<?php echo $title; ?></h4>
                                    <p class="card-text"><?php echo $details; ?></p>
                                    <p class="card-text">Notice Date:<b><?php echo $date ?></b></p>
                                    <form method="POST">
                                        <input type="hidden" name="v" value="<?php echo $id ?>">
                                        <button class="btn btn-outline-primary" name="important">Favourite <i class="material-icons">star_border</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                        $uquery = "update tblnotice set status=1 where notice_id=$id";
                        $getquery1 = mysqli_query($conn, $uquery);
                    }
                }
                ?>

            <?php
            }
            if (isset($_POST['important'])) {
                $id = $_POST['v'];
                if ($type == "Owner") {
                    $select = "select * from tblimpnotice where notice_id=$id and owner_id=$sid";
                    $getselect = mysqli_query($conn, $select);
                    $row = mysqli_num_rows($getselect);
                    if ($row > 0) {
                        echo "<script>alert('Notice Already Added')</script>";
                    } else {
                        $iquery = "insert into tblimpnotice (notice_id,owner_id) values ($id,$sid)";
                        $getquery1 = mysqli_query($conn, $iquery);
                        echo "<script>alert('Successfully added to favourite.')</script>";
                    }
                } else if ($type == "Rent") {
                    $select = "select * from tblimpnotice where notice_id=$id and rent_id=$sid";
                    $getselect = mysqli_query($conn, $select);
                    $row = mysqli_num_rows($getselect);
                    if ($row > 0) {
                        echo "<script>alert('Notice Already Added')</script>";
                    } else {
                        $iquery = "insert into tblimpnotice (notice_id,rent_id) values ($id,$sid)";
                        $getquery1 = mysqli_query($conn, $iquery);
                        echo "<script>alert('Successfully added to favourite.')</script>";
                    }
                }
            }
            ?>
        </div>
        
        <div id="home1" class="container tab-pane "><br>
            <?php
            $query = "select * from `tbllostandfound` where `status`=0 order by `item_id` desc";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                $oname = $row['contact_person'];
                $title = $row['name'];
                $item_id=$row['item_id'];
                $details = $row['description'];
                $conNumber = $row['contact_mobile'];
                $conId = $row['owner_id'];
                $date = $row['date'];
                $item = $row['item_id'];
                $status = $row['status'];
                $category=$row['category'];
                $lostPhoto = $row['photo'];
            ?>
            <div class="container" >
                <div class="jumbotron">
                    <div class="card-block">
                        <?php if ($lostPhoto != '' || $lostPhoto != null) { ?>
                        <div class="img" style="height: auto;">
                            <p><img src="./images/lost_found/<?php echo $lostPhoto ?>" style="width: 200px; height:150px;float:right;"></p>
                        </div>
                        <?php } ?>

                        <h4 class="card-title">(<?php echo $category;?>) <?php echo $title; ?></h4>

                        <p class="card-text"><?php echo $details; ?></p>
                        <p class="card-text"><b>Contact To:</b> <?php echo $oname; ?></p>
                        <p class="card-text"><b>Contact Number:</b> <?php echo $conNumber; ?></p>
                        <p class="card-text"><b>Date:</b>&nbsp;<?php echo $date ?></p>
                        <?php if($conId == $sid || isset($_SESSION['adminId'])) { ?>
                            <a href="noticeboard.php?id=<?php echo $item_id;?>"><button type="button" name="received" class="btn btn-primary">Received</button>  </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
                }
            
            ?>

        </div>
        <div id="menu1" class="container tab-pane fade"><br>
            <?php
            if ($type == "Rent") {
                $query1 = "select tn.*,ti.* from `tblnotice` tn,`tblimpnotice` ti where ti.`notice_id`=tn.`notice_id` and ti.`rent_id`=$sid and ti.`status`=0 order by ti.`imp_id` desc";
                
            } else if ($type == "Owner") {
                $query1 = "select tn.*,ti.* from `tblnotice` tn,`tblimpnotice` ti where ti.`notice_id`=tn.`notice_id` and ti.`owner_id`=$sid and ti.`status`= 0 order by ti.`imp_id` desc";
                
            }
            $getquery = mysqli_query($conn, $query1);
            while ($row = mysqli_fetch_array($getquery)) {
                $title = $row['notice_title'];
                $details = $row['notice_details'];
                $date = $row['date'];
                $id = $row['notice_id'];
                $iid = $row['imp_id'];
                $type1=$row['type'];
                $notice_photo = $row['notice_photo'];
            ?>
                <div class="container">
                    <div class="jumbotron">
                        <?php if ($notice_photo != '' || $notice_photo != null) { ?>
                            <div class="img" style="height: auto;">
                                <p><img src="images/noticephoto/<?php echo $notice_photo ?>" style="width: 200px; float:right;"></p>
                            </div>
                        <?php } ?>
                        <div class="card-block">
                            <h4 class="card-title">(<?php echo $type1 ?>)<?php echo $title ?></h4>
                            <p class="card-text"><?php echo $details ?></p>
                            <p class="card-text">Notice Date:<b><?php echo $date ?></b></p>
                            <form method="POST">
                                <input type="hidden" name="v1" value="<?php echo $iid ?>">
                                <button class="btn btn-outline-primary" name="unimportant">Remove from Fav <i class="material-icons">star_border</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
            if (isset($_POST['unimportant'])) {
                $id1 = $_POST['v1'];

                $uquery1 = "delete from tblimpnotice where imp_id=$id1";
                $get = mysqli_query($conn, $uquery1);
                echo "<script>alert('Successfully Remove Important')</script>";
                echo "<script>window.location='noticeboard.php'</script>";
            }
            ?>
        </div>
    </div>
</div>
</body>

</html>