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

include 'session.php';
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
}
echo "</div1>";
?>