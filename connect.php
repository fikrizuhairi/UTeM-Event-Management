	<html>
<head>
</head>
<body>
<?php

	ini_set('display_errors', 1);
	error_reporting(~0);

   $serverName = "localhost";
   $userName = "root";
   $userPassword = "";
   $dbName = "utem_event";
  
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (mysqli_connect_errno())
	{
		
		return false;//echo "Database Connect Failed : " . mysqli_connect_error();
	}
	else
	{
		return true;
		//echo "Database Connected.";
	}

	//mysqli_close($conn);
?>
</body>
</html>