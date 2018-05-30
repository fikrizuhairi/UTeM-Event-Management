 
<!DOCTYPE html>
<?php
	include("connect.php");
	session_start();
	if(!isset($_SESSION["organizer"]))
	{
	  header("location:index.php");
	}
	$sql = "select *
	from organizer
	where organizer_id = '".$_SESSION['organizer']."' ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	
	$sql1= "select COUNT(program_code) as A from program where organizer_id IS NULL AND status_program='pending' ORDER BY program_code ASC ";
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	
	$sql2= "select COUNT(program_code) as B from program where staff_matric_no IS NULL AND status_program='pending' ORDER BY program_code ASC ";
	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2);
	
	$sql3= "SELECT COUNT(program_code) as C from program where status_program='pending' ";
	$result3 = mysqli_query($conn,$sql3);
	$row3 = mysqli_fetch_array($result3);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>UTeM Event</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>UTeM EVENT</b></a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
     <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  
              	  <h5 class="centered"><?php echo $row["organizer_name"]; ?></h5>
				  <h5 class="centered">Organizer</h5>
              	  	
                  <li class="mt">
                      <a  href="OrganizerIndex.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-bank"></i>
                          <span>Event</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="registerEventOrganizer.php">Register event</a></li>
						  <li><a  href="statusEventOrganizer.php">Status Event</a></li>
						  <li><a  href="previousEventOrganizer.php">Previous Event</a></li>
					  </ul>
                  </li>
				  <li class="sub-menu">
                      <a class ="active" href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="eventAnalysisOrganizer.php">Event Analysis</a></li>
                          <li class="active"><a  href="feedbackEventOrganizer.php">Feedback event</a></li>
                      </ul>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="	fa fa-institution"></i> Feedback Event</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Event name</h4>
					  <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
					  <?php 
					  $txtKeyword = '';
					  if(isset($_GET['txtKeyword']) && strlen(trim($_GET['txtKeyword'])) >0) 
					  {
						$txtKeyword = trim($_GET['txtKeyword']);
					  }
					  ?>

							<input style="width: 30%" name="txtKeyword" type="text" id="txtKeyword" placeholder="Insert event name" value="<?php echo $txtKeyword;?>">
							<input type="submit" class="btn btn-default btn-sm" value="Search"></th>	
					</form>
					<br>

					<section id="unseen">
					
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
								  <th>Index</th>
								  <th>Event code</th>
                                  <th>Event Name</th>
                                  <th>Start date</th>
                                  <th class="numeric">End Date</th>
                                  <th class="numeric">Location</th>
								  <th class="numeric">Feedback</th>

                              </tr>
                              </thead>
                              <tbody>
                              <tr>
							 <?php

						if($txtKeyword != "")
						{ 
								  $strSQL = "SELECT * FROM program WHERE (program_name LIKE '%".$txtKeyword."%'AND status_program='approved' and end_date < CURDATE() and staff_matric_no IS NULL ORDER BY end_date DESC)";
								  $objQuery = mysqli_query($conn, $strSQL) or die ("Error Query [".$strSQL."]");
						  
								  $i = 0;
								  while($objResult = mysqli_fetch_array($objQuery))
								  {
																  
									  $i++;
									?>
	
									  <td> <?php echo $i++; ?> </td>
									  <td> <?php echo $objResult['program_code'] ?></td>
									  <td> <?php echo $objResult['program_name'] ?></td>
									  <td> <?php echo $objResult['start_date'] ?></td>
									  <td> <?php echo $objResult['end_date'] ?></td>
									  <td> <?php echo $objResult['program_location'] ?></td>
									  <td><a href="viewFeedback.php?program_code=<?php echo $objResult['program_code']; ?>"><button type="button" class="btn btn-primary">View feedback</button></td>
									
								  </tr>
								  <?php
								  }
								  ?>
                              </tbody>
                          </table>
								  <?php
						}
						else
						{
							$sql = "SELECT * FROM program WHERE end_date < CURDATE() AND status_program='approved' and staff_matric_no IS NULL  ORDER BY end_date DESC";
							$result1 = mysqli_query($conn, $sql);

							$i = 1;
							 while ($rows = mysqli_fetch_array($result1)) 
							 {

								echo "<tr>";
								  echo "<td>" . $i++. "</td>";
								  echo "<td>" . $rows['program_code']. "</td>";
								  echo "<td>" . $rows['program_name']. "</td>";
								  echo "<td>" . $rows['start_date']. "</td>";
								  echo "<td>" . $rows['end_date'] . "</td>";
								  echo "<td> " . $rows['program_location']. "</td>";
								  echo " <td><a href='viewFeedbackOrganizer.php?program_code=".$rows['program_code']."'><button type='button' class='btn btn-primary'>View feedback</button></td>";  
							  }

						}
						
						mysqli_close($conn);
						?>
                               </tr>
                              </tbody>
                          </table>
                          </section>
                  </div>
				  
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
           
		   <!--  <input type="submit" name="RegisterEvent" style="float:Right; margin-right:30px" value="Register Event"> -->
			
          	</form>
         
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->


      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - UTeM Event Management
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
