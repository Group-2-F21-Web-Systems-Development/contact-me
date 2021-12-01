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

    // ?user=$username
    $username = $_GET['user'];
    $stmt = "SELECT * FROM users WHERE username = :u";
    $user = $conn->prepare($stmt);
    $username = $_SESSION['username'];
    $user->execute(array(':u' => $username));
    if ($user->rowCount() === 0) {
      // user does not exist
    } else {
      // 1 user exists
      $user = $user->fetch();
      $fname = $user['fname'];
      $lname = $user['lname'];
      $username = $user['username'];
      $links = $user['links'];
      $links = json_decode($links, true);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/profile.css">
  <script defer src="./src/ajax/ajax.js"></script>
  <script defer src="./profile.js"></script>
</head>
<body>
<div id="bodyBlock">
      <h1>Edit Your Profile (<?php echo ($username); ?>)</h1>
      <form id="addForm" name="addForm" action="update-user.php" method="post">
        <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
            <label for="firstName">First Name:</label>
            <div class="value"><input type="text" size="60" value="<?php echo ($fname); ?>" name="firstName" id="firstName"/></div>
          
            <label for="lastName">Last Name:</label>
            <div class="value"><input type="text" size="60" value="<?php echo ($lname); ?>" name="lastName" id="lastName"/></div>
            
            <label>Social Media(s):</label>
            <button id="new-media" type="button">+</button>
            <button id="del-media" type="button">-</button>
            <div id="medias" class="value">
              <?php
                if (!(empty($links))) {
                  // put key values into input key values
                  foreach ($links as $platform => $handle) {
                    echo ("<input type='text' size='40' value='$platform' name='platform[]' placeholder='platform'/>
                  <input type='text' size='40' value='$handle' name='handle[]' placeholder='link/handle'/> ");
                  }
                } else {
                  // no social medias
                  echo ('<input type="text" size="40" value="" name="platform[]" placeholder="platform"/>
                  <input type="text" size="40" value="" name="handle[]" placeholder="link/handle"/> ');
                }
              ?>
              
            </div>
            <input type="submit" value="save" id="save" name="save"/></div>
        </fieldset>
      </form>
    </div>
</body>
</html>

<?php
    }
  } else {
    header("Location: login.php?error=You must be logged in to edit your profile!");
    exit();
  }
?>