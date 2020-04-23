<?php
include("header.php");
if (!isset($_GET['id'])) {
    echo "<script>window.location='payment_history.php'</script>";
} else {
    $id = $_GET['id'];
?>

    <div class="container">
        <h2 style="text-align: center"><br />Payments</h2>
        <br>
        <!-- Nav pills -->
        <div style="padding-left: 3%">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#home">Paid</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#menu1">Unpaid</a>
                </li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
                <div class="container">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Block No</th>
                                <th>Owner Name</th>
                                <th>Reference No</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Late Fee</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select tr.*,tp.* from tblpayment_details tp,tblregistration tr where tp.owner_id=tr.owner_id and tp.paymenttype_id=$id";
                            $getquery = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($getquery)) {
                                $plot = $row['plot_no'];
                                $transaction = $row['transaction_number'];
                                $date = $row['payment_date'];
                                $amount = $row['total_amount'];
                                $name = $row['owner_name'];
                                $late=$row['late_fee'];
                                $total=$amount+$late;
                            ?>
                                <tr>
                                    <td><?php echo $plot; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $transaction; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo "Rs." . $amount; ?></td>
                                    <td><?php echo "Rs." . $late; ?></td>
                                    <td><?php echo "Rs." . $total; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Block No</th>
                                <th>Owner Name</th>
                                <th>Reference No</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Late Fee</th>
                                <th>Total Amount</th>

                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>

            <div id="menu1" class="container tab-pane fade"><br>
                <div class="container">
                    <table id="example1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Block No</th>
                                <th>Owner Name</th>
                                <th>Bill Description</th>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $string = "";
                            $query = "select * from tblpayment_details where paymenttype_id=$id";
                            $getquery = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($getquery)) {
                                $owner_id = $row['owner_id'];
                                $string = $owner_id . "," . $string;
                            }
                            $count = strlen($string);
                            $string1 = substr($string, 0, $count - 1);

                            $query = "select * from tblpayment_type where paymenttype_id=$id";
                            $getquery = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($getquery);
                            $type = $row['type_name'];
                            $date = $row['start_date'];
                            $time = strtotime($date);
                            $final = date("Y-m-d", strtotime("+1 month", $time));
                            $month = $row['bill_month'];
                            $amount = round($row['amount_per_person']);
                            if($string!=''){
                                $query = "select * from tblregistration where owner_id not in($string1)";
                            }
                            else {
                                $query = "select * from tblregistration";
                            }
                            $getquery = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($getquery)) {
                                $plot = $row['plot_no'];
                                $name = $row['owner_name'];

                            ?>
                                <tr>
                                    <td><?php echo $plot; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $type; ?></td>
                                    <td><?php echo $month; ?></td>
                                    <td><?php echo $final; ?></td>
                                    <td><?php echo "Rs.".$amount; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Block No</th>
                                <th>Owner Name</th>
                                <th>Bill Description</th>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

    </div>
    </div>


    </div>
    </div>
    </body>

    </html>
<?php } ?>

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

    $(document).ready(function() {
        var table = $('#example1').DataTable();

        $('#example1 tbody').on('click', 'tr', function() {
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