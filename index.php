<?php
	session_start();
?>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Main</title>
	</head>
	<body style="background-color: #F0F8FF">
		<h2 align="center">Main</h2>
		<form action="testreg.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Login:</td>
					<td>
						<input name="login"  type="text" maxlength="20" placeholder="Your_login" required />
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input name="password" type="password" maxlength="20" placeholder="Your_password" /><br />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Login">
						<br>
						<p>
						<button><a href="reg.php">Registrate</a></button> 
						</p>
					</td>
				</tr>
			</table>
		</form>
		<p>
		<button><a href="about.php">About</a></button>
		</p>
	</body>
</html>
<?php
function tete()
{
	unset($_SESSION['login']); 
	unset($_SESSION['id']);
	unset($_SESSION['password']);
}
if(array_key_exists('tete',$_POST))
{
	tete();
}
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
	echo "You are not logged in.";
}
else
{
	echo '<form action="index.php" method="post">
			<input type="submit" name="tete" id="tete" value="Logout">
		 </form>';					
	echo "You are logged in as: ".$_SESSION['login']."<br>";
}
?>



