<?php include("header.php"); ?>
<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <style>
    body {
      font-family: "Lato", sans-serif;
      background-color: #DCDCDC;

    }

    .intro {
      margin: 10px;
      outline: 1px solid #CCC;
      height: auto;
      overflow: auto;
    }

    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #2F4F4F;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 20px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }
  </style>
</head>

<body>


  <div id="main">
    
  

    <div class="container">
      <h2 style="text-align: center;margin: 10px;">Resident Details</h2>
      <br>
      <!-- Nav pills -->
      <div style="padding-left: 3%">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#owner">Owner</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#tenant">Tenant</a>
            </li>
         
        </ul>
      </div>
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="owner" class="container tab-pane active"><br>
          <div class="container">
            <div class="jumbotron">
              
			  <center>
	<table id="example" class="row-border hover order-column" style="width:100%">
        <thead>
            <tr>
			    <th>Block No</th>
                <th>Name</th>
				        <th>Mobile No</th>
                <th>View</th>
              
            </tr>
        </thead>
        <tbody>
<?php
$query = "select * from tblregistration";
$getquery = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($getquery)) {
$block_no = $row['plot_no'];
$owner_name = $row['owner_name'];
$mno = $row['mobile_no'];
$mno2 = $row['mobile_no_2'];
$email = $row['email_id'];
$photo = $row['owner_photo'];
$identity = $row['owner_identity'];
$total_person = $row['no_of_person'];                         
?>

<tr>
    <td><?php echo $block_no; ?></td>
    <td><?php echo $owner_name; ?></td>
    <td><?php echo $mno; ?></td>
    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewoldcomplain<?php echo $block_no; ?>"> View
        </button></td>
</tr>
<div class="modal" id="viewoldcomplain<?php echo $block_no; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="text-align: left;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Owner Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="font-family: verdana;">
                <div class="table1">
                  <div class="table1-row">
                  <div class="table1-col"></div>
                  <div class="table1-col">
                    <div class="table1-col">
                      <?php if ($photo != null) { ?>
                        <br>  
                          &nbsp;<img src="../images/profile/<?php echo $photo; ?>" style="border: 2px solid black; width: 200px;height:200px; margin-top: -50px;"><br>
                      <?php } ?>
                    </div>
                  </div>
                  <div style="float:right; margin-right:10px;">
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Name</b>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 2px;">: <?php echo $owner_name; ?>
                        </div>

                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Block No</b></p>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $block_no; ?></p>
                        </div>
                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Mobile No</b></p>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $mno; ?></p>
                        </div>
                    </div>
                    <?php if ($mno2 != null) { ?>
                          <div class="table1-row">
                              <div class="table1-col">
                                  <p><b style="font-family:Verdana;">Mobile No 2</b></p>
                              </div>
                              <div class="table1-col">
                                  <p style="font-size: 13px;margin-top: 3px;">: <?php echo $mno2; ?></p>
                              </div>
                          </div>
                    <?php } ?>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Email</b></p>
                        </div>
                        <div class="table2-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Total Person </b></p>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $total_person; ?></p>
                        </div>
                    </div>
                </div>
            </div>
                </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>

                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </tbody>
        <tfoot>
            <tr>
                <th>Block No</th>
                <th>Name</th>
				        <th>Mobile No</th>
                <th>View</th>
            </tr>
        </tfoot>
    </table>
  </center>
			  
            </div>
   
          </div>
        </div>












        <div id="tenant" class="container tab-pane fade"><br>
          <div class="container">
            <div class="jumbotron">
              
			  <center>
	<table id="example1" class="row-border hover order-column" style="width:100%">
        <thead>
            <tr>
                <th>Block No</th>
                <th>Name</th>
	         			<th>Mobile No</th>
                <th>View</th>
           </tr>
        </thead>
        <tbody>
        <?php
            $query = "select * from tblrenttable";
            $getquery = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($getquery)) {
                
                $owner_id = $row['owner_id'];
                $tenant_name = $row['tenant_name'];
                $mno = $row['mobile_no'];
                $email = $row['email_id'];
                $photo = $row['tenant_photo'];
                $total_person = $row['no_of_persons'];

                $query1 = "select * from tblregistration where owner_id=$owner_id";
                $getquery1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_array($getquery1);
                $block_no=$row1['plot_no'];
                $owner_name=$row1['owner_name'];

            ?>

<tr>
    <td><?php echo $block_no; ?></td>
    <td><?php echo $tenant_name; ?></td>
    <td><?php echo $mno; ?></td>
    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tenant<?php echo $block_no; ?>"> View
        </button></td>
</tr>
<div class="modal" id="tenant<?php echo $block_no; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="text-align: left;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tenant Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="font-family: verdana;">
                <div class="table1">
                  <div class="table1-row">
                      
                  <div class="table1-col"></div>
                  <div class="table1-col">
                    <div class="table1-col">
                      <?php if ($photo != null) { ?>
                      <br>  
                          &nbsp;<img src="../images/profile/<?php echo $photo; ?>" style="border: 2px solid black; width: 200px;height:200px; margin-top: -50px;"><br>
                      <?php } ?>
                    </div>
                  </div>
                  <div style="float:right; margin-right:10px;">
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Name</b>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 2px;">: <?php echo $tenant_name; ?>
                        </div>

                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Block No</b></p>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $block_no; ?></p>
                        </div>
                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Mobile No</b></p>
                        </div>
                        <div class="table1-col">
                            <span style="font-size: 13px;margin-top: 3px;">: <?php echo $mno; ?></span>
                        </div>
                    </div>
                    <?php if ($mno2 != null) { ?>
                          <div class="table1-row">
                              <div class="table1-col">
                                  <p><b style="font-family:Verdana;">Mobile No 2</b></p>
                              </div>
                              <div class="table1-col">
                                  <p style="font-size: 13px;margin-top: 3px;">: <?php echo $mno2; ?></p>
                              </div>
                          </div>
                    <?php } ?>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Email</b></p>
                        </div>
                        <div class="table2-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="table1-row">
                        <div class="table1-col">
                            <p><b style="font-family:Verdana;">Total Person </b></p>
                        </div>
                        <div class="table1-col">
                            <p style="font-size: 13px;margin-top: 3px;">: <?php echo $total_person; ?></p>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>

                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </tbody>
        <tfoot>
            <tr>
                <th>Block No</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>View</th>
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
            function openNav() {
                document.getElementById("heading").style.marginLeft = "200px";
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                document.getElementById("main2").style.marginLeft = "250px";
                document.getElementById("mySidebar").style.display = "block";
                document.getElementById("openNav").style.display = 'none';
            }

            function closeNav() {
                document.getElementById("heading").style.marginLeft = "0";
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0%";
                document.getElementById("mySidebar").style.display = "none";
                document.getElementById("openNav").style.display = "inline-block";
            }
			
			$(document).ready(function() {
    var table = $('#example1').DataTable();
     
    $('#example1 tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );
} );

$(document).ready(function() {
    var table = $('#example').DataTable();
     
    $('#example tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );
} );
		
        </script>
</body>
</html>