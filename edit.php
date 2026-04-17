<title>Edit food Pages</title>
<style>
    {
        box-sizing: border-box;
    }

    body {
        margin: 0;
    }

    /* Style the header */
    .header {
        
        padding: 20px;
        text-align: center;
    }

    /* Style the top navigation bar */
    .topnav {
        overflow: hidden;
        background-color: #333;
    }

    /* Style the topnav links */
    .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change color on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }


    /* Center the main content */
    main {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style the header */
    .header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Style the top navigation bar */
    .topnav {
        overflow: hidden;
        background-color: #f2f2f2;
        border-bottom: 1px solid #ddd;
    }

    /* Style the topnav links */
    .topnav a {
        float: left;
        display: block;
        color: #333;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change color on hover */
    .topnav a:hover {
        background-color: #ddd;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
        font-weight: normal;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    img {
        width: 100px;
        height: auto;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 4px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }
    

    </style>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$row = null;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $table_name = $_POST['table_name'];
    $sql = "SELECT * FROM $table_name WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

$errors = [];

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $table_name = $_POST['table_name'];

    if ($price < 1) {
        $errors[] = "Price must be more than RM 1";
    }

    // 如果上传了新图片
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];

        // 根据表名决定保存目录
        if ($table_name == 'burger') {
            $target = "menu/burger/" . basename($image);
        } elseif ($table_name == 'pizza') {
            $target = "menu/pizza/" . basename($image);
        } elseif ($table_name == 'drink') {
            $target = "menu/drink/" . basename($image);
        } elseif ($table_name == 'snack') {
            $target = "menu/snack/" . basename($image);
        } else {
            $target = "images/" . basename($image); // 默认保存到 images
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = $target; // 数据库保存完整路径
    } else {
        $image = $row['image']; // 没上传就保留原路径
    }

    if (empty($errors)) {
        $sql = "UPDATE $table_name SET name='$name', price='$price', image='$image'";

        // burger 和 pizza 有 ingredient 字段
        if ($table_name == 'burger' || $table_name == 'pizza') {
            $ingredient = $_POST['ingredient'];
            $sql .= ", ingredient='$ingredient'";
        }

        $sql .= " WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Edit successful!"); window.location.href = "adminremovefood.php";</script>';
            exit();
        } else {
            echo '<script>alert("Edit failed: ' . mysqli_error($conn) . '"); window.location.href = "edit.php?id=' . $id . '&table_name=' . $table_name . '";</script>';
            exit();
        }
    }
}
?>

<h1 style="text-align: center;">Edit <?php echo $table_name; ?></h1>

<?php if (!empty($errors)): ?>
    <div style="color: red; text-align: center; margin-bottom: 10px;">
        <?php foreach ($errors as $error): ?>
            <?php echo $error; ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" name="editForm">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">

    <label for="image">Image:</label>
    <input type="file" name="image"><br>
    <?php if ($row['image']): ?>
        <img src="<?php echo $row['image']; ?>" width="100">
    <?php endif; ?>

    <label for="name">Name:</label>
    <input type="text" name="name" required value="<?php echo $row['name']; ?>"><br>

    <?php if ($table_name == 'burger' || $table_name == 'pizza'): ?>
        <label for="ingredient">Ingredient:</label>
        <input type="text" name="ingredient" required value="<?php echo $row['ingredient']; ?>"><br>
    <?php endif; ?>

    <label for="price">Price:</label>
    <input type="text" name="price" required value="<?php echo $row['price']; ?>"><br>
    <button type="submit" name="update">Update</button>
</form>

<form method="POST" action="adminremovefood.php">
    <button type="submit" style="background-color: red; color: white;">Cancel</button>
</form>

<?php
mysqli_close($conn);
?>