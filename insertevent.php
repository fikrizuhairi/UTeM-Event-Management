<?php
//Initialise the session
session_start();
include("connect.php");


$code = $_POST['pro_code'];
$limit = $_POST['limit'];

//$limit1 = $limit-1;
//echo $limit1;






$sql="insert into program_student(program_code,student_matric_no) values ('".$_POST['pro_code']."','".$_POST['student_id']."') ";
$result = mysqli_query($conn, $sql);

//$sql1="UPDATE `program` SET `student_limit`='".$limit1."' WHERE `program_code`='".$code."' ";
//$result1 = mysqli_query($conn,$sql1);


echo "<script type='text/javascript'>
							alert('Data has been inserted!')
							location.href='studentIndex.php'
							</script>";

							?>