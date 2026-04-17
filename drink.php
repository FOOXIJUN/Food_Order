<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
  <style>
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch; /* Updated to stretch instead of center */
    padding: 10px;
    padding-left: 120px;
    height: auto;
    max-width: 1700px;

  }

  .col-sm-6 {
    display: flex;
    width: 350px;
    flex-wrap: wrap;
    border: 2px solid black;
    border-radius: 0.25rem;
    float: left;
    margin: 20px;
    transition: transform 0.3s; /* Add transition property for smooth animation */
  }

.col-sm-6:hover {
  transform: scale(1.02); /* Enlarge the element on hover */
  border: 2.2px solid black;
}

 .card {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  padding: 20px;
  display: auto;

}

.card-img-top {
  width: 100%;
  height: auto;
}

.card-title {
  font-size: 1.4rem;
  font-weight: bold;
  text-align: center;
  color: #17a2b8;
  width: 100%;
  height: auto;
  display: block; /* 将标题显示在下一行 */
  overflow: hidden; /* 隐藏溢出的文本 */
  text-overflow: ellipsis; /* 使用省略号表示溢出的文本 */
}

.card-text {
  font-size: 1.25rem;
  font-weight: bold;
  text-align: center;
  color: #17a2b8;
  width: 300px;
  height: 50px; /* Limit the height of the product name */
  overflow: hidden; /* Hide any overflowing text */
  text-overflow: ellipsis; /* Add ellipsis (...) for truncated text */
  white-space: nowrap; /* Prevent wrapping of text */
  height: auto;
}

.card-footer .row {
  display: flex;
  align-items: center;
}

.card-footer .col-md-6 {
  display: flex;
  align-items: center;
}

.card-footer .col-md-6 input {
  margin-left: 10px;
}

.form-control {
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-info {
  color: #fff;
  background-color: #17a2b8;
  width: 100%;
  padding: 0.75rem;
  font-size: 1.2rem;

}
.btn-info:hover
{
  background-color:rgb(28, 133, 208);
  border: 3px solid black;
  transform: scale(1.05);
  border-radius: 5%;
}
.paging {
  display: flex;

  margin-top: 20px;
}

.paging a {
  display: inline-block;
  padding: 5px 10px;
  margin-right: 5px;
  border: 1px solid #ccc;
  text-decoration: none;
}

.paging a.active {
  background-color: #17a2b8;
  color: #fff;
  border-color: #17a2b8;
} 

#cart-icon
{
color:  rgb(51, 163, 242);
}
#cart-item
{
  color: white;
  background-color: red;
  border: 1px solid black;
  padding:0px 4px 0px 4px;
margin-bottom: 2px;
margin-top: 2px;
border-radius: 5px;
font-weight:600;
}

#cart-icon:hover
{
color: rgb(4, 63, 191);


}

#message
{
  width: 100%;
  height:auto;
  font-size: 20px;
  }

#message .alert-success
{

border-radius: 5px;
padding-left: 20px;
 background-color: rgb(171, 214, 175);
}

#message .alert-danger
{
  width: 100%;
border-radius: 5px;
padding-left: 20px;
background-color: rgb(246, 30, 30);
}

.close
  {
    float:right;
    background-color: transparent;
font-weight: bolder;
    font-size: 30px;
border: none;
margin-top: -10px;
margin-right: 30px;

  }
  </style>
</head>

<body>
<?php
require 'user_valid.php';
include('userheader.php');
?>

<br><br><br><br><br>

  <!-- Displaying Products Start -->
  <div class="container">
  <form id="searchForm" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="searchInput">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br><br><br><br>
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include 'Connectdb.php';
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        $query = "SELECT * FROM drink WHERE blocked = 0 AND name LIKE '%$searchTerm%'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo "<p>No products found.</p>";
        }
        
        while ($row = $result->fetch_assoc()):
        ?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">    <!-- p_name和价钱 -->
              <h4 class="card-title text-center text-info"><?= $row['name'] ?> (tin)</h4><br>
              <h5 class="card-text text-center text-danger">RM</i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?>/-</h5>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit" style="align-items: flex-end;">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                  <br>  <br>  <br>    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="id" value="<?= $row['id'] ?>">
                <input type="hidden" class="name" value="<?= $row['name'] ?>">
                <input type="hidden" class="price" value="<?= $row['price'] ?>">
                <input type="hidden" class="image" value="<?= $row['image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var id = $form.find(".id").val();
      var name = $form.find(".name").val();
      var price = $form.find(".price").val();
      var image = $form.find(".image").val();
      var pcode = $form.find(".pcode").val();
      var pqty = $form.find(".pqty").val();

      if (pqty <= 0) {
        alert("Quantity must be greater than 0.");
        return;
      }
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          id: id,
          name: name,
          price: price,
          pqty: pqty,
          image: image,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });

  $(document).ready(function() {
  // 计算最高的边框高度
  var maxBorderHeight = 0;
  $('.col-sm-6').each(function() {
    var borderHeight = $(this).outerHeight();
    if (borderHeight > maxBorderHeight) {
      maxBorderHeight = borderHeight;
    }
  });

  // 应用最高边框高度给所有 .col-sm-6 元素
  $('.col-sm-6').css('height', maxBorderHeight + 'px');
});
$(document).ready(function() {
  // Handle search form submission
  $('#searchForm').submit(function(e) {
    e.preventDefault();
    var searchTerm = $('#searchInput').val();
    // Reload the page with the search query parameter
    window.location.href = 'drink.php?search=' + encodeURIComponent(searchTerm);
  });
});
  </script>
</body>

</html>