<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
	echo 'pelase login first';
	echo '<script>window.location.href = "admin_login.php";</script>';
	exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Customer Detail</title>
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

table 
{
    width: 100%;
    border-collapse: collapse;
    border: 5px solid #ddd;
}
  
th, td 
{
    text-align: center;
    padding: 12px;
}
  
th 
{
    background-color: #f2f2f2;
}
  
tbody tr:nth-child(even) 
{
    background-color: #f2f2f2;
}

input[type="text"], input[type="number"], textarea 
{
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}
  
button[type="submit"] 
{
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <header>
        <h1>CUSTOMER LIST</h1>
    </header>
    
    <?php
    include('admin_header.php');
    ?>

    <?php
    include('connectdb.php');
    ?>
    

    <?php
    if (isset($_POST['block'])) {
        $id = $_POST['id'];

        $query = "UPDATE customer SET blocked = 1 WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Customer has been blocked.');</script>";
        } else {
            echo "<script>alert('Error blocking customer.');</script>";
        }
    }

    if (isset($_POST['unblock'])) {
        $id = $_POST['id'];

        $query = "UPDATE customer SET blocked = 0 WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Customer has been unblocked.');</script>";
        } else {
            echo "<script>alert('Error unblocking customer.');</script>";
        }
    }

    // Query to retrieve customer data
    $sql = "SELECT id, name, email, nomobile, address, poscode, country, blocked FROM customer";
    $result = mysqli_query($conn, $sql);

    // Check if there are records
    if (mysqli_num_rows($result) > 0) {

        // Bar chart HTML and CSS
        echo "
        <div style='text-align: center;'>
            <h2>Customer Statistics</h2>
            <div style='width: 500px; margin: 0 auto;'>
                <canvas id='customerChart'></canvas>
            </div>
        </div>
        <br>
        <table>
            <tr>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Postcode</th>
                <th>State</th>
                <th>Actions</th>
            </tr>";

        // Variables to store customer counts
        $blockedCount = 0;
        $activeCount = 0;

        // Iterate through each customer record
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["nomobile"]."</td>
                <td>".$row["address"]."</td>
                <td>".$row["poscode"]."</td>
                <td>".$row["country"]."</td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='id' value='".$row['id']."'>";

            // Check if the customer is blocked or not
            if ($row["blocked"]) {
                echo "<button type='submit' name='unblock'>Unblock</button>";
                $blockedCount++;
            } else {
                echo "<button type='submit' name='block'>Block</button>";
                $activeCount++;
            }

            echo "
                    </form>
                </td>
            </tr>";
        }

        echo "</table>";

        // JavaScript to create the bar chart
        echo "
        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script>
            const customerChart = document.getElementById('customerChart').getContext('2d');

            new Chart(customerChart, {
                type: 'bar',
                data: {
                    labels: ['Blocked', 'Unblock'],
                    datasets: [{
                        label: 'Customer Status',
                        data: [".$blockedCount.", ".$activeCount."],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        </script>";
    } else {
        echo "No records found.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
