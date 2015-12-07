<?php
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect ( $host, 'root', 'root', $db ) or die ( "some error" );
?>

<!DOCTYPE html>
<!--HEADER-->
<html>
<head>
<style>
.error {
	color: #FF0000
}
</style>
    <style>
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}

th, td {
	padding: 5px;
}
</style>
<title>Manager</title>
</head>

<!--FIRST BODY-->
<?php 
$userErr = $passErr = $fnameErr = $lnameErr = $addErr = $salErr = $fireErr = "";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
    if (! empty ( $_POST ['addemployee'] )) {    
        $username = $_POST ['username'];
        $password = $_POST ['password'];
        $fname = $_POST ['fname'];
        $lname = $_POST ['lname'];
        $address = $_POST ['address'];
        $salary = $_POST ['salary'];
        $library = $_POST ['library'];
        $supervisor = $_POST ['supervisor'];
        if ($library == "" || $username == "" || $password == "" || $fname == "" || $lname == "" || $address == "" || $salary == "" ) {
			echo 'There is one or more empty fields.';
        } else {

      
        $strSQL = "INSERT INTO employee (address, salary, fname, lname, superEID, username, password, library) VALUES ('$address', '$salary', '$fname', '$lname', '$supervisor', '$username', '$password', '$library');";
        $result = mysqli_query ( $con, $strSQL );
        if (! $result) {
				echo 'Already an employee!';
			} else {
				echo 'New Employee added!';
			}
		}
}
    
        
    if (! empty ( $_POST ['fire'] )) {
		$eID = $_POST ['eID'];
        
        $strSQL = "DELETE FROM employee WHERE EID = $eID";
			$query = mysqli_query ( $con, $strSQL );
			if (! $query) {
				echo 'Enter an Employee ID.';
			} else {
                echo 'Employee has been removed.';
            }
	}
}
    


    ?>
<!--SECOND BODY-->
<body>
	<table width="100%" border="0">
		<tr>
			<td colspan="2" width="100%" align="center" bgcolor="#9999ff">
				<h1>Manager</h1>
			</td>
		</tr>
		<tr><td align="left" bgcolor ="#E6E6E6" style='padding-left: 20px' >
		<h3>Register an Employee</h3>
    	<form name="addemployee"
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
			method="post">
    	<table>
    		<tr>
    			<td>Username: <input type="text" name="username" /> <span class="error"><?php echo $userErr;?></span></td>
    			<td>Password: <input type="password" name="password" /> <span class="error"> <?php echo $passErr;?></span></td>
    		</tr>
    		<tr>
    			<td>First Name: <input type="text" name="fname" /> <span class="error"> <?php echo $fnameErr;?></span></td>
    			<td>Last Name: <input type="text" name="lname" /> <span class="error"> <?php echo $lnameErr;?></span></td>
    		</tr>
    		<tr>
    			<td>Address: <input type="text" name="address" /> <span class="error"> <?php echo $addErr;?></span></td>
    			<td>Salary ($per hour): <input type="text" name="salary" /> <span class="error"> <?php echo $salErr;?></span></td>
    		</tr>
    		<tr>
    			<td>Library:
				<select name="library">
				<?php
					$strSQL = "SELECT name FROM library";
					$query = mysqli_query ( $con, $strSQL );
					while ( $result = mysqli_fetch_assoc ( $query ) ) {
						echo '<option value=' . '"' . $result ['name'] . '"' . '>' . $result ['name'] . '</option>';
					}
				?>
				</select>
				</td>
				<td>Supervisor:
				<select name="supervisor">
				<?php
					$strSQL = "SELECT eid, fname, lname FROM employee";
					$query = mysqli_query ( $con, $strSQL );
					while ( $result = mysqli_fetch_assoc ( $query ) ) {
						echo '<option value=' . '"' . $result ['fname'] . '"' . '>' . $result ['eid'] . ' - ' . $result ['fname'] . ' ' . $result ['lname'] . '</option>';
					}
				?>
				</select></td>
			</tr>
		</table>
	
    <input type="submit" name="addemployee" value="add Employee" />
    </form>
    
   <h3>Fire Employee</h3>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
		method="post">
            Employee ID: <input type="text" name="eID" /> <br> <input type="submit" name="fire" value="fire Employee" /> 
            <br> <?php echo $fireErr; ?>
               </form> 
    
    <h3>Checked Out Books</h3>
    <?php
	$strSQL = "SELECT * FROM memberborrowsbook";
	$query = mysqli_query ( $con, $strSQL );
	if (! $query) {
		echo "error " . mysqli_error ( $con );
		exit ();
	}
	echo "<table style=\"width:100 %\">";
	echo "<tr><th>Book ISBN</th><th>Member ID</th><th>Due Date</th>";
	while ( $result = mysqli_fetch_array ( $query ) ) {
		echo '<tr>';
		echo '<td>' . $result ['isbn'] . '</td>';
		echo '<td>' . $result ['memberID'] . '</td>';
		echo '<td>' . $result ['dueDate'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>
    
    <td align='left' bgcolor ="#E6E6E6" style='padding-left: 160px'>
    <h3>Current Employees</h3>
    <?php
	$strSQL = "SELECT fname, lname, EID, library FROM employee";
	$query = mysqli_query ( $con, $strSQL );
	if (! $query) {
		echo "error " . mysqli_error ( $con );
		exit ();
	}
	echo "<table style=\"width:100 %\">";
	echo "<tr><th>First Name</th><th>Last Name</th><th>Employee ID</th><th>Location</th>";
	while ( $result = mysqli_fetch_array ( $query ) ) {
		echo '<tr>';
		echo '<td>' . $result ['fname'] . '</td>';
		echo '<td>' . $result ['lname'] . '</td>';
		echo '<td>' . $result ['EID'] . '</td>';
		echo '<td>' . $result ['library'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	?> </td>
	</tr>
	</table>
	<a href="log.php"><br>View Logs</br></a>
	<a href="/index.php">Back to Main Page</a>