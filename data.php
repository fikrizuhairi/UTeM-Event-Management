<?php
include ("connect.php");


	$matric_no = $_POST['cardNumber'];
	$code = $_POST['program_code'];
	
	$_SESSION['matric_no']= $_GET['matric_no'];
	$sql = "UPDATE program_student SET participant_attendance='attend' WHERE program_code ='".$code."' AND student_matric_no = '".$matric_no."'";
	$result = mysqli_query($conn, $sql);
	if ($result)
	{
		echo "Request";
		
	}
	else
	{
		echo "Request is not sent";
	}
?>