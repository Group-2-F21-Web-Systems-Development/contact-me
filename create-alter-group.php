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
  <title>Create/Edit Groups</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/create-alter-groups.css">
  <script defer src="./src/ajax/ajax.js"></script>
  <script defer src="./create-alter-groups.js"></script>
</head>
<?php 
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

  

  if (isset($_GET['group'])){
    // user is accessing a group that already exists (editing)
    $title = $_GET['group'];

    $stmt= "SELECT * FROM groups WHERE title = :title";
    $group = $conn->prepare($stmt);

    $group->execute(array(':title' => $title));

    if ($group->rowCount() === 0) {
      echo 'This group does not exist';
      exit();
    }

    $group = $group->fetch();
    $groupCreator = $group['created_by'];
    $description = $group['description'];
    $photoLocation = $group['photo_location'];
    $groupPassword = $group['group_password'];
    $groupid = $group['groupid'];
    $whitelist = $group['whitelist'];

    if ($groupCreator != $_SESSION['id']) {
      // this user did not create the group
      header("Location: groups.php");
      exit();
    }
?>
<!-- only displays if editing group -->
<body>
  <section id="edit-form">
    <h1><span>Edit Group:</span> <?php echo($title); ?></h1>
    <?php 
        // show group password
        echo("<p id='group-password'><span>group password</span>: $groupPassword</p>");
        // show delete group button
        echo("<form id='delete-form' method='post' action='delete-group.php?group=$groupid'><button id='delete-btn'>Delete $title</button></form>");
    ?>
    <form id="group-form" method="post" action="update-group.php?group=<?php echo($title); ?>" enctype="multipart/form-data" >
    <?php if (isset($_GET['error'])) { echo "<p id='error'>" . $_GET['error'] . "</p>"; } ?>
      <label for="title">Title</label>
      <input id="title" name="title" type="text" value="<?php echo($title); ?>">
      <label for="description">Description</label>
      <textarea id="description" name="description" cols="30" rows="10"><?php echo($description); ?></textarea>
      <div id="platform-container">
        <label for="platform">Enter platforms you want users to see in the group</label>
        <button id="new-media" type="button">+</button>
        <button id="del-media" type="button">-</button>
        <?php
          // display all whitelisted platforms
          $whitelist = json_decode($whitelist, true);
          foreach ($whitelist as $platform) {
            echo ("<input type='text' class='platform' size='40' value='$platform' name='platform[]' placeholder='platform'/>");
          }
        ?>
      </div>
      <div id="img-content">
        <label for="img">Image</label>
        <input type="file" id="img" name="img" src="./src/img/activities_fair.jpg" accept="image/*">
        <p id="current-photo-p">current photo:</p>
        <img id='current-photo' src="<?php echo($photoLocation); ?>" alt="image of <?php echo($title); ?>">
      </div>
      <button id= "save">Save</button>
    </form>
  </section>
</body>
</html>
<?php
  }
  if (isset($_GET['new']) && $_GET['new']==='true')  {
    // user is creating a new group
?>
<!-- only displays if user is creating new group -->
<body>
  <section id="edit-form">
    <h1>Create <span>New</span> Group</h1>
    <form id="group-form" method="post" action="update-group.php?new=true" enctype="multipart/form-data">
      <?php if (isset($_GET['error'])) { echo "<p id='error-new'>" . $_GET['error'] . "</p>"; } ?>
      <label for="title">Title</label>
      <input id="title" name="title" type="text" value="">
      <label for="description">Description</label>
      <textarea id="description" name="description" cols="30" rows="10"></textarea>
      <div id="platform-container">
        <label for="platform">Enter platforms you want users to see in the group</label>
        <button id="new-media" type="button">+</button>
        <button id="del-media" type="button">-</button>
        <input type='text' class="platform" size='40' value='' name='platform[]' placeholder='platform'/>
      </div>
      <div id="img-content">
        <label for="img">Image</label>
        <input type="file" id="img" name="img" src="./src/img/activities_fair.jpg" accept="image/*">
        <p id="current-photo-p">current photo:</p>
        <img id='current-photo' src="./uploads/48724i2bsakfnsaoidjfoqijwr82104182jdsaf;oj31u4.jpeg" alt="default group image">
      </div>
      <button id= "save">Save</button>
    </form>
  </section>
</body>
</html>
<?php
  }
?>


<?php
  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>