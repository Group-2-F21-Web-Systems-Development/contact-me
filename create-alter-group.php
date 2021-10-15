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