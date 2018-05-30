<?php 

	
    mysql_query("UPDATE program_student SET participant_attendance='attend' WHERE program_code ='".$code."' AND student_matric_no = '".$itemId."'");
       return json_encode(array("status" => true, "added" => true));
?>
