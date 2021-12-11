<?php
  session_start();
  if (isset($_SESSION['userid'])) {
      $userid = $_SESSION['userid'];
      $dbusername= "root";
      $dbpassword = "group2websys";
      
      $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword);
      if (!$conn) {
         echo "Connection failed!";
      }

      $question = '';
      $num;
      if (isset($_GET['question'])){
         $num = $_GET['question'];
         
         if($num == 1){
            $question = "What's your favorite movie?";
         }else if ($num == 2){
            $question = "What is the name of your best friend in grade school?";
         }else if ($num == 3){
            $question = "What is your mother's maiden name?";
         }else if ($num == 4){
            $question = "What sport did you play growing up?";
         }
      }

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
  <link rel="stylesheet" href="./src/styles/login.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
<div id="bodyBlock">
   <form id="addForm" name="addForm" action="sec.php<?php echo("?question=$num"); ?>" method="post">
      <fieldset>
         <label for="question">Question:</label>
         <?php
      if (isset($_GET['error'])) {
        echo "<p id='error'>". $_GET['error'] . "</p>";
      }
    ?>

         <?php
            echo "<p>" . $question . "</p>"
         ?>
         <input name="answer" id="answer" type="text" maxlength="255">
         <button type="submit">submit</button>
      </fieldset>
   </form>
   </div>   
</body>
</html>

<?php
      if (isset($_POST['answer'])) {
         function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
   
         $answer = validate($_POST['answer']);
         if (empty($answer)) {
            header("Location: sec.php?error=answer is required&question=$num");
            exit();
         }else{
            $sql = "select sec_answer from users where userid=:usid";
            $result = $conn->prepare($sql);
            $result->execute(array(':usid'=> $userid));
            $ans = $result->fetchAll();
            foreach($ans as $row){
               $answer = strtolower($answer);
               if(password_verify($answer, $row[0])){
                  header("Location: change_pass.php");
                  exit();  
               }else{
                  header("Location: sec.php?error=answer is wrong&question=$num");
                  exit();
               }       
            }
         }
      }
   }

?>