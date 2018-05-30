<?php

   define("DB_SERVER", "localhost");
            define("DB_USER", "root");
            define("DB_PASSWORD", "");
            define("DB_DATABASE", "event_management");
	
            $conn = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
			if(!isset($_POST['email'])) {
				$email  = '';
			}
			else{
				$email  = $_POST['email'];
			}
			
		$sql="select student_password from student where student_email='$email'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		
		$passwordUser = $row['student_password'];
		
		
		 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		 $random_string_length = 6;
		$newpassword = '';
		for ($i = 0; $i < $random_string_length; $i++) {
        $newpassword .= $characters[mt_rand(0, 61)];

}

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'syahrinaazyan@gmail.com';          // SMTP username
$mail->Password = '123456tain'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom($email, 'UTeM Event Management');
$mail->addReplyTo($email, 'UTeM Event Management');
$mail->addAddress($email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>UTeM Event Management</h1>';
$bodyContent .= '<p>Your new password is</p>'. $passwordUser;


$mail->Subject = 'New password ';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;

} 
else {
	
		echo "berjaya";
			
}

?>
