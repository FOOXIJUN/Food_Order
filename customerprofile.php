<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://fontawesome.com/search?q=door&c=users-people&o=r">
<link rel="stylesheet" href="customerprofile.css">
<style>
body 
{
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
}
h1
{
    background-image: url('menu/image_1.jpg');
    background-size: cover;
    color: white;
    text-align: center;
    padding: 2em;
    font-size: 2em;
}

.menu-bar 
{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #444;
    padding: 1em 2em;
    font-size: 1.2em;
}

.menu-bar a
{
    text-decoration: none;
    color: white;
    margin: 0 1em;
    font-weight: bold;
    border-radius: 16px;
    padding: 1em 2em;
    transition: background-color 0.2s ease;
}

.menu-bar a:hover 
{
    background-color: #666;
}

table 
{
    margin: 2em auto;
    border-collapse: collapse;
    width: 50%;
    box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.1);
    background-color: linen;
}

th, td 
{
    border: 1px solid #ccc;
    padding: 1em;
    text-align: left;
}

th 
{
    background-color: #eee;
    font-weight: bold;
}

body
{
     background-color: powderblue;
}

#but
{
    background-color: #8bc34a;
    border: none;
    color: white;
    padding: 1em 2em;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1em;
    margin: 0.5em;
    cursor: pointer;
    border-radius: 16px;
    transition: background-color 0.2s ease;
    box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.1);
}

.left 
{
    float: left;
    width: 30%;
    margin-top: 2em;
    margin-left: 2em;
}

.left h2 
{
    text-align: center;
}

.left table 
{
    margin-top: 1em;
}

.right 
{
    float: right;
    width: 60%;
    margin-top: 2em;
    margin-right: 2em;
}

</style>
<head>
    <title>Customer Profile</title>
</head>
<body>
    <?php
    session_start();
    // MySQL database credentials
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'food';

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    $cus_email=$_SESSION["customeremail"];

    

    $sql="select * from customer where email='$cus_email'";
    // Check connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    //$email=$_GET['email'];
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $customer_name= $row['name'];
    $customer_nomobile = $row['nomobile'];
    $customer_password = $row['password'];
    $customer_address = $row['address'];
    $customer_poscode = $row['poscode'];
    $customer_country = $row['country'];



// Close connection
//mysqli_close($conn);
?>
<?php
include('userheader.php')
?>
        <br><br><br>
        <h1>Your Profile</h1>

        <div class="center">
        <table>
    <tr>
        <td>Email :</td>
        <td><?php echo $row["email"]; ?></td>
    </tr>
    

    <tr>
        <td>Full Name:</td>
        <td><?php echo $customer_name; ?></td>
    </tr>

    <tr>
        <td>Contact Number:</td>
        <td><?php echo $customer_nomobile; ?></td>
    </tr>

    <tr>
        <td>Address:</td>
        <td><?php echo $customer_address; ?></td>
    </tr>

    <tr>
        <td>Postcode:</td>
        <td><?php echo $customer_poscode; ?></td>
    </tr>

    <tr>
        <td>State:</td>
        <td><?php echo $customer_country; ?></td>
    </tr>
</table>

        <div>
            <button id="but"><a href='customerreset.php'>Edit profile</a></button>
        </div>
    </div>
    </div>
<?php
include('userfooter.php')
?>
</body>
</html>