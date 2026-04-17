<!DOCTYPE html>
<html>
<head>
	<title>Add food Pages</title>
    <style>
* 
{
  box-sizing: border-box;
}
header h1
{
    height: 20px;
    text-align: center;
}
    
form
{
  font-style: normal;
  text-decoration: none;
}

form 
{
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  margin: 20px auto;
  max-width: 500px;
  padding: 20px;
}

label 
{
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
select 
{
  border: none;
  border-radius: 3px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  font-size: 16px;
  padding: 10px;
  width: 100%;
}

input[type="file"] 
{
  margin-bottom: 20px;
}

button[type="submit"] 
{
  background-color: #4CAF50;
  border: none;
  border-radius: 3px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  padding: 10px;
  width: 100%;
}

button[type="submit"]:hover 
{
   background-color: #3e8e41;
}
    </style>
      <script>
  function validateForm() {
    var type = document.getElementById("type").value;
    var ingredient = document.getElementById("ingredient").value.trim();
    var image = document.getElementById("image").value;
    var price = parseFloat(document.getElementById("price").value);

    if ((type === 'burger' || type === 'pizza') && ingredient === '') {
      alert("Ingredient is required for Burger and Pizza");
      return false;
    }

    if ((type === 'drink' || type === 'snack') && ingredient !== '') {
      alert("Ingredient should not be filled for Drink and Snack");
      return false;
    }

    var name = document.getElementById("name").value.trim();
    if (name === '') {
      alert("Name is required");
      return false;
    }

    if (image === '') {
      alert("You must upload the image");
      return false;
    }

    if (isNaN(price) || price <= 0) {
      alert("Price must be a valid number and more than RM 1");
      return false;
    }

    return true;
  }
</script>

</head>
<?php
include('connectdb.php');
?>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];
  $target = "menu/" . basename($image);

  if ($_POST['type'] == 'burger') {
    $ingredient = $_POST['ingredient'];
    $query = "INSERT INTO burger (name, ingredient, price, image) VALUES ('$name', '$ingredient', '$price', '$image')";
  } elseif ($_POST['type'] == 'pizza') {
    $ingredient = $_POST['ingredient'];
    $query = "INSERT INTO pizza (name, ingredient, price, image) VALUES ('$name', '$ingredient', '$price', '$image')";
  } elseif ($_POST['type'] == 'snack') {
    $query = "INSERT INTO snack (name, price, image) VALUES ('$name', '$price', '$image')";
  } elseif ($_POST['type'] == 'drink') {
    $query = "INSERT INTO drink (name, price, image) VALUES ('$name', '$price', '$image')";
  }

  // Move the uploaded image to the target directory
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
      echo "Add food successful";
    } else {
      echo "Failed to add food";
    }
  } else {
    echo "Image upload failed";
  }
}

mysqli_close($conn);
?>

<body>
  <header>
    <h1>ADD FOOD</h1>

  </header>
  <?php
include('admin_header.php');
?>

  <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="type">Select a table:</label>
    <select name="type" id="type">
      <option value="burger">Burger</option>
      <option value="pizza">Pizza</option>
      <option value="snack">Snack</option>
      <option value="drink">Drink</option>
    </select><br>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>

    <label for="ingredient">Ingredient:</label>
    <input type="text" name="ingredient" id="ingredient"><br>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price"><br>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image"><br>

    <input type="submit" name="submit" value="Add">
  </form>
</body>