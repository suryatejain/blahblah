<html>
<style>
	div1 {
    width: 50%;
    height: 50%;

    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;
}
</style>

<?php
error_reporting(0);
session_start();
#echo json_encode($_REQUEST);
if(!isset($_SESSION['user']))
{
	die("You have not logged in.");
}
if(isset($_REQUEST['logout'])){
	unset($_SESSION['user']);
	session_destroy();
}
echo '<div style="top:0px;right:25px;position: fixed;">
	<form action="index.php" method="post"><input type="hidden" name="logout" value=1><input type="submit" value="logout"></form>
</div>';
echo "hello ".$_SESSION['user']." <a href='index.php'>home</a><br><br>";

include 'mydb.php';
include 'sidebar.php';
include 'opcfunctions.php';
$user = $_SESSION['user'];


$abc = 0;
if(isset($_REQUEST['ques'])) {
	$ab = 'q'.$_REQUEST['questionbankid'];
	$abc = iscorrectanswer($_REQUEST['questionbankid'],$_REQUEST[$ab]);
	}
	
$sql = "select * from questionbank where id = ".$_REQUEST['questionbankid'];
$result = mysql_query($sql);
$k = 1;
while ($row = mysql_fetch_array($result))
	{
	echo "<div1>";
	echo "<form action='#' method='post'>";
	echo "<input type='hidden' name='questionbankid' value='".$_REQUEST['questionbankid']."'";
	if($abc){
	
	echo questionhtml($row['id'],1,0);
	}
	else{
	echo questionhtml($row['id'],0,0);
	}
	
		if($abc) {
		echo "<br> Correct Answer !! Well Done.";
	}
	else {
	echo "<br><input type='submit' value='Check Answer'>";
	if(isset($_REQUEST['ques'])) {
	echo " . Na Na Na Wrong Answer. Try again.";
	}
	}
echo "</form>";

$k++;	
}



echo "</div1>";

?>