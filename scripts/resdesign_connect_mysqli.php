<?php  
	$db_host = "localhost";
	$db_username = "rezinunts"; 
	$db_pass = "Mungching1!"; 
	$db_name = "resonancedesigns";

	$myConnection = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die ("could not connect to mysql");    
?>