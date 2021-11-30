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
      <h1>My Profile</h1>
      <!-- image of Jeff Bezos -->
      
      <?php
         $dbusername= "root";
         $dbpassword = "group2websys";
         
         $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
         if (!$conn) {
            echo "Connection failed!";
         }
         $username = $_SESSION['username'];
         $stmt = "SELECT * FROM users WHERE username = ':u'";
         $results = $conn->prepare($stmt);
         $results->execute(array(':u' => $username));
         $results = $results->fetchAll();
         foreach($results as $user){
            $source = $user['photo_location'];
            $firstname = $user['fname'];
            $lastname = $user['lname'];

            echo(
               "<fieldset> 
                     <img src='./$source' alt='photo of $firstname $lastname'>
                     <!-- start of profile page -->
                     <!-- name, contact information of user -->
                  <legend><b>Contact Information</b></legend>
                  <ul>
                        <li> <b>First Name:</b>$firstname</li>
                     </ul>
                     <ul>
                        <li><b>Last Name:</b>$lastname</li>
                     </ul>
                     <ul>
                        <li><b>Social Media(s):</b>
                           Twitter- @JeffBezos
                           Instagram- @jeffbezos</li>
                     </ul>
               </fieldset>
        ");
         }
      ?>
        
    </div>
</body>
</html>

