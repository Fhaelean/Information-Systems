<?php
session_start();
include ("bd.php");
if (isset($_POST['oldpass'])) 
{ 
	$oldpass = $_POST['oldpass']; 
} 
if (isset($_POST['newpass'])) 
{ 
	$newpass=$_POST['newpass']; 
	if ($newpass =='') { unset($newpass);} 
}
if (isset($_POST['newpass1'])) 
{ 
	$newpass1=$_POST['newpass1']; 
	if ($newpass1 =='') { unset($newpass1);} 
}
if ($newpass1 != $newpass) 
{
	if ($_SESSION['id'] == 6) 
	{
		echo "<a href='adminmenu.php'>Menu</a><br>";
		exit ("Password dosen't match");	
	}
	else 
	{ 
		echo "<a href='menu.php'>Menu</a><br>";
		exit ("Password dosen't match");	
	}
}
$logid = $_SESSION['id'];
$login = $_SESSION['login'];
$restr = mysql_query("SELECT * FROM users WHERE id='$logid'",$db);
$mrestr = mysql_fetch_array($restr);
//--------------------------------------------------------------------------------
$salt = $mrestr['salt'];
function mc_encrypt($encrypt, $key)
{
	$iv = "";
    $encoded = mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $encrypt, MCRYPT_MODE_STREAM, $iv);
    $encoded = base64_encode($encoded);
    return $encoded;
}
$pass = mc_encrypt($oldpass, ENCRYPTION_KEY);
$hasholdpass = hash('md2',hash('md2',$pass).$salt);
//--------------------------------------------------------------------------------
$saltr = mt_rand(100, 999);
mysql_query( "UPDATE users SET salt = '$saltr' WHERE login = '$login'");
function mc_encrypt1($encrypt, $key)
{
	$iv = "";
    $encoded = mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $encrypt, MCRYPT_MODE_STREAM, $iv);
    $encoded = base64_encode($encoded);
    return $encoded;
}
$newpassh = mc_encrypt1($newpass, ENCRYPTION_KEY);
$hashnewpass = hash('md2',hash('md2',$newpassh).$saltr);
//--------------------------------------------------------------------------------
if($oldpass != '')
{
	if ($hasholdpass != $_SESSION['password']) 
	{
		if ($_SESSION['id'] == 6) 
		{
			echo "<a href='adminmenu.php'>Menu</a><br>";
			exit ("Incorrect password");	
		}
		else 
		{ 
			echo "<a href='menu.php'>Menu</a><br>";
			exit ("Incorrect password");	
		}
	}
}
$logid = $_SESSION['id'];
if($mrestr['restriction'] == 1)
{
	if (preg_match('/[a-zA-Z]/', $newpass1)) 
	{
		if (preg_match('/[-+*=\/]/', $newpass1)) 
		{
			echo "<br>F.<br>";
		}
		else
		{
			echo "<a href='menu.php'>Try again</a><br>";
			exit ('You should use "A-Z, a-z, -, +, *, =, /" in password');
		}
	} 
	else 
	{
		echo "<a href='menu.php'>Try again</a><br>";
		exit ('You should use "A-Z, a-z, -, +, *, =, /" in password');
	}
}
$password=$_SESSION['password'];
$id =$_SESSION['id']; 
$con = mysqli_connect('localhost','root','','users') or die(mysqli_error());
$respass = mysql_query("SELECT id FROM users WHERE password='$hashnewpass'",$db);
$mr = mysql_fetch_array($respass);
if (!empty($mr['id']))
{
	if ($_SESSION['id'] == 6) 
	{
		echo "<button><a href='adminmenu.php'>Try again</a></button><br>";
		exit ("Try once more password is occupied");	
	}
	else 
	{ 
		echo "<button><a href='menu.php'>Try again</a></button><br>";
		exit ("Try once more password is occupied");	
	}
}
$result = mysqli_query($con,"SELECT * FROM users WHERE login='$login'");
if (!$result) echo "Error no result"; 
if ($result->num_rows > 0)
{
	$result1 = mysql_query( "UPDATE users SET password = '$hashnewpass' WHERE login = '$login'");
	if ($_SESSION['id'] == 6) 
	{
		if (!$result1) throw new Exception('Password cant be changed.'); 
		else echo "Password successfully changed<br><a href='adminmenu.php'>Back</a><br>";
		$_SESSION['password'] = $hashnewpass;
	}
	else 
	{ 
		if (!$result1) throw new Exception('Password cant be changed.'); 
		else echo "Password successfully changed<br><a href='menu.php'>Back</a><br>";
		$_SESSION['password'] = $hashnewpass;
	}
}
else echo "Error old password is incorrect <br><a href='menu.php'>Try again</a>"; 
?>
<html>
	<body>
		<form action="testreg.php" method="post">
			<input type="submit" name="test" id="test" value="Logout" /><br/>
		</form>
	</body>
</html>