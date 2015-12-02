<?php
$user = $pass = "";
$fname = $mname = $lname = $email = $address = $strNum = $pcode = $gender = "";
$userErr = $passErr = $fnameErr = $lnameErr = $addressErr = $strNumErr = $pcodeErr = "";
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect($host, 'root', 'root', $db) or die ("Unable to connect to MySQL");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// check for valid input
	if (checker()) {
		// add user to the database
		$query = "INSERT INTO member (username, password, fname, lname) VALUES ('$user', '$pass', '$fname', '$lname')";
		$result = mysqli_query($con, $query);

		if (!$result) {
			echo "Username already exists!";
		} else {
			echo "Success, you are now a user";
		}

		$strSQL = "SELECT memberID, username FROM member";
		$query = mysqli_query($con, $strSQL);
		if (!$query) {
			echo "syntax error";
		}

		$memberID = "";
		while ($result = mysqli_fetch_array ($query)) {
			if ($result['username'] == $user) {
				$memberID = $result['memberID'];
			}
		}

		$strSQL = "INSERT INTO memberaddress(memberID, street, number, postalCode) VALUES ('$memberID', '$address', '$strNum', '$pcode')";
		$result = mysqli_query($con, $strSQL);
		if (!$result) {
			echo "new address entree failed" . '<br>';
		}
	}
}
function checker() {
	global $user, $pass, $fname, $mname, $lname, $email, $address, $strNum, $pcode, $gender;
	global $userErr, $passErr, $fnameErr, $lnameErr, $addressErr, $strNumErr, $pcodeErr;
	$valid = True;

	$user = $_POST["user"];
	if ($user == "") {
		$valid = False;
		$userErr = "Username can't be empty";
	}

	$pass = $_POST["pass"];
	if ($pass == "") {
		$passErr = "Password can't be empty";
		$valid = False;
	}

	$fname = $_POST["fname"];
	if ($fname == "") {
		$fnameErr = "First name is required.";
		$valid = False;
	}

	$mname = $_POST["mname"];

	$lname = $_POST["lname"];
	if ($lname == "") {
		$lnameErr = "Last name is required";
		$valid = False;
	}

	$email = $_POST["email"];

	$address = $_POST["address"];
	if ($address == "") {
		$addressErr = "Address is required";
		$valid = False;
	}

	$strNum = $_POST["strNum"];
	if ($strNum == "") {
		$strNumErr = "Street Number is required.";
		$valid = False;
	}
	else if (!preg_match("/^[0-9]*$/", $strNum )) {
		$strNumErr = "Street Number must be an int.";
		$valid = False;
	}
	$strNum = (int) $strNum;

	$pcode = $_POST ["pcode"];
	if ($pcode == "") {
		$pcodeErr = "Postal Code is required.";
		$valid = False;
	}

	$gender = $_POST ["gender"];

	return $valid;
}
?>

<!DOCTYPE html>
<html>

<head>
	<style>
		.error {
			color: #FF0000;
		}
	</style>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Register</title>
</head>

<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="2" bgcolor="#9999ff" align="center">
				<h1>New User Form</h1>
			</td>
		</tr>
		<tr>
			<td width="100%" align="center"><font color="red"> Required * </font>


				<form method="post"
					action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<table>
						<tr>
							<td style="width:200px"></td>
							<td style="width:175px"></td>
							<td style="width:175px"></td>
							<td style="width:300px"></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Username<font color="red">*</font></td>
							<td><input type="text" name="user" /></td>
							<td><span class="error"><?php echo $userErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Password<font color="red">*</font></td>
							<td><input type="password" name="pass" /></td>
							<td><span class="error"><?php echo $passErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">First Name<font color="red">*</font></td>
							<td><input type="text" name="fname" /></td>
							<td><span class="error"><?php echo $fnameErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Middle Name</td>
							<td><input type="text" name="mname" /></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Last Name<font color="red">*</font></td>
							<td><input type="text" name="lname" /></td>
							<td><span class="error"><?php echo $lnameErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Email &nbsp</td>
							<td><input type="text" name="email" /></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Address<font color="red">*</font></td>
							<td><input type="text" name="address" /></td>
							<td><span class="error"><?php echo $addressErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Street Number<font color="red">*</font></td>
							<td><input type="text" name="strNum" /></td>
							<td><span class="error"><?php echo $strNumErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Postal Code<font color="red">*</font></td>
							<td><input type="text" name="pcode" /></td>
							<td><span class="error"><?php echo $pcodeErr;?></span></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right">Gender<font color="red">*</font></td>
							<td><input type="radio" name="gender" value="male" checked="checked">Male <input type="radio" name="gender" value="female">Female</td>
						</tr>
							
					</table>
					<input type="submit" value="Submit" />
				</form> <br></td>
		</tr>
	</table>
	<a href="index.php">Back to Main Page</a>
</body>

</html>