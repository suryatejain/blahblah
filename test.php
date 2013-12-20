<?php
include 'opcfunctions.php';
include 'mydb.php';
include 'sidebar.php';

$sql = 'select id from questionbank';
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{

}

$qid = array(8);

foreach($qid as $w)
{

$qhtml = questionhtml($w,1,1);
echo$qhtml;
}

?>