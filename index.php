<?php
$user = 'root';
$password = 'root';
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect ( $host, $user, $password, $db ) or die ( "some error" );

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Library</title>
<script>
      function register(){
      location.href = "register.php";
      }
    </script>

</head>
<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="2" bgcolor="#9999ff" align="center"><img
				alt="library icon" src="library.png"
				style="width: 145px; height: 100px;">

				<h1>Library Data Base</h1></td>
		</tr>
		<tr>
			<td width="20%" bgcolor="#cccccc" height="300"><a href="employee.php">employees</a></td>
			<td width="80%" valign="top">
				<h3>Sign in</h3>
      <?php
						if (isset ( $_GET ['incorrect'] )) {
							$val = $_GET ['incorrect'];
							if ($val == True) {
								echo "Incorrect Username/Password" . '<br>';
							}
						}
						?>

      <form action="login.php" method="post">
					Username: <input type="text" name="username" /><br> Password: <input
						type="text" name="password" /><br> <input type="submit"
						value="Submit" /> <input type="button" value="Register"
						onclick="register()">
				</form>
			</td>
		</tr>
	</table>


</body>

</html>
