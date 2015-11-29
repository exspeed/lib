<!DOCTYPE html> <html>
  <head>
    <style>
      .error {color: #FF0000}
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <title>Library</title>
  </head> <body>
    <h1>New User Form</h1>
    <div align="left">
      <font color="red"> Requried * </font>
      <?php 

	 ?>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Username: <input type="text" name="user"/>
	<span class="error">*</span><br>

	Password:  <input type="text" name="pass"/>
	<span class="error">*</span><br><br>

	First Name: <input type="text" name="fname"/>
	<span class="error">*</span><br>

	Middle Name: <input type="text" name="mname"/><br>

	Last Name: <input type="text" name="lname"/>
	<span class="error">*</span><br>

	Email: <input type="text" name="email"/><br>

	Address: <input type="text" name="address"/>
	<span class="error">*</span><br>

	Street Number: <input type="text" name="strNum"/>
	<span class="error">*</span><br>

	Postal-Code: <input type="text" name="pcode"/>
	<span class="error">*</span><br>

	Gender:
	<input type="radio" name="gender" value="female" checked="checked"> Female
	<input type="radio" name="gender" value="male">Male*<br>
	<input type="submit" value="Submit"/>
      </form>

      <?php
	 $user = $pass = "";
	 $fname = $mname = $lname = $email = $address = $strNum = $pcode = $gender = "";
	 $nameErr = "";
	 
	 $db = 'library';
	 $host = 'localhost';
	 $port = 8889;
	 
	 $con = mysqli_connect($host,'root','root', $db) or die("some error");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // check for valid input
    if(checker()){
	//add user to the database
	 
	$query = "INSERT INTO member (username, password, fname, lname) VALUES ('$user', '$pass', '$fname', '$lname')";
	$result = mysqli_query($con, $query);

	if(!$result){
	    echo "fail to insert, make sure you have a unique username";
	}else{
	    echo "success you are a new user";
	}

	$strSQL = "SELECT memberID, username FROM member";
	$query = mysqli_query($con, $strSQL);
	if(!$query){
	    echo "syntax error";
	}

	$memberID = "";
	while($result = mysqli_fetch_array($query)){
	    if($result['username'] == $user){
		$memberID = $result['memberID'];
	    }
	}

	$strSQL = "INSERT INTO memberaddress(memberID, street, number, postalCode) VALUES ('$memberID', '$address', '$strNum', '$pcode')";
	$result = mysqli_query($con, $strSQL);
	if(!$result){
	    echo "new address entree failed". '<br>';
	}
	 
	exit();
    }
}

function checker(){
    global $user, $pass, $fname, $mname, $lname, $email, $address,$strNum, $pcode, $gender;
    $valid = True;
    $user = $_POST["user"];
    if($user == ""){
	$valid = False;
    }
    $pass = $_POST["pass"]; 
    if($pass == ""){
	echo "password can't be null" . '<br>';
	$valid = False;
    }      
    $fname = $_POST["fname"];
    if($fname == ""){
	echo "first name can't be null" . '<br>';
	$valid = False;
    }
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    if($lname == ""){
	echo "lastname can't be null" . '<br>';
	$valid = False;
    }
    $email = $_POST["email"];
    $address = $_POST["address"];
    if($address == ""){
	echo "address can't be null" . '<br>';
	$valid = False;
    }
    $strNum = $_POST["strNum"];
    if (!preg_match("/^[0-9]*$/",$strNum)){
	echo "street number must be an int" . '<br>';
	$valid = False;
    }
	 $strNum = (int) $strNum;
    $pcode = $_POST["pcode"];
    if($pcode == ""){
	echo "postal code can't be null" . '<br>';
	$valid = False;
    }
    $gender = $_POST["gender"];
    return $valid;
}
?>



  </body>

</html>