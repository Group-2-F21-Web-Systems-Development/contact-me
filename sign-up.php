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
   <?php
      if (isset($_GET['error'])) {
        echo "<p id='error'>". $_GET['error'] . "</p>";
      }
    ?>
      <h1>Sign up</h1>
      <form id="addForm" name="addForm" action="sign-up.php" method="post">
        <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
                         <!-- labels of the fields -->
                         <!-- when you click on the label you can type in the field -->
            <label for="first-name">First Name:</label>
            <div class="value"><input name="first-name" id="first-name" type="text" maxlength="100"></div>
            <label for="last-name">Last Name:</label>
            <div class="value"><input name="last-name" id="last-name" type="text" maxlength="255"></div>
            <label for="email">Email:</label>
            <div class="value"><input name="email" id="email" type="text" maxlength="320"></div>
            <label for="username">Username:</label>
            <div class="value"><input name="username" id="username" type="text" maxlength="255"></div>
            <label for="password">Password:</label>
            <div class="value"><input name="password" id="password" type="password" maxlength="255"></div>
            <label for="confirm">Confirm Password:</label>
            <div class="value"><input name="confirm" id="confirm" type="password" maxlength="255"></div>
            <label for="sec">Security Question:</label>
            <select name="security" id="security">
               <option value="1">What's your favorite movie?</option>
               <option value="2">What is the name of your best friend in grade school?</option>
               <option value="3">What is your mother's maiden name?</option>
               <option value="4">What sport did you play growing up?</option>
            </select>
            <input name="answer" id="answer" type="text" maxlength="255">
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
    $question = validate($_POST["security"]);
    $sec = validate($_POST['answer']);
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
    } else if(empty($question) || empty($sec)) {
         header("Location: sign-up.php?error=need to select a security question and answer");
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
        $sql = "insert into users(username, pass, email, fname, lname, sec_question, sec_answer) VALUES(:uname, :pass, :email, :fname, :lname, :sec_question, :sec_answer)";
        $result = $conn->prepare($sql);
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        $sec = strtolower($sec);
        $sec = password_hash($sec, PASSWORD_BCRYPT);
        echo 'user created!';
        $result->execute(array(':uname'=> $uname, ':pass' => $pass, ':email' => $email, ':fname' => $fname, ':lname' => $lname, ':sec_question' => $question, ':sec_answer' => $sec));
        header("Location: login.php");
        exit();
      }
    }
}
?>