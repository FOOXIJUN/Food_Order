<!DOCTYPE html>
<html>
<head>
    <title>Remove food Pages</title>
    <style>
* {
    box-sizing: border-box;
}

header h1 {
    height: 20px;
    text-align: center;
}

main {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: 5em;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 5px solid #ddd;
}

th, td {
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




button[name=remove] {
            background-color: #f44336;
            color: #fff;
            border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
        }

        button[name=block], button[name=unblock] {
            background-color: orange;
            color: #fff;
            border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
        }

        button[name=edit] {
            background-color: lightgreen;
            color: #fff;
            border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
        }

        button[name=remove]:hover {
            background-color: #d32f2f;
        }

        button[name=block]:hover, button[name=unblock]:hover {
            background-color: darkorange;
        }

        button[name=edit]:hover {
            background-color: limegreen;
        }

img {
    width: 100px;
    height: auto;
}
</style>

</head>

<body> 
<header>
        <h1>FOOD LIST</h1>
</header>
<?php
include('admin_header.php')
?>

<?php
include('connectdb.php')
?>


<?php
if(isset($_POST['block'])) 
{
    $id = $_POST['id'];
    $table = $_POST['table'];

    $query = "UPDATE $table SET blocked=1 WHERE id=$id";

    if(mysqli_query($conn, $query)) 
    {
        echo "<script>alert('Food has been blocked.');</script>";
    } 
    else 
    {
        echo "<script>alert('Error blocking item.');</script>";
    }
}

if(isset($_POST['unblock'])) 
{
    $id = $_POST['id'];
    $table = $_POST['table'];

    $query = "UPDATE $table SET blocked=0 WHERE id=$id";

    if(mysqli_query($conn, $query)) 
    {
        echo "<script>alert('Food has been unblocked.');</script>";
    } else {
        echo "<script>alert('Error unblocking item.');</script>";
    }
}

if (isset($_POST['remove'])) 
{
    $id = $_POST['id'];
    $table = $_POST['table'];
    $sql = "DELETE FROM $table WHERE id='$id'";
    if (mysqli_query($conn, $sql)) 
    {
        echo "<script>alert('Food remove successful.');</script>";
        echo '<meta http-equiv="refresh" content="0">';
    } 
    else 
    {
        echo "<script>alert('Error remove food.');</script>";
    }

}




$tables = array("Burger");

foreach($tables as $table) 
{
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    echo "<h2>$table</h2>";
    echo "<table>";
    echo "<tr><th>Image</th><th>Name</th><th>Ingredient</th><th>Price</th><th>Edit</th><th>Block / Unblock / Remove</th></tr>";

    while($row = mysqli_fetch_assoc($result)) 
    {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $ingredient = $row['ingredient'];
        $image = $row['image'];
        $blocked = $row['blocked'];

        echo "<tr>";
        echo "<td><img src='$image' width='100' height='100'></td>";
        echo "<td>$name</td>";
        echo "<td>$ingredient</td>";
        echo "<td>RM $price</td>";

        echo "<td>";
        echo "<form method='post' action='edit.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table_name' value='burger'>";
        echo "<button type='submit' name='edit'>Edit</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if ($blocked) {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table' value='$table'>";
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}


?>
<?php

$tables = array("Pizza");

foreach($tables as $table) 
{
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    echo "<h2>$table</h2>";
    echo "<table>";
    echo "<tr><th>Image</th><th>Name</th><th>Ingredient</th><th>Price</th><th>Edit</th><th>Block / Unblock / Remove</th></tr>";

    while($row = mysqli_fetch_assoc($result)) 
    {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $ingredient = $row['ingredient'];
        $image = $row['image'];
        $blocked = $row['blocked'];

        echo "<tr>";
        echo "<td><img src='$image' width='100' height='100'></td>";
        echo "<td>$name</td>";
        echo "<td>$ingredient</td>";
        echo "<td>RM $price</td>";

        echo "<td>";
        echo "<form method='post' action='edit.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table_name' value='pizza'>";
        echo "<button type='submit' name='edit'>Edit</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if ($blocked) {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table' value='$table'>";
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}
?>






<?php
$tables = array("snack");

foreach($tables as $table) 
{
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    echo "<h2>$table</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Image</th><th>Price</th><th>Edit</th><th>Block / Unblock / Remove</th></tr>";

    while($row = mysqli_fetch_assoc($result)) 
    {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $blocked = $row['blocked'];

        echo "<tr>";
        echo "<td><img src='$image' width='100' height='100'></td>";
        echo "<td>$name</td>";
        echo "<td>RM$price</td>";
        echo "<td>";

        echo "<form method='post' action='edit.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table_name' value='drink'>";
        echo "<button type='submit' name='edit'>Edit</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if ($blocked) {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table' value='$table'>";
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
}
?>


<?php
$tables = array("Drink");

foreach($tables as $table) 
{
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    echo "<h2>$table</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Image</th><th>Price</th><th>Edit</th><th>Block / Unblock / Remove</th></tr>";

    while($row = mysqli_fetch_assoc($result)) 
    {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $blocked = $row['blocked'];

        echo "<tr>";
        echo "<td><img src='$image' width='100' height='100'></td>";
        echo "<td>$name</td>";
        echo "<td>RM $price</td>";
        echo "<td>";

        echo "<form method='post' action='edit.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table_name' value='drink'>";
        echo "<button type='submit' name='edit'>Edit</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if ($blocked) {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='table' value='$table'>";
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
}



mysqli_close($conn);
?>