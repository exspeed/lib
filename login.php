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
	}
}

if ($goback) {
	header ( 'Location: index.php?incorrect=True' );
}

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Account</h1>
	<h2>Welcome <?php echo "$fname  $lname" ?></h2>

	<h3>Your Address: <?php echo "$number $street $postalCode";?><br>
      You owe us: <?php echo $fines; ?> <br>
      Number of books borrowed: <?php echo $totalBorrowed; ?><br>
      MemberID is <?php echo $memberID?>
    </h3>



</body>
<style>
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}

th, td {
	padding: 5px;
}
</style>
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
<h3>Available Books</h3>
<form action="" method="post">
	Search: <input type="text" name="name" /> By: <input type="radio"
		name="search" value="title" checked="checked"> Title <input
		type="radio" name="search" value="author">Author <input type="hidden"
		name="username" value="<?php echo $_POST['username']?>"> <input
		type="hidden" name="password" value="<?php echo $_POST['password']?>">
	<input type="submit" name="submit" value="Go" /><br> <br>
</form>

  <?php
		if (! empty ( $_POST ['submit'] )) {
			$strSQL = "";
			if($_POST['name'] == ''){
				$strSQL = "SELECT * FROM book WHERE available = 1 ORDER BY title";}
			else if ($_POST['search'] == 'title') {
				$title = $_POST['name'];
				$strSQL = "SELECT * FROM book WHERE available = 1 AND
				title = '$title'";
			} else {
				$author = $_POST['name'];
				$strSQL = "SELECT * FROM book WHERE available = 1 AND
				author = '$author'";
			}
			$query = mysqli_query ( $con, $strSQL );
			echo "<table style=\"width:100 %\">";
			echo "<tr><th>Title</th><th>Author</th><th>Publisher</th></tr>";
			while ( $result = mysqli_fetch_array ( $query ) ) {
				echo '<tr>';
				echo '<td>' . $result ['title'] . '</td>';
				echo '<td>' . $result ['author'] . '</td>';
				echo '<td>' . $result ['publisher'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		?>
</html>
