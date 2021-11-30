<?php 
  session_start();
  if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Groups Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/groups.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
  <section class="groups">
    <h1>View Your Groups</h1>
    <?php
      // connect to databse
      $dbusername= "root";
      $dbpassword = "group2websys";
      
      $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
      if (!$conn) {
          echo "Connection failed!";
      }
      
      $stmt = "SELECT * FROM users WHERE username = ':u'";
      $user = $conn->prepare($stmt);
      $username = $_SESSION['username'];
      $user->execute(array(':u' => $username));
      $user->fetchAll();
      // display create/alter group button (only for admin accounts)
      if ($_SESSION['is_admin']) {
        echo('<div class= "create-groups-btn closed">
                <h2>Create</h2>
                <ul>
                  <li id="new-group"><a href="./create-alter-group.php?new=true">+ group</a></li>');
        $stmt = "SELECT * 
                 FROM groups 
                 WHERE created_by = :userid
                 ORDER BY groupid DESC";
        $userid = $_SESSION['id'];
        $result = $conn->prepare($stmt);
        $result->execute(array(':userid' => $userid));
        if ($result->rowCount() > 0) {
          $results = $result->fetchAll();
          foreach ($results as $group) {
            $title = $group['title'];
            echo("<li><a href='./create-alter-group.php?group=$title'>$title</a></li>");
          }
        }
        echo ('</ul> </div>');
      }
      // display user's groups
      $stmt = "SELECT groups.title, groups.photo_location, groups.groupid
                FROM groups
                INNER JOIN pairing ON pairing.groupid = groups.groupid
                WHERE pairing.userid = :userID
                ORDER BY groups.groupid DESC";

      $userid = $_SESSION['id'];
      $result = $conn->prepare($stmt);
      $result->execute(array(':userID' => $userid));
      // $result = $conn->query($stmt);
      if ($result->rowCount() > 0) {
        echo("<ul>");
        $results = $result->fetchAll();
        foreach ($results as $group) {
          $source = $group['photo_location'];
          $title = $group['title'];
          $groupID = $group['groupid'];
          
          $stmt= "SELECT count(userid) as attendies
                  FROM pairing
                  WHERE groupid = :grID";
          $pstmt = $conn->prepare($stmt);
          $pstmt->execute(array(':grID' => $groupID));
          $result = $pstmt->fetchAll();
          $attendies = $result[0]['attendies'];
          if ($attendies == 1) {
            $attendies = "1 person";
          } else {
            $attendies = $attendies . " people";
          }
          echo("
              <li class='group'>
                <img src='./$source' alt='photo of $title'>
                <a href='./individual-group.php?group=$title'>$title</a>
                <p class='people'>$attendies</p>
              </li>
          ");
        }
        echo("</ul>");
      } else {
        echo("<h2>You should try joining a group!</h2>");
      }
      
    ?>
  </section>
</body>
</html>

<?php
  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>