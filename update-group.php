<?php 

  function generateRandomString($length = 10) {
    // https://stackoverflow.com/questions/4356289/php-random-string-generator
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }


  session_start();
  if (isset($_SESSION['username'])) {
    $title = validate($_POST['title']);
    $description = validate($_POST['description']);
    $OGtitle = $_GET['group'];
    if (empty($title)) {
      // user hasn't entered a title
      if (isset($_GET['group'])) {
        // user is editing group
        header("Location: create-alter-group.php?group=$OGtitle&error=You must enter a title!");
        exit();
      }
      if (isset($_GET['new']) && $_GET['new'] = 'true') {
        // user is creating group
        header("Location: create-alter-group.php?new=true&error=You must enter a title!");
        exit();
      }
    }    

    // connect to databse
    $dbusername= "root";
    $dbpassword = "group2websys";

    $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    if (!$conn) {
      echo "Connection failed!";
    }

    $stmt= "SELECT *
            FROM groups
            WHERE title = :title";
    $stmt = $conn->prepare($stmt);
    $stmt->execute(array(':title' => $title));
    if ($stmt->rowCount() > 0 && $title != $OGtitle) {
      if (isset($_GET['group'])) {
        header("Location: create-alter-group.php?group=$OGtitle&error=Group title already exists!");
        exit();
      }
      if (isset($_GET['new']) && $_GET['new'] = 'true') {
        header("Location: create-alter-group.php?new=true&error=Group title already exists!");
        exit();
      }
    }

    if (isset($_GET['group'])) {
      // editing existing group

      // PHP UPLOADER
      // $image = $_POST['img'];

      // ASSUMING THAT $image_location will be given by you :)
      $image_location = "";

      if ($_FILES['img']['size'] == 0 && $_FILES['img']['error'] == 0) { // check if image file exists
        // no image file
        // Don't update photo_location
        $stmt= "UPDATE groups
              SET title = :title, `description` = :descr
              WHERE title = :OGtitle";
        $stmt = $conn->prepare($stmt);
        $stmt->execute(array(':title' => $title, ':descr' => $description, ':OGtitle' => $OGtitle));

        // assuming it worked
        header("Location: individual-group.php?group=$title");
        exit();
      } else {
        // Image file posted
        // Update photo_location
        $stmt= "UPDATE groups
              SET title = :title, `description` = :descr, photo_location = :pholoc
              WHERE title = :OGtitle";
        $stmt = $conn->prepare($stmt);
        $stmt->execute(array(':title' => $title, ':descr' => $description, ':pholoc' => $image_location, ':OGtitle' => $OGtitle));

        // assuming it worked
        header("Location: individual-group.php?group=$title");
        exit();
      }
      
    }
    if (isset($_GET['new']) && $_GET['new'] = 'true') {
      // creating new group

      // PHP UPLOADER
      // $image = $_POST['img'];

      // ASSUMING THAT $image_location will be given by you :)

      // two sql statements:: one for inserting with image location, one for not
      // RANDOM STRING FOR GROUP_PASSWORD
      $image_location = "";


      $randomPass = generateRandomString(20); // random password, maybe hash it?
      $userID = $_SESSION['id'];
      if ($_FILES['img']['size'] == 0 && $_FILES['img']['error'] == 0) { // check if image file exists
        // no image file
        // don't update photo_location
        $stmt = "INSERT INTO groups(title, `description`, created_by, group_password) 
                 VALUES(:title, :descr, :userID, :grpPass)";
        $stmt = $conn->prepare($stmt);
        $stmt->execute(array(':title' => $title, ':descr' => $description, ':userID' => $userID, 'grpPass' => $randomPass));
      } else {
        // image file posted
        // update photo location
        $stmt = "INSERT INTO groups(title, `description`, photo_location, created_by, group_password) 
                 VALUES(:title, :descr, :pholoc, :userID, :grpPass)";
        $stmt = $conn->prepare($stmt);
        $stmt->execute(array(':title' => $title, ':descr' => $description, ':pholoc' => $image_location, ':userID' => $userID, 'grpPass' => $randomPass));
      }

      // Add user who created group to the actual group
      $groupid = $conn->lastInsertId();
      $stmt = "INSERT INTO pairing(userid, groupid) 
               VALUES(:usid, :grid)";
      $stmt = $conn->prepare($stmt);
      $stmt->execute(array(':usid' => $userID, ':grid' => $groupid));

      // assuming it worked
      header("Location: individual-group.php?group=$title");
      exit();
    }

  } else {
    header("Location: login.php?error=You must be logged in to access the groups page!");
    exit();
  }
?>