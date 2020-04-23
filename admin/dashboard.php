<?php include("header.php");?>
<div class="wrapper ">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">supervisor_account</i>
                  </div>
                  <p class="card-category">Total Residents</p>
                  <h3 class="card-title">
                    <?php 
                    $query = "select * from tblregistration";
                    $get = mysqli_query($conn, $query);
                    $count=mysqli_num_rows($get);
                    echo "$count";
                     ?>
                    <small>Persons</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">stars</i>
                    <a href="view_residents.php">Manage Rights</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Fund</p>
                  <?php
                      $ct=40000;
                      $query="select * from tblextrpay";
                      $get=mysqli_query($conn,$query);             
                      while($row=mysqli_fetch_array($get)){
                        $amount=$row['amount'];
                        $ct=$ct+$amount;
                      }

                  ?>
                  <h3 class="card-title">₹<?php echo $ct;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Pending Issues</p>
                  <h3 class="card-title">
                  <?php
                      $query = "select * from tblcomplaint";
                      $getquery = mysqli_query($conn, $query);
                      $ct = 0;
                      while ($row = mysqli_fetch_array($getquery)) {
                      $status1 = $row['status'];
                      
                      if($status1 == 'Pending')
                      {
                        $ct=$ct+1;
                      } }
                      echo "$ct";
                  ?>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Tracked from Complain Box
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">event_note</i>
                  </div>
                  <p class="card-category">Statistics</p>
                  <h3 class="card-title">3<small> Graphs</small></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Last Month Record
                  </div>
                </div>
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title" style="color: white;">Roles :</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#admins" data-toggle="tab">
                            <i class="material-icons">event_seat</i> Chairmans
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#secretary" data-toggle="tab">
                            <i class="material-icons">supervisor_account</i> secretaries
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#comitee" data-toggle="tab">
                            <i class="material-icons">work</i> Management
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="admins">
                      <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Block No</th>
                      <th>Name</th>
                      <th>Role</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>B-201</td>
                        <td>Harshil Patel</td>
                        <td>Core Chairman</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>D-302</td>
                        <td>Dhruvil Shah</td>
                        <td>Assistant Chairman</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                    </div>
                    <div class="tab-pane" id="secretary">
                      <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Block No</th>
                      <th>Name</th>
                      <th>Role</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>A-101</td>
                        <td>Fenil Parmar</td>
                        <td>System Admin</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>C-202</td>
                        <td>Harsh Reddiar</td>
                        <td>System Admin</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>A-302</td>
                        <td>Aman Patel</td>
                        <td>Secratary</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                    </div>
                    <div class="tab-pane" id="comitee">
                      <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Block No</th>
                      <th>Name</th>
                      <th>Role</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>C-302</td>
                        <td>Marmik Patel</td>
                        <td>Chief Comitee</td>
                      </tr>
                        <tr>
                        <td>2</td>
                        <td>A-302</td>
                        <td>Meet Patel</td>
                        <td>Comitee member</td>
                      </tr>
                        <tr>
                        <td>3</td>
                        <td>D-302</td>
                        <td>Sarjan Patel</td>
                        <td>Treasurer</td>
                      </tr>
                        <tr>
                        <td>4</td>
                        <td>B-302</td>
                        <td>Nimesh Panchal</td>
                        <td>Event Manager</td>
                      </tr>
                        <tr>
                        <td>5</td>
                        <td>D-204</td>
                        <td>Ravi Prajapati</td>
                        <td>Comitee member</td>
                      </tr>
                        <tr>
                        <td>6</td>
                        <td>C-206</td>
                        <td>Deven Mudhava</td>
                        <td>Comitee member</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title" style="color: white;">Staff Stats</h4>
                 <p class="card-category">Permanent Employed Person (Annual Salary)</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Salary</th>
                      <th>Role</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Shyam Sheth</td>
                        <td>₹36,738</td>
                        <td>Gardener</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Jigabhai Patel</td>
                        <td>₹23,789</td>
                        <td>Sweeper</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Rasiklal Chaudhary</td>
                        <td>₹56,142</td>
                        <td>Gate Keeper</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Katrina Kaif</td>
                        <td>₹38,735</td>
                        <td>Sweeper</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>