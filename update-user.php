<?php
session_start();
if (isset($_SESSION['username'])) {
  // connect to databse
  $dbusername= "root";
  $dbpassword = "group2websys";
  
  $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
  if (!$conn) {
      echo "Connection failed!";
  }

  function parseMedia($platforms, $handles) {
    // create an associative array for all social medias
    // convert to a string for SQL storage
    $arr = array();
    $i = 0;
    foreach ($platforms as $platform) {
      // only creat key values of non-empty values
      if (!(empty($platform) && empty($handles[$i]))) {
        $arr[$platform] = $handles[$i];
      }
      $i++;
    }
    $str = json_encode($arr);
    return $str;
  }

  // sanitize data and check for incomplete fields
  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $fname = validate($_POST['firstName']);
  $lname = validate($_POST['lastName']);
  $platforms = $_POST['platform'];
  $handles = $_POST['handle'];
  $i=0;
  foreach ($platforms as $platform) {
    $platforms[$i] = validate($platform);
    $i++;
  }
  $i=0;
  foreach ($handles as $handle) {
    $handles[$i] = validate($handle);
    $i++;
  }

  $i=0;
  foreach ($platforms as $platform) {
    // check if one field is filled in, but other isn't
    if (empty($platforms[$i]) xor empty($handles[$i])) {
      header("Location: profile.php?error=Social media fields incomplete");
      exit();
    }
    $i++;
  }
  
  if (empty($fname)) {
    header("Location: profile.php?error=First name is required");
    exit();
  }
  if (empty($lname)) {
    header("Location: profile.php?error=Last name is required");
    exit();
  }

  // no form errors!
  $links = parseMedia($platforms, $handles);
  $userID = $_SESSION['id'];

  // change user row
  $stmt= "UPDATE users
          SET fname = :fname, lname = :lname, links = :links
          WHERE userid = :userID";
  $stmt = $conn->prepare($stmt);
  $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':links' => $links, ':userID' => $userID));

  include 'uploader.php';
  // go to users personal page (for display)
  $userid = $_SESSION['id'];
  header("Location: personalprofile.php?user=$userid");
  exit();

} else {
  header("Location: login.php?error=You must be logged in to edit your profile!");
  exit();
}
?>
