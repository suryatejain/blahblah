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

include 'session.php';
include 'mydb.php';
include 'sidebar.php';
include 'opcfunctions.php';
$user = $_SESSION['user'];

if(isset($_REQUEST['approve'])) {
	$sql = "UPDATE questionbank set statusid = 3 where id = ".$_REQUEST['questionbankid'];
	if(mysql_query($sql))
	{
	 header("Location: approve.php");
	}
	}
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
	echo questionhtml($row['id'],0,1);
	
		if($abc) {
		echo "<br><form style='display:inline;' action='#' method='post'><input type='hidden' name='questionbankid' value='".$_REQUEST['questionbankid']."'>
<input type='hidden' name='approve' value=1>
<input style='background-color:lightgreen' type='submit' value='Validate and Approve'></form>";
	}
	else {
	echo "<br><input type='submit' value='Check Answer'>";
	if(isset($_REQUEST['ques'])) {
	echo "Incorrect Question";
	}
	}
echo "</form>";

$k++;	
}



echo "</div1>";

?>