<html>
<title>OPC</title>
<body>

<?php
error_reporting(0);
include 'mydb.php';
session_start();
if(isset($_POST['logout'])){
	unset($_SESSION['user']);
	session_destroy();
}
if(isset($_POST['myusername']))
{
	$u = $_POST['myusername'];
	$sql = "select * from users where username like '$u'";
	$query = mysql_query($sql);
	while ($row=mysql_fetch_array($query)) { 
			if($row['password'] != md5($_POST['mypassword']) ){
				echo "Wrong username/password";
				die();
			}
			else {
				echo "<h2>".$_POST['myusername'].", You have logged in.</h2>";
				session_start();
				$_SESSION['user'] = $_POST['myusername'];
			}
	}
}

if (isset($_SESSION['user']))
{
echo '<div style="top:0px;right:25px;position: fixed;">
	<form action="#" method="post"><input type="hidden" name="logout" value=1><input type="submit" value="logout"></form>
</div>';

		echo '<h2>Hi '.$_SESSION['user'].', here are some important links...</h2>
<br>
<a href="create.php">add a new question</a><br>
<a href="approve.php">approve the questions</a><br>
<a href ="approvedquestions.php">approved questions</a><br>
<a href ="myques.php">my questions</a><br>
<h3> under development links .. </h3>
<a href="#">user profile</a><br>
<a href="#">sample paper from the existing pool of questions</a>';
}

else
{
	if(isset($_REQUEST['register'])) {
	 echo "<script>alert('You have been registered')</script>";
	}
		echo '<br><br><br><br><table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form style="display:inline;" name="form1" method="post" action="index.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="password" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></form>&nbsp;<form style="display:inline;" action="register.php"><input type="submit" value="Register"></form></td>
</tr>
</table>
</td>

</tr>
</table>';
}

?>
	