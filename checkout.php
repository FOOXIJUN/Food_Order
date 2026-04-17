<?php
require 'user_valid.php';
	require 'Connectdb.php';
  session_start();
	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart  WHERE user_id = ?";
  $user_id = $_SESSION['user_id'];
	$stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price']; 
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
  
  // Check if the form is submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Assuming the payment is successful, you can capture the payment date
		$paymentDate = date('Y-m-d'); // Current date

		// Store the payment date in the database
		$sql = "UPDATE cart SET pay_date = ? WHERE user_id = ?"; // Modify this query according to your table structure
		$stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $paymentDate, $user_id);
		$stmt->execute();

		// Check if the update was successful
		if ($stmt->affected_rows > 0) {
			// Payment date successfully stored in the database
			// You can perform any additional actions or display a success message here
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
<style> 
@import url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .container {
      margin-top: 40px;
    }
    #order {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .text-info {
      color: #17a2b8;
    }
    .lead {
      font-size: 16px;
    }
    .text-center {
      text-align: center;
    }
    .jumbotron {
      background-color: #f8f9fa;
      border: none;
      margin-bottom: 20px;
    }
    h4 {
      font-size: 18px;
      font-weight: 600;
    }
    h5 {
      font-size: 16px;
      font-weight: 600;
    }
    form {
      margin-top: 20px;
    }
    .form-control {
      margin-bottom: 10px;
    }
    .btn-block {
      width: 100%;
    }
    /* delivery status checking icon */
    .cdit{
      display:none;
    }

  </style>
</head>

<body>
<?php
include('userheader.php');
?>
 <br> <br> <br> <br> <br>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input  name="products" type="hidden" value="<?= $allItems; ?>">
          <input  name="grand_total" type="hidden"value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required minlength='10' maxlength='11'>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">

             <!-- Select method -->

            <select id="mySelect" name="pmode" class="form-control"  onchange="showHideTextbox()" method="post" required >
            <option value="" disabled selected >Select your option</option>
              <option value="cards" >Debit/Credit Card</option>
            </select>
          </div>

             <!--Card holder detail -->
          <div  id="myTextbox" style="display:none;" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
          <h4 style="align-items: center">Payment Details</h4>
							<div class="form-group">
								<label>Card Number <span class="text-danger">*</span></label>
								<input type="text" name="cardNumber" id="cardNumber" class="form-control" maxlength="16" minlength="16" placeholder="xxxx xxxx xxxx xxxx"  onkeypress="">
								<span id="errorCardNumber" class="text-danger"></span>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Expiry Month</label>
										<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
										<span id="errorCardExpMonth" class="text-danger"></span>
									</div>
									<div class="col-md-4">
										<label>Expiry Year</label>
										<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
										<span id="errorCardExpYear" class="text-danger"></span>
									</div>
									<div class="col-md-4">
										<label>CVC</label>
										<input type="text" name="cardCVC" id="cardCVC" class="form-control" placeholder="123" maxlength="3" onkeypress="return validateNumber(event);">
										<span id="errorCardCvc" class="text-danger"></span>
									</div>
								</div>
							</div>
          </div>
  
          <br>

    <!--Submit button-->
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  function showHideTextbox() {
    var select = document.getElementById("mySelect");
    var textbox = document.getElementById("myTextbox");
      
    if (select.value == "cards") {
      textbox.style.display = "block";
    } else {
      textbox.style.display = "none";
    }
  }

  function validateNumber(event) {
    var key = event.keyCode;
    return (key >= 48 && key <= 57);
  }

  function getCurrentYear() {
    var currentDate = new Date();
    return currentDate.getFullYear();
  }

  function validateCardDetails() {
  var cardNumber = document.getElementById("cardNumber").value;
  var cardExpMonth = document.getElementById("cardExpMonth").value;
  var cardExpYear = document.getElementById("cardExpYear").value;
  var cardCVC = document.getElementById("cardCVC").value;

  if (cardNumber.length !== 16) {
    document.getElementById("errorCardNumber").textContent = "Please enter a valid card number.";
    return false;
  }
  if (cardExpMonth < 1 || cardExpMonth > 12) {
    document.getElementById("errorCardExpMonth").textContent = "Please enter a valid expiry month (1-12).";
    return false;
  }
  var currentYear = getCurrentYear();
  if (cardExpYear == currentYear && cardExpMonth < getCurrentMonth()) {
    document.getElementById("errorCardExpMonth").textContent = "Please enter a valid expiry month.";
    return false;
  }
  if (cardExpYear < currentYear) {
    document.getElementById("errorCardExpYear").textContent = "Please enter a valid expiry year.";
    return false;
  }
  if (cardCVC.length !== 3) {
    document.getElementById("errorCardCvc").textContent = "Please enter a valid CVC.";
    return false;
  }

  return true;
}
function getCurrentMonth() {
  var currentDate = new Date();
  return currentDate.getMonth() + 1; // Months are zero-based, so add 1 to get the actual month
}


  $(document).ready(function() {
  $("#placeOrder").submit(function(e) {
    e.preventDefault();
    if ($("#mySelect").val() === "cards" && !validateCardDetails()) {
      return false;
    }
    $.ajax({
      url: 'action.php',
      method: 'post',
      data: $('form').serialize() + "&action=order",
      success: function(response) {
        $("#order").html(response);
      }
    });
  });

  load_cart_item_number();

function load_cart_item_number() {
  $.ajax({
    url: 'action.php',
    method: 'get',
    data: {
      cartItem: "cart_item",
      user_id: "<?php echo $_SESSION['user_id']; ?>" // Add user_id to the request data
    },
    success: function(response) {
      $("#cart-item").html(response); 
    }
    });
  }
});

</script>


  
</body>

</html>