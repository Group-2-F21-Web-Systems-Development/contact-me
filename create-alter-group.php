  <!-- empty form group(users are creating new group) -->
  <?php 
  session_start();
        // connect to databse
        $dbusername= "root";
        $dbpassword = "group2websys";
        
        $conn = new PDO('mysql:host=localhost;dbname=contactme',$dbusername, $dbpassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
        if (!$conn) {
            echo "Connection failed!";
        }
  
  if (isset($_GET['group'])){
    // user is accessing a group that already exists 
    $title=$_GET['group'];
    // groups is table and title is a column from groups table 
    $stmt= "SELECT * FROM groups WHERE title = :title";
    $group = $conn->prepare($stmt);
    //title is coming from the url from the individual-group.php
    $group ->execute(array(':title' => $title));
  }
    if ($group->rowCount() === 0) {
      echo 'This group does not exist';
    }
    else{
      // fetch means getting the data  
      $group = $group->fetch();
      // code for if the the row returns
      // fix lines 30-33
      $description = $group['description'];
      $photoLocation = $group['photo_location'];
            // do I need a groupid?
      // $groupid = $group['groupid'];

    }
      // allowing users to make changes and creating a new group -->
    if (isset($_GET['new']) && $_GET['new']==='true')  {
      $sql_insert_group="INSERT INTO groups(title, description) VALUES('$title,'$description');"
      $result = $conn->query( $sql_insert_group);

     }


?>
      <section class="group-info">
      <div class="column">
        <img src="./<?php echo($photoLocation); ?>" alt="photo of <?php echo($title); ?>">
        <h1><?php echo($title); ?></h1>
      </div>
      <div class="column">
        <h2>Description</h2>
        <p class="description"><?php echo($description); ?></p>
      </div>
    </section>



    }




    

    <!-- // look for anything to write sql commands that is looking for the group, specified from the title
    // save the information into php variables and display onto the form/website
    // ask the database for the group with that title 
    // look at lab 7 (look at the README) -->
  }
  <!-- // true is coming from groups.php and it is getting the url from line 41 -->
    <!-- // write in the specific fields (monkeys)
    // user is creating a new group, which is inserting a new row into the database 



    // connecting to database -->
    <!-- $title=mysqli_real_escape_string($conn, $_GET['new']);
    $description=mysqli_real_escape_string($conn, $_GET['new']);

    // create sql
    // insert into the groups table and we want to update these columns (title and description) and these are the values for those columns
    $sql="INSERT INTO groups(title, description) VALUES('$title,'$description');"
    // way to set up the query
    $result = $conn->prepare($sql);
    prepare = 
    $result->execute();
    // save to db and check to see if the everything is saved
    // this will be a success and check is if everything is true
    if {
      // success
    }
    else{
      echo "Changes not saved!".mysqli_error($conn);
    }
 -->
      <!-- text input instead of p tag -->
      <!-- text input instead of p tag -->
 <input class="new"><?php echo $_GET['new']; ?></input>

    <?php } ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Groups Page</title>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./src/styles/style.css">
  <link rel="stylesheet" href="./src/styles/create-alter-groups.css">
  <script defer src="./src/ajax/ajax.js"></script>
</head>
<body>
  <section id="edit-form">
    <h1><span>Edit Group:</span> Monkey Apreciation Club Interest Meeting</h1>
    <form>
      <label for="title">Title</label>
      <!-- // include php inside of value -->
      <input id="title" name="title" type="text" value="Monkey Apreciation Club Interest Meeting">
      <label for="description">Description</label>
      <textarea id="description" name="description" cols="30" rows="10">Some primate species are recognized for their tree-swinging leaps that moved being acrobats to shame! Some monkey species take this “ arm at arm ” technique you may have seen children practicing on that “ monkey bars ” in the yard! Colobus monkeys, unlike other primate species, have hind legs that are much further than their forelimbs, creating for unbelievable leaping power with good velocity. In other words, monkeys are cool so come to our club interest meeting</textarea>
      <label for="img">Image</label>
      <input type="file" id="img" name="img" accept="image/*">
      <button id= "save">Save</button>
    </form>
  </section>
</body>
</html>

<!-- // make sure all of the data is saved into the sql  -->

<!-- // put php after the document  -->



  



<!-- // make if statements -->
<!-- // make sure the ids are the same and only change the data that needs to be changed     -->