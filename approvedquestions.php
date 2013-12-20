<?php
error_reporting(0);
session_start();

#echo json_encode($_REQUEST);
if(!isset($_SESSION['user']))
{
	die("You have not logged in.");
}
if(isset($_POST['logout'])){
	unset($_SESSION['user']);
	session_destroy();
}
echo '<div style="top:0px;right:25px;position: fixed;">
	<form action="index.php" method="post"><input type="hidden" name="logout" value=1><input type="submit" value="logout"></form>
</div>';
echo "hello ".$_SESSION['user']." <a href='index.php'>home</a><br><br>";

include 'mydb.php';
include 'opcfunctions.php';
include 'sidebar.php';
$user = $_SESSION['user'];

$sql = "select * from questionbank where statusid in (3)";
$result = mysql_query($sql);
$k = 1;
while ($row = mysql_fetch_array($result))
{
echo questionhtml($row['id'],1,1);
$k++;
}