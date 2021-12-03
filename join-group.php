<?php 
  session_start();
  if (isset($_SESSION['username'])) {


    if (isset($_POST['password']) && empty($_POST['password'])) {
      header("Location: ./join-group.php?error=Password not entered!");
      exit();
    }
    if (isset($_POST['password'])) {

    
      // connect to databse
      $dbusername= "root";
      $dbpassword = "group2websys";
      
      $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
      if (!$conn) {
          echo "Connection failed!";
      }

      // find group
      $stmt= "SELECT *
              FROM groups
              WHERE group_password = :pw";
      $group = $conn->prepare($stmt);
      $password = $_POST['password'];
      $group->execute(array(':pw' => $password));
      if ($group->rowCount() === 0) {
        header("Location: ./join-group.php?error=Password does not match a group");
        exit();
      }
      if ($group->rowCount() > 1) {
        // somehow more than one group with the same password
        header("Location: ./join-group.php?error=Something went wrong please try again");
        exit();
      }
      $group = $group->fetch();

      // check if user is already in the group
      $userID = $_SESSION['id'];
      $groupID = $group['groupid'];
      $stmt= "SELECT *
              FROM pairing
              WHERE userid = :u AND groupid = :g";
      $pstmt = $conn->prepare($stmt);
      $pstmt->execute(array(':u' => $userID, ':g' => $groupID));
      if ($pstmt->rowCount() > 0) {
        // user is in group
        header("Location: ./join-group.php?error=You are already a part of this group!");
        exit();
      }

      // add user to group
      $stmt= "INSERT INTO pairing (userid, groupid)
              VALUES (:u, :g)";
      $pstmt = $conn->prepare($stmt);
      $pstmt->execute(array(':u' => $userID, ':g' => $groupID));
      if ($pstmt) {
        // successful join group
        $title = $group['title'];
        header("Location: ./individual-group.php?group=$title");
        exit();
      } else {
        // unsuccessful join group
        header("Location: ./join-group.php?error=Something went wrong please try again");
        exit();
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join a Group</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <script defer src="./src/ajax/ajax.js"></script>
  <link rel="stylesheet" href="./src/styles/join-group.css">
</head>
<body>
  <section id="join-group">
  <?php
      if (isset($_GET['error'])) {
        echo "<p id='error'>". $_GET['error'] . "</p>";
      }
    ?>
    <h1>Join a Group</h1>
    <form action="join-group.php" method="post">
    <?php
      if (isset($_GET['error'])) {
        echo "<p id='error'>". $_GET['error'] . "</p>";
      }
    ?>
      <fieldset>
        <label for="password">Enter your given group password</label>
        <input type="text" name="password" id="password">
        <input id="save" type="submit" value="submit">
      </fieldset>
    </form>
  </section>
</body>
</html>

<?php
  } else {
    header("Location: login.php?error=You must be logged in to access the join groups page!");
    exit();
  }
?>