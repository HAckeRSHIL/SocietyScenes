<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    ini_set('max_execution_time', 300);
    include("Connection.php");
    include("./fpdf181/fpdf/fpdf.php");
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->setFont("Arial", "B", 16);
    $image1 = "Fulla.jpg";

    $query="select * from tblpayment_details where details_id=$id";
    $getquery=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($getquery);
    $paymentid=$row['paymenttype_id'];
    $ownerid=$row['owner_id'];
    $transction=$row['transaction_number'];
    $total=$row['total_amount'];
    $date=$row['payment_date'];
    $mobile=$row['mobile_no'];
    $email=$row['emailid'];
    $late=$row['late_fee'];

    $oquery="select * from tblregistration where owner_id=$ownerid";
    $ogetquery=mysqli_query($conn,$oquery);
    $orow=mysqli_fetch_array($ogetquery);
    $name=$orow['owner_name'];
    $plot=$orow['plot_no'];

    $tquery="select * from tblpayment_type where paymenttype_id=$paymentid";
    $tgetquery=mysqli_query($conn,$tquery);
    $trow=mysqli_fetch_array($tgetquery);
    $type=$trow['type_name'];
    $date = $trow['start_date'];
    $time = strtotime($date);
    $total2=$trow['total_amount'];
    $final = date("Y-m-d", strtotime("+1 month", $time));
    $month=$trow['bill_month'];
    $list1=$trow['list_name1'];
    $listamount1=$trow['list1_amount']; 
    $list2=$trow['list_name2'];
    $listamount2=$trow['list2_amount'];
    $list3=$trow['list_name3'];
    $listamount3=$trow['list3_amount'];
    $list4=$trow['list_name4'];
    $listamount4=$trow['list4_amount'];

    $pdf->AddPage();
    $pdf->Cell(0, 0, $pdf->Image($image1, 0, 0, 297, 210), 0, 0, 'I', false);
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY(23, 65);
    $pdf->Write(0, $name);
    $pdf->SetXY(23, 70);
    $pdf->Write(0, $plot.",Smart Society");
    $pdf->SetXY(23, 75);
    $pdf->Write(0, $mobile);
    $pdf->SetXY(23, 80);
    $pdf->Write(0, $email);

    $pdf->SetXY(223, 31);
    $pdf->Write(0, $date);
    $pdf->SetXY(223, 37);
    $pdf->Write(0, $transction);
    $pdf->SetXY(223, 43);
    $pdf->Write(0, $final);
    $pdf->SetXY(200, 49.5);
    $pdf->Write(0, $type." Bill: ".$month);

    if($list2!='' && $list3!='' && $list4!=''){
        $pdf->SetXY(23, 105);
        $pdf->Write(0, $list1);
        $pdf->SetXY(260, 105);
        $pdf->Write(0, "Rs. ".$listamount1);
        $pdf->SetXY(23, 110);
        $pdf->Write(0, $list2);
        $pdf->SetXY(260, 110);
        $pdf->Write(0, "Rs. ".$listamount2);
        $pdf->SetXY(23, 115);
        $pdf->Write(0, $list3);
        $pdf->SetXY(260, 115);
        $pdf->Write(0, "Rs. ".$listamount3);
        $pdf->SetXY(23, 120);
        $pdf->Write(0, $list4);
        $pdf->SetXY(260, 120);
        $pdf->Write(0, "Rs. ".$listamount4);
    }
    else if($list2!='' && $list3!='' && $list4==''){
        $pdf->SetXY(23, 105);
        $pdf->Write(0, $list1);
        $pdf->SetXY(260, 105);
        $pdf->Write(0, "Rs. ".$listamount1);
        $pdf->SetXY(23, 110);
        $pdf->Write(0, $list2);
        $pdf->SetXY(260, 110);
        $pdf->Write(0, "Rs. ".$listamount2);
        $pdf->SetXY(23, 115);
        $pdf->Write(0, $list3);
        $pdf->SetXY(260, 115);
        $pdf->Write(0, "Rs. ".$listamount3);
    }
    else if($list2!='' && $list3=='' && $list4==''){
        $pdf->SetXY(23, 105);
        $pdf->Write(0, $list1);
        $pdf->SetXY(260, 105);
        $pdf->Write(0, "Rs. ".$listamount1);
        $pdf->SetXY(23, 110);
        $pdf->Write(0, $list2);
        $pdf->SetXY(260, 110);
        $pdf->Write(0, "Rs. ".$listamount2);
    }
    else{
        $pdf->SetXY(23, 105);
        $pdf->Write(0, $list1);
        $pdf->SetXY(260, 105);
        $pdf->Write(0, "Rs. ".$listamount1);
    }

    $pdf->SetXY(180, 130);
    $pdf->Write(0, "Total Amount for Flat  :");

    $pdf->SetXY(260, 130);
    $pdf->Write(0, "Rs. ".$total2);


    if($late!=0){
        $pdf->SetXY(260, 138);
        $pdf->Write(0, "Rs. ".$late);
    }
    else{
        $pdf->SetXY(260, 138);
        $pdf->Write(0, "Rs. ".$late);
    }
    $total1=$total+$late;
    $pdf->SetXY(260, 144);
    $pdf->Write(0, "Rs. ".$total1);

    $name = "Payment.pdf";
    //$pdf->Output($name, "D");
    $pdf->Output($name, "I");
} else {
    echo "<script>window.location='payment.php'</script>";
}
