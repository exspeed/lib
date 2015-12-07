<?php
$user = 'root';
$password = 'root';
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect ( $host, $user, $password, $db ) or die ( "some error" );
$strSQL = "SELECT * FROM member INNER JOIN  memberaddress ON memberaddress.memberID = member.memberID";

// checks if username and password is in the db
$goback = True;
$memberID = $street = $number = $postalCode = "";
$fname = $lname = $fines = $totalBorrowed = "";

$query = mysqli_query ( $con, $strSQL );

while ( $result = mysqli_fetch_array ( $query ) ) {
	if ($result ['username'] == $_POST ["username"] && $result ['password'] == $_POST ["password"]) {
		$goback = False;
		$memberID = $result ['memberID'];
		$street = $result ['street'];
		$number = $result ['number'];
		$postalCode = $result ['postalCode'];
		$fname = $result ['fname'];
		$lname = $result ['lname'];
		$fines = $result ['fines'];
		$strSQL = "SELECT COUNT(*) as total FROM memberborrowsbook WHERE memberID= $memberID";
		$query = mysqli_query ( $con, $strSQL );
		$data = mysqli_fetch_assoc ( $query );
		$totalBorrowed = $data ['total'];
		$strSQL = "SELECT dueDate FROM memberborrowsbook WHERE memberID= $memberID";
		$query1 = mysqli_query ( $con, $strSQL );
		$date = time ();
		$fines = 0;
		while ( $result1 = mysqli_fetch_array ( $query1 ) ) {
			if (strtotime ( $result1 ['dueDate'] ) < $date) {
				$fines = $fines + 1.25;
			}
		}
	}
}

if ($goback) {
	header ( 'Location: index.php?incorrect=True' );
}

?>

<!DOCTYPE html>
<html>

<style>
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}

