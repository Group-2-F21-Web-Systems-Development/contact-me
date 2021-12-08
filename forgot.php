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
   <form id="addForm" name="addForm" action="forgot.php" method="post">
      <label for="username">username:</label>
      <div class="value"><input type="text" size="60" value="" name="username" id="username"/></div>
      <button type="submit">submit</button>
   </form>
</body>
</html>

<?php
      session_start()
      $dbusername= "root";
      $dbpassword = "group2websys";
      
      $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
      if (!$conn) {
         echo "Connection failed!";
      }
      if (isset($_POST['username']){
         function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
   
         $uname = validate($_POST['username']);
         $ques = "select sec_question from users where username= :username";
         $result = $conn->query($ques);
         $result->execute(array(':username' => $uname));
         $sec = $result->fetchAll();
         foreach $row in $sec:
            $_SESSION['username'] = $uname;
            header("sec.php?question=$sec");


      }
  }

?>
