<!DOCTYPE html>

<?php
include("connect.php");
session_start();
if(!isset($_SESSION["advisor"]))
{
  header("location:index.php");
}
$program =$_GET['program_code'];
$sql = "select *
from program
where program_code = '".$_GET['program_code']." ' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql1 = "select *
from staff
where staff_matric_no = '".$_SESSION['advisor']." ' ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

$sql2= "select COUNT(program_code) as A from program where organizer_id IS NULL AND status_program='pending' ORDER BY program_code ASC ";
	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2);
	
	$sql3= "select COUNT(program_code) as B from program where staff_matric_no IS NULL AND status_program='pending' ORDER BY program_code ASC ";
	$result3 = mysqli_query($conn,$sql3);
	$row3 = mysqli_fetch_array($result3);
	
	$sql4= "SELECT COUNT(program_code) as C from program where status_program='pending' ";
	$result4 = mysqli_query($conn,$sql4);
	$row4 = mysqli_fetch_array($result4);


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Better Muslim</title>

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
            <a href="advisorIndex.php" class="logo"><b>Bettter Muslim</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
							
                            <span class="badge bg-theme"><?php echo $row4['C'] ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?php echo $row4['C'] ?> pending tasks</p>
                            </li>
                            <li>
                                <a href="listToDoFICTS.php">
                                    <div class="task-info">
                                        <div class="desc">Staff request event</div>
                                        <div class="percent"><?php echo $row2['A']?>%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row2['A']?>%">
                                            <span class="sr-only"><?php echo $row2['A']?>% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="listToDo.php">
                                    <div class="task-info">
                                        <div class="desc">Other organizer request event</div>
                                        <div class="percent"><?php echo $row3['B']?>%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row3['B']?>%">
                                            <span class="sr-only"><?php echo $row3['B']?>% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="listToDoAll.php">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    
                </ul>
                <!--  notification end -->
            </div>
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
	  <?php
					$advisorno= $_SESSION["advisor"];
					//echo "<br><br><br>" . $username;
					$strSQL = "SELECT * FROM staff WHERE staff_matric_no='$advisorno'";
					$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
					$objResult = mysqli_fetch_assoc($objQuery);
					//echo $objResult['ficts_name'];
					?>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  
              	  <h5 class="centered"><?php echo $objResult['staff_name'];?></h5>
				  <h5 class="centered">Advisor</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="advisorIndex.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-bookmark"></i>
                          <span>List Of Event Request</span>
                      </a>
                      <ul class="sub">
						  <li><a href="listToDoAll.php" >All event request</a></li>
						  <li><a  href="listToDoFICTS.php" >Event request</a></li>
                          <!-- <li><a  href="listToDo.php" >Event request (Other)</a></li>  -->
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-bank"></i>
                          <span>Event</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="previousEvent.php">Previous event</a></li>
                      </ul>
                  </li>
                 <!--  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="reportGraph.php">Event Analysis</a></li>
                          <li><a  href="feedbackEvent.php">Feedback event</a></li>
                      </ul>
                  </li> -->
                 

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
                  	<div class="row mtbox">
                  		<h2 style="margin-top:-40px;"><i class="fa fa-bullhorn"></i>Information Detail</h2>
                  	
                  	</div><!-- /row mt -->	
       
            <div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
				    <h4><i class="fa fa-angle-right"></i> Information</h4>
                      <form class="form-horizontal style-form" method="post" action="updateEvent.php">
                       <div class="form-group">
                          
                              <div class="col-sm-10">
                                  <input type="hidden" class="form-control" name="pro_code" value="<?php echo $row['program_code'];?>">
                              </div>
                              <div class="col-sm-10">
                                  <input type="hidden" class="form-control" name="student_id" value="<?php echo $row1['staff_matric_no'];?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Event Name</label>
                              <div class="col-sm-10">
                                  <?php echo $row['program_name'];?>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Event Start Date</label>
                              <div class="col-sm-10">
                                  <?php echo $row['start_date'];?>
                                  
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Event End Date</label>
                              <div class="col-sm-10">
                                  <?php echo $row['end_date'];?>
                              </div>
                          </div>
                         
                         
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Event Location</label>
                              <div class="col-sm-10">
                                 <?php echo $row['program_location'];?>
                              </div>
                          </div>
              
              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Event Description</label>
                              <div class="col-sm-10">
                                  <?php echo $row['program_description'];?>
                              </div>
                          </div>
              
              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Total Donation need</label>
                              <div class="col-sm-10">
                                  <?php echo $row['student_limit'];?>
                              </div>
                          </div>             
            
              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Poster</label>
                              <div class="col-sm-10">
                                <img src="<?php  echo $row['upload_poster']; ?>" class="img-responsive" /><br />
                              </div>
                          </div>

              
			  
			<!--<center><button type="submit" name="register" class="btn btn-theme btn-block" style="width:200px;"><i class="fa fa-lock"></i>  Update</button> -->  
                      </form>
                  </div>
          		</div><!-- col-lg-12--> 
          	</div><!-- /row -->                  
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Better Muslim-copyright-2018
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
