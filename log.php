<?php 
$db = 'library';
$host = 'localhost';
$port = 8889;

$con = mysqli_connect ( $host, 'root', 'root', $db ) or die ( "some error" );

	$strSQL = "SELECT * FROM record ORDER BY date";
	$query1 = mysqli_query ( $con, $strSQL );
	
	echo "<table style=\"width:100% \" border=\"1\">";
	echo "<tr><th>Date</th><th>Type</th><th>MemberID</th><th>ISBN</th></tr>";
	while ( $result = mysqli_fetch_array ( $query1 ) ) {
		echo '<tr>';
		echo '<td>' . $result ['date'] . '</td>';
		echo '<td>' . $result ['type'] . '</td>';
		echo '<td>' . $result ['memberID'] . '</td>';
		echo '<td>' . $result ['isbn'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
?>

<a href="index.php">Back to Main Page</a>