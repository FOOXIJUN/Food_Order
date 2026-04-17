<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_header.css">
    <title>header</title>
<style>
header 
{
	background-color: #333;
	color: #fff;
	padding: 20px;
    border: 5px solid #ddd;    
}

body 
{
  background-image: url("image/paper.jpg");
}

nav ul 
{
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #f1f1f1;
    
}

nav li 
{
    font-size: 20px;
   
}

nav ul li 
{
    display: inline-block;
    position: relative;
}

nav ul li a 
{
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    }

nav ul li:hover > ul 
{
    display: block;
}

nav ul ul 
{
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #f1f1f1;
    padding: 0;
}

nav ul ul li 
{
    display: block;
    width: 100px;
}

nav ul ul li a 
{
    padding: 8px 10px;
}
</style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="admin_page.php">Admin home</a></li>
            <li><a href="admin_customer.php">Managed Customer</a></li>
            <li><a href="contact_admin.php">File Contact</a></li>
            <li><a href="Adminaddfood.php">Add Food</a></li>
            <li>
                <a href="Adminremovefood.php">Manage Food</a>
                <ul>
                    <li><a href="adminremoveburger.php">Burger</a></li>
                    <li><a href="adminremovepizza.php">Pizza</a></li>
                    <li><a href="adminremovesnack.php">Snack</a></li>
                    <li><a href="adminremovedrink.php">Drink</a></li>
                </ul>
            </li>
            <li><a href="order.php">Order </a></li>
        <li><a href="order_detail.php">Order History</a></li>
            <li><a href="admin_logout.php">Log out</a></li>
        </ul>
    </nav>
</body>
</html>