<?php
if(isset($_POST['myusername'])) {
$u = $_POST['myusername'];
$p = md5($_POST['mypassword']);
include 'mydb.php';

$sql = "INSERT INTO `users` (`id`,`username`,`password`,`created`) VALUES('','$u','$p',now())";
if(mysql_query($sql))
{

 header("Location: index.php?register=1");
}
}
else
{
echo '<html>
<body>
	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="#">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Member Registration </strong></td>
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
<td><input type="submit" name="Register" value="Register"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>';	
}	
?>
	
