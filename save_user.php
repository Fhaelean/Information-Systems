<?php
if (isset($_POST['login'])) 
{ 
	$login = $_POST['login']; 
	if ($login == '') { unset($login);} 
} 
if (isset($_POST['password'])) 
{ 
	$password=$_POST['password']; 
	if ($password =='') { unset($password);} 
}
if (empty($login) or empty($password))
{
	echo "<a href='reg.php'>Try again</a><br>";
	exit ("Inf not complete!");
}
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$login = trim($login);
$password = trim($password);

include ("bd.php");

$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);

$result1 = mysql_query("SELECT id FROM users WHERE password='$password'",$db);
$myrow1 = mysql_fetch_array($result1);
if (!empty($myrow['id']) or !empty($myrow1['id'])) 
{
	echo "<a href='reg.php'>Try again</a><br>";
	exit ("Try once more this login or password is occupied");
}
$result2 = mysql_query ("INSERT INTO users (login,password) VALUES('$login','$password')");
if ($result2=='TRUE')
{
	echo "Congratulations you are registrated. <a href='index.php'>Main</a>";
}
else 
{
	echo "Error you are not registerd. <a href='reg.php'>Try once more</a>";
}
?>