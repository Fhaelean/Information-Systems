<?php
	session_start();
	include ("bd.php");
	if (isset($_SESSION['login'])) 
	{
		echo "You are logged in as: ".$_SESSION['login']."<br>";
	}
	else 
	{ 
		header('Location:http://localhost/files/index.php'); 
		exit; 
	}
?>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Menu</title>
	</head>
	<body style="background-color: #F0F8FF">
		<h2 align="center">Menu</h2>
		<h3 align="center">Change password</h3>
		
		<form action="changepass.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Old password:</td>
					<td>
						<input name="oldpass"  type="password" maxlength="20" placeholder="Old_password" />
					</td>
				</tr>
				<tr>
					<td>New password:</td>
					<td>
						<input name="newpass1" type="password" maxlength="20" placeholder="New_password" required  /><br />
					</td>
				</tr>
				<tr>
					<td>Repeat password:</td>
					<td>
						<input name="newpass" type="password" maxlength="20" placeholder="Repeat_password" required  /><br />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Change">
					</td>
				</tr>
			</table>
		</form>
		<p>
		<button><a href="about.php">About</a></button>
		</p>
		<form action="testreg.php" method="post">
			<input type="submit" name="test" id="test" value="Logout" /><br/>
		</form>
	</body>
</html>