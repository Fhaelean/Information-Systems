<?php
	session_start();
?>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>About</title>
	</head>
	<body style="background-color: #F0F8FF">
		<h2 align="center">About</h2>
		<form align="center" action="about.php" method="post">
			<p>
				<input type="submit" name="ref" id="ref" value="Reference">
			</p>
			<p>
				<button><a href='index.php'>Main</a></button>
			</p>
		</form>
	</body>
</html>
<?php
	function showinf()
	{
		echo '<form align="center">
			<p>Developer: Vova G Blynkov FB-41</p>
			<p>Individual task: Restrictions on selected passwords</p>
			<p>The presence of letters and arithmetic operators.</p>
			</form>';
	}
	function showadminf()
	{
		echo '<form align="center">
			<p>Premissions: 1 - ADMIN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2 - User</p>
			<p>Block: 0 - Unblocked &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1 - Blocked</p>
			<p>Restrictions on password: 0 - Unrestricted &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1 - restricted</p>
			</form>';
	}
	if(array_key_exists('ref',$_POST))
	{
		showinf();
	}
	if(array_key_exists('adm',$_POST))
	{
		showadminf();
	}
	if (empty($_SESSION['login']) or empty($_SESSION['id']))
	{}
	else
	{
		if ($_SESSION['id'] == 6) 
		{
			echo '<p align="center">
					<button><a href="adminmenu.php">Menu</a></button>
			      </p>';
			echo '<form align="center" action="about.php" method="post">
					<input type="submit" name="adm" id="adm" value="Information to ADMIN">
			      </form>';
		}
		else 
		{ 
			echo '<p align="center">
					<button><a href="menu.php">Menu</a></button>
				  </p>';
		} 	
	}
?>