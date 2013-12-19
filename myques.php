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
echo "hello ".$_SESSION['user']." <a href='index.php'>home</a><br><br><br>";

include 'mydb.php';
$user = $_SESSION['user'];

$sql = "select * from questionbank where createdby like '$user'";
$result = mysql_query($sql);
$k = 1;
while ($row = mysql_fetch_array($result))
	{
$question = $row['question'];
$questiontypeid = $row['questiontypeid'];
$answer = $row['answer'];
$answerkey = $row['answerkey'];
$banktypeid = $row['banktypeid'];
$complexity = $row['complexity'];


#######
if($questiontypeid == 3)
{
	echo $k.". Question : ".$question."";
	$an = json_decode($answerkey);
	$i = 0;
	$fin = $an->{'answer'}[0];
	foreach($an->{'answer'} as $ans) {
		if($i)
		{
		$fin = $fin . " & ". $ans;
		}
		$i++;
	}
	echo "<br>Answer - ".$fin;
}

######
if($questiontypeid == 1)
{

$options = json_decode($answer);
$an = json_decode($answerkey);

echo $k.". Question : ".$question."<br>";
foreach($options->{'options'} as $o) {
	echo "<input type='radio'>".$o."<br>";
	}
echo "Answer : option - ".$an->{'answer'}." i.e ".$options->{'options'}[$an->{'answer'}];	

}
#######
if($questiontypeid == 2)
{

$options = json_decode($answer);
$an = json_decode($answerkey);

echo $k.". Question : ".$question."<br>";
foreach($options->{'options'} as $o) {
	echo "<input type='checkbox'>".$o."<br>";
	}
	$i = 0;
	$fin = $options->{'options'}[$an->{'answer'}[0]];
	$f = $an->{'answer'}[0];
	foreach($an->{'answer'} as $ans) {
		if($i) {
		$f = $f . " & ".$ans;
		$fin = $fin . " & ". $options->{'options'}[$ans];
		}
		$i++;
	}
echo "Answer : options - ".$f." i.e ".$fin;	

}
echo "<br>Complexity - ".$complexity."<hr>";


$k++;	
}