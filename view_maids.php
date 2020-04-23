<?php include("header.php");?>

<?php
if (isset($_SESSION['ownerId'])) {
    $id = $_SESSION['ownerId'];
    $type = "Owner";
}

if (isset($_SESSION['rentId'])) {
    $id = $_SESSION['rentId'];
    $type = "Rent";
}

if(isset($_GET['id'])){
    $id1=$_GET['id'];
    $query="INSERT INTO `tblpermaid`(`owner_id`, `maid_id`, `type`) VALUES ($id,$id1,'$type')";
    $get=mysqli_query($conn,$query);
    if($get){
        echo "<script>alert('Record Successfully Inserted')</script>";
        echo "<script>window.location='view_maids.php'</script>";
    }
}


?>

<div id="main">



<div class="content">
    <br>
    <div class="container">
        
            <h4 style="padding-left: 40%;">All Hired persons
                <a href="add_maid.php"><button type="button" class="btn btn-primary float-right"> <i class="material-icons">
post_add
</i> new Entry</button></a>
<a href="my_maid.php"><button type="button" class="btn btn-primary float-right"> <i class="material-icons">
post_add
</i> Personal Home Maids</button></a>
            </h4>
            
     
        <br>
        <br>
        <br>
        <div class="row">
        <?php     
            $query="select * from tblmaid";
            $get=mysqli_query($conn,$query);
            while($row=mysqli_fetch_array($get)){
                $type=$row['maid_service'];
                $name=$row['maid_name'];
                $mobileno=$row['maid_contact'];
                $speciality=$row['maid_speciality'];
                $photo=$row['maid_photo'];
                $maid_id=$row['maid_id'];
        ?>
        <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <img class="img" src="./images/maids/<?php echo $photo;?>" />
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray"><?php echo $type;?></h6>
                        <h4 class="card-title"><?php echo $name;?></h4>
                        <p class="card-description">
                            Phone Number : <?php echo $mobileno;?><br>
                            Speciality   : <?php echo $speciality;?> 
                        </p>
                        <a href="view_maids.php?id=<?php echo $maid_id;?>" class="btn btn-sm btn-primary btn-round">Add to my List</a>
                    </div>
                </div>
                
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</body>
</html>
