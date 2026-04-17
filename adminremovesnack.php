<!DOCTYPE html>
<html>
<head>
    <title>Remove food Pages</title>
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

main 
{
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: 5em;
}

table 
{
    width: 100%;
    border-collapse: collapse;
    border: 5px solid #ddd;
}

th, td 
{
    text-align: left;
    padding: 8px;
}

th 
{
    background-color: #f2f2f2;
    font-weight: normal;
}

tr:nth-child(even) 
{
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

img 
{
    width: 100px;
    height: auto;
}
    </style>
</head>
<!DOCTYPE html>
<html>
<head>
    <title>Remove Snack</title>
</head>
<body>
    <header>
        <h1>REMOVE SNACK</h1>
    </header>

    <?php
    include('admin_header.php');
    include('connectdb.php');

    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
        $searchQuery = $_GET['query'];

        $sql = "SELECT * FROM snack WHERE name LIKE '%$searchQuery%' AND blocked = 0";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) === 0) {
            echo "<p style='text-align: center; font-weight: bold; color: red;'>Invalid search</p>";
        }
        
    }
    ?>

    <div style="text-align: right; padding: 20px;">
        <form method="GET" action="">
            <input type="text" name="query" placeholder="Search snack by name" style="padding: 8px;">
            <button type="submit" style="padding: 8px 16px; background-color: #4CAF50; color: #fff; border: none; cursor: pointer;">Search</button>
        </form>
    </div>

    <?php
    if (isset($_POST['block'])) {
        $id = $_POST['id'];

        $query = "UPDATE snack SET blocked = 1 WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('snack has been blocked.');</script>";
        } else {
            echo "<script>alert('Error blocking snack.');</script>";
        }
    }

    if (isset($_POST['unblock'])) {
        $id = $_POST['id'];

        $query = "UPDATE snack SET blocked = 0 WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('snack has been unblocked.');</script>";
        } else {
            echo "<script>alert('Error unblocking snack.');</script>";
        }
    }

    if (isset($_POST['remove'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM snack WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('snack removed successfully.');</script>";
            echo '<meta http-equiv="refresh" content="0">';
        } else {
            echo "<script>alert('Error removing snack.');</script>";
        }
    }
    ?>

    <h2>Drink</h2>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Block / Unblock / Remove</th>
        </tr>

        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
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
           
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
           
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
       
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }

            echo "</table>";
        
        } else {
            $query = "SELECT * FROM snack";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
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
            
            echo "<button type='submit' name='unblock'>Unblock</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='id' value='$id'>";
            
            echo "<button type='submit' name='block'>Block</button>";
            echo "</form>";
        }
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' onsubmit='return confirm(\"Are you sure you want to remove this item?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
       
        echo "<button type='submit' name='remove'>Remove</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }

            
        }
        ?>
    </table>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>