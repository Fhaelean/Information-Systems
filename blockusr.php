<?php
session_start();
if (isset($_POST['blocklogin'])) 
{ 
	$blocklogin = $_POST['blocklogin']; 
	if ($blocklogin == '') { unset($blocklogin);}
	$blocker = 1;
}
$blocklogin = stripslashes($blocklogin);
$blocklogin = htmlspecialchars($blocklogin);
$blocklogin = trim($blocklogin);
	
include ("bd.php");

$prov = mysql_query("SELECT id FROM users WHERE login='$blocklogin'",$db);
$myprov = mysql_fetch_array($prov);
if(array_key_exists('unblcok',$_POST))
{
	$unblocker = 0;
	if (empty($myprov['id'])) 
	{
		echo "<a href='adminmenu.php'>Try again</a><br>";
		exit ("There is no login such this try once more");
	}
	else
	{
		$result2 = mysql_query( "UPDATE users SET block = '$unblocker' WHERE login = '$blocklogin'");
		echo "<p align='center'> <b>User successfully unblocked</b> <br><button><a href='adminmenu.php'>Menu</a></button></p>";	
	}
}
else
{
	if (empty($myprov['id'])) 
	{
		echo "<a href='adminmenu.php'>Try again</a><br>";
		exit ("There is no login such this try once more");
	}
	else
	{
		$result1 = mysql_query( "UPDATE users SET block = '$blocker' WHERE login = '$blocklogin'");
		echo "<p align='center'> <b>User successfully blocked</b> <br><button><a href='adminmenu.php'>Menu</a></button></p>";	
	}
}
?>
