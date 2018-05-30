<!DOCTYPE html>
<?php
include("connect.php");
session_start();
if(!isset($_SESSION["student"]))
{
  header("location:index.php");
}

$sql1 = "select *
from student
where student_matric_no = '".$_SESSION['student']." ' ";
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
 <script>
    function confirmLogout()
{
var pasti=confirm("Are you sure want to save new password?");
if (pasti)
    return true ;
else
    return false ;
}

function joinprogram()
{
  var yes=confirm("Are you sure want to join this program?");
if (yes)
    return true ;
else
    return false ;


}
</script>
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
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    
                </ul>
                <!--  notification end -->
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
              
              	  <p class="centered"><img src="uploads/<?php echo $row1['student_pic'];?>" alt="pic1" class="img-circle" width="100"></p>
              	  <h5 class="centered"><?php echo $row1['student_name'];?></h5>
				  <h5 class="centered">STUDENT</h5>
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
                  		<h2 style="margin-top:-40px;"><i class="fa fa-bullhorn"></i>Change password</h2>
                  	
                  	</div><!-- /row mt -->	
       
            <div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
				    <h4><i class="fa fa-angle-right"></i>Once you've made the change,need to sign in again</h4>
					<i style= color:red;>Please fill all the details.</i>
                      <form class="form-horizontal style-form" name="frmChange" method="post" action="" onSubmit="return validatePassword()" >
                       <div class="form-group">
					   <script>
							var myInput = document.getElementById("psw");
							var letter = document.getElementById("letter");
							var capital = document.getElementById("capital");
							var number = document.getElementById("number");
							var length = document.getElementById("length");

							// When the user clicks on the password field, show the message box
							myInput.onfocus = function() {
							  document.getElementById("message").style.display = "block";
							}

							// When the user clicks outside of the password field, hide the message box
							myInput.onblur = function() {
							  document.getElementById("message").style.display = "none";
							}

							// When the user starts to type something inside the password field
							myInput.onkeyup = function() {
							  // Validate lowercase letters
							  var lowerCaseLetters = /[a-z]/g;
							  if(myInput.value.match(lowerCaseLetters)) { 
								letter.classList.remove("invalid");
								letter.classList.add("valid");
							  } else {
								letter.classList.remove("valid");
								letter.classList.add("invalid");
							}

							  // Validate capital letters
							  var upperCaseLetters = /[A-Z]/g;
							  if(myInput.value.match(upperCaseLetters)) { 
								capital.classList.remove("invalid");
								capital.classList.add("valid");
							  } else {
								capital.classList.remove("valid");
								capital.classList.add("invalid");
							  }

							  // Validate numbers
							  var numbers = /[0-9]/g;
							  if(myInput.value.match(numbers)) { 
								number.classList.remove("invalid");
								number.classList.add("valid");
							  } else {
								number.classList.remove("valid");
								number.classList.add("invalid");
							  }

							  // Validate length
							  if(myInput.value.length >= 8) {
								length.classList.remove("invalid");
								length.classList.add("valid");
							  } else {
								length.classList.remove("valid");
								length.classList.add("invalid");
							  }
							}
						</script>
						<script>
							
							function validatePassword() {
							var currentPassword,newPassword,confirmPassword,output = true;
							currentPassword = document.frmChange.currentPassword;
							newPassword = document.frmChange.newPassword;
							confirmPassword = document.frmChange.confirmPassword;
							if(!currentPassword.value) {
							currentPassword.focus();
							document.getElementById("currentPassword").innerHTML = "Please enter your valid password";
							output = false;
							}
							else if(!newPassword.value) {
							newPassword.focus();
							document.getElementById("newPassword").innerHTML = " New password is required";
							output = false;
							}
							else if(!confirmPassword.value) {
							confirmPassword.focus();
							document.getElementById("confirmPassword").innerHTML = "Confirm password is required";
							output = false;
							}
							if(newPassword.value != confirmPassword.value) {
							newPassword.value="";
							confirmPassword.value="";
							newPassword.focus();
							document.getElementById("confirmPassword").innerHTML = "Password don't match";
							output = false;
							} 	
							return output;
							}
						</script>
                          <input name="nowPassword" id="nowPassword"   value="<?php echo $row1["student_password"];?>" type="hidden">
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Current Password: </label>
                              <div class="col-sm-10">
                                  <input name="currentPassword" id="currentPassword" type="password" required class="form-control" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">New Password: <br><i style="color:red;">*</i> <i><b>(format : Abc@1234)</b></i></label>
                              <div class="col-sm-10">
							   <input name="newPassword" id="newPassword" type="password"  required class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Confirm New Password:</label>
                              <div class="col-sm-10">
                                  <input name="confirmPassword" id="confirmPassword" type="password" required class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
                              </div>
                          </div>
                                  <center><a class="logout" href="logout.php" onclick="return confirmLogout()" ><button type="submit" name="register" class="btn btn-theme btn-block" style="width:100px;"><i class="fa fa-lock"></i>  Save</button></a></center>   				 
                      </form>
					  <?php
					  if(count($_POST)>0) {
						  $matric =$_GET['matric'];
						  
						  echo $_SESSION['student'];
							$result = mysqli_query($conn,"select * from student where student_matric_no = '".$_SESSION['student']."' ");
							$row=mysqli_fetch_array($result);
							if($_POST["currentPassword"] == $row["student_password"]) {
							mysqli_query($conn,"UPDATE student set student_password='".$_POST["newPassword"]."' WHERE student_matric_no='".$_SESSION['student']."'");
							 { 
										mysqli_commit($conn );
									    echo "<script>alert('You have successfully changed your password. Please log in again..');";
										echo "window.location.href = 'logout.php';</script>";
										
										exit;
								}

							}
							}
					  ?>
                  </div>
          		</div><!-- col-lg-12-->			
          	</div><!-- /row -->                
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
             2018 - UTeM Event Management
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
