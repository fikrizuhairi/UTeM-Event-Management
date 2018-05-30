
<!DOCTYPE html>
<?php
include("connect.php");
session_start();
if(!isset($_SESSION["staff"]))
{
  header("location:index.php");
}

$sql8 = "select *
from program_student
where program_code = '".$_GET['program_code']."' AND participant_attendance='attend' ";
$result8 = mysqli_query($conn,$sql8);

$sql4 = "select COUNT(program_student_code) as total_student from program_student where program_code = '".$_GET['program_code']."' AND participant_attendance='attend' ";
$result4 = mysqli_query($conn,$sql4);
$objResult4 = mysqli_fetch_assoc($result4);
	
$sql = "select *
from staff
where staff_matric_no = '".$_SESSION['staff']." ' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql7 = "select * from program where program_code = '".$_GET['program_code']."' ";
$result7 = mysqli_query($conn,$sql7);
$objResult7 = mysqli_fetch_assoc($result7);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>UTeM Event Management</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

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
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/azyan.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $objResult['staff_name'];?></h5>
				  <h5 class="centered">Staff</h5>
              	  	
                  <li class="mt">
                      <a href="fictsIndex.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-bank"></i>
                          <span>Event</span>
                      </a>
                      <ul class="sub">
						  <li><a  href="registerEvent.php">Add event</a></li>
                          <li class="active"><a  href="previousEventFicts.php">Previous event</a></li>
						    <li><a  href="updateList.php">Update event </a></li>
						  <li><a  href="eventToday.php">Event Today</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a  href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li ><a  href="reportGraphFicts.php">Event Analysis</a></li>
                          <li><a  href="feedbackEventFicts.php">Event Feedback</a></li>
						  <li><a  href="eventToday.php">Event Today</a></li>
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
          	<h3><i class="fa fa-bank"></i> Previous Event</h3>
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
						  <th><i class="fa fa-bullhorn"></i>Index</th>
						   <th><i class="fa fa-bullhorn"></i>Program Code</th>
                           <th class="hidden-phone"><i class="fa fa-flag-checkered"></i>Student matric no</th>
						   <h4><i class="fa fa-angle-right"></i>List Previous Event of <?php echo $objResult7["program_name"]; ?></h4>
								  
								  <?php
										if($objResult4["total_student"]==0)
										{
											echo "<h4 style='color:red;'><i class='fa fa-angle-right'></i>";
											echo "No student attend...";
											echo "</h4>";
											
										}
										else
										{   echo "<h4 style='color:green;'><i class='fa fa-angle-right'></i>";
											echo $objResult4["total_student"];
											echo "  Student attend";
										}
								  ?></h4>
									  
						  
						  
						  
	                  	  	     <?php
								  $query = "select student_matric_no,program_code from program_student where program_code = '".$_GET['program_code']."' AND participant_attendance='attend'";
								  $result1 = mysqli_query($conn,$query);
								  if(mysqli_num_rows($result1)>0)
								  {
									$no=1;
									while($row1 = mysqli_fetch_array($result1))
									{
									  ?>
									  <div class="col-md-4">
										<tr>
											  <td><?php echo $no++ ;?></td>
											  <td><?php echo $row1['program_code'] ;?></td>
											  <td><?php echo $row1['student_matric_no'] ;?></td>
											  
											  
											 
										</tr>

									  </div>
									<?php
									}

								  }
							?>
	                  	  	
                           
                             
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - UTeM Event Management
              <a href="responsive_table.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
