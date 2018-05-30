
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
where organizer_id = '".$_SESSION['organizer']." ' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql1 = "select *
from program
where program_code ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);
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
					$staffno= $_SESSION["organizer"];
					//echo "<br><br><br>" . $username;
					$strSQL = "SELECT * FROM organizer WHERE organizer_id='$staffno'";
					$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
					$objResult = mysqli_fetch_assoc($objQuery);
					//echo $objResult['ficts_name'];
					?>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"></a></p>
              	  <h5 class="centered"><?php echo $objResult['organizer_name'];?></h5>
				  <h5 class="centered">ORGANIZER</h5>
              	  	
                  <li class="mt">
                      <a href="organizerIndex.php">
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
						  <li><a  href="registerEventOrganizer.php">Add event</a></li>
                          <li><a  href="previousEventOrganizer.php">Previous event</a></li>
						  <li><a  href="updateListOrganizer.php">Update event </a></li>
						    <li class="active"><a  href="eventTodayOrganizer.php">Event Today</a></li>
                      </ul>
                  </li>
                  <!-- <li class="sub-menu">
                      <a  href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li ><a  href="reportGraphFicts.php">Event Analysis</a></li>
                          <li><a  href="feedbackEventFicts.php">Event Feedback</a></li>
                      </ul>
                  </li>
                  -->

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
	                  	  	  <h4><i class="fa fa-angle-right"></i>List Event</h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
								  <th><i class="fa fa-bullhorn"></i> Index</th>
                                  <th><i class="fa fa-bullhorn"></i> Program code</th>
                                  <th class="hidden-phone"><i class="fa fa-flag-checkered"></i> Event Name</th>
                                  <th><i class="fa fa-calendar"></i> Start Date</th>
								  <th><i class="fa fa-calendar"></i> End Date</th>
								  <th><i class=" fa fa-file-pdf-o"></i> Attendance</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
								 $sql1 ="select * from program where status_program='approved' and start_date = date(CURRENT_DATE) OR end_date = date(CURRENT_DATE)";
								  $result2 = mysqli_query($conn,$sql1);
								  $row2 = mysqli_fetch_assoc($result2);
							  
							  
								  $query = "select * from program where status_program ='approved' AND organizer_id='".$_SESSION["organizer"]."' AND start_date = date(CURRENT_DATE) OR end_date = date(CURRENT_DATE) OR start_date >= '".$row2['start_date']."' AND end_date <= '".$row2['end_date']."'";
								  $result = mysqli_query($conn,$query);
								  if(mysqli_num_rows($result)>0)
								  {
									  $no=1;
									while($row = mysqli_fetch_array($result))
									{
									  ?>
									  <div class="col-md-4">
										<tr>
											  <td><?php echo $no++ ;?></td>
											  <td><?php echo $row['program_code'] ;?></td>
											  <td class="hidden-phone"><?php echo $row['program_name'] ;?></td>
											  <td><?php echo $row['start_date'] ;?></td>
											  <td><?php echo $row['end_date'] ;?></td>
											  <td>
												 <a href="recordAttendance.php?program_code=<?php echo $row['program_code'] ;?>" ><button class="btn btn-success btn-xs" style="background-color:#23c693; border-color:#23c693;">Record attendance<a class="glyphicon glyphicon-file" ></a></button></a>
												 <a href="recordListAttendance.php?program_code=<?php echo $row['program_code'] ;?>" ><button class="btn btn-success btn-xs" style="background-color:#23c693; border-color:#23c693;">Record List attendance<a class="glyphicon glyphicon-file" ></a></button></a>
											  </td>
											 
										</tr>

									  </div>
									  <?php
									}

								  }
							?>
                             
                              </tbody>
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
              Better Muslim-copyright-2018
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
