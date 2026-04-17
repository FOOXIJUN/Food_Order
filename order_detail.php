<!DOCTYPE html>
<html>
<head>
	<title>View Order History</title>
	<link rel="stylesheet" href="admin_page.css">
	<style>
			main 
{
	margin: 20px;
}

header h1
{
    height: 20px;
    text-align: center;
}

footer 
{
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
	</style>
</head>
<body>
<header>
	<h1>VIEW ORDER HISTORY</h1>
</header>
<?php
include('admin_header.php')
?>
<!-- Add the filter/search button -->
<nav>
	<form method="GET" action="">
		<input type="month" style="height:30px; width:150px; border:2px bold black;" name="order_month" placeholder="Select Order Month">
		<button type="submit" style="height:30px; width:100px; border:2px bold black;">Filter/Search</button>
	</form>
</nav>

<main>
<?php
require_once 'Connectdb.php';

$sql = "SELECT tracking_no, name, email, phone, address, pmode, products, amount_paid, pay_date, status FROM orders";

if (isset($_GET['order_month'])) {
    $orderMonth = $_GET['order_month'];
    // 获取所选订单月份的第一天和最后一天
    $startDate = date('Y-m-01', strtotime($orderMonth));
    $endDate = date('Y-m-t', strtotime($orderMonth));
    // 添加 WHERE 子句以根据订单日期过滤
    $sql .= " WHERE pay_date BETWEEN '$startDate' AND '$endDate'";
}
		// Execute the query
		$result = $conn->query($sql);

		// Check if the query executed successfully
		if ($result) {
            if ($result->num_rows > 0) {
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
					if ($status === "success") {
						// Display container with limited information
						echo "<big><div class='container' onclick='toggleDetails(\"$trackingNo\")'>";
						echo "<strong>Tracking Number: $trackingNo</strong><br>";
						echo "Name: $name<br>";
						echo "Amount Paid: RM $amount_paid<br>";
						echo "<div class='details' id='details-$trackingNo' style='display: none;'>";
						echo "<h3>More Details:</h3>";
						echo "Email: $email<br>";
						echo "Phone: $phone<br>";
						echo "Address: $address<br>";
						echo "Payment Mode: $pmode<br>";
						echo "Product that bought: $products<br>";
						echo "Order date: $paydate<br>";
						echo "</div>";
						echo "</div> </big>"; // Close the container div
						echo "<br>"; // Add line breaks for better readability
					}
				}
			} else {
				echo "No order history found.";
			}
		} else {
			// Query execution failed
			echo "Error executing the query: " . mysqli_error($conn);
		}

		// Close the database connection
		mysqli_close($conn);
	?>

	<!-- JavaScript code to handle the toggle functionality -->
	<script>
		function toggleDetails(trackingNo) {
			const detailsDiv = document.getElementById(`details-${trackingNo}`);
			if (detailsDiv.style.display === 'none') {
				detailsDiv.style.display = 'block';
			} else {
				detailsDiv.style.display = 'none';
			}
		}
	</script>
</main>
</body>
</html>