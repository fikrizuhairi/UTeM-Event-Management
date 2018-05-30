<?php
//Initialise the session
session_start();
include("connect.php");

echo $_POST['pro_code'];
echo $_POST['student_id'];
$limit = $_POST['limit'];



$sql="insert into program_student(program_code,student_matric_no) values ('".$_POST['pro_code']."','".$_POST['student_id']."') ";
$result = mysqli_query($conn, $sql);

$sql1="UPDATE `program` SET `student_limit`='".$limit-1."' WHERE `program_code`='".$code."'";


echo "<script type='text/javascript'>
							alert('Data has been inserted!')
							location.href='studentIndex.php'
							</script>";
