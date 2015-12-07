<?php
$user = 'root';
$password = 'root';
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect($host, $user, $password, $db) or die ("Unable to connect to MySQL");
	if (! empty ( $_POST ['Login'] )) {
			$logErr = "";
			$username = $_POST ['username'];
			$password = $_POST ['password'];
			$strSQL = "SELECT username, password FROM employee WHERE username = '$username' AND password = '$password'";
			
			$query = mysqli_query ( $con, $strSQL );
			if ($query) {
				$result = mysqli_fetch_array ( $query );
			}
			if ($result) {
				header('Location: manager.php');
			}
			else {
				$logErr = "Invalid Username/Password";
			}
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Manager Login</title>
</head>

<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="2" bgcolor="#9999ff" align="center">
				<img alt="library icon" src="library.png" style="width:145px; height:100px;">

				<h1>Manager Login</h1>
			</td>
		</tr>
		
		<tr>
			<td width="100%" valign="top" style="padding-left: 40px">
			<form method="post" action="">
				<h3>Login:</h3>
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
     				<input type="submit" name="Login" value="Login"/>
     				<?php echo $logErr; ?>
			</form>
			</td>
		</tr>
	</table>
	<a href="/index.php">Back to Main Page</a>
</body>

</html>
