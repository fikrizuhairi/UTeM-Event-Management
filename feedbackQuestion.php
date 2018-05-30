<!DOCTYPE html>
<?php
include "connect.php";
session_start();
if(!isset($_SESSION["student"]))
{
  header("location:index.php");
}
$programStudentCode = $_GET['programStudentCode'];
$program_code=$_GET['program_code'];

$sql="select * from program where program_code='".$program_code."'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql1 = "select *
from student
where student_matric_no = '".$_SESSION['student']." ' ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

$sql2="select * from program_student where student_matric_no='".$_SESSION['student']." '";
$result2 =mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result);
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
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		textarea.form-control
		{
			text-transform: uppercase;
		}
	</style>
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
            <a href="studentIndex.php" class="logo"><b>UTeM EVENT</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php" onclick="return confirmLogout()" >Logout</a></li>
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
              
              	  
              	  <h5 class="centered"><?php echo $row1['student_name'];?></h5>
				  <h5 class="centered">STUDENT</h5>
              	  	
                  <li class="mt">
                      <a href="studentIndex.php">
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
                          <li class="active"><a  href="previousEventStudent.php">Previous event</a></li>
						  <li>
                            <a href="feedbackEventStudent.php">View feedback event </a>
                        </li>
                      </ul>
                  </li>
                  <li>
                      <a href="studentProfile.php"><i class="fa fa-cog"></i> Setting</a>
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
          	<h3><i class="fa fa-edit"></i> Feedback Question</h3>
			<br>
			<h4><i class="fa fa-angle-right"></i> Program <?php echo $row["program_name"]; ?></h4>
          	<!-- INPUT MESSAGES -->
			<form action="feedbackQuestion1.php?program_code=<?php echo $program_code;?>&programStudentCode=<?php echo $programStudentCode;?>"class="form-horizontal style-form" method="post">
          	<div class="row mt">
          		<div class="col-lg-12">
				<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric"><center>Index</center></th>
                                  <th><center>Question</center></th>
                                  <th><center>Very Unsatisfied</center></th>
                                  <th><center>Unsatisfied</center></th>
                                  <th><center>Neutral</center></th>
								  <th><center>Satisfied</center></th>
								  <th><center>Very Satisfied</center></th>

                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Does the organizer provide a suitable and comfortable place for the event?</td>
                                  <td><center><input type="radio" name="optionsRadios1" id="optionsRadios1" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios1" id="optionsRadios1" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios1" id="optionsRadios1" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios1" id="optionsRadios1" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios1" id="optionsRadios1" value="5" ></center></td>

                              </tr>
                               <tr>
                                  <td>2</td>
                                  <td>Does the organizer organized tentative effectively?</td>
                                  <td><center><input type="radio" name="optionsRadios2" id="optionsRadios2" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios2" id="optionsRadios2" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios2" id="optionsRadios2" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios2" id="optionsRadios2" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios2" id="optionsRadios2" value="5" ></center></td>

                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Does the organizer provide adequate facilities?</td>
                                  <td><center><input type="radio" name="optionsRadios3" id="optionsRadios3" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios3" id="optionsRadios3" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios3" id="optionsRadios3" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios3" id="optionsRadios3" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios3" id="optionsRadios3" value="5" ></center></td>

                              </tr>
							  <tr>
                                  <td>4</td>
                                  <td>Does the organizer organizer provides food throughout the event?</td>
                                  <td><center><input type="radio" name="optionsRadios4" id="optionsRadios4" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios4" id="optionsRadios4" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios4" id="optionsRadios4" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios4" id="optionsRadios4" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios4" id="optionsRadios4" value="5" ></center></td>

                              </tr>
							  <tr>
                                  <td>5</td>
                                  <td>Does the moderator made it possible for student to increase kowledge and skill?</td>
                                  <td><center><input type="radio" name="optionsRadios5" id="optionsRadios5" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios5" id="optionsRadios5" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios5" id="optionsRadios5" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios5" id="optionsRadios5" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios5" id="optionsRadios5" value="5" ></center></td>

                              </tr>
                              <tr>
                                  <td>6</td>
                                  <td>Does the moderator encourages students to analyse ideas and to think critically?</td>
                                  <td><center><input type="radio" name="optionsRadios6" id="optionsRadios6" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios6" id="optionsRadios6" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios6" id="optionsRadios6" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios6" id="optionsRadios6" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios6" id="optionsRadios6" value="5" ></center></td>

                              </tr>
							  <tr>
                                  <td>7</td>
                                  <td>I enjoy the event activities</td>
                                  <td><center><input type="radio" name="optionsRadios7" id="optionsRadios7" value="1" checked></center></td>
                                  <td><center><input type="radio" name="optionsRadios7" id="optionsRadios7" value="2" ></center></td>
								  <td><center><input type="radio" name="optionsRadios7" id="optionsRadios7" value="3" ></center></td>
								  <td><center><input type="radio" name="optionsRadios7" id="optionsRadios7" value="4" ></center></td>
								  <td><center><input type="radio" name="optionsRadios7" id="optionsRadios7" value="5" ></center></td>

                              </tr>
                              </tbody>
                          </table>
					<div class="form-panel">
						<h4 class="mb"><i class="fa fa-angle-right"></i> Comment</h4>
						<label style="color:blue;">* Your comment is optional</label>
						<textarea class="form-control" name = "comment" id = "comment" cols="100" rows="5" placeholder = "**Put your comment here**" ></textarea><br />
				    </div>
					<!-- /form-panel 
					<button type="submit" class="btn btn-default" style="float:right">Submit</button>-->
					<center><button class="btn btn-primary"> Save </button></center>
					
				
          		</div><!-- /col-lg-12 -->
          	
          	</form>
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - UTeM Event Management
              <a href="form_component.html#" class="go-top">
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
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
