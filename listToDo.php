
<!DOCTYPE html>
<?php
	include("connect.php");
	session_start();
	if(!isset($_SESSION["advisor"]))
	{
	  header("location:index.php");
	}
	$sql = "select *
	from ficts
	where staff_matric_no = '".$_SESSION['advisor']."' ";
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
            <a href="advisorIndex.php" class="logo"><b>UTeM EVENT</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
							
                            <span class="badge bg-theme"><?php echo $row3['C'] ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?php echo $row3['C'] ?> pending tasks</p>
                            </li>
                            <li>
                                <a href="listToDoFICTS.php">
                                    <div class="task-info">
                                        <div class="desc">Staff request event</div>
                                        <div class="percent"><?php echo $row1['A']?>%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row1['A']?>%">
                                            <span class="sr-only"><?php echo $row1['A']?>% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="listToDo.php">
                                    <div class="task-info">
                                        <div class="desc">Other organizer request event</div>
                                        <div class="percent"><?php echo $row2['B']?>%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row2['B']?>%">
                                            <span class="sr-only"><?php echo $row2['B']?>% Complete (warning)</span>
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
              
              	  <p class="centered"><a href="profile.html"></a></p>
              	  <h5 class="centered"><?php echo $objResult['staff_name'];?></h5>
				  <h5 class="centered">Advisor</h5>
              	  	
                  <li class="mt">
                      <a href="advisorIndex.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-bookmark"></i>
                          <span>List Of Event Request</span>
                      </a>
                      <ul class="sub">
					      <li><a href="listToDoAll.php" >All event request</a></li>
						  <li><a  href="listToDoFICTS.php" >Event request (STAFF)</a></li>
                          <li class="active"><a href="listToDo.php" >Event request (Other)</a></li> 
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
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="reportGraph.php">Event Analysis</a></li>
                          <li><a  href="feedbackEvent.php">Feedback event</a></li>
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
          	<h3><i class="fa fa-flag-checkered"></i> Event request</h3>
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i>List of <button type="button" class="btn btn-warning">Pending</button> event request by Other Organization</h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> Index</th>
                                  <th class="hidden-phone"><i class="fa fa-flag-checkered"></i> Program Name</th>
								  <th><i class="fa fa-folder-open"></i> Start Date</th>
                                  <th><i class="fa fa-user"></i> Organizer Name</th>
								  <th><i class="fa fa-folder-open"></i> Detail</th>
                                  <!--<th><i class=" fa fa-edit"></i> Approvement</th>-->
								  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
							  <?php
							  $no = 0;
							  $query = "select * from program where staff_matric_no IS NULL AND status_program='pending' ORDER BY start_date ASC";
							  $result = mysqli_query($conn,$query);
							  if(mysqli_num_rows($result)>0)
							  {
								while($row = mysqli_fetch_array($result))
								{
									$no++;
									$query1 = "select * from organizer where organizer_id='".$row["organizer_id"]."'";
									$result1 = mysqli_query($conn,$query1);
									$row1 = mysqli_fetch_assoc($result1);
									$organizer_name= $row1["organizer_name"];
							 ?>
                              <tbody>
                              <tr>
                                  <td><?php echo $no; ?></td>
                                  <td class="hidden-phone"><?php echo $row["program_name"]; ?></td>
								  <td class="hidden-phone"><?php echo $row["start_date"]; ?></td>
                                  <td><?php echo $organizer_name; ?></td>
                                  <td>
                                      <a href="updateRequestEventOther.php?program_code=<?php echo $row['program_code'];?>"><button class="btn btn-success btn-xs" style="background-color:orange; border-color:orange;"><i class="fa fa-eye"></i></button></a>
                                  </td>
								  <!--<td>
                                     <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
									 <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
									 <button class="btn btn-danger btn-xs">KIV</button>
                                  </td>-->
								  <td><?php 
											if ($row["status_program"] == "approved")
											{echo '<button type="button" class="btn btn-success">Approved</button>';}
											elseif ($row["status_program"] == 'reject')
											{echo '<button type="button" class="btn btn-danger">Reject</button>';}
											else 
											{echo '<button type="button" class="btn btn-warning">Pending</button>';} 
										?>
								  </td>
                              </tr>
							  <?php 
								}
							  }
								?>
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

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
