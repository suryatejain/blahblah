<?php
error_reporting(0);

include 'session.php';
include 'mydb.php';
include 'opcfunctions.php';
include 'sidebar.php';

$user = $_SESSION['user'];
$sql = "select * from questionbank where statusid in (3)";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
	{	
		echo questionhtml($row['id'],1,1);
	}
?>