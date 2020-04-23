<?php include("header.php"); ?>
<?php
if (isset($_SESSION['ownerId'])) {
    $id=$_SESSION['ownerId'];
    $type1="Owner";
} else if (isset($_SESSION['rentId'])) {
    $id=$_SESSION['rentId'];
    $type1="Rent";
}

if(isset($_POST['submitreq'])){
    $mess=$_POST['message'];
    date_default_timezone_set("Asia/Calcutta");
    $time = date("Y-m-d H:i:s");
    $type=$_POST['type'];
    $id=$_POST['id'];

    $query="INSERT INTO `tblmessage`(`owner_id`, `message`, `time`, `type`) VALUES ($id,'$mess','$time','$type')";
    $get=mysqli_query($conn,$query);
    echo "<script>window.location='Chatbox.php'</script>";
    
}

?>
<div id="main">
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $('#example tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#button').click(function() {
                table.row('.selected').remove().draw(false);
            });
        });
    </script>


</div>
<div class="container">
    <div class="chat_window">
        <div class="top_menu">
            <div class="buttons">
                <div class="button close"></div>
                <div class="button minimize"></div>
                <div class="button maximize"></div>
            </div>
            <div class="title">Chat</div>
        </div>
        <ul class="messages" id="div111">
            <?php 
                $query="select * from tblmessage";
                $getquery=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($getquery)){
                    $ownerid=$row['owner_id'];
                    $type=$row['type'];
                    if ($type=="Owner") {
                        $ownerquery = "select * from tblregistration where owner_id=$ownerid";
                        $getownerquery = mysqli_query($conn, $ownerquery);
                        $ownerrow = mysqli_fetch_array($getownerquery);
                        $name = $ownerrow['owner_name'];
                    } else if ($type=="Rent") {
                        $rentquery = "select * from tblrenttable where rent_id=$ownerid";
                        $getrent = mysqli_query($conn, $rentquery);
                        $rentrow = mysqli_fetch_array($getrent);
                        $name = $rentrow['tenant_name'];
                    }

                    if($type==$type1 && $id==$ownerid){
        
            ?>
            <li class="message right appeared">
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text"><?php echo $row['message'];?><br><span style="font-size:10px;font-family: serif;float:right;"><?php echo $name;?> <?php echo $row['time'];?></span></div>
                </div>
            </li>
                <?php } 
                else { ?>
            
            <li class="message left appeared">
                <div class="avatar"></div>
                <div class="text_wrapper">
                    <div class="text"><?php echo $row['message'];?><br><span style="font-size:10px;font-family: serif;float:left;"><?php echo $name;?> <?php echo $row['time'];?></span></div>
                </div>
            </li>
                <?php }} ?>

        </ul>
        <div class="bottom_wrapper clearfix">
            <div class="message_input_wrapper">
                <form action="Chatbox.php" method="POST">
                    <input type="hidden" name="type" value="<?php echo $type1;?>"/>
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <input type="text" class="message_input" placeholder="Type your message here..." name="message"></div>
            <div class="send_message">
                <div class="icon"></div>
                <button type="submit" class="btn btn-primary" name="submitreq">Send</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="message_template">
        <li class="message">
            <div class="avatar"></div>
            <div class="text_wrapper">
                <div class="text"></div>
            </div>
        </li>
    </div>


</div>
</body>
<script>
    $('#div111').scrollTop($('#div111')[0].scrollHeight);
</script>
</html>
