
<!DOCTYPE html>
<?php
	ob_start();
	session_start();
    include("connect.php");
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['advisor'])!="" ) {
		header("Location: index.php");
		exit;
	}
	elseif (isset($_SESSION['student'])!="") {
		header("Location: index.php");
		exit;
	}
    elseif (isset($_SESSION['staff'])!="") {
        header("Location: index.php");
        exit;
    }
	elseif (isset($_SESSION['organizer'])!="") {
        header("Location: index.php");
        exit;
    }
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$username = trim($_POST['username']);
		$position = trim($_POST['position']);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
		
			$res=mysqli_query($conn,"SELECT * FROM student WHERE student_matric_no ='$username'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

			$res2=mysqli_query($conn,"SELECT * FROM staff WHERE staff_matric_no='$username'");
			$row2=mysqli_fetch_array($res2);
			$count2 = mysqli_num_rows($res2); // if uname/pass correct it returns must be 1 row

           /* $res3=mysqli_query($conn,"SELECT * FROM staff WHERE staff_matric_no='$username'");
            $row3=mysqli_fetch_array($res3);
            $count3 = mysqli_num_rows($res3);*/
			
			$res3=mysqli_query($conn,"SELECT * FROM organizer WHERE organizer_id='$username'");
            $row3=mysqli_fetch_array($res3);
            $count3 = mysqli_num_rows($res3);
			
			if( $count == 1 && $row['student_password']==$pass && $position == 'student' ) {
				if($row['student_password']=='1234')
				{
					echo '<script>';
					echo 'alert("Please change you default password")';
					echo '</script>';
					$_SESSION['student'] = $row['student_matric_no'];
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=changePassword1.php?matric='".$_SESSION['student']."' \">";
					//header("Location: changePassword1.php?matric='".$_SESSION['student']."'");
				}
				else{
					$_SESSION['student'] = $row['student_matric_no'];
					header("Location: studentIndex.php");
				}
				//$_SESSION['student'] = $row['student_matric_no'];
				//header("Location: studentIndex.php");
			} 
			elseif ($count2 == 1 && $row2['staff_password']==$pass && $position == 'staff') {
				$_SESSION['staff'] = $row2['staff_matric_no'];
				header("Location: fictsIndex.php");
			}
			elseif ($count2 == 1 && $row2['staff_password']==$pass && $position == 'advisor') {
				$_SESSION['advisor'] = $row2['staff_matric_no'];
				header("Location: advisorIndex.php");
			}
            elseif ($count3 == 1 && $row3['organizer_password']==$pass && $position == 'organizer') {
                $_SESSION['organizer'] = $row3['organizer_id'];
                header("Location: organizerIndex.php");
            } 

			else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Event Management</title>
	

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

		<style>
		h1 {font-family: "Raleway", sans-serif}
		</style>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Roboto+Mono&subset=greek" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
			<center><h1 class="w3-jumbo w3-animate-top">Better Muslim</h1></center>
			
		      <form class="form-login" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		        <h2 class="form-login-heading" style="font-size:30px;">Sign in</h2><br>
		        <div class="login-wrap">
				<!-- <h3 style="font-size:14px; margin-top:-40px;">* Use course as a default eg. BITS</h3> -->
				<br>
				<?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
			<br>
		            <input type="text" name="username" class="form-control" placeholder="User ID" autofocus />
		            <br>
		            <input type="password" name="pass" class="form-control" placeholder="Password">
					<br>
					<select class="form-control" name="position" >
					<option value="" >Role</option>
					<!-- <option value="student">STUDENT</option> -->
					<option value="staff">STAFF</option>
					<option value="advisor">ADVISOR</option>
					<!-- <option value="organizer">ORGANIZER</option> -->
					</select>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="index.php#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button type="submit" name="btn-login" class="btn btn-theme btn-block" value="SIGN IN" ><i class="fa fa-lock"></i>  SIGN IN</button>
		            <br>
		         
		            <a href="register.php" name="signup" class="btn btn-theme btn-block">  Register</a>

		            <hr>
		
		        </div>
				</form>
				<form action="forgotpassword.php" method="post">
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
							  </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <input value="Submit" class="btn btn-theme" type="submit">
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		      </form>	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/1.jpg", {speed: 500});
    </script>


  </body>
</html>
<?php ob_end_flush(); ?>