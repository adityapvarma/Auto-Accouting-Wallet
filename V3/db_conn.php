<?php
   $dbhost = 'localhost';
   $dbuser = "root";
   $dbpass = '';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, "tarpdb");
   if(! $conn )
   {
	   die(mysqli_error_list($conn));
   }
   mysqli_select_db($conn, 'tarpdb') or die(mysqli_error($conn));
?>
