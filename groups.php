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
      // connect to database here
      $conn;
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
        // MAY NOT BE creted_by AS COLUMN NAME
        // OR groupid FOR ORDER BY
        $stmt = "SELECT * 
                 FROM groups 
                 WHERE created_by = ':uid'
                 ORDER BY groupid DESC";
        $userid = $_SESSION['id'];
        $result->execute(array(':uid' => $userid));
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
      // DEFINITELY TEST THIS QUERY
      $stmt = "SELECT groups.title, groups.attendies, groups.photo_location
               FROM groups
               INNER JOIN pairing ON pairing.groupid = groups.groupid
               WHERE pairing.userid = ':uid'
               ORDER BY groups.groupid DESC";
      $userid = $_SESSION['id'];
      $result->execute(array(':uid' => $userid));
      if ($result->rowCount() > 0) {
        echo("<ul>");
        $results = $result->fetchAll();
        foreach ($results as $group) {
          $source = $group['photo_location'];
          $title = $group['title'];
          $attendies = $group['attendies'];
          echo("
              <li class='group'>
                <img src='./$source' alt='photo of $title'>
                <a href='./individual-group.php?group=$title'>$title</a>
                <p class='people'>$attendies people</p>
              </li>
          ");
        }
        echo("</ul>");
      } else {
        echo("<h2>You should try joining a group!</h2>");
      }
      
    ?>
    <div class= "create-groups-btn closed">
      <h2>Create</h2>
      <ul>
        <li id="new-group"><a href="./create-alter-group.php">+ group</a></li>
        <li><a href="./create-alter-group.php">Monkey Appreciation Club Interest Meeting</a></li>
        <li><a href="./create-alter-group.php">RPI Activities Fair</a></li>
      </ul>
    </div>
    <ul>
      <li class="group">
        <img src="./src/img/activities_fair.jpg" alt="photo of RPI Activities Fair">
        <a href="./individual-group.php">RPI Activities Fair</a>
        <p class="people">300 people</p>
      </li>
      <li class="group">
        <img src="./src/img/tree.jpg" alt="photo of Enviornmental Society Meet-up">
        <a href="./individual-group.php">Enviornmental Society Meet-up</a>
        <p class="people">95 people</p>
      </li>
      <li class="group">
        <img src="./src/img/golf.jpg" alt="photo of Geiss Country Club Networking Event">
        <a href="./individual-group.php">Geiss Country Club Networking Event</a>
        <p class="people">2,000 people</p>
      </li>
      <li class="group">
        <img src="./src/img/monkey.jpg" alt="photo of Monkey Appreciation Club Interest Meeting">
        <a href="./individual-group.php">Monkey Appreciation Club Interest Meeting</a>
        <p class="people">22 people</p>
      </li>
      <li class="group">
        <img src="./src/img/activities_fair.jpg" alt="photo of RPI Activities Fair">
        <a href="./individual-group.php">RPI Activities Fair</a>
        <p class="people">300 people</p>
      </li>
      <li class="group">
        <img src="./src/img/tree.jpg" alt="photo of Enviornmental Society Meet-up">
        <a href="./individual-group.php">Enviornmental Society Meet-up</a>
        <p class="people">95 people</p>
      </li>
      <li class="group">
        <img src="./src/img/golf.jpg" alt="photo of Geiss Country Club Networking Event">
        <a href="./individual-group.php">Geiss Country Club Networking Event</a>
        <p class="people">2,000 people</p>
      </li>
      <li class="group">
        <img src="./src/img/monkey.jpg" alt="photo of Monkey Appreciation Club Interest Meeting">
        <a href="./individual-group.php">Monkey Appreciation Club Interest Meeting</a>
        <p class="people">22 people</p>
      </li>
      <li class="group">
        <img src="./src/img/activities_fair.jpg" alt="photo of RPI Activities Fair">
        <a href="./individual-group.php">RPI Activities Fair</a>
        <p class="people">300 people</p>
      </li>
      <li class="group">
        <img src="./src/img/tree.jpg" alt="photo of Enviornmental Society Meet-up">
        <a href="./individual-group.php">Enviornmental Society Meet-up</a>
        <p class="people">95 people</p>
      </li>
      <li class="group">
        <img src="./src/img/golf.jpg" alt="photo of Geiss Country Club Networking Event">
        <a href="./individual-group.php">Geiss Country Club Networking Event</a>
        <p class="people">2,000 people</p>
      </li>
      <li class="group">
        <img src="./src/img/monkey.jpg" alt="photo of Monkey Appreciation Club Interest Meeting">
        <a href="./individual-group.php">Monkey Appreciation Club Interest Meeting</a>
        <p class="people">22 people</p>
      </li>
    </ul>
  </section>
</body>
</html>

<?php
  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>