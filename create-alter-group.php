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
  
        // <!-- only works if the url has error=  -->
        // <!-- text input instead of p tag -->
        // <!-- user is creating a new group -->
        // true is coming from groups.php and it is getting the url from line 41
  if (isset($_GET['group'])){
    // user is accessing a group that already exists 
    $title=$_GET['group'];
    // look for anything to write sql commands that is looking for the group, specified from the title
    // save the information into php variables and display onto the form/website
    // ask the database for the group with that title 
    // look at lab 7 (look at the README)
  }
  if (isset($_GET['new']) && $_GET['new']==='true')  { 
    // write in the specific fields (monkeys)
    // user is creating a new group, which is inserting a new row into the database 
    // creating a new group
    $title='';
    $description='';



    // connecting to database
    $title=mysqli_real_escape_string($conn, $_GET['new']);
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

      // <!-- only works if the url has error=  -->
      // <!-- text input instead of p tag -->
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
      // include php inside of value
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

// put php after the document 



  



// <!-- make if statements -->
// <!-- make sure the ids are the same and only change the data that needs to be changed     -->