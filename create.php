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
include 'sidebar.php';

?>
<html>
<title>OPC</title>
<head>
<style>
	textarea#styleid1{
color:#666;
font-size:14px;
-moz-border-radius: 8px; -webkit-border-radius: 8px;
margin:5px 0px 10px 0px;
padding:10px;
height:75px;
width:350px;
border:#999 1px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
transition: all 0.25s ease-in-out;
-webkit-transition: all 0.25s ease-in-out;
-moz-transition: all 0.25s ease-in-out;
box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
} - See more at: http://www.prettyklicks.com/blog/textarea-animated-glow-like-on-twitter-using-css3/#sthash.woq3evpN.dpuf
	</style>
<script>

var fieldnumber = 2;
var activefield = "text";

function addOption(q) { 
		var fname = q + "answer";
	    var fnum = fieldnumber + 1 ;
		var theForm = document.getElementById(fname); 
		var newOption = document.createElement("input"); 
		newOption.name = fname + '[]'; // poll[optionX]
		if(q == 'radio')
		{
		newOption.name = fname;
		}
		newOption.type = q;
		if(q != 'text')
		{
		newOption.value = q + fnum;
		}
		theForm.appendChild(newOption); 

		if(q != 'text')
		{
		var newOption1 = document.createElement("input"); 
		newOption1.type = 'text';
		newOption1.name = q + fnum;

		theForm.appendChild(newOption1); 
		}
		var mybr = document.createElement('br');
		theForm.appendChild(mybr);
		fieldnumber++


}
function hidedivs(p) {
	document.getElementById('addfield').style.display = "block";
if(p==0) {
activefield = "";
document.getElementById('textanswer').style.display = "none";
document.getElementById('radioanswer').style.display = "none";
document.getElementById('checkboxanswer').style.display = "none";
}
	
if(p==3) {
activefield = "text";
document.getElementById('textanswer').style.display = "block";
document.getElementById('radioanswer').style.display = "none";
document.getElementById('checkboxanswer').style.display = "none";
}

if(p==1) {
	activefield = "radio";
document.getElementById('textanswer').style.display = "none";
document.getElementById('radioanswer').style.display = "block";
document.getElementById('checkboxanswer').style.display = "none";
}

if(p==2) {
	activefield = "checkbox";
document.getElementById('textanswer').style.display = "none";
document.getElementById('radioanswer').style.display = "none";
document.getElementById('checkboxanswer').style.display = "block";
}

}
</script>
</head>
<body>

<form name="xform" action="post.php" method="POST">
	<table>
<tr>
<td>Enter your Question : </td><td><textarea id="styleid1" name="question"></textarea></td></tr>
<tr><td>Question Type : </td><td><select name="questiontypeid" onchange="hidedivs(this.value);">
			<option value=0></option>
			<option value=1>Single Answer Options</option>
			<option value=2>Multiple Answer Options</option>
			<option value=3>Fill the blanks</option>
		</select></td></tr>
<tr><td>
Answer : </td><td>Please enter/select/check the correct answer(s) while entering the options</td></tr>
<div>
<tr>
<td></td><td id="textanswer" style="display:none;"><input name="textanswer[]" type="text"><br></td>

</tr>
</div>
<div>
<tr><td></td><td id="radioanswer" style="display:none;">
<input type="radio" name="radioanswer" value="radio1"><input type="text" name="radio1"><br>
<input type="radio" name="radioanswer" value="radio2"><input type="text" name="radio2"><br>
</td>
</tr>
</div>

<div>
<tr><td></td><td id="checkboxanswer" style="display:none;">
<input type="checkbox" name="checkboxanswer[]" value="checkbox1"><input type="text" name="checkbox1"><br>
<input type="checkbox" name="checkboxanswer[]" value="checkbox2"><input type="text" name="checkbox2"><br>
</td>
</tr>
<tr><td></td>
	<td id="addfield" style="display:none;"><button onclick="addOption(activefield);return false;">Add Field</button></td>
	</tr>
</div>
<tr><td>
Select the complexity</td><td>
<select name="complexity" onchange="">
			<option value=1>1 (easiest)</option>
			<option value=2>2</option>
			<option value=3>3</option>
		</select></td></tr>
<tr><td>
Type of Question</td><td>
<select name="banktypeid" onchange="">
			<option value=1>Analytical</option>
			<option value=2>Common Tech</option>
			<option value=3>Java</option>
			<option value=4>SQL Questions</option>
		</select></td></tr>
<tr><td>
<input type="hidden" id="myField" name="fnum" value="" />
<input type="submit" value="submit" onclick="document.getElementById('myField').value = fieldnumber;"></td></tr></table><br><br>
</form>
</body>
</html>



