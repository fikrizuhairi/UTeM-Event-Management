
<?php
include("connect.php");
session_start();
if(!isset($_SESSION["staff"]))
{
  header("location:index.php");
}
$sql = "select *
from staff
where staff_matric_no = '".$_SESSION['staff']." ' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
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
            <a href="index.html" class="logo"><b>Better Muslim</b></a>
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
	   <?php
			$staffno= $_SESSION["staff"];
			//echo "<br><br><br>" . $username;
			$strSQL = "SELECT * FROM staff WHERE staff_matric_no='$staffno'";
			$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
			$objResult = mysqli_fetch_assoc($objQuery);
			//echo $objResult['ficts_name'];
			?>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  
              	  <h5 class="centered"><?php echo $objResult['staff_name'];?></h5>
				  <!-- <h5 class="centered">STAFF</h5> -->
              	  	
                  <li class="mt">
                      <a class="active" href="fictsIndex.php">
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
						  <li><a  href="registerEvent.php">Add event</a></li>
                          <li><a  href="previousEventFicts.php">Previous event</a></li>
						  <li><a  href="updateList.php">Update event </a></li>
						  <!-- <li><a  href="eventToday.php">Event Today</a></li> -->
						 <!--  <li><a  href="paperwork.php">Paper Work</a></li> -->
						  
                      </ul>
                  </li>
                 <!--  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="reportGraphFicts.php">Event Analysis</a></li>
                          <li><a  href="feedbackEventFicts.php">Event Feedback</a></li>
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

              
                  <div class="col-lg-9 main-chart" style="margin-top:-70px;">
                  
                  	<div class="row mtbox">
                  		<h2><i class="fa fa-bullhorn"></i> Upcoming Event</h2>
                  	
                  	</div><!-- /row mt -->	
        <?php
      $query = "select * from program where status_program='approved' and staff_matric_no = '".$_SESSION['staff']." ' ORDER BY program_code ASC";
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        while($row = mysqli_fetch_array($result))
        {
			
			
          ?>
          <div class="col-md-4">
            <form>
              <div style="border: 1px solid #333; background-color: #f1f1f1; border-radius: 5px; padding: 16px;" align="center">
                  <img src="<?php  echo $row['upload_poster']; ?>" class="img-responsive" width="200" height="200"/><br />
                  <h4 class="text-info"><?php echo $row['program_name']; ?></h4>
                  <h5 class="text-info"><?php echo $row['program_description']; ?></h5>
				  
				  <a href="infoEventFicts.php?program_code=<?php echo $row['program_code'];?>" class="btn btn-success" style="margin-top: 5px">View Program</a><br><br>
				  <!-- <a href="uploadStudentCsv.php?program_code=<?php echo $row['program_code'];?>" class="btn btn-primary btn-xs" style="margin-top: 5px">Register Student</a> -->
              </div>
            </form>

          </div>
          <?php
        }

      }



      ?>
				  </div>
                  

              </div> 
             
              
              
                <! --/row -->

          </section>
      </section>
      



      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
      </footer>
    </section>
          <div class="text-center">
              Better Muslim-copyright-2018
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
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
