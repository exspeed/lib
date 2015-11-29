<?php
       
   $user = 'root';
   $password = 'root';
   $db = 'library';
   $host = 'localhost';
   $port = 8889;

   $con = mysqli_connect($host, $user,$password, $db) or die("some error");
   
?>

<!DOCTYPE html> <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <title>Library</title>
    <script>
      function register(){
      location.href = "register.php";
      }
</script>

  </head> <body bgcolor ="#FFFFCC">
    
    <h1>Library Data Base</h1>
      <div align="center">
    <h3> Sign in </h3>
    <?php
    if(isset($_GET['incorrect'])){
       $val = $_GET['incorrect'];
       if($val == True){
       echo "Incorrect Username/Password" . '<br>';
       }
       }
       ?>

	<form action="login.php" method="post">
	  Username: <input type="text" name="username"/><br>
	  Password: <input type="text" name="password"/><br>
	  
	  <input type="submit" value="Submit"/>
	<input type="button" value="Register" onclick="register()">
	</form>


   
      </div>
     <h3> add books</h3>
	<form action="" method="post">
	  isbn: <input type="text" name="isbn"/><br>
	  title: <input type="text" name="title"/><br>
	  author: <input type="text" name="author"/><br>
	  publisher: <input type="text" name="publisher"/><br>
	  
	  <input type="submit" value="add"/>
	</form>

  
    <?php
       
       // query
       $strSQL = "SELECT * FROM author";
       $query = mysqli_query($con, $strSQL);

       while($result = mysqli_fetch_array($query)){
       echo $result['name'] . '<br>';
       }

       mysqli_close($con);
       ?>

 </body>

</html>
