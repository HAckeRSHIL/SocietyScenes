<?php include("header.php"); ?>
<?php

if (isset($_SESSION['ownerId'])) {
    $type = "Owner";
    $getid = $_SESSION['ownerId'];
}

if (isset($_SESSION['rentId'])) {
    $type = "Rent";
    $getid = $_SESSION['rentId'];
}

?>

<div class="container">
    <h2 style="text-align: center;margin: 10px;">Funds History</h2>
    <br>
    <div class="jumbotron">
        <center>
            <table id="example" class="row-border hover order-column" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Block No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tblextrpay";
                    $getquery = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($getquery)) {
                        $owner_id = $row['owner_id'];

                        $title = $row['title'];
                        $des = $row['description'];
                        $amount = $row['amount'];
                        $type = $row['type'];

                        $query1 = "select * from tblregistration where owner_id=$owner_id";
                        $getquery1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_array($getquery1);
                        $block = $row1['plot_no'];
                        $name = $row1['owner_name'];

                    ?>
                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $block; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $des; ?></td>
                            <td><?php echo $amount; ?></td>

                        </tr>

                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Block No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </tfoot>
            </table>
        </center>

    </div>

</div>

</div>
</div>
</div>

</div>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable();

        $('#example tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
    });
</script>
</body>

</html>