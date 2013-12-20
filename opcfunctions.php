<?php

include 'mydb.php';


function iscorrectanswer($qid,$ans) {

	$sql = "select * from questionbank where id = ".$qid ;
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result))
	{
		$an = json_decode($row['answerkey']);
		$diff = array_diff($ans,$an->{'answer'});
		$diff1 = array_diff($an->{'answer'},$ans);
		if(empty($diff) and empty($diff1)) {
			return 1;
		}
	}
	return 0;
}

function questionhtml($qid,$answeryn,$qdetailsyn) {
	
	$sql = "select * from questionbank where id = ".$qid ;
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result))
	{
		$question = $row['question'];
		$questiontypeid = $row['questiontypeid'];
		$answer = $row['answer'];
		$answerkey = $row['answerkey'];
		$banktypeid = $row['banktypeid'];
		$complexity = $row['complexity'];
		$createdby = $row['createdby'];

		$questionhtml = "<hr>";
		$questionhtml = $questionhtml."Question : ".$question . "<br>";
		$answerhtml = "";
		$complexityhtml = "";
		
		$questionhtml = $questionhtml. "<input name='ques[]' type='hidden' value='".$qid."'>";
		if($questiontypeid == 3)
		{
			$an = json_decode($answerkey);
			$count = count($an->{'answer'});
			$i = 0;
			$fin = $an->{'answer'}[0];
			foreach($an->{'answer'} as $ans) {
				if($i)
				{
					$fin = $fin . " & ". $ans;
				}
			$i++;
			$questionhtml = $questionhtml. "<input name='q".$qid."[]' type='text'>&nbsp;&nbsp;&nbsp;";
			}
		$answerhtml = $answerhtml . "<br> Answer - ". $fin;
		}

######
		if($questiontypeid == 1)
		{
			$options = json_decode($answer);
			$an = json_decode($answerkey);
			$i = 0;
			foreach($options->{'options'} as $o) {
				$questionhtml = $questionhtml . "<input name='q".$qid."[]' type='radio' value = ".$i.">".$o."<br>";
				$i++;
			}
			$answerhtml = $answerhtml . "Answer : option - ".$an->{'answer'}[0]." i.e ".$options->{'options'}[$an->{'answer'}[0]];	

		}
#######
		if($questiontypeid == 2)
		{
			$options = json_decode($answer);
			$an = json_decode($answerkey);
			$i = 0;
			foreach($options->{'options'} as $o) {
				$questionhtml = $questionhtml . "<input name='q".$qid."[]' value=".$i." type='checkbox'>".$o."<br>";
				$i++;
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
		$answerhtml = $answerhtml . "Answer : options - ".$f." i.e ".$fin;	

		}
		$complexityhtml =$complexityhtml. "<br>Complexity - ".$complexity."<br>Question added by - ".$createdby;
	}
	
	if($answeryn) {
		$questionhtml = $questionhtml.$answerhtml;
	}
	if($qdetailsyn) {
		$questionhtml = $questionhtml.$complexityhtml;
	}
	
	return $questionhtml;
}
	
?>