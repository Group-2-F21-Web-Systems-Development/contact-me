<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/login.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
<div id="bodyBlock">
      <h1>Please Login</h1>
      <form id="addForm" name="addForm" action="db.php" method="post">
      <?php
      if (isset($_GET['error'])) {
        echo "<p id='error'>". $_GET['error'] . "</p>";
      }
      if (isset($_GET['success'])) {
        echo "<p id='success'>". $_GET['success'] . "</p>";
      }
    ?>

    
      <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
                         <!-- labels of the fields -->
                         <!-- when you click on the label you can type in the field -->
            <label for="username">username:</label>
            <div class="value"><input type="text" size="60" value="" name="username" id="username"/></div>
            
            <label for="title">Password:</label>
            <div class="value"><input type="password" size="60" value="" name="pass" id="pass"/></div>
          </div>
          <button type="submit">LOGIN</button>
        </fieldset>
      </form>
      <a href="forgot.php">Forgot Password?</a>
    </div>
</body>
</html>

