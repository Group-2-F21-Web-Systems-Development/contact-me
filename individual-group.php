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
  <?php
    if (isset($_GET['group'])) {
      $title = $_GET['group'];
      echo("<title>$title</title>");
    } else {
      echo("<title>Group Page</title>");
    }
  ?>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/individual-group.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
  <?php
    // connect to databse
    $dbusername= "root";
    $dbpassword = "group2websys";
    
    $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$conn) {
      echo "Connection failed!";
    }

    // find group
    $stmt= "SELECT * 
            FROM groups
            WHERE title = :title";
    $group = $conn->prepare($stmt);
    $group->execute(array(':title' => $title));
    if ($group->rowCount() === 0) {
      // group not found
      // error with query string or user altered query string
      echo("$title does not exist as a group");
    } else {
      // check if user should have access to this group page
      $userid = $_SESSION['id'];
      $stmt= "SELECT *
              FROM pairing
              WHERE userid = :userID";
      $pstmt = $conn->prepare($stmt);
      $pstmt->execute(array(':userID' => $userid));
      if ($pstmt->rowCount() === 0) {
        // group exists, but user is not in the group
        echo("You do not have access to this group");
      } else {

      // display all group information
      $group = $group->fetch();
      $description = $group['description'];
      $photoLocation = $group['photo_location'];
      $description = $group['description'];
      $groupid = $group['groupid'];
  ?>
  <section class="group-info">
    <div class="column">
      <img src="./<?php echo($photoLocation); ?>" alt="photo of <?php echo($title); ?>">
      <h1><?php echo($title); ?></h1>
    </div>
    <div class="column">
      <h2>Description</h2>
      <p class="description"><?php echo($description); ?></p>
    </div>
  </section>
  <section class="attendies">
    <h2>Attendies</h2>
    <?php
      $stmt= "SELECT users.photo_location, users.fname, users.lname 
              FROM users
              INNER JOIN pairing ON pairing.userid = users.userid
              WHERE pairing.groupid = :groupID
              ORDER BY users.fname, users.lname";
      $users = $conn->prepare($stmt);
      $users->execute(array(':groupID' => $groupid));
      if ($users->rowCount() === 0) {
        echo("There are no users in this group yet!");
      } else {
        echo("<ul>");
        foreach ($users as $user) {
          $fname = $user['fname'];
          $lname = $user['lname'];
          $photoLocation = $user['photo_location'];

          echo("
                <li>
                  <img src='./$photoLocation' alt='photo of $fname $lname'>
                  <a href='./personalprofile.php?user=$fname $lname'>$fname $lname</a>
                </li>
              ");
        }
        echo("</ul>");
      }
    ?>
  </section>
</body>
</html>

<?php
      }
    }
  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>