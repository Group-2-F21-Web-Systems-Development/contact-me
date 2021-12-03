<?php

  session_start();
  if (isset($_SESSION['username'])) {

    // connect to databse
    $dbusername= "root";
    $dbpassword = "group2websys";

    $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$conn) {
      echo "Connection failed!";
    }
    
    // query string:
    // remove-user.php?group=$groupid
    $groupid = $_GET['group'];
    $userid = $_SESSION['id'];
    echo "groupid: $groupid userid: $userid";
    
    $stmt= "DELETE FROM pairing
            WHERE groupid = :g AND userid = :u";
    $pstmt = $conn->prepare($stmt);
    $pstmt->execute(array(':g' => $groupid, ':u' => $userid));
    if ($pstmt) {
      // successful deletion
      header("Location: groups.php");
      exit();
    } else {
      // something went wrong
      echo("something went wrong, you were not removed from the group");
    }
  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>