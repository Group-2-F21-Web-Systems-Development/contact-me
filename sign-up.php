<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/login.css">
  <link rel="stylesheet" href="./src/styles/style.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
   <div id="bodyBlock">
      <h1>Sign up</h1>
      <form id="addForm" name="addForm" action="#" method="post" onsubmit="return validate(this);">
        <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
                         <!-- labels of the fields -->
                         <!-- when you click on the label you can type in the field -->
            <label for="first-name">First Name:</label>
            <div class="value"><input name="first-name" id="first-name" type="text"></div>
            <label for="last-name">Last Name:</label>
            <div class="value"><input name="last-name" id="last-name" type="text"></div>
            <label for="email">Email:</label>
            <div class="value"><input name="email" id="email" type="text"></div>
            <label for="password">Password:</label>
            <div class="value"><input name="password" id="password" type="text"></div>
            <label for="confirm">Confirm Password:</label>
            <div class="value"><input name="confirm" id="confirm" type="text"></div>
          </div>
          <button onclick="clickMe()">Sign Up</button>
        </fieldset>
      </form>
   </div>
</body>
</html>