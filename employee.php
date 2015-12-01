<?php
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect ( $host, 'root', 'root', $db ) or die ( "some error" );
?>

<!DOCTYPE html>
<html>
<head>
<style>
.error {
	color: #FF0000
}
</style>
<title>Employee</title>
</head>
<body>

	<h1>Employee</h1>
	<h3>Add Books</h3>
	<form name="addbooks"
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
		method="post">
		title: <input type="text" name="title" /> <span class="error"> <?php $titleErr = ""; echo $titleErr;?></span>
		<br> author:<select name="author"> <?php
		$strSQL = "SELECT name FROM author";
		$query = mysqli_query ( $con, $strSQL );
		while ( $result = mysqli_fetch_assoc ( $query ) ) {
			echo '<option value=' . '"' . $result ['name'] . '"' . '>' . $result ['name'] . '</option>';
		}
		?></select><br> publisher: <select name="publisher">
			<?php
			$strSQL = "SELECT name FROM publisher";
			$query = mysqli_query ( $con, $strSQL );
			while ( $result = mysqli_fetch_assoc ( $query ) ) {
				echo '<option value=' . '"' . $result ['name'] . '"' . '>' . $result ['name'] . '</option>';
			}
			?>
			</select> <input type="submit" name="addbook" value="add" />
	</form>
	<br>
</body>


<?php
$authorErr = $publisherErr = $checkoutErr = $returnErr= "";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	if (! empty ( $_POST ['addbook'] )) {
		$title = $_POST ['title'];
		if ($title == "") {
			echo 'title can\'t be null';
		} else {
			$author = $_POST ['author'];
			$publisher = $_POST ['publisher'];
			$strSQL = "INSERT INTO book (title, author, publisher) VALUES ('$title', '$author', '$publisher')";
			$result = mysqli_query ( $con, $strSQL );
			if (! $result) {
				echo 'book entry failed';
			} else {
				echo 'new book added';
			}
		}
	}
	
	if (! empty ( $_POST ['addauthor'] )) {
		$author = $_POST ['name'];
		if ($authorErr == '') {
			$authorErr = "field can't be empty";
		} else {
			$strSQL = "INSERT INTO author (name) VALUES ('$author')";
			$result = mysqli_query ( $con, $strSQL );
			if (! $result) {
				$authorErr = "No duplicate entries";
			}
		}
	}
	if (! empty ( $_POST ['addpublisher'] )) {
		$publisher = $_POST ['name'];
		if ($publisher == '') {
			$publisherErr = "field can't be empty";
		} else {
			$strSQL = "INSERT INTO publisher (name) VALUES ('$publisher')";
			$result = mysqli_query ( $con, $strSQL );
			if (! $result) {
				$publisherErr = "No duplicate entries";
			}
		}
	}
	
	if (! empty ( $_POST ['checkout'] )) {
		
		$memberID = $_POST ['memberid'];
		$book_isbn = $_POST ['bookisbn'];
		if (! ($memberID == '' || $book_isbn == '')) {
			
			$strSQL = "SELECT available FROM book WHERE isbn = $book_isbn";
			$query = mysqli_query ( $con, $strSQL );
			if (! $query) {
				echo mysqli_error ( $con );
				exit ();
			}
			while ( $result = mysqli_fetch_array ( $query ) ) {
				if ($result ['available'] == 1) {
					$today = date ( "Y-m-d" );
					$date = date ( 'Y-m-d', strtotime ( $today . '+ 14 days' ) );
					$strSQL = "INSERT INTO memberborrowsbook (memberID, isbn, dueDate)
				VALUES ('$memberID', '$book_isbn', '$date')";
					
					$result = mysqli_query ( $con, $strSQL );
					
					$strSQL = "UPDATE book SET available ='0' WHERE isbn= $book_isbn";
					$result = mysqli_query ( $con, $strSQL );
				}
			}
		}else{
			$checkoutErr ='field can\'t be empty';
		}
	}
	
	if (! empty ( $_POST ['return'] )) {
		$memberID = $_POST ['memberid'];
		$book_isbn = $_POST ['bookisbn'];
		if (! ($memberID == '' || $book_isbn == '')) {
			
			$strSQL = "DELETE FROM memberborrowsbook WHERE 
		memberID = $memberID AND isbn = $book_isbn";
			$query = mysqli_query ( $con, $strSQL );
			if (! $query) {
				echo mysqli_error ( $con );
			}
			
			$strSQL = "UPDATE book SET available = '1' WHERE isbn = $book_isbn";
			$query = mysqli_query ( $con, $strSQL );
		}
		else{
			$returnErr = 'field can\'t be empty';
		}
	}
}
?>

<h3>Add Authors</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">
	Author: <input type="text" name="name" /> <input type="submit"
		name="addauthor" value="add" /> <br> <?php echo $authorErr; ?>
</form>
<h3>Add Publisher</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">
	Publisher: <input type="text" name="name" /> <input type="submit"
		name="addpublisher" value="add" /> <br> <?php echo $publisherErr; ?>	
</form>
<h3>Member Checks Out Book</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">
	MemberID: <input type="text" name="memberid" /><br> Book ISBN: <input
		type="text" name="bookisbn" /> <br> <input type="submit"
		name="checkout" value="checkout" /> <br> <?php echo $checkoutErr; ?>	
</form>

<h3>Member Returns Book</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">
	MemberID: <input type="text" name="memberid" /><br> Book ISBN: <input
		type="text" name="bookisbn" /> <br> <input type="submit" name="return"
		value="return" /> <br> <?php echo $returnErr; ?>	
</form>
</html>