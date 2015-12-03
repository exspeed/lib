<?php
$user = 'root';
$password = 'root';
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect($host, $user, $password, $db) or die ("Unable to connect to MySQL");
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>CPSC 471 Library</title>
	<script>
		function register(){
			location.href = "register.php";
		}
	</script>
</head>

<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="2" bgcolor="#9999ff" align="center">
				<img alt="library icon" src="library.png" style="width:145px; height:100px;">

				<h1>Library Database</h1>
			</td>
		</tr>
		
		<tr>
			<td width="20%" valign="top" bgcolor="#cccccc" height="300" style="padding-left: 20px">
				<a href="employee.php"><br>Employees</br></a>
				<a href="index_old.php"><br>Manager</br></a>
			</td>
			
			<td width="80%" valign="top" style="padding-left: 40px">
				<h3>Member Login</h3>
				<?php
					if (isset($_GET['incorrect'])) {
						$val = $_GET['incorrect'];
						if ($val == True) {
							echo '<font color="red">' . "Incorrect Username/Password" . '</font>' . '<br>';
						}
					}
				?>

     			<form action="login.php" method="post">
     				<table>
     					<tr>
     						<td>Username:</td>
     						<td><input type="text" name="username" /></td>
     					</tr>
     					<tr>
     						<td>Password:</td>
     						<td><input type="password" name="password" /></td>
     					</tr>
     				</table>
     				
					<input type="submit" value="Submit" />
					<input type="button" value="Register" onclick="register()">
				</form>
			</td>
		</tr>
	</table>
</body>

</html>
