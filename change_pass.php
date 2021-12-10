<?php
  session_start();
  if (isset($_SESSION['userid'])) {
      $userid = $_SESSION['userid'];
      $dbusername= "root";
      $dbpassword = "group2websys";
      
      $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
      if (!$conn) {
         echo "Connection failed!";
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/login.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
<div id="bodyBlock">   
   <form id="addForm" name="addForm" action="change_pass.php" method="post">
      <fieldset>
         <label for="pass">New Password:</label>
         <div class="value"><input name="pass" id="pass" type="password" maxlength="255"></div>
         <label for="confirm">Confirm Password:</label>
         <div class="value"><input name="confirm" id="confirm" type="password" maxlength="255"></div>
         <button type="submit">submit</button>
      </fieldset>
   </form>
</div>   
</body>
</html>

<?php
   if (isset($_POST['pass']) && isset($_POST['confirm'])) {
      function validate($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
      }
  
      $pass = validate($_POST['pass']);
      $confirm = validate($_POST['confirm']);
      if (empty($pass)) {
         header("Location: change_pass.php?error=pass is required");
         exit();
      } else if($pass != $confirm){
         header("Location: change_pass.php?error=Passwords don't match");
         exit();
     } else{
         $stmt= "UPDATE users
                 SET pass = :pass
                 WHERE userid = :usid";
         $pass = password_hash($pass, PASSWORD_BCRYPT);
         $stmt = $conn->prepare($stmt);
         echo $uname;
         $stmt->execute(array(':pass'=> $pass, ':usid' => $userid));
         session_unset();
         session_destroy();
         setcookie(session_name(), "", time() - 3600);
         header("Location: login.php");
      }
   }
  }
?>