<?php
  // delete-group.php?group=$groupid
  session_start();
  if (isset($_SESSION['username'])) {
    // session exists
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] === 0 ) {
      // not an admin user
      header("Location: groups.php");
      exit();
    }
    // connect to databse
    $dbusername= "root";
    $dbpassword = "group2websys";

    $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    if (!$conn) {
      echo "Connection failed!";
    }
    $groupid;
    if (isset($_GET['group'])) {
      $groupid = $_GET['group'];
    }

    // delete all rows in pairing referencing group
    $stmt = "DELETE FROM pairing WHERE groupid = :gid";
    $pstmt = $conn->prepare($stmt);
    $pstmt->execute(array(':gid' => $groupid));
    if ($pstmt) {
      // successful deletion
      
      // delete group in groups table
      $stmt = "DELETE FROM groups WHERE groupid = :gid";
      $pstmt = $conn->prepare($stmt);
      $pstmt->execute(array(':gid' => $groupid));
      if ($pstmt) {
        // all users were removed from group and group was deleted
        header("Location: groups.php");
        exit();
      } else {
        // something went wrong
        echo("something went wrong, the group was not deleted");
      }
    } else {
      // something went wrong
      echo("something went wrong, users were not able to be removed from the group");
    }

  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>