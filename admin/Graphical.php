<?php include('connection.php')?>
<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php 
    
    $qu1="select * from tblpayment_type where bill_month='January 2020'";
    $ge1=mysqli_query($conn,$qu1);
    $s1=0;
    while($row=mysqli_fetch_array($ge1))
    {
        $s1=$s1+$row['total_amount'];
    }

    $qu2="select * from tblpayment_type where bill_month='Febuary 2020'";
    $ge2=mysqli_query($conn,$qu2);
    $s2=0;
    while($row=mysqli_fetch_array($ge2))
    {
        $s2=$s2+$row['total_amount'];
    }

$qu3="select * from tblpayment_type where bill_month='March 2020'";
    $ge3=mysqli_query($conn,$qu3);
    $s3=0;
    while($row=mysqli_fetch_array($ge3))
    {
        $s3=$s3+$row['total_amount'];
    }

$qu4="select * from tblpayment_type where bill_month='April 2020'";
    $ge4=mysqli_query($conn,$qu4);
    $s4=0;
    while($row=mysqli_fetch_array($ge4))
    {
        $s4=$s4+$row['total_amount'];
    }

$qu5="select * from tblpayment_type where bill_month='May 2020'";
    $ge5=mysqli_query($conn,$qu5);
    $s5=0;
    while($row=mysqli_fetch_array($ge5))
    {
        $s5=$s5+$row['total_amount'];
    }

$qu6="select * from tblpayment_type where bill_month='June 2020'";
    $ge6=mysqli_query($conn,$qu6);
    $s6=0;
    while($row=mysqli_fetch_array($ge6))
    {
        $s6=$s6+$row['total_amount'];
    }

$qu7="select * from tblpayment_type where bill_month='July 2020'";
    $ge7=mysqli_query($conn,$qu7);
    $s7=0;
    while($row=mysqli_fetch_array($ge7))
    {
        $s7=$s7+$row['total_amount'];
    }

$qu8="select * from tblpayment_type where bill_month='August 2020'";
    $ge8=mysqli_query($conn,$qu8);
    $s8=0;
    while($row=mysqli_fetch_array($ge8))
    {
        $s8=$s8+$row['total_amount'];
    }
    
$qu9="select * from tblpayment_type where bill_month='September 2020'";
    $ge9=mysqli_query($conn,$qu9);
    $s9=0;
    while($row=mysqli_fetch_array($ge9))
    {
        $s9=$s9+$row['total_amount'];
    }

    $qu10="select * from tblpayment_type where bill_month='October 2020'";
    $ge10=mysqli_query($conn,$qu10);
    $s10=0;
    while($row=mysqli_fetch_array($ge10))
    {
        $s10=$s10+$row['total_amount'];
    }

    $qu11="select * from tblpayment_type where bill_month='November 2020'";
    $ge11=mysqli_query($conn,$qu11);
    $s11=0;
    while($row=mysqli_fetch_array($ge11))
    {
        $s11=$s11+$row['total_amount'];
    }

    $qu12="select * from tblpayment_type where bill_month='December 2020'";
    $ge12=mysqli_query($conn,$qu12);
    $s12=0;
    while($row=mysqli_fetch_array($ge12))
    {
        $s12=$s12+$row['total_amount'];
    }
?>

    
    <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Monthly Expense"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",
      	indexLabelFontSize: 16,
		dataPoints: [
			{ y: <?php echo"$s1"; ?> },
			{ y: <?php echo"$s2"; ?>},
			{ y: <?php echo"$s3"; ?>, },
			{ y: <?php echo"$s4"; ?> },
			{ y: <?php echo"$s5"; ?> },
			{ y: <?php echo"$s6"; ?> },
			{ y: <?php echo"$s7"; ?> },
			{ y: <?php echo"$s8"; ?> },
			{ y: <?php echo"$s9"; ?> , },
			{ y: <?php echo"$s10"; ?> },
			{ y: <?php echo"$s11"; ?> },
			{ y: <?php echo"$s12"; ?> }
            
		]
	}]
});
chart.render();

}
</script>
    
    
    </head>
    
    <body style="background-color:#D3D3D3;">

<?php 
    
    $query1="select * from tblcomplaint where status='Pending'";
    $get1=mysqli_query($conn,$query1);
    $ans1=mysqli_num_rows($get1);
        
    $query2="select * from tblcomplaint where status='Processing'";
    $get2=mysqli_query($conn,$query2);
    $ans2=mysqli_num_rows($get2);

    $query3="select * from tblcomplaint where status='Completed'";
    $get3=mysqli_query($conn,$query3);
    $ans3=mysqli_num_rows($get3);

    $query4="select * from tblcomplaint where status='Rejected'";
    $get4=mysqli_query($conn,$query4);
    $ans4=mysqli_num_rows($get4);
?>

<?php 
    
    $q1="select * from tblnotice where type='Maintenance break'";
    $g1=mysqli_query($conn,$q1);
    $a1=mysqli_num_rows($g1);
        
    $q2="select * from tblnotice where type='New Event'";
    $g2=mysqli_query($conn,$q2);
    $a2=mysqli_num_rows($g2);

    $q3="select * from tblnotice where type='Meeting'";
    $g3=mysqli_query($conn,$q3);
    $a3=mysqli_num_rows($g3);

    $q4="select * from tblnotice where type='Alert'";
    $g4=mysqli_query($conn,$q4);
    $a4=mysqli_num_rows($g4);
      
    $q5="select * from tblnotice where type='Inspection/Checking'";
    $g5=mysqli_query($conn,$q5);
    $a5=mysqli_num_rows($g5);
        
    $q6="select * from tblnotice where type='Policy/Rule Changes'";
    $g6=mysqli_query($conn,$q6);
    $a6=mysqli_num_rows($g6);
        
    $q7="select * from tblnotice where type='Requirements (Volunteering)'";
    $g7=mysqli_query($conn,$q7);
    $a7=mysqli_num_rows($g7);
        
    $q8="select * from tblnotice where type='Others'";
    $g8=mysqli_query($conn,$q8);
    $a8=mysqli_num_rows($g8);
      
?>

<center><h1>Statistics</h1></center>
<div class="row">
<div id="piechart"></div>
<div id="piechart1"></div>
</div>
<div id="chartContainer1" style="height: 200px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>        
        
        
        
        

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values

    
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Status', 'Number of persons'],
  ['Pending', <?php echo"$ans1"; ?>],
  ['Processing', <?php echo"$ans2"; ?>],
      ['Completed', <?php echo"$ans3"; ?>],
      ['Rejected', <?php echo"$ans4"; ?>]
 
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Request Stastistics', 'width':650, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
    chart.draw(data, options);
}
</script>


    
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Types', 'Number of Notices'],
  ['Maintainance Break', <?php echo"$a1"?>],
  ['New Event', <?php echo"$a2"?>],
  ['Meeting', <?php echo"$a3"?>],
  ['Alert', <?php echo"$a4"?>],
  ['Inspection/checking', <?php echo"$a5"?>],
  ['Policy/Rule Changes', <?php echo"$a6"?>],
  ['Volunteering', <?php echo"$a7"?>],
  ['Others', <?php echo"$a8"?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Notice Types(Last month)', 'width':650, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
  
    chart.draw(data, options);
}
</script>    
        
        
        
    
</body>
</html>
