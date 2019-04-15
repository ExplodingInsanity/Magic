	<?php 
	$server   = "localhost";
	$user 	  = "root";
	$pass 	  = "";
	$database = "magic";
	$charset  = "UTF8"; //utf8mb4 //ISO-8859-16
	$connection = mysqli_connect($server,$user,$pass,$database);
	mysqli_set_charset($connection, $charset);
	?>
