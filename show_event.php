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

<?php
$query = "select * from `tblevent` where `isApproved`=1 order by `event_id` desc";
$getquery = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($getquery)) {
    $id = $row['event_id'];
    $enddate = $row['end_date'];
    $current = date("Y-m-d", time());
    if ($current > $enddate) {
        $query1 = "update tblevent set isApproved=2 where event_id=$id";
        $getquery1 = mysqli_query($conn, $query1);
    }
}
?>

<div class="container">
    <h2 style="text-align: center;margin: 10px;">Event Dashboard</h2>
    <br>
    <!-- Nav pills -->
    <div style="padding-left: 3%">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home1">General Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#past">Past Events <i class="material-icons">events</i></a>
            </li>
        </ul>
    </div>
    <!-- Tab panes -->
    <div class="tab-content">
        <!--General Events -->


        <div id="home1" class="container tab-pane active"><br>
            <?php
            $query = "select * from `tblevent` where `isApproved`=1 order by `event_id` desc";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                $oname = $row['name'];
                $title = $row['event_name'];
                $details = $row['desceiption'];
                $date = $row['event_date'];
                $enddate = $row['end_date'];
                $id = $row['event_id'];
                $location = $row['location'];
                $strtime = $row['start_time'];
                $endtime = $row['complete_time'];
                $type1 = $row['type'];
            ?>
                <div class="container">
                    <div class="jumbotron">
                        <div class="card-block">
                            <h2 class="card-title" style="color:black"> <?php echo $title; ?></h2>
                            <h4 class="card-text"><?php echo $oname; ?></h4>
                            <p class="card-text"><?php echo $location; ?></p>
                            <p class="card-text"><?php echo $details; ?></p>
                            <p class="card-text">Date:&nbsp;<b><?php echo $date ?></b>&nbsp;<b><?php echo $strtime ?></b> &nbsp;To &nbsp;<b><?php echo $enddate ?></b>&nbsp;<b><?php echo $endtime ?></b></p>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>

        <!--Past Events-->
        <div id="past" class="container tab-pane fade"><br>
            <?php
            $query = "select * from `tblevent` where `isApproved`=2 order by `event_id` desc";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                $oname = $row['name'];
                $title = $row['event_name'];
                $details = $row['desceiption'];
                $date = $row['event_date'];
                $enddate = $row['end_date'];
                $id = $row['event_id'];
                $location = $row['location'];

                $type1 = $row['type'];
            ?>
                <div class="container">
                    <div class="jumbotron">
                        <div class="card-block">
                            <h2 class="card-title" style="color:black"> <?php echo $title; ?></h2>
                            <h4 class="card-text"><?php echo $oname; ?></h4>
                            <p class="card-text"><?php echo $location; ?></p>
                            <p class="card-text"><?php echo $details; ?></p>
                            <p class="card-text">Date:&nbsp;<b><?php echo $date ?></b>&nbsp;<b><?php echo $strtime ?></b> &nbsp;To &nbsp;<b><?php echo $enddate ?></b>&nbsp;<b><?php echo $endtime ?></b></p>
                            <button type="button" class="btn btn-primary">View Photos</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>