<?php

session_start();
include("connect.php");


    $val = $_POST['nilai'];
    

    switch($val){
        case 'pending':
                echo "<option value='postpone'>Postpone</option>";
				echo "<option value='test'>Test</option>";
        break;

        case 'approved':     
                echo "<option value='-' disabled>No reason pending</option>";
        break;
		
		case 'reject':     
                echo "<option value='' disabled>No reason pending</option>";
        break;

        /*case 'FKM':
           $query = "SELECT * FROM `course` WHERE `faculty_id`='FKM' ORDER BY course_id" ;
            $execute = mysqli_query($connect,$query);
            
            while ($result = mysqli_fetch_assoc($execute)){
                echo "<option value=".$result['course_id'].">".$result['course_id']." - ".$result['course_name']."</option>";
            }
        break;*/
        

              
        
        

        
    }

?>