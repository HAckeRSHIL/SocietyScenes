<?php
//include "db.php";
//if(isset($_GET['id'])){
 //   $id=$_GET['id'];
    ini_set('max_execution_time', 300);
    include "../fpdf181/fpdf/fpdf.php";
    $pdf = new FPDF('L','mm','A4'); 
    $pdf->setFont("Arial","B",16);
    $image1 = "final-01.jpg";
    $conn=mysqli_connect("localhost","root","","vaa");
    $query="SELECT * FROM `vaa_prof` WHERE `branch`='Information Technology' and `passingYear`='2020'";
    $run_query=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($run_query)){ 
       $pdf->AddPage();
       $id=$row['id'];
       $pass=$row['passingYear'];
       $fname=$row['firstName'];
       $mname=$row['middleName'];
       $lname=$row['lastName'];
       $passyear=$row['passingYear'];
       $branch=$row['branch'];
       $enroll=$row['enrollNo'];
       $mobile=$row['mobile'];
       $emailid=$row['emailID'];
       $address=$row['address'];
       $distric=$row['district'];
       $state=$row['state'];
       $postcode=$row['postalcode'];

       $name=$distric.",".$state."-".$postcode;
       //$pic=$row['pic'];

        if($address==''){
            $address1='';
            $address2='';
            $address3='';
        }
        else if(strlen($address)<35){
            $address1=$address;
            $address2='';
            $address3=''; 
        }
        else if(strlen($address)>35 && strlen($address)<70){
            $address1=substr($address,0,35);
            $address2=substr($address,35);
            $address3='';
        }
        else{        
            $address1=substr($address,0,35);
            $address2=substr($address,35,70);
            $address3=substr($address,70);  
       }

            $str="$fname $mname $lname";
            $str1="VAA2018001";
            if(strlen($id)==2){
        	    $str2="VAA".$pass."00".$id;
        	}
        	else if(strlen($id)==3){
        	    $str2="VAA".$pass."0".$id;
        	}
        	else{
        	    $str2="VAA".$pass.$id;
        	}

        $pdf->Cell( 0,0, $pdf->Image($image1, 0, 0,297,210), 0, 0, 'I', false );

        $pdf->SetFont('Helvetica','B',20); // Font Name, Font Style (eg. 'B' for Bold), Font Size

        $pdf->SetTextColor(0,0,0); // RGB

        $pdf->SetXY(110, 84); // X start, Y start in mm

        $pdf->Write(0, $str);

        $pdf->SetXY(238.55, 70.5); // X start, Y start in mm

        $pdf->Write(0, $str2);

        $pdf->SetXY(142,97.5);
        $pdf->Write(0, $passyear);

        $pdf->SetXY(125,111);
        $pdf->Write(0, $enroll);
       
        $pdf->SetXY(125,125.5);
        $pdf->Write(0, $branch);

        if($address1!='' && $address2=='' && $address3==''){
        $pdf->SetXY(125,139.5);
        $pdf->Write(0, $address1);

        $pdf->SetXY(125,147.5);
        $pdf->Write(0, $name);
    	}
        else if($address1!='' && $address2!='' && $address3==''){
        $pdf->SetXY(125,139.5);
        $pdf->Write(0, $address1);

        $pdf->SetXY(125,147.5);
        $pdf->Write(0, $address2);

        $pdf->SetXY(125,155.5);
        $pdf->Write(0, $name);
    	}
        else if($address1!='' && $address2!='' && $address3!=''){
        $pdf->SetXY(125,139.5);
        $pdf->Write(0, $address1);

        $pdf->SetXY(125,147.5);
        $pdf->Write(0, $address2);

        $pdf->SetXY(125,155.5);
        $pdf->Write(0, $address3);

        $pdf->SetXY(125,163.5);
        $pdf->Write(0,$name);
    	}

        $pdf->SetXY(125,176.5);
        $pdf->Write(0, $emailid);

        $pdf->SetXY(130,189.99);
        $pdf->Write(0, $mobile);

        //$pdf->Image($pic,11.5,77,65.5,89.5);
        
             
    }  
    $name="I-Card.pdf";
        $pdf->Output($name,"D");
//}
?>
