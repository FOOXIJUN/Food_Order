<!DOCTYPE html>
<html>

<head>
  <title>Product Details</title>
  <style>
    .product-details {
      border: 1px solid #ccc;
      padding: 10px;
      width: 700px;
      margin: 20px auto;
      display: flex;
    }

    .product-image {
      width: 40%;
      text-align: center;
    }

    .product-image img {
      max-width: 100%;
      height: auto;
    }

    .product-info {
      width: 60%;
      padding-left: 10px;
    }

    .product-type {
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
      font-size: 20px;
    }

    .product-name {
      font-weight: bold;
      margin-top: 10px;
    }

    .product-ingredient {
      margin-top: 5px;
      font-weight: bold;
    }

    .product-price {
      margin-top: 5px;
      font-weight: bold;
    }

    .close-button {
      display: inline-block;
      padding: 5px 10px;
      background-color: black;
      border: none;
      color: white;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <?php
  include 'Connectdb.php';

  // Check if the ID parameter is provided in the URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the product details from the database
    $query = "SELECT * FROM pizza WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product with the given ID exists
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $name = $row['name'];
      $price = $row['price'];
      $image = $row['image'];
      $ingredient = $row['ingredient'];
    } else {
      // Product not found
      echo "Product not found.";
      exit;
    }
  } else {
    // ID parameter not provided
    echo "Invalid request.";
    exit;
  }
  ?>

  <div class="product-details">
    <div class="product-image">
      <img src="<?= $image ?>" alt="Product Image">
    </div>
    <div class="product-info">
      <p class="product-type">Type: Pizza</p>
      <p class="product-name">Name: <?= $name ?></p>
      <p class="product-price">Price: RM<?= $price ?></p>
      <p class="product-ingredient">Ingredient: <?= $ingredient ?></p>
      <button class="close-button" onclick="goToPizzaPage()">Close</button>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script>
    function goToPizzaPage() {
      window.location.href = 'pizza.php';
    }
  </script>
</body>

</html>