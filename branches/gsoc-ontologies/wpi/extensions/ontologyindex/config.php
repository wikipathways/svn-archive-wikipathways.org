<?php
	$db = 'wikipathways';
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	global $con;
	$con = mysql_connect($server, $user, $pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db($db);
?>