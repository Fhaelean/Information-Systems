<?php
if (isset($_POST['login'])) 
{ 
	$login = $_POST['login']; 
	if ($login == '') { unset($login);} 
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$login = trim($login);

include ("bd.php");

$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);

if (!empty($myrow['id'])) 
{
	echo "<a href='adminmenu.php'>Try again</a><br>";
	exit ("Try once more this login is occupied");
}
$result2 = mysql_query ("INSERT INTO users (login) VALUES('$login')");
if ($result2=='TRUE')
{
	echo "Congratulations you are add new user. <br><button><a href='adminmenu.php'>Menu</a></button><br><button><a href='index.php'>Main</a></button>";
}
else 
{
	echo "Error you are not registerd. <a href='adminmenu.php'>Try once more</a>";
}
?>