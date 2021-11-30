<?php 
session_start(); 

$dbusername= "root";
$dbpassword = "group2websys";

$conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
if (!$conn) {
    echo "Connection failed!";
}

if (isset($_POST['username']) && isset($_POST['pass'])) {
    function validate($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['pass']);

    if (empty($uname)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } else if(empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "select * from users where username=:uname";
        $result = $conn->prepare($sql);
        $result->execute(array(':uname'=> $uname));
        $count = $result->rowCount();

        if ($count === 1) {
            $results = $result->fetchAll();
            foreach($results as $row){
               if(password_verify($pass, $row['pass'])) {
                  echo "Logged in!";
                  $_SESSION['username'] = $row['username'];
                  $_SESSION['fname'] = $row['fname'];
                  $_SESSION['lname'] = $row['lname'];
                  $_SESSION['fname'] = $row['fname'];
                  $_SESSION['email'] = $row['email'];
                  $_SESSION['links'] = $row['links'];
                  $_SESSION['is_admin'] = $row['is_admin'];
                  $_SESSION['photo_location'] = $row['photo_location'];
                  $_SESSION['id'] = $row['userid'];
                  header("Location: personalprofile.php");
                  exit();
               } else {
                  header("Location: login.php?error=Incorect credentials");
                  exit();
               }
            }
        } else {
            header("Location: login.php?error=Incorect credentials");
            exit();
    }
  }
} else {
  header("Location: index.php");
  exit();
}
?>