<?php

session_start();
if(!isset($_SESSION["student"]))
{
  header("location:index.php");
}
include "connect.php";

$programStudentCode = $_GET['programStudentCode'];
$program_code = $_GET['program_code'];

$sql = "select COUNT(program_student_code) as A from feedback where program_student_code = '".$programStudentCode."' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql1 = "select COUNT(program_student_code) as B from program_student where program_student_code = '".$programStudentCode."' AND program_code='".$program_code."' AND student_matric_no= '".$_SESSION["student"]."' ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

//echo $row["A"];
//echo $row1["B"];

if ($row["A"] == 0 & $row1["B"] ==1)
{
	$stucomm = $_POST['comment'];
	$q1 = $_POST['optionsRadios1'];
	$q2 = $_POST['optionsRadios2'];
	$q3 = $_POST['optionsRadios3'];
	$q4 = $_POST['optionsRadios4'];
	$q5 = $_POST['optionsRadios5'];
	$q6 = $_POST['optionsRadios6'];
	$q7 = $_POST['optionsRadios7'];
	$total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7;
	$sql2 = "INSERT INTO feedback (program_student_code,q1,q2,q3,q4,q5,q6,q7,total,comment) VALUES('".$programStudentCode."','".$q1."','".$q2."','".$q3."','".$q4."','".$q5."','".$q6."','".$q7."','".$total."',UPPER('".$stucomm."'))";
	$result2=$conn->query($sql2);
	
	/*echo $program_code;
	echo $q1;
	echo $q2;
	echo $q3;
	echo $q4;
	echo $q5;
	echo $q6;
	echo $q7;
	echo $stucomm;
	echo $programStudentCode ;*/
	
	if($result2)
	{
		echo '<script>';
		echo 'alert("Your feedback has successfully inserted")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=studentIndex.php\">";
	}
	else
	{
		echo '<script>';
		echo 'alert("Please answer all question")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=previousEventStudent.php\">";
		
}
}
else
{
		echo '<script>';
		echo 'alert("You are only allowed to evaluate this program once. Please evaluate other event.")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=previousEventStudent.php?programStudentCode=$programStudentCode&program_code=$program_code\">";

}
	
	
	?>