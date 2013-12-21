<?php
error_reporting(0);

include 'session.php';
include 'sidebar.php';
include 'mydb.php';
include 'opcfunctions.php';

$user = $_SESSION['user'];
$sql = "select * from questionbank where statusid in (1,2,4)";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
	{
		echo questionhtml($row['id'],1,1);
		echo "<form style='display:inline;' action='approvequestion.php' method='post'><input type='hidden' name='questionbankid' value='".$row['id']."'>
<input type='submit' value='Validate and Approve'></form>";
	}