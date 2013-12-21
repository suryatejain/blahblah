<?php
error_reporting(0);

include 'session.php';
include 'sidebar.php';
include 'mydb.php';

$question = $_REQUEST['question'];
$questiontypeid = $_REQUEST['questiontypeid'];
$fnum = $_REQUEST['fnum'] + 1;
$textanswer = $_REQUEST['textanswer'];
$radioanswer = $_REQUEST['radioanswer'];
$radiofinalans = $_REQUEST[$radioanswer];
$checkboxanswer = $_REQUEST['checkboxanswer'];
$banktypeid = $_REQUEST['banktypeid'];
$complexity = $_REQUEST['complexity'];
$user = $_SESSION['user'];
  
$i = 0;
if(isset($question))
{
	foreach($checkboxanswer as &$ans) {
		$checkfinans[$i] = $_REQUEST[$ans];
		$i++;
	}
	$i = 0;
	foreach($textanswer as &$ans1) {
		$textfinans[$i] = $ans1;
		$i++;
	}

	echo "You have entered the following question :<br>";
	echo "<table><tr>";
	echo "<td>Question : </td><td><div>".$question."</div></td></tr>";
	if($questiontypeid == 3)
	{
		$i = 0;
		$prans = $textanswer[0];
		foreach($textanswer as &$ans2) {
			if($i > 0){
				$prans = $prans." & ".$ans2;
			}
			$i++;
		}
		echo "<tr><td>Answer is : </td><td>" .$prans."</td></tr>";
		$stuff = array(
			'answer' => $textanswer
		);
		$optionjson = NULL;
		$answerjson = json_encode($stuff);
		echo "<tr><td><strong>AnswersJSON -- </strong></td><td>".$answerjson."</td></tr>";
	}

	if($questiontypeid == 1)
	{
		$i = 1;
		echo "<tr><td></td><td>";
		while($i < $fnum)
		{
			$j = $i - 1;
			$radiooptions[$j] =$_REQUEST['radio'.$i];	
			echo "<input type='radio' value=''>".$_REQUEST['radio'.$i]."<br>";
			$i++;
		}
		echo "</td></tr><tr><td>Answer : </td><td>".$radiofinalans."</td></tr>";
		$stuff1 = array(
			'options' => $radiooptions
		);
		$stuff = array(
			'answer' => array(array_search($radiofinalans,$radiooptions))
		);
		$optionjson = json_encode($stuff1);
		$answerjson = json_encode($stuff);
		echo "<tr><td><strong>OptionsJSON -- </strong></td><td>".json_encode($stuff1)."</td></tr>";
		echo "<tr><td><strong>AnswersJSON -- </strong></td><td>".json_encode($stuff)."</td></tr>";
	}

	if($questiontypeid == 2)
	{
		$i = 0;
		$prans = $checkfinans[0];
		foreach($checkfinans as &$ans1) {
			if($i > 0){
				$prans = $prans." & ".$ans1;
			}
			$i++;
		}
		$i = 1;
		echo "<tr><td></td><td>";
		while($i < $fnum)
		{
			$checkboxoptions[$i-1] =$_REQUEST['checkbox'.$i];	
			echo "<input type='checkbox' value=''>".$_REQUEST['checkbox'.$i]."<br>";
			$i++;
		}
		echo "</td></tr><tr><td>Answer : </td><td>".$prans."</td></tr>";
		$i = 0;
		foreach($checkfinans as &$ans1) {
			$checkfinalanswerindex[$i] = array_search($ans1,$checkboxoptions);
			$i++;
		}
		$stuff1 = array(
			'options' => $checkboxoptions
		);
		$stuff = array(
			'answer' => $checkfinalanswerindex
		);
		$optionjson = json_encode($stuff1);
		$answerjson = json_encode($stuff);
		echo "<tr><td><strong>OptionsJSON -- </strong></td><td>".json_encode($stuff1)."</td></tr>";
		echo "<tr><td><strong>AnswersJSON -- </strong></td><td>".json_encode($stuff)."</td></tr>";
	}
	echo "</table>";
	$htmlq = addslashes($question);
	$sql = "INSERT INTO `questionbank` (`id`,`questiontypeid`,`banktypeid`,`question`,`answer`,`answerkey`,`complexity`,`createdby`,`created`,`statusid`)
	VALUES('',$questiontypeid,$banktypeid,'$htmlq','$optionjson','$answerjson',$complexity,'$user',now(),1);";
	if(mysql_query($sql)){
		echo "<br>The question has succesfully been added to the question bank. Await approval.";
		echo "<br><a href='validate.php?questionbankid=".mysql_insert_id()."'>Validate Question</a><br>";
	}
}
?>

<html>
	<body>
	<a href="create.php">add another question</a>
	</body>
</html>

