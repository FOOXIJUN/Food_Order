<!DOCTYPE html>
<html>
<head>
    <title>Customer's order</title>
    
    <style>
        main {
          margin: 20px;
        }
        
        header h1 {
          text-align: center;
        }
        
        footer {
          background-color: #333;
          color: #fff;
          text-align: center;
          padding: 20px;
        }
        
        .big-container {
          max-width: 1600px;
          grid-gap: 20px;
          padding-left: 40px;
        }
        
        .container {
          display: flex;
          width: 500px;
          flex-direction: column;
          border: 3px solid black;
          padding: 20px;
          border-radius: 0.25rem;
          float: left;
          margin: 20px;
          height: auto;
          text-align: left;
          background: linear-gradient(to right, #FFC3A0, #FFAFBD); /* Gradient background */
        }
        
        .container:hover {
          background-color: #e0e0e0;
        }
        
        .container.open {
          width: 900px; /* Updated width for the open container */
        }
        
        .container .title {
          font-size: 20px;
          font-weight: bold;
        }
        
        .container .details {
          display: none;
          margin-top: 10px;
          font-size: 18px;
          padding-left: 10px;
        
        }
        
        .container .details p {
          margin: 5px 0;
        }
        
        button {
          height: 30px;
          width: 90px;
          border: 2px solid black;
          margin-top: 10px;
        }
        
        button:hover {
          border-color: blue;
          background-color: lightskyblue;
        }
    </style>
</head>

<body>
    <main>
    <?php
session_start();
require 'user_valid.php';
include('userheader.php');
echo ('<br><br><br><br>');
include 'Connectdb.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT tracking_no, name, email, phone, address, pmode, products, amount_paid, pay_date, status FROM orders WHERE user_id = '$user_id'";

// Check if the filters are provided
if (isset($_GET['order_month']) || isset($_GET['status'])) {
    $orderMonth = $_GET['order_month'];
    $status = isset($_GET['status']) ? $_GET['status'] : null; // Check if the status is set

    // Check if the order month filter is provided
    if (!empty($orderMonth)) {
        // Get the first and last day of the selected order month
        $startDate = date('Y-m-01', strtotime($orderMonth));
        $endDate = date('Y-m-t', strtotime($orderMonth));
        // Add a WHERE clause to filter by order date
        $sql .= " AND pay_date BETWEEN '$startDate' AND '$endDate'";
    }

    // Check if the status filter is provided
    if (!empty($status)) {
        // Add a WHERE clause to filter by order status
        if ($status == 'complete') {
            $sql .= " AND status = 'success'";
        } elseif ($status == 'incomplete') {
            $sql .= " AND status != 'success'";
        }
    }
}
// Add ORDER BY clause to the query
$sql .= " ORDER BY pay_date DESC";
// Execute the query
$result = $conn->query($sql);
echo "<h1>Your Order!<br></h1>";
?>
<!-- Rest of your HTML code -->


        <form method="GET"> <!-- Add the opening form tag here -->
            <label for="order_month"><br>Filter by Date:</label>
            <input type="month" style="height:30px; width:150px; border:2px bold black;" name="order_month" placeholder="Select Order Month">
            <br>
            <label for="status"><br>Filter by Status:</label>
            <select name="status" id="status"  style="height:30px; width:150px; border:2px bold black;">
                <option disabled selected value>- Select</option> 
                <option value="complete" <?php if(isset($_GET['status']) && $_GET['status'] == 'complete') echo 'selected'; ?>>Complete</option>
                <option value="incomplete" <?php if(isset($_GET['status']) && $_GET['status'] == 'incomplete') echo 'selected'; ?>>Incomplete</option> 
            </select> 
            <button class="filter" type="submit">Filter</button><br><br>
        </form> <!-- Close the form tag here -->
        <div class="big-container">
            <?php
            // Check if the query executed successfully
            if ($result) {
                echo "<div class='big-container'>";
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

                    if ($status) {
                         // Display container with limited information
                         echo "<big><div class='container' id='container-$trackingNo' onclick='toggleDetails(\"$trackingNo\")'>";
                         echo"<img src='menu/logo_nb.png' style='display:none;'>";
                         echo "<strong>Tracking Number: $trackingNo</strong><br>";
                         echo "Name: $name<br>";
                         echo "Order date: $paydate<br>";
                         echo "<div class='details' id='details-$trackingNo' style='display: none;'>";
                         echo"<hr style='border-width:4px;  border:solid black; width:102%; '>";
                         echo "<br><h3>More Details:</h3>";
                         echo "Email: $email<br>";
                         echo "Phone: $phone<br>";
                         echo "Address: $address<br>";
                         echo "Payment Mode: $pmode<br>";
                         echo "Product that bought: $products<br>";
                         echo "Amount Paid: RM $amount_paid<br>";
                         echo "<p class='name' style='display:none;'> Name: $name</p><br>";
                         echo "<p class='date'style='display:none;'>Order date: $paydate</p>";
                         echo "</div>";
                         echo "<button onclick='printOrder(\"$trackingNo\")'>Print PDF</button>";
                         echo "</div> </big>"; // Close the container div
                    }
                }
                echo "</div>"; // Close the big-container div
            } else {
                echo "No order history found.";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
        <!-- JavaScript code to handle the toggle functionality -->
        <script>
            function toggleDetails(trackingNo) {
                const detailsDiv = document.getElementById(`details-${trackingNo}`);
                const containerDiv = document.getElementById(`container-${trackingNo}`);

                if (detailsDiv.style.display === 'none') {
                    detailsDiv.style.display = 'block';
                    containerDiv.classList.add('open'); // Add the 'open' class to expand width
                } else {
                    detailsDiv.style.display = 'none';
                    containerDiv.classList.remove('open'); // Remove the 'open' class to revert width
                }
            }


           function printOrder(trackingNo) {
  const detailsDiv = document.getElementById(`details-${trackingNo}`);
  const imageSrc = document.querySelector(`#container-${trackingNo} img`).src; // Get the image source
  const payDate = detailsDiv.querySelector('p').innerHTML; // Get the pay date value

  // Create a new window for printing
  const printWindow = window.open('', '', 'width=600,height=600');

  // Generate the content for the print window
  let content = "<html><head><title>Order Details</title></head><body>";
  content += `<img src="${imageSrc}" style="max-width: 200px; display:block; margin:-20px; margin-bottom:-50px;"><p>Jalan Ayer Keroh Lama, <br>75450 Bukit Beruang,<br> 
  Melaka</p> `;
  content += `<h1>Order Details - Tracking Number: ${trackingNo}</h1>`;
  const orderDate = detailsDiv.querySelector('p.date').innerText;
const name = detailsDiv.querySelector('p.name').innerText;

  content += `<p> ${orderDate}</p>`; // Include the order date
  content += `<p> ${name}</p>`; // Include the order date
  content += detailsDiv.innerHTML; // Copy the order details HTML
  content += `<br><br><br><br><br><br><p>Phone number: +60 19-590-9369<br>Email :<a href="mailto:1211204752@student.mmu.edu.my">1211204752@student.mmu.edu.my</a><br>F & C Fast Food Restaurant</p>`; // Include the pay date
  content += "</body></html>";

  // Write the content to the print window
  printWindow.document.open();
  printWindow.document.write(content);
  printWindow.document.close();

  // Focus and print the window
  printWindow.focus();
  printWindow.print();
}
        </script>
    </main>
</body>
</html>