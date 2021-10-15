<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me Profile Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/profile.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
<div id="bodyBlock">
      <h1>Edit Your Profile</h1>
      <form id="addForm" name="addForm" action="#" method="post" onsubmit="return validate(this);">
        <fieldset> 
          <legend>Contact Information</legend>
          <div class="formData">
                         <!-- labels of the fields -->
                         <!-- when you click on the label you can type in the field -->
            <label for="firstName">First Name:</label>
            <div class="value"><input type="text" size="60" value="" name="firstName" id="firstName"/></div>
          
            <label for="lastName">Last Name:</label>
            <div class="value"><input type="text" size="60" value="" name="lastName" id="lastName"/></div>
            
            <label for="title">Social Media(s):</label>
            <div class="value"><input type="text" size="60" value="" name="title" id="title"/></div>
                        
            <label for="pseudonym">Nickname:</label>
            <div class="value"><input type="text" size="60" value="" name="pseudonym" id="pseudonym"/></div>
            
            <label for="comments">Comments:</label>
            <div class="value"><textarea rows="4" cols="40" name="comments" id="comments" onclick="clearBox('comments');">Please enter your comments</textarea></div>
            <!-- onclick=clearBox makes sure that once you click this field the text inside of it is removed -->
            <input type="submit" value="save" id="save" name="save"/></div>
        </fieldset>
      </form>
    </div>
</body>
</html>