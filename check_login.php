<?php
//error_reporting(E_ALL);
include 'connect.php';
session_start();


/*function sanitizeString($var)
{
    $var = stripslashes   ($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}*/

if(isset($_POST['login']))
{
	$username = ($_POST['username']);
	$password = ($_POST['password']);
	$position = ($_POST['position']);
	
	$_SESSION["username"] =($_POST['username']);
	$_SESSION["password"] = ($_POST['password']);
	$_SESSION["position"] = ($_POST['position']);
	
	if($username == "" || $password == "" ||$position == "")
	{
		echo "<script>alert('Please insert your user ID and Password');";
			echo "window.location.href = 'index.php';</script>";
			//echo "<script>alert('this is index.');";
	}
	
	
	
	
	if($username != "" && $password != "" && $position == 'student')
	{
			
		$query = "SELECT * FROM student WHERE student_matric_no ='$username' AND student_password = '$password'  "; 
		$result = mysqli_query ($conn, $query) or exit("The query could not be performed");
		if (mysqli_num_rows($result) == 1)
		{
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["position"] = $position;
			echo "<script>alert('You have successfully login.');";
			//echo "berjaya student";
			echo "window.location.href = 'studentIndex.php';</script>";
		}
	}
	
	elseif($username != "" && $password != "" && $position == 'ficts')
	{
		$query = "SELECT * FROM staff WHERE staff_matric_no ='$username' AND staff_password = '$password'  "; 
		$result = mysqli_query ($conn, $query) or exit("The query could not be performed");
		if (mysqli_num_rows($result) == 1)
		{
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["position"] = $position;
			echo "<script>alert('You have successfully login.');";
			//echo "berjaya student";
			echo "window.location.href = 'fictsIndex.php';</script>";
		}
	}
	elseif($username != "" && $password != "" && $position == 'advisor')
	{
		$query = "SELECT * FROM staff WHERE staff_matric_no ='$username' AND staff_password = '$password'  "; 
		$result = mysqli_query ($conn, $query) or exit("The query could not be performed");
		if (mysqli_num_rows($result) == 1)
		{
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["position"] = $position;
			echo "<script>alert('You have successfully login.');";
			//echo "berjaya student";
			echo "window.location.href = 'advisorIndex.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('Login failed. User ID or Password is invalid');";
		echo "fail";
		echo "window.location.href = 'index.php';</script>";
		exit;
	}

	
}
?>