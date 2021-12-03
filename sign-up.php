<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Signup Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/login.css">
  <link rel="stylesheet" href="./src/styles/style.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
   <div id="bodyBlock">
      <h1>Sign up</h1>
      <form id="addForm" name="addForm" action="sign-up.php" method="post">
        <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
                         <!-- labels of the fields -->
                         <!-- when you click on the label you can type in the field -->
            <label for="first-name">First Name:</label>
            <div class="value"><input name="first-name" id="first-name" type="text"></div>
            <label for="last-name">Last Name:</label>
            <div class="value"><input name="last-name" id="last-name" type="text"></div>
            <label for="email">Email:</label>
            <div class="value"><input name="email" id="email" type="text"></div>
            <label for="username">Username:</label>
            <div class="value"><input name="username" id="username" type="text"></div>
            <label for="password">Password:</label>
            <div class="value"><input name="password" id="password" type="password"></div>
            <label for="confirm">Confirm Password:</label>
            <div class="value"><input name="confirm" id="confirm" type="password"></div>
          </div>
          <button type="submit">Sign Up</button>
        </fieldset>
      </form>
   </div>
</body>
</html>

<?php 
session_start(); 

$dbusername= "root";
$dbpassword = "group2websys";

$conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
if (!$conn) {
    echo "Connection failed!";
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['confirm'])) {
    function validate($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);
    $fname = validate($_POST['first-name']);
    $lname = validate($_POST['last-name']);
    $confirm = validate($_POST['confirm']);
    echo $uname . ' ' . $pass . ' ' . $email . ' ';


    if (empty($uname)) {
        header("Location: sign-up.php?error=Username is required");
        exit();
    } else if(empty($email)) {
        header("Location: sign-up.php?error=email is required");
        exit();
    } else if(empty($pass)) {
        header("Location: sign-up.php?error=Password is required");
        exit();
    } else if(empty($fname)) {
        header("Location: sign-up.php?error=First Name is required");
        exit();
    } else if(empty($lname)) {
        header("Location: sign-up.php?error=Last Name is required");
        exit();
    } else if($pass != $confirm){
        header("Location: sign-up.php?error=Passwords don't match");
        exit();
    } else {
      $sql = "select * from users where username=:uname";
      $result = $conn->prepare($sql);
      $result->execute(array(':uname'=> $uname));
      $count = $result->rowCount();

      if ($count === 1) {
            header("Location: sign-up.php?error=username already exists");
            exit();
      }else{
        $sql = "insert into users(username, pass, email, fname, lname) VALUES(:uname, :pass, :email, :fname, :lname)";
        $result = $conn->prepare($sql);
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        echo 'user created!';
        $result->execute(array(':uname'=> $uname, ':pass' => $pass, ':email' => $email, ':fname' => $fname, ':lname' => $lname));
        header("Location: login.php");
        exit();
      }
    }
}
?>
