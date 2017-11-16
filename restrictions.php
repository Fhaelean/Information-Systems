<?php
session_start();
if (isset($_POST['restr'])) 
{ 
	$restr = $_POST['restr']; 
	if ($restr == '') { unset($restr);}
}
$restr = stripslashes($restr);
$restr = htmlspecialchars($restr);
$restr = trim($restr);
	
include ("bd.php");

$re = mysql_query("SELECT id FROM users WHERE login='$restr'",$db);
$myre = mysql_fetch_array($re);
if(array_key_exists('unrest',$_POST))
{
	$unrestparam = 0;
	if (empty($myre['id'])) 
	{
		echo "<a href='adminmenu.php'>Try again</a><br>";
		exit ("There is no login such this try once more");
	}
	else
	{
		$result2 = mysql_query( "UPDATE users SET restriction = '$unrestparam' WHERE login = '$restr'");
		echo "<p align='center'> <b>User password successfully unrestricted</b> <br><button><a href='adminmenu.php'>Menu</a></button></p>";	
	}
}
else
{
	$restparam = 1;
	if (empty($myre['id'])) 
	{
		echo "<a href='adminmenu.php'>Try again</a><br>";
		exit ("There is no login such this try once more");
	}
	else
	{
		$result1 = mysql_query( "UPDATE users SET restriction = '$restparam' WHERE login = '$restr'");
		echo "<p align='center'> <b>User password successfully restricted</b> <br><button><a href='adminmenu.php'>Menu</a></button></p>";	
	}
}
?>
