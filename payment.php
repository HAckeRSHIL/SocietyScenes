<?php
include('header.php');

if (isset($_SESSION['ownerId'])) {
    $getid = $_SESSION['ownerId'];
}

if (isset($_SESSION['rentId'])) {
    $getid1 = $_SESSION['rentId'];

    $ownerid = "select * from tblrenttable where rent_id=$getid1 and status='True'";
    $getownerid = mysqli_query($conn, $ownerid);
    $row = mysqli_fetch_array($getownerid);
    $getid = $row['owner_id'];
}

if (isset($_POST['confirm'])) {
    $f_paymentid = $_POST['paymenttype_id'];
    $f_owner_id = $_POST['owner_id'];
    $f_mobile = $_POST['mobile_no'];
    $f_email = $_POST['email_id'];
    $f_total = $_POST['total'];
    $f_late = $_POST['late'];
    $f_current = date("Y-m-d", time());

    function random_strings($length_of_string)
    {
        $str_result = '1234567890';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    $transaction = 'SM' . random_strings(9);
    $card = "Debit Card";

    $insert = "insert into tblpayment_details (`paymenttype_id`, `owner_id`, `transaction_number`, `payment_mode`, `total_amount`, `payment_date`, `mobile_no`, `emailid`,`late_fee`) values ($f_paymentid,$f_owner_id,'$transaction','$card',$f_total,'$f_current','$f_mobile','$f_email',$f_late)";
    $getinsert = mysqli_query($conn, $insert);

    if ($getinsert) {
        echo "<script>alert('Payment Paid')</script>";
        $f_id = "select * from tblpayment_details where paymenttype_id=$f_paymentid and owner_id=$getid";
        $f_getid = mysqli_query($conn, $f_id);
        $f_row = mysqli_fetch_array($f_getid);
        $f_did = $f_row['details_id'];
        echo "<script>window.location='payment_recepit.php?id=$f_did'</script>";
    } else {
        echo "<script>alert('Payment Not Successful')</script>";
    }
}
?>



<div class="container">
    <h2 style="text-align: center"><br />Payments</h2>
    <br>
    <!-- Nav pills -->
    <div style="padding-left: 3%">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">Bills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu1">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#extrapay">Extra Payments</a>
            </li>
        </ul>
    </div>
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <div class="container">
                <div class="row">
                    <div class="card-deck">
                        <?php
                        $count = 0;

                        $data = "select * from tblregistration where owner_id=$getid";
                        $getdata = mysqli_query($conn, $data);
                        $r = mysqli_fetch_array($getdata);
                        $plot = $r['plot_no'];
                        $owner_name = $r['owner_name'];
                        $mobile_no = $r['mobile_no'];
                        $email_id = $r['email_id'];

                        $gettype = "select * from tblpayment_type where status=0";
                        $getresult = mysqli_query($conn, $gettype);
                        $count1 = mysqli_num_rows($getresult);
                        while ($row = mysqli_fetch_array($getresult)) {
                            $id = $row['paymenttype_id'];
                            $user = "select * from tblpayment_details where owner_id=$getid and paymenttype_id=$id";
                            $getuser = mysqli_query($conn, $user);
                            if (mysqli_num_rows($getuser) <= 0) {
                                if ($count > 1) {
                                    $count = 0;

                        ?>
                    </div>
                    <div class="card-deck">
                        <?php
                                }

                                $name = $row['type_name'];
                                $month = $row['bill_month'];
                                $total = $row['total_amount'];
                                $date = $row['start_date'];
                                $time = strtotime($date);
                                $final = date("Y-m-d", strtotime("+1 month", $time));
                                $current = date("Y-m-d", time());
                                if ($date <= $current) {
                                    if ($current <  $final) {
                                        $extra=0;
                                    }
                                    else{
                                        $extra=100;
                                    }
                        ?>
                            <div class="col-sm-6">
                                <div class="card border-dark bg-light mb-3 c2" style="width: 33rem;">
                                    <div class="card-header"><?php echo $name; ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $month; ?></h5>
                                        <p class="card-text">Amount : <?php echo round($row['amount_per_person']); ?>/-
                                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $row['paymenttype_id']; ?>">Pay</button>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text"><small class="text-muted ">Due Date : <?php echo $final; ?></small></p>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade bd-example-modal-lg<?php echo $row['paymenttype_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Maintance Bill</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                Invoice
                                                                <strong><?php echo $current; ?></strong>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <center> <strong>Month:</strong><?php echo $month; ?></center>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <span class="float-right"> <strong>Status:</strong> <span style="color:darkgoldenrod;"> Pending</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-4">
                                                            <div class="col-sm-6">
                                                                <h6 class="mb-3">From:</h6>
                                                                <div>
                                                                    <strong>Smart Society</strong>
                                                                </div>
                                                                <div>R.C. technical road</div>
                                                                <div>Near I.D. Patel School</div>
                                                                <div>Ahmedabad-380061, Gujarat</div>
                                                                <div>Email: <a href="mailto:societyissmart@gmail.com?Subject=Hello%20again" target="_top"> societyissmart@gmail.com</a>
                                                                </div>
                                                                <div>Phone: +91 444 666 3333</div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <h6 class="mb-3">To:</h6>
                                                                <div>
                                                                    <strong><?php echo $owner_name; ?></strong>
                                                                </div>
                                                                <div>Plot No:<?php echo $plot; ?></div>
                                                                <div>Email: <?php echo $email_id; ?></a>
                                                                </div>
                                                                <div>Phone: <?php echo $mobile_no; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive-sm">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="center">#</th>
                                                                        <th>Item</th>
                                                                        <th></th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="center">1</td>
                                                                        <td><?php echo $row['list_name1']; ?></td>
                                                                        <td></td>
                                                                        <td>₹<?php echo $row['list1_amount']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    if ($row['list_name2'] != '' && $row['list2_amount'] != '0' && $row['list_name3'] != '' && $row['list3_amount'] != '0' && $row['list_name4'] != '' && $row['list4_amount'] != '0') {
                                                                    ?>
                                                                        <tr>
                                                                            <td class="center">2</td>
                                                                            <td class="left"><?php echo $row['list_name2']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list2_amount']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="center">3</td>
                                                                            <td class="left"><?php echo $row['list_name3']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list3_amount']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="center">4</td>
                                                                            <td class="left"><?php echo $row['list_name4']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list4_amount']; ?></td>
                                                                        </tr>
                                                                    <?php } else if ($row['list_name2'] != '' && $row['list2_amount'] != '0' && $row['list_name3'] != '' && $row['list3_amount'] != '0' && $row['list_name4'] == '' && $row['list4_amount'] == '0') { ?>
                                                                        <tr>
                                                                            <td class="center">2</td>
                                                                            <td class="left"><?php echo $row['list_name2']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list2_amount']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="center">3</td>
                                                                            <td class="left"><?php echo $row['list_name3']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list3_amount']; ?></td>
                                                                        </tr>
                                                                    <?php } else if ($row['list_name2'] != '' && $row['list2_amount'] != '0' && $row['list_name3'] == '' && $row['list3_amount'] == '0' && $row['list_name4'] == '' && $row['list4_amount'] == '0') { ?>
                                                                        <tr>
                                                                            <td class="center">2</td>
                                                                            <td class="left"><?php echo $row['list_name2']; ?></td>
                                                                            <td></td>
                                                                            <td class="right">₹<?php echo $row['list2_amount']; ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                        <tr>
                                                                            <td class="center"></td>
                                                                            <td></td>
                                                                            <td>
                                                                                <strong>Total Cost</strong>
                                                                            </td>
                                                                            <td class="right">₹<?php echo $total; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="center"></td>
                                                                            <td></td>
                                                                            <td>
                                                                                <strong>Amount Per House</strong>
                                                                            </td>
                                                                            <td class="right">₹<?php echo round($row['amount_per_person']); ?></td>
                                                                        </tr>
                                                                        <?php if($extra!=0){ ?>
                                                                        <tr>
                                                                            <td class="center"></td>
                                                                            <td></td>
                                                                            <td>
                                                                                <strong>Late Fees</strong>
                                                                            </td>
                                                                            <td class="right">₹<?php echo $extra; ?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                        <tr>
                                                                            <td class="center"></td>
                                                                            <td></td>
                                                                            <td>
                                                                            <strong>Total</strong>
                                                                            </td>
                                                                            <td class="right">₹<strong><?php $a=round($row['amount_per_person']); $total1=$a+$extra; echo $total1;?></strong></td>
                                                                        </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="payment.php" method="POST">
                                                <input type="hidden" name="paymenttype_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="owner_id" value="<?php echo $getid; ?>">
                                                <input type="hidden" name="mobile_no" value="<?php echo $mobile_no; ?>">
                                                <input type="hidden" name="email_id" value="<?php echo $email_id; ?>">
                                                <input type="hidden" name="total" value="<?php echo round($row['amount_per_person']); ?>">
                                                <input type="hidden" name="late" value="<?php echo $extra; ?>">
                                                <input type="submit" class="btn btn-primary" name="confirm" value="Confirm">
                                            </form>
                                            <pre>  </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php 
                                }
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu1" class="container tab-pane fade">
            <div class="row">
                <div class="col-sm-12" style=" height:50px; ">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bill Description</th>
                                <th>Month</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>View</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = "select * from tblregistration where owner_id=$getid";
                            $getdata = mysqli_query($conn, $data);
                            $r = mysqli_fetch_array($getdata);
                            $plot = $r['plot_no'];
                            $owner_name = $r['owner_name'];
                            $mobile_no = $r['mobile_no'];
                            $email_id = $r['email_id'];

                            $gettabel = "select * from tblpayment_type order by paymenttype_id desc";
                            $getrows = mysqli_query($conn, $gettabel);
                            while ($rows = mysqli_fetch_array($getrows)) {
                                $t_id = $rows['paymenttype_id'];
                                $type = $rows['type_name'];
                                $month = $rows['bill_month'];
                                $t_data = "select * from tblpayment_details where paymenttype_id=$t_id and owner_id=$getid order by details_id desc";
                                $t_getdata = mysqli_query($conn, $t_data);
                                if (mysqli_num_rows($t_getdata) > 0) {
                                    $t_row = mysqli_fetch_array($t_getdata);
                                    $td_id = $t_row['details_id'];
                                    $transaction = $t_row['transaction_number'];
                                    $date = $t_row['payment_date'];
                                    $amount = $t_row['total_amount'];
                                    $late=$t_row['late_fee'];
                                    $total1=round($rows['amount_per_person'])+$late;

                            ?>
                                    <tr>
                                        <td><?php echo $rows['type_name']; ?></td>
                                        <td><?php echo $rows['bill_month']; ?></td>
                                        <td><?php echo $rows['start_date']; ?></td>
                                        <td><?php echo "Rs." . $total1; ?></td>
                                        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-viewbill-lg<?php echo $t_id; ?>">View Bill</button></td>
                                        <td><a href="payment_recepit.php?id=<?php echo $td_id; ?>" target="_blank"><button class="btnDownload"><i class="fa fa-download"></i> Download</button></a></td>
                                    </tr>
                                    <div class="modal fade bd-viewbill-lg<?php echo $t_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $type; ?> Bill</h5>
                                                    <div class="col-sm-5"></div>

                                                    <h5>Receipt No : <?php echo $transaction; ?></h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        Invoice : 
                                                                        <strong><?php echo $date ?></strong>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <center> <strong>Month : </strong><?php echo $month; ?></center>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <span class="float-right"> <strong>Status:</strong><span style="color: green;"> Paid</span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row mb-4">
                                                                    <div class="col-sm-6">
                                                                        <h6 class="mb-3">From:</h6>
                                                                        <div>
                                                                            <strong>Smart Society</strong>
                                                                        </div>
                                                                        <div>R.C. technical road</div>
                                                                        <div>Near I.D. Patel School</div>
                                                                        <div>Ahmedabad-380061, Gujarat</div>
                                                                        <div>Email: <a href="mailto:societyissmart@gmail.com?Subject=Hello%20again" target="_top"> societyissmart@gmail.com</a>
                                                                        </div>
                                                                        <div>Phone: +91 444 666 3333</div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <h6 class="mb-3">To:</h6>
                                                                        <div>
                                                                            <strong><?php echo $owner_name; ?></strong>
                                                                        </div>
                                                                        <div><?php echo $plot; ?>,Smart Society</div>
                                                                        <div>Email: <?php echo $email_id; ?></div>
                                                                        <div>Phone: <?php echo $mobile_no; ?></div>
                                                                    </div>
                                                                </div>
                                                                <div style="  border-width:5px;  
    border-style:groove; ">
                                                                    <div class="table1">
                                                                        <div class="table1-row">
                                                                            <div class="table1-col">
                                                                                <pre style="text-align: center"><b>#</b></pre>
                                                                            </div>
                                                                            <div class="table1-col">
                                                                                <pre style="text-align: center"><b>Item</b></pre>
                                                                            </div>
                                                                            <div class="table1-col">
                                                                                <pre style="text-align: center"><b>Amount</b></pre>
                                                                            </div>
                                                                        </div>

                                                                        <?php if ($rows['list_name2'] != '' && $rows['list_name3'] != '' && $rows['list_name4'] != '') { ?>

                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">1</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name1'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list1_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">2</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name2'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list2_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">3</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name3'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list3_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">4</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name4'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list4_amount']; ?></pre>
                                                                                </div>
                                                                            </div>

                                                                        <?php } else if ($rows['list_name2'] != '' && $rows['list_name3'] != '' && $rows['list_name4'] == '') { ?>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">1</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name1'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list1_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">2</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name2'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list2_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">3</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name3'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list3_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                        <?php } else if ($rows['list_name2'] != '' && $rows['list_name3'] == '' && $rows['list_name4'] == '') { ?>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">1</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name1'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list1_amount']; ?></pre>
                                                                                </div>
                                                                            </div>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">2</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name2'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list2_amount']; ?></pre>
                                                                                </div>
                                                                            </div> <?php } else { ?>
                                                                            <div class="table1-row">
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center">1</pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo $rows['list_name1'] ?></pre>
                                                                                </div>
                                                                                <div class="table1-col">
                                                                                    <pre style="text-align: center"><?php echo "Rs." . $rows['list1_amount']; ?></pre>
                                                                                </div>
                                                                            </div> <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Change font according to the modal other fonts by harshil patel-->

                                                                <div class="row">
                                                                    <div class="col-sm-6"></div>
                                                                    <div class="col-sm-3">
                                                                        <div class="float-right c3">Subtotal</div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div><?php echo "Rs. " . $rows['total_amount']; ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6"></div>
                                                                    <div class="col-sm-3">
                                                                        <div class="float-right c3">Amount per House</div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div><?php echo "Rs. " . $amount; ?></div>
                                                                    </div>
                                                                </div>
                                                                <?php if($late!=0){ ?>
                                                                <div class="row">
                                                                    <div class="col-sm-6"></div>
                                                                    <div class="col-sm-3">
                                                                        <div class="float-right c3">Late Fee</div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div><?php echo "Rs. " . $late; ?></div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-sm-6"></div>
                                                                    <div class="col-sm-3">
                                                                        <div class="float-right c3">Total</div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div><?php echo "Rs. " . $total1; ?></div>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="payment_recepit.php?id=<?php echo $td_id; ?>" target="_blank"><button class="btnDownload"><i class="fa fa-download"></i> Download</button></a>
                                                    <pre>  </pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Bill Description</th>
                                <th>Month</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>View</th>
                                <th>Download</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>


            </div>
        </div>
    <?php
    
    if (isset($_SESSION['ownerId'])) {
        $id = $_SESSION['ownerId'];
        $type = "Owner";
    }
    
    if (isset($_SESSION['rentId'])) {
        $id = $_SESSION['rentId'];
        $type = "Rent";
    }
    
    ?>
    
 <div id="extrapay" class="container tab-pane fade">
            <div class="row">
                <div class="col-sm-12" style=" height:10px; ">
                </div>
            </div>
			
			 <div class="row">
                <div class="col-sm-12">
				
				<div class="formclass">
            <div class="jumbotron">
                <div class="container-fluid">

                    
                    <form action="payment.php" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
					
						<div class="form-group">
                            <label for="title"><b>Title:</b></label>
                            <select class="form-control" name="type">
                            <option value="Sponsorship">Sponsorship</option>
                            <option value="EventOther">Events</option>
                            <option value="Others">Others</option>
                            
                        </select>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
						<div class="form-group">
                            <label for="name"><b>Description:</b></label>
                            <input type="text" class="form-control" id="desc" placeholder="Description" name="description" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
						<div class="form-group">
                            <label for="amount"><b>Amount:</b></label>
                            <input type="text" class="form-control" id="amount" placeholder="Enter Amount" name="amount" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                       
                        
                        <div class="form-group"></div>
                        <button type="submit" class="btn btn-primary" name="submit_Ext">Submit</button>
                    </form>
                </div>
            </div>

				</div>
			</div>
			 </div>
					
				
                </div>
    
    
    
    
    
    
    </div>
</div>
</div>
</body>

<?php

if (isset($_POST['submit_Ext'])) {
    

    if (isset($_SESSION['ownerId'])) {
        $id = $_SESSION['ownerId'];
        $type = "Owner";
    }
    
    if (isset($_SESSION['rentId'])) {
        $id = $_SESSION['rentId'];
        $type = "Rent";
    }

    $title=$_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    
  $query = "insert into tblextrpay (owner_id,title,description,amount,type) values ($id,'$title','$description',$amount,'$type')";
        $getresult = mysqli_query($conn, $query);
     if ($getresult) {
            echo "<script>alert('Extra Payement for event done successfully')</script>";
            echo "<script>window.location='payment.php'</script>";
        } else {
            echo "<script>alert('Extra Payment for event failed')</script>";
            echo "<script>window.location='payment.php'</script>";
        }
    }
?>


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