th, td {
	padding: 5px;
}
</style>
<body>
	<table width="100%" boarder="0">
		<tr>
			<td colspan="2" width=%100 align="center" bgcolor="#9999ff">
				<h1>Account Summary</h1>
			</td>
		</tr>


		<tr>
			<td bgcolor="#E6E6E6">
				<h2>Welcome <?php echo "$fname  $lname" ?></h2>

				<h3>Your Address: <?php echo "$number $street $postalCode";?><br>
      You owe us: <?php echo $fines; ?> <br>
      Number of books borrowed: <?php echo $totalBorrowed; ?><br>
      MemberID is <?php echo $memberID?>
    </h3>
			
			<td align="center">
			<form action="" method="post">
			<input type="hidden" name="username" value="<?php echo $_POST['username']?>">
			<input type="hidden" name="password" value="<?php echo $_POST['password']?>">
			<input type="submit" name="refresh" value="Refresh" /><br>
			</form>
			<form action="" method="post">
				<h3>Your Workrooms</h3>
				<input type="hidden" name="username" value="<?php echo $_POST['username']?>">
				<input type="hidden" name="password" value="<?php echo $_POST['password']?>">
	<?php
	$strSQL = "SELECT *
	FROM memberbooksworkroom
	WHERE memberid = $memberID
	ORDER BY date";
	$query = mysqli_query ( $con, $strSQL );
	if (! $query) {
		echo "your wokroom error " . mysqli_error ( $con );
		exit ();
	}
	$has = False;
	while ( $result = mysqli_fetch_array ( $query ) ) {
		$has = True;
		echo '<input type="radio" name="removeRoom" value="' . $result ['roomNumber'] . '"> Room ' . $result ['roomNumber'] . ' for ' . $result['date'] . '<br>';
	}
	if ($has == True) {
		echo '<input type="submit" name="rmRoom" value="Delete Reservation" /><br>';
	}
	else {
		echo "No workrooms reserved.";
	}
	?>
	
	<?php
	if (! empty ( $_POST ['rmRoom'] )) {
		if ($_POST ['removeRoom']) {
			$room = $_POST ['removeRoom'];
			$strSQL = "DELETE FROM memberbooksworkroom
			WHERE memberID = $memberID AND roomNumber = $room";
			$query = mysqli_query ( $con, $strSQL );
			if (! $query) {
				echo mysqli_error ( $con );
			}
			echo "Successfully deleted reservation.";
		}
		else {
			echo "No reservation selected.";
		}
	}
	?>
			</form>
				<h3>Your Books</h3>
	<?php
	$strSQL = "SELECT * 
	FROM book INNER JOIN memberborrowsbook 
	WHERE book.isbn = memberborrowsbook.isbn 
		AND memberborrowsbook.memberid = $memberID
		ORDER BY book.title";
	$query = mysqli_query ( $con, $strSQL );
	if (! $query) {
		echo "your book error " . mysqli_error ( $con );
		exit ();
	}
	echo "<table style=\"width:100 %\">";
	echo "<tr><th>Title</th><th>Author</th><th>Publisher</th><th>Due Date</th></tr>";
	while ( $result = mysqli_fetch_array ( $query ) ) {
		echo '<tr>';
		echo '<td>' . $result ['title'] . '</td>';
		echo '<td>' . $result ['author'] . '</td>';
		echo '<td>' . $result ['publisher'] . '</td>';
		echo '<td>' . $result ['dueDate'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>
	</td>
		
		
		<tr>
	
	</table>
	<h3>Available Workrooms</h3>
	<form action="" method="post">
		<input type="hidden" name="username" value="<?php echo $_POST['username']?>">
		<input type="hidden" name="password" value="<?php echo $_POST['password']?>">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() { $( "#datepicker" ).datepicker(); });
		</script>
		<p>Select Booking Date: <input type="text" name="datepicker" id="datepicker" readonly="readonly" value="<?php echo $_POST[datepicker] ?>"></p>
		<input type="submit" name="selectdate" value="View Available Workrooms" /><br><br>
	
	<?php
	if (! empty ( $_POST ['selectdate'] )) {
		$strSQL = "";
		if ($_POST ['datepicker'] == '') {
			echo "Select a date.";
		}
		else {
			$date = $_POST ['datepicker'];
			$strSQL = "SELECT * FROM memberbooksworkroom WHERE date = '$date'";
			$query = mysqli_query ( $con, $strSQL );
			
			$rooms = array(1, 1, 1, 1, 1);
			$avail = False;
			
			while ( $result = mysqli_fetch_array ( $query ) ) {
				$rooms[$result ['roomNumber'] - 1] = 0;
			}
			
			for ($i = 0; $i < count($rooms); $i++) {
				if ($rooms[$i] == 1) {
					$avail = True;
					echo '<input type="radio" name="workroom" value="' . ($i + 1) . '"> Room ' . ($i + 1) . '<br>';
				}
			}
			
			if ($avail == False) {
				echo 'No available workrooms for ' . $date;
			}
			else {
				echo '<br><input type="submit" name="book" value="Book Workroom" />';
			}
		}
	}
	?>
	
		
	<?php
	if (! empty ( $_POST ['book'] )) {
		$strSQL = "";
		if ($_POST ['workroom']) {
			$room = $_POST ['workroom'];
			$date = $_POST ['datepicker'];
			$strSQL = "INSERT INTO memberbooksworkroom (memberID, roomNumber, date) VALUES ('$memberID', '$room', '$date')";
			$result = mysqli_query ( $con, $strSQL );
			if (! $result) {
				echo 'workroom entry failed' . $room . $date . mysqli_error ( $con );
			} else {
				echo 'Success, Room ' . $room . ' has been booked for you on ' . $date;
			}
		}
		else {
			echo "No workroom selected.";
		}
	}
	?>
	</form>
	
	<h3>Available Books</h3>
	<form action="" method="post">
		Search: <input type="text" name="name" />
			By: <input type="radio" name="search" value="title" checked="checked"> Title
				<input type="radio" name="search" value="author"> Author
				<input type="hidden" name="username" value="<?php echo $_POST['username']?>">
				<input type="hidden" name="password" value="<?php echo $_POST['password']?>">
				<input type="submit" name="submit" value="Go" /><br> <br>
	</form>

  <?php
		if (! empty ( $_POST ['submit'] )) {
			$strSQL = "";
			if ($_POST ['name'] == '') {
				$strSQL = "SELECT * FROM book WHERE available = 1 ORDER BY title";
			} else if ($_POST ['search'] == 'title') {
				$title = $_POST ['name'];
				$strSQL = "SELECT * FROM book WHERE available = 1 AND
				title LIKE '%$title%'";
			} else {
				$author = $_POST ['name'];
				$strSQL = "SELECT * FROM book WHERE available = 1 AND
				author LIKE '%$author%'";
			}
			$query = mysqli_query ( $con, $strSQL );
			
				echo "<table style=\"width:100 %\">";
				echo "<tr><th>Title</th><th>Author</th><th>Publisher</th><th>ISBN</th></tr>";
				while ( $result = mysqli_fetch_array ( $query ) ) {
					echo '<tr>';
					echo '<td>' . $result ['title'] . '</td>';
					echo '<td>' . $result ['author'] . '</td>';
					echo '<td>' . $result ['publisher'] . '</td>';
					echo '<td>' . $result ['isbn'] . '</td>';
					echo '</tr>';
				}
				echo '</table>';
		}
		?>
		
			<a href="/index.php">Back to Main Page</a>

</body>
</html>