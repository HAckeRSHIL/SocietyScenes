<?php include("header.php");?>
<div class="row">
    <div class="col-sm-12" style=" height:50px; ">
    </div>
</div>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Bill Description</th>
                    <th>Month</th>
                    <th>Payment Date</th>
                    <th>Total Amount</th>
                    <th>Amount Per House</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query="select * from tblpayment_type where status=0 order by paymenttype_id desc";
                    $getquery=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($getquery)){
                        $type=$row['type_name'];
                        $month=$row['bill_month'];
                        $date=$row['start_date'];
                        $id=$row['paymenttype_id'];
                        $total=$row['total_amount'];
                ?>
                <tr>
                    <td><?php echo $type;?></td>
                    <td><?php echo $month;?></td>
                    <td><?php echo $date;?></td>
                    <td>Rs. <?php echo $total;?></td>
                    <td>Rs. <?php echo round($row['amount_per_person']);?></td>
                    <td><a href="view_payment.php?id=<?php echo $id;?>" class="btn btn-info" role="button">View Bill</a></td>
                </tr>
                    <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Bill Description</th>
                    <th>Month</th>
                    <th>Payment Date</th>
                    <th>Total Amount</th>
                    <th>Amount Per House</th>
                    <th>View</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-sm-2"></div>
</div>
</body>

</html>
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