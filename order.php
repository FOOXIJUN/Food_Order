<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
	echo 'sadasdsadasd';
	echo '<script>window.location.href = "admin_login.php";</script>';
	exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Order History</title>
    <link rel="stylesheet" href="admin_page.css">
    <style>
        main {
            margin: 20px;
        }

        header h1
        {
            height: 20px;
            text-align: center;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .container {
            background-color: #f1f1f1;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .container:hover {
            background-color: #e0e0e0;
        }

        .update-status {
            background-color: #f1f1f1;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 10px;
        }

        .update-status:hover {
            background-color: #e0e0e0;
        }

        select {
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            width: 200px;
        }

        select:hover {
            border-color: #2196F3;
            outline: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>VIEW ORDER & UPDATE STATUS</h1>
    </header>
    <?php
include('admin_header.php')
?>
<main>
    <?php
    // Include the Connectdb.php file
    require_once 'Connectdb.php';

    // Establish the database connection

    // Prepare the SQL query
    $sql = "SELECT tracking_no, name, email, phone, address, pmode, products, amount_paid,pay_date, status FROM orders";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result) {
        // Fetch the data and display limited information
        while ($row = mysqli_fetch_assoc($result)) {
            $trackingNo = $row['tracking_no'];
            $name = $row['name'];
            $products = $row['products'];
            $email = $row['email'];
            $address = $row['address'];
            $pmode = $row['pmode'];
            $phone = $row['phone'];
            $amount_paid = $row['amount_paid'];
            $status = $row['status'];
            $paydate = $row['pay_date'];

            if ($status != "success") {
                // Display container with limited information
                echo "<big><div class='container' onclick='toggleDetails(\"$trackingNo\")'>";
                echo "<div style='float: left;'><strong>Tracking Number: $trackingNo</strong><br>";
                echo "Name: $name<br>";
                echo "Amount Paid: RM $amount_paid<br>";
                echo "</div>";
                echo "<div style='clear: both;'></div>";
                echo "<div class='details' id='details-$trackingNo' style='display: none;'>";
                echo "<h3>More Details:</h3>";
                echo "Email: $email<br>";
                echo "Phone: $phone<br>";
                echo "Address: $address<br>";
                echo "Payment Mode: $pmode<br>";
                echo "Product that bought : $products<br>";
                echo "Order date : $paydate<br>";
                echo "</div>";
                echo "</div>"; // Close the container div
                echo "<div class='update-status' style='float: right;margin-top:-90px; background-color: #f1f1f1; padding: 10px; cursor: pointer; border-radius: 5px;'>";
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='tracking_no' value='$trackingNo'>";
                echo "<select name='status' onchange='updateStatus(this)'>";
                echo "<option value='checkout' " . ($status == 'checkout' ? 'selected' : '') . ">Checkout</option>";
                echo "<option value='preparing' " . ($status == 'preparing' ? 'selected' : '') . ">Preparing</option>";
                echo "<option value='delivering' " . ($status == 'delivering' ? 'selected' : '') . ">Delivering</option>";
                echo "<option value='success' " . ($status == 'success' ? 'selected' : '') . ">Success</option>";
                echo "</select>";
                echo "</form>";
                echo "</div></big>";
                echo "<br>"; // Add line breaks for better readability
            }
        }
    } else {
        // Query execution failed
        echo "Error executing the query: " . mysqli_error($conn);
    }

    // Check if the status update form is submitted
    if (isset($_POST['tracking_no']) && isset($_POST['status'])) {
        $trackingNo = $_POST['tracking_no'];
        $status = $_POST['status'];

        // Update the status in the database
        $updateSql = "UPDATE orders SET status='$status' WHERE tracking_no='$trackingNo'";
        $updateResult = $conn->query($updateSql);
        if ($updateResult) {
            echo "<script>
                alert('Status updated successfully.');
            </script>";
        } else {
            echo "<script>
                alert('Error updating the status: " . mysqli_error($conn) . "');
            </script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- JavaScript code to handle the toggle functionality -->
    <!-- Move the JavaScript code to the bottom of the file, just before the closing </body> tag -->
    <script>
        let containerClicked = false; // Variable to track container click

        function toggleDetails(trackingNo) {
            const detailsDiv = document.getElementById(`details-${trackingNo}`);
            if (containerClicked) { // Display details only if container is clicked
                if (detailsDiv.style.display === 'none') {
                    detailsDiv.style.display = 'block';
                } else {
                    detailsDiv.style.display = 'none';
                }
            }
            containerClicked = false; // Reset the container click status
        }

        function updateStatus(selectElement) {
            const trackingNo = selectElement.parentElement.querySelector('input[name="tracking_no"]').value;
            const status = selectElement.value;

            // Send an AJAX request to update the status
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Status updated successfully.');
                } else {
                    alert('Error updating the status.');
                }
            };
            xhr.send(`tracking_no=${trackingNo}&status=${status}`);
        }

        // Event listener to track container click
        const containers = document.getElementsByClassName('container');
        for (let i = 0; i < containers.length; i++) {
            containers[i].addEventListener('click', function (event) {
                if (!event.target.classList.contains('update-status')) {
                    containerClicked = true;
                }
            });
        }
    </script>
</body>
</html>
