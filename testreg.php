<?php
session_start();
include ("bd.php");
function testfun()
{
	unset($_SESSION['login']); 
	unset($_SESSION['id']);
	unset($_SESSION['password']);
}
if(array_key_exists('test',$_POST))
{
	testfun();
}
if (isset($_POST['login'])) 
{ 
	$login = $_POST['login']; 
	if ($login == '') { unset($login);} 
} 
if (isset($_POST['password'])) 
{ 
	$password=$_POST['password']; 
}
if (empty($login)) 
{
	echo "<a href='index.php'>Main</a><br>";
	exit ("You are logged out");
}

$block = mysql_query("SELECT * FROM users WHERE login='$login'",$db);
$mb = mysql_fetch_array($block);

if($mb['login'] != $login)
{
	echo "<a href='index.php'>Main</a><br>";
	exit ("There is no login such this");
}
if($mb['block'] == 1)
{
	echo "<a href='index.php'>Main</a><br>";
	exit ("This user is blocked");
}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$login = trim($login);
$password = trim($password);

$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
//--------------------------------------------------------------------------------
if($password != '')
{
	$salt = $myrow['salt'];
	function mc_encrypt($encrypt, $key)
	{
		$iv = "";
		$encoded = mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $encrypt, MCRYPT_MODE_STREAM, $iv);
		$encoded = base64_encode($encoded);
		return $encoded;
	}
	$pass = mc_encrypt($password, ENCRYPTION_KEY);

	$hashpass = hash('md2',hash('md2',$pass).$salt);
}
else
{
	$hashpass = $password;
}
//--------------------------------------------------------------------------------
$exitclick;
$_SESSION['exitclick'];
if ($myrow['password']!=$hashpass)
{
	if($_SESSION['exitclick'] < 2)
	{
		echo "<p align='center'> <b>Incorrect login or password</b> <br><button><a href='index.php'>Try again</a></button></p>";
		$_SESSION['exitclick']++;
	}
	else
	{
		echo "<p align='center'><b>You used the maximum number of attempts</b></p>";
		$_SESSION['exitclick'] = 0;
	}
}
else 
{
	if ($myrow['password']==$hashpass) 
	{
		$_SESSION['login']=$myrow['login']; 
		$_SESSION['id']=$myrow['id'];
		$_SESSION['password']=$myrow['password'];
		echo "<p align='center'><b>Congratulations you are in</b></p>";
		if ($myrow['permissions'] == 1)
		{
			echo "<br><p align='center'><b>You are ADMIN</b><br><button><a href='adminmenu.php'>Menu</a></button></p>";
		}
		else
		{
			echo "<br><p align='center'><b>You are usual user</b><br><button><a href='menu.php'>Menu</a></button></p>";
		}
	}
	else 
	{
		echo "<p align='center'><b>Incorrect login or password1</b> <br><a href='index.php'>Main</a>";   
	}
}
?>