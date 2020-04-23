<?php
include('header.php');
if (isset($_SESSION['ownerId'])) {
    $type = "Owner";
    $sid = $_SESSION['ownerId'];
} else if (isset($_SESSION['rentId'])) {
    $type = "Rent";
    $sid = $_SESSION['rentId'];
}

?>
<div class="container">
    <h2 style="text-align: center;margin: 10px;">Lost And Found</h2>
    <br>
    <!-- Nav pills -->
    <!-- Tab panes -->
    <div class="tab-content">
        <!--General Events -->


        <div id="home1" class="container tab-pane active"><br>
            <?php
            $query = "select * from `tbllostandfound` where `status`=0 order by `item_id` desc";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                $oname = $row['contact_person'];
                $title = $row['name'];
                $details = $row['description'];
                $conNumber = $row['contact_mobile'];
                $conId = $row['owner_id'];
                $date = $row['date'];
                $item = $row['item_id'];
                $status = $row['status'];
                $lostPhoto = $row['photo'];
                $time = strtotime($date);
                $final = date("Y-m-d", strtotime("+2 month", $time));
                $current = date("Y-m-d", time());
                if ($status == 0) {
            ?>
            <div class="container" >
                <div class="jumbotron">
                    <div class="card-block">
                        <?php if ($lostPhoto != '' || $lostPhoto != null) { ?>
                        <div class="img" style="height: auto;">
                            <p><img src="images/lostFound/<?php echo $lostPhoto ?>" style="width: 200px; height:150px;float:right;"></p>
                        </div>
                        <?php } ?>

                        <h2 class="card-title" style="color:black"> <?php echo $title; ?></h2>
                        <h4 class="card-text"><?php echo $oname; ?></h4>
                        <p class="card-text"><?php echo $details; ?></p>
                        <p class="card-text"><?php echo $conNumber; ?></p>
                        <p class="card-text">Date:&nbsp;<b><?php echo $date ?></b></p>
                        <?php echo $conId; echo $sid; ?>
                        <?php if($conId == $sid ) { ?>
                        <button type="button" name="received" class="btn btn-primary">Received</button>  
                        <?php } ?>
                        <?php if(isset($_POST['received'])){
                $queryy = "DELETE from `tbllostandfound` where `item_id` = '$item' ";
                mysqli_query($conn,$queryy);

            } ?>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
</div>
