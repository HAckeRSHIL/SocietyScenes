<?php
include('header.php');
?>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-8" id="pa">

        <p style="font-size: 40px;">Payment Entry</p><br>
        <form action="paymentadd.php" method="POST">
            <div><b><label for="text">Cause Of Payment</label><input type="text" class="form-control" name="cause" placeholder="eg: Maintenance" style="width:420px" required></div>
            <label for="text">Cause 1</label>
            <div class="row" style="margin-left:2px;"><input type="text" name="cause1" class="form-control" placeholder="eg : Electricity Bill" style="width:
        200px;" required><b style="padding-top:5 px;">-></b>
                <input type="number" name="t21" class="form-control" placeholder="Enter Amount" style="width: 200px;" required></div>

            <label for="text">Cause 2</label>
            <div class="row" style="margin-left:2px;"><input type="text" name="cause2" class="form-control" placeholder="eg : Water Bill" style="width:
        200px;"><b style="padding-top:5 px;">-></b>
                <input type="number" name="t22" class="form-control" value="0" placeholder="Enter Amount" style="width: 200px;"></div>

            <label for="text">Cause 3</label>
            <div class="row" style="margin-left:2px;"><input type="text" name="cause3" class="form-control" placeholder="eg : Cleaning Bill" style="width:
        200px;"><b style="padding-top:5 px;">-></b>
                <input type="number" name="t23" class="form-control" placeholder="Enter Amount" style="width: 200px;" value="0"></div>

            <label for="text">Cause 4</label>
            <div class="row" style="margin-left:2px;"><input type="text" name="cause4" class="form-control" placeholder="eg : Extra Bill" style="width:
        200px;"><b style="padding-top:5 px;">-></b>
                <input type="number" name="t24" class="form-control" placeholder="Enter Amount" style="width: 200px;" value="0"></div>


            <label for="text">Starting Date</label>
            <div><input type="date" style="width: 420px;" class="form-control" name="date" required></div>
            <label for="text">Duration</label>
            <div><input type="text" class="form-control" name="months" placeholder="Duration(Months) Ex.June-September 2018" style="width: 420px;" required></div>

            <label for="text">Total Amount</label>
            <div><input type="text" class="form-control" name="dur" placeholder="Amount(Rs)" style="width: 420px;" readonly><br></div>
            <label for="text">Amount Per House</label>
            <div><input type="text" class="form-control" name="perperson" placeholder="Amount(Rs)" style="width: 420px;" readonly><br></div>

            <div><input type="submit" class="btn btn-primary a1" name="submit" style="width: 420px;"><br></div>
        </form>
    </div>

    <div class="col-sm-2"></div>
</div>
</body>

</html>


<script>
    $(document).ready(function(e) {
        $("input").change(function() {
            var total = 0;
            $("input[name=t21]").each(function() {
                total = total + parseInt($(this).val());
            })
            $("input[name=t22]").each(function() {
                total = total + parseInt($(this).val());
            })
            $("input[name=t23]").each(function() {
                total = total + parseInt($(this).val());
            })
            $("input[name=t24]").each(function() {
                total = total + parseInt($(this).val());
            })
            $("input[name=dur]").val(total);
        });
    });

    $(document).ready(function(e) {
        $("input").change(function() {
            var total1 = 0;
            $("input[name=dur]").each(function() {
                total1 = parseFloat($(this).val()) / 24;
            })
            $("input[name=perperson]").val(total1);
        });
    });
</script>

<?php
    if(isset($_POST['submit'])){
        $name=$_POST['cause'];
        $cause1=$_POST['cause1'];
        $amount1=$_POST['t21'];
        $cause2=$_POST['cause2'];
        $amount2=$_POST['t22'];
        $cause3=$_POST['cause3'];
        $amount3=$_POST['t23'];
        $cause4=$_POST['cause4'];
        $amount4=$_POST['t24'];
        $date=$_POST['date'];
        $timedate=strtotime($date);
        $new_date=date("Y-m-d",$timedate);
        $months=$_POST['months'];
        $amount=$_POST['dur'];
        $peramount=$_POST['perperson'];

        $query="INSERT INTO `tblpayment_type`(`type_name`, `start_date`, `total_amount`, `bill_month`, `list_name1`, `list1_amount`, `list_name2`, `list2_amount`, `list_name3`, `list3_amount`, `list_name4`, `list4_amount`, `amount_per_person`) VALUES ('$name','$new_date',$amount,'$months','$cause1',$amount1,'$cause2',$amount2,'$cause3',$amount3,'$cause4',$amount4,$peramount)";
        $get=mysqli_query($conn,$query);
        if($get){
            echo "<script>alert('Payment Added Successfully.')</script>";
            echo "<script>window.location='paymentadd.php'</script>";
        }   
        else{
            echo "<script>alert('Payment Adding Fail.')</script>";
        }
    }
?>