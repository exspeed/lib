<?php
   $user = 'root';
   $password = 'root';
   $db = 'library';
   $host = 'localhost';
   $port = 8889;

   $con = mysqli_connect($host, $user,$password, $db) or die("some error");
   $strSQL = "SELECT * FROM member INNER JOIN  memberaddress ON memberaddress.memberID = member.memberID";

   // checks if username and password is in the db
   $goback = True;   
  $memberID = $street = $number = $postalCode = "";
   $fname= $lname=$fines= $totalBorrowed = "";

   $query = mysqli_query($con,$strSQL);
/*   if(!$query){
   echo mysqli_error($con);
   exit();
   }

   good debugging code :D
*/
   while($result = mysqli_fetch_array($query)){
   if($result['username'] == $_POST["username"] && $result['password'] == $_POST["password"]){
   $goback = False;
   $memberID = $result['memberID'];
   $street =  $result['street'];
   $number =  $result['number'];
   $postalCode =  $result['postalCode'];
   $fname =  $result['fname'];
   $lname =  $result['lname'];
   $fines =  $result['fines'];
   $totalBorrowed =  $result['totalBorrowed'];

   }
   }

   if($goback){
   header('Location: index.php?incorrect=True');
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
</html>
