<!DOCTYPE html>
<html lang="en">
<head>
    <title>project</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

*
{
    padding:0;
    margin:0;
    box-sizing:border-box;
}

.topnav 
{
  overflow: hidden;
  background-color: #333;
}

.topnav a 
{
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

body
{
    margin: 0;
    padding: 0;
    background: url(menu/image_1.jpg);
    background-size: cover;
}

.contact-form
{
    width: 85;
    max-width: 600px;
    background: #f1f1f1;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 30px 40px;
    box-sizing: border-box;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 0 20px #000000b3;
    font-family: "montserrat", sans-serif;
    border: 4px solid;
}

.contact-form h1
{
    margin-top: 0;
    font-weight: 200;
}

.txtb
{
    border: 1px solid gray;
    margin: 8px 0;
    padding: 12px 18px;
    border-radius: 8px;
}

.txtb label
{
    display: block;
    text-align:left;
    color: #333;
    text-transform: uppercase;
    font-size: 14px;
}

.txtb input, .txtb textarea
{
    width: 100%;
    border: none;
    background: none;
    outline: none;
    font-size: 18px;
    margin-top: 6px;
}

.btn
{
    display: block;
    background: #9b59b6;
    padding: 14px 0;
    color: white;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 8px;
    width: 100%;
}

.btn div:hover
{
    background: #2bab0d;
}

footer {
    position: absolute;
    bottom: 0; 
    display: block;
    top: 600px;
}

</style>
</head>
<body>
<?php
include('userheader.php')

?>
    <form  method="POST" action="">
        <div class="contact-form">
            <h1><b>Contact Us</b></h1>

            <div class="txtb">
                <label>FULL NAME :</label>
                <input type="text" name="fname"  placeholder="Enter Your Name" maxlength="20" required>
            </div>

            <div class="txtb">
                <label>EMAIL : </label>
                <input type="email" name="femail"   placeholder="ALI1234@gmail.com" required>
            </div>

            <div class="txtb">
                <label>PHONE NUMBER : </label>
                <input type="number" name="fnumber"  placeholder="000-0000000" maxlength="11">
            </div>

            <div class="txtb">
                <label>Message :</label>
                <textarea name="fmessage" ></textarea>
            </div>
            <input type="submit" name="fbutton" value="send" class="btn">
        </div>
    </form>

    <?php
    include('userfooter.php')
    ?>
</body>
</html>

<!-- the php format must follow -->
<?php
require 'user_valid.php';
$host = "localhost";
$product ="root";
$pass = "";
$database = "food"; //database name.

$connect= mysqli_connect($host, $product, $pass, $database);

//if error
if(!$connect)
{
    die("Fail".mysqli_connect_error());
}
//function will save the data to contac.
if(isset($_POST['fbutton']))
{
    $yname= $_POST["fname"];
    $yemail= $_POST["femail"];
    $ynumber = $_POST["fnumber"];
    $ymessage = $_POST["fmessage"];
                                                        //data neme                             the data must given the name to store the value
    $sql = mysqli_query($connect,"INSERT INTO contact(name,email,phone_number,message) VALUES('$yname','$yemail','$ynumber','$ymessage')");
}
?>