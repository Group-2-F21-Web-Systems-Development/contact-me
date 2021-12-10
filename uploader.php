<?php
  $username = $_SESSION['username'];
  // Check if image file is a actual image or fake image
  if ($_FILES['img']['size'] == 0 && $_FILES['img']['error'] == 4) { // check if image file exists
     #header("Location: personalprofile.php?user=$username&noImage");
  }else{
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["img"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["img"]['tmp_name']);
    if($check) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  
     // Check if file already exists
     /*
     if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
     }
     */
  
     // Check file size
     if ($_FILES["img"]["size"] > 500000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
     }
  
     // Allow certain file formats
     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
     && $imageFileType != "gif" ) {
         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
     }
  
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
     } else {
        $temp = explode(".", $_FILES["img"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $newfilename = "./uploads/" . $newfilename;
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $newfilename)) {
           echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
           $stmt= "UPDATE users
               SET photo_location = :phid
               WHERE userid = :userID";
            $stmt = $conn->prepare($stmt);
            $stmt->execute(array(':phid' => $newfilename, ':userID' => $userID));
        } else {
           echo "Sorry, there was an error uploading your file.";
        }
     }
  }
?>