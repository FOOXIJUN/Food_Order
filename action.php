<?php
	session_start();
	require 'Connectdb.php';
?>

	<?php
	$user_id = $_SESSION['user_id'];
	// Add products into the cart table
	if (isset($_POST['id'])) {
	  $id = $_POST['id'];
	  $name = $_POST['name'];
	  $price = $_POST['price'];
	  $image = $_POST['image'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $user_id = $_SESSION['user_id'];
	  $total_price = $price * $pqty;

	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND user_id=?');
	  $stmt->bind_param('si', $pcode, $user_id);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (product_name, product_price, product_image, qty, total_price, product_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
	    $query->bind_param('ssssssi', $name, $price, $image, $pqty, $total_price, $pcode, $user_id);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2"  style="padding-top: 10px;padding-bottom:4px;margin-top:-20px;">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } 
	  else 
	  {
	    echo '<div class="alert alert-danger alert-dismissible mt-2" style="padding-top: 10px; padding-bottom:4px; margin-top:-20px;">
						  <button type="button" class="close" data-dismiss="alert" >&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
		$stmt = $conn->prepare('SELECT * FROM cart WHERE user_id = ?');
		$stmt->bind_param('i', $user_id);
		$stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
		$stmt = $conn->prepare('DELETE FROM cart WHERE user_id=?');
		$stmt->bind_param('i', $user_id);

		$stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=? ');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	function generateTrackingNumber($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$trackingNumber = '';
	
		for ($i = 0; $i < $length; $i++) {
			$randomIndex = mt_rand(0, strlen($characters) - 1);
			$trackingNumber .= $characters[$randomIndex];
		}
	
		return $trackingNumber;
	}
	$trackingNumber = generateTrackingNumber();
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];

	  $data = '';
	  $user_id = $_SESSION['user_id'];

	  $stmt = $conn->prepare('INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid, tracking_no, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
	  $stmt->bind_param('ssssssssi', $name, $email, $phone, $address, $pmode, $products, $grand_total, $trackingNumber, $user_id);
	  $stmt->execute();
	  $stmt2 = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
	  $stmt2->bind_param('i', $user_id);
	  $stmt2->execute();
	$data .= '
	<style>
	.cdit{
		display:block;
	  }
	  .badge
	  {
		display:non;
	  }

	</style>
	<div class="text-center">
                <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                <h2 class="text-success">Your Order Placed Successfully!</h2>
                <h4 class="bg-danger text-light rounded p-2">Items Purchased: ' . $products . '</h4>
                <h4>Your Name: ' . $name . '</h4>
                <h4>Your E-mail: ' . $email . '</h4>
                <h4>Your Phone: ' . $phone . '</h4>
                <h4>Total Amount Paid: RM ' . number_format($grand_total,2) . '</h4>
                <h4>Payment Mode: ' . $pmode . '</h4> 
                <h4>Tracking Number: ' . $trackingNumber . '</h4>
				<a href="order_user.php" class="btn btn-primary">Order Detial</a>
                <a href="pizza.php" class="btn btn-primary">Order More</a>
            </div>';

echo $data;
	}
?>