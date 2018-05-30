
<!DOCTYPE html>
<?php
	include("connect.php");
	session_start();
	if(!isset($_SESSION["organizer"]))
	{
	  header("location:index.php");
	}
	$sql5 = "select *
	from organizer
	where organizer_id = '".$_SESSION['organizer']."' ";
	$result5 = mysqli_query($conn,$sql5);
	$row5 = mysqli_fetch_array($result5);

	
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Better Muslim</title>
	<style>

	.axis .domain {
	  display: none;
	}

	</style>
	<script src="Chart.js"></script>
	
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
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  
              	  <h5 class="centered"><?php echo $row5["organizer_name"]; ?></h5>
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
				  <!-- <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="eventAnalysisOrganizer.php">Event Analysis</a></li>
                          <li><a  href="feedbackEventOrganizer.php">Feedback event</a></li>
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
			<h3><i class="fa fa-flag-checkered"></i> Analysis participant attendance</h3>
				<h4 class="mb"></i>*Number of participant join each program by session</h4>
                <div class="row">
                    <div class="col-lg-12">
					<div class="content-panel">

						<h4 class="mb"><i class="fa fa-search"></i>Event session</h4>
						  <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
						  <?php 
						  $txtKeyword = '';
						  if(isset($_GET['txtKeyword']) && strlen(trim($_GET['txtKeyword'])) >0) 
						  {
							$txtKeyword = trim($_GET['txtKeyword']);
						  }
						  ?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<select name="txtKeyword" id="txtKeyword" style="width: 30%">
									<option value="<?php echo $txtKeyword;?>">Event Session</option>
									<?php
									$sql1 = "select DISTINCT(program_session) from program where status_program='approved' AND organizer_id ='".$_SESSION['organizer']."' ";
									$result1 = mysqli_query($conn,$sql1);
									while ($row1 = mysqli_fetch_array($result1))
									{
										echo "<option value='".$row1['program_session']."'>".$row1['program_session']."</option>";
									}
									?>
								</select>
								<input type="submit" class="btn btn-default btn-sm" value="Search"></th>	
						</form>
						<?php
							$sql = "SELECT  program.program_name,program.program_name,	 count(program_student.participant_attendance) as a FROM program_student join program on program.program_code = program_student.program_code WHERE participant_attendance ='attend' and program.program_session='".$txtKeyword."' GROUP by program_student.program_code";
							$result = mysqli_query($conn,$sql);
							$chart_data = '';
							while($row = mysqli_fetch_array($result))
							{
							 $chart_data .= "{ student:'".$row["a"]."' , a:'".$row["program_name"]."' },";
							}

						?>
					</div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                            <div class="row" >
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Attendance Student per Program</h3>
                            </div>
                            <div class="panel-body">
							<?php
								$sql2 = "select program_session from program where program_code NOT IN (select program_code from program_student)";
								$result2 = mysqli_query($conn,$sql2);
								
								while($row2 = mysqli_fetch_array($result2))
								{
									if($row2['program_session'] == $txtKeyword)
									{
										echo '<script>';
										echo 'alert("No participant attend the program in this session")';
										echo '</script>';
										echo "<meta http-equiv=\"refresh\" content=\"0; URL=reportGraphFicts.php\">";
									}
									else{
										echo "<div id='myfirstchart' style='height: 250px;'></div>";
									}
								}
								
							?>
                                
                            </div>
                        </div>
                    </div>

                    <!-- /.col-lg-12 -->
            </div>

          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Better Muslim-copyright-2018
              <a href="basic_table.html#" class="go-top">
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
