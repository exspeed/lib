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
    <a href="employee.php" >employees</a>

  </body>

</html>
