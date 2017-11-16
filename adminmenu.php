<?php
session_start();
include ("bd.php");
	if ($_SESSION['id']!=6) 
	{
		header('Location:http://localhost/files/index.php'); 
		exit; 
	}
	else 
	{ 
		echo "You are logged in as: ".$_SESSION['login'];
	} 
?>
<html>
	<head>
		<title>Admin Menu</title>
	</head>
	<body style="background-color: #F0F8FF">
		<h2 align="center">Admin Menu</h2>
		<h3 align="center">Premissions</h3>
		<form align="center">
			<?php
				$con = new mysqli('localhost','root','','users');
				$qur = "SELECT * FROM users";
				if($result = $con->query($qur))
				{
					while ($row = $result->fetch_assoc())
				   {
					   echo '<b>Login: </b>'.$row['login'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					   echo '<b>Permissions: </b>'.$row['permissions'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					   echo '<b>Block: </b>'.$row['block'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					   echo '<b>Restrictions: </b>'.$row['restriction'].'<br>';
				   }
				}
			?>
		</form>
		<h3 align="center">Change ADMIN password</h3>
		<form action="changepass.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Old password:</td>
					<td>
						<input name="oldpass"  type="password" maxlength="20" placeholder="Old_password" required />
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
		<h3 align="center">Add user</h3>
		<form action="newusr.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Login:</td>
					<td><input name="login" type="text" maxlength="20" placeholder="New_Login" required><br></td>
				</tr>
				<tr>
					<td>Password: NULL<td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add">
					</td>
				</tr>
			</table>
		</form>
		<h3 align="center">Block/Unblock user activity</h3>
		<form action="blockusr.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Block user:</td>
					<td><input name="blocklogin" type="text" maxlength="20" placeholder="User_Login" required><br></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Block">
					</td>
					<td colspan="2">
						<input type="submit" name="unblcok" id="unblcok" value="Unblock">
					</td>
				</tr>
			</table>
		</form>
		<h3 align="center">Password restrictions</h3>
		<form action="restrictions.php" method="post">
			<table align="center" id="reg_table" cellspacing="10" border="0">
				<tr>
					<td>Restrict user:</td>
					<td><input name="restr" type="text" maxlength="20" placeholder="User_Login" required><br></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Restrict">
					</td>
					<td colspan="2">
						<input type="submit" name="unrest" id="unrest" value="Unrestrict">
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
