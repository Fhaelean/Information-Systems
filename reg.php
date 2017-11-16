<html>
	<head>
		<title>Registration</title>
	</head>
	<body style="background-color: #F0F8FF">
		<h2 align="center">Registration</h2>
		<form align="center" action="save_user.php" method="post">
			<p>
				<label>Login:<br></label>
				<input name="login" type="text" size="15" maxlength="15" required>
			</p>
			<p>
				<label>Password:<br></label>
				<input name="password" type="password" size="15" maxlength="15" required>
			</p>
			<p>
				<input type="submit" name="submit" value="Registration">
			</p>
			<p>
				<button><a href='index.php'>Main</a></button>
			</p>
		</form>
	</body>
</html>
