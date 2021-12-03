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
  <title>Contact Me Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/personalprofile.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
<div id="bodyBlock">
      <?php
         $dbusername= "root";
         $dbpassword = "group2websys";
         
         $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
         if (!$conn) {
            echo "Connection failed!";
         }

         function echoLinksList($links) {
            // echo("here: -->$links<--");
            $str='';
            if (!(empty($links))) {
               // There are social medias to display
               // convert back to associative array
               $links = json_decode($links, true);
               // setup list
               $str .= "<ul>";
               foreach ($links as $platform => $handle) {
                  $str .= "";
                  if ($handle[0] === '@') {
                     // assume handle
                     $str .= "<li>$platform: $handle</li>";
                  } else {
                     // assume link
                     if ($handle[0] != 'h' || $handle[1] != 't' || $handle[2] != 't' || $handle[3] != 'p'){
                        // if http:// not at beginning, concat it on
                        $handle = "http://" . $handle;
                     }
                     $str .= "<li><a href='$handle'>$platform</a></li>";
                  }
               }
               // finish list
               $str .= "</ul>";
            } else {
               // no social medias
               $username = $_SESSION['username'];
               $usernameViewing = $_GET['user'];
               if ($username ===  $usernameViewing) {
                  $str .= "<ul> <li> You should add some social links <a href='./profile.php?user=$username'>here</a> </li> </ul> ";
               } else {
                  $str .= "<ul> <li>User has not added any social media</li> </ul>";
               }
            }
            return $str;
         }


         $username = $_GET['user'];
         $stmt = "SELECT * FROM users WHERE username = :u";
         $results = $conn->prepare($stmt);
         $results->execute(array(':u' => $username));
         if ($results->rowCount() === 0) {
            echo "$username is not a user";
         }
         $results = $results->fetchAll();
         foreach($results as $user){
            $source = $user['photo_location'];
            $firstname = $user['fname'];
            $lastname = $user['lname'];
            $links = $user['links'];
            $username = $user['username'];
            $editBtn = '';
            if ($user['userid'] == $_SESSION['id']) {
               $heading = "My Profile ($username)";
               $editBtn = "<a id='edit-profile' href='./profile.php?user=$username'>edit</a>";
            } else {
               $heading = "$username's Profile";
            }

            echo(
               "
               <h1>$heading</h1> $editBtn
               <fieldset> 
                     <div id='img-container'><img src='./$source' alt='photo of $firstname $lastname'></div>
                     <!-- start of profile page -->
                     <!-- name, contact information of user -->
                  <legend><b>Contact Information</b></legend>
                  <ul>
                        <li> <b>First Name:</b> $firstname</li>
                     </ul>
                     <ul>
                        <li><b>Last Name:</b> $lastname</li>
                     </ul>
                     <ul>
                        <li>
                        <b>Social Media(s):</b>" . echoLinksList($links) . "
                           
                        </li>
                     </ul>
               </fieldset>
        ");
         }
      ?>
        
    </div>
</body>
</html>


<?php
  } else {
    header("Location: login.php?error=You must be logged in to access someone's profile!");
    exit();
  }
?>