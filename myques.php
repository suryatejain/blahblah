<?php
error_reporting(0);

include 'session.php';
include 'mydb.php';
include 'sidebar.php';
include 'opcfunctions.php';

$user = $_SESSION['user'];
$sql = "select * from questionbank where createdby like '$user'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
	{
		echo questionhtml($row['id'],1,1);
		echo "<br><a href='validate.php?questionbankid=".$row['id']."'>Validate Question</a><hr>";
	}
?>