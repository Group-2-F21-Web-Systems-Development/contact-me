<?php
    session_start();
    if (isset($_SESSION['username'])) {

      function echoLinksList($links, $whitelist) {
         // echo("here: -->$links<--");
         $str='';
         if (!(empty($links))) {
            // There are social medias to display
            // convert whitelist and links back to associative array
            $links = json_decode($links, true);
            $whitelist = json_decode($whitelist, true);
            // setup list
            $str .= "<ul>";
            $i=0;
            foreach ($links as $platform => $handle) {
               if ($_SESSION['id'] == $_GET['user']  || in_array($platform, $whitelist)) {
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
               $i++;
            }
            // finish list
            $str .= "</ul>";
         } else {
            // no social medias
            $userid = $_SESSION['id'];
            $useridViewing = $_GET['user'];
            if ($userid ===  $useridViewing) {
               $str .= "<ul> <li> You should add some social links <a href='./profile.php?user=$userid'>here</a> </li> </ul> ";
            } else {
               $str .= "<ul> <li>User has not added any social media</li> </ul>";
            }
         }
         return $str;
      }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
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

         $useridOnScreen = '';
         if (isset($_GET['user'])) {
            $useridOnScreen = $_GET['user'];
         }
         $groupid = '';
         if (isset( $_GET['group'])) {
            $groupid = $_GET['group'];
         }
         $loggedUser = $_SESSION['id'];
         // make sure both users are part of the group
         $stmt = "SELECT * FROM pairing 
                 WHERE (userid = :logged AND groupid = :gid) OR (userid = :onscreen AND groupid = :gid)";
         $results = $conn->prepare($stmt);
         $results->execute(array(':logged' => $loggedUser, ':gid' => $groupid, ':onscreen' => $useridOnScreen));
         if ($results->rowCount() != 2 && $loggedUser != $useridOnScreen) {
            // only if user is not looking at their own account
            echo "You don't have access to this profile";
            exit();
         }

         $stmt = "SELECT * FROM users WHERE userid = :u";
         $results = $conn->prepare($stmt);
         $results->execute(array(':u' => $useridOnScreen));
         if ($results->rowCount() === 0) {
            echo "This is not a user";
            exit();
         }

         // query for whitelisted social handles
         // can assume group exists because passed check above on users in group
         // would have exited if either user wasn't part of this group
         $sql = "SELECT whitelist FROM groups WHERE groupid = :gid";
         $whtRes = $conn->prepare($sql);
         $whtRes->execute(array(':gid' => $groupid));
         $whitelist = '';
         if (isset($_GET['group'])) {
            $whitelist = $whtRes->fetch()['whitelist'];
         }
         

         $results = $results->fetchAll();
         foreach($results as $user){
            $source = $user['photo_location'];
            $firstname = $user['fname'];
            $lastname = $user['lname'];
            $links = $user['links'];
            $username = $user['username'];
            $userid = $user['userid'];
            $editBtn = '';
            if ($user['userid'] == $_SESSION['id']) {
               $heading = "My Profile ($username)";
               $editBtn = "<a id='edit-profile' href='./profile.php?user=$userid'>edit</a>";
            } else {
               $heading = "$username's Profile";
            }

            echo(
               "
               <h1>$heading</h1> $editBtn
               <fieldset> 
                     <img src='./$source' alt='photo of $firstname $lastname'>
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
                        <b>Social Media(s):</b>" . echoLinksList($links, $whitelist) . "
                           
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