<!DOCTYPE html>
<html lang="en">
<!-- icon link-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="Customerprofile.css">
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

button 
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="Customerprofile.css">
    <style>
        /* CSS styles */
    </style>
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

    $cus_email = $_SESSION["customeremail"];

    $sql = "SELECT * FROM customer WHERE email='$cus_email'";
    // Check connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $customer_id = $row['id'];
    $customer_name = $row['name'];
    $customer_mobile = $row['nomobile'];
    $customer_address = $row['address'];
    $customer_poscode = $row['poscode'];
    $customer_country = $row['country'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // update customer details
        $customer_mobile = $_POST['customer_mobile'];
        $customer_address = $_POST['customer_address'];
        $customer_poscode = $_POST['customer_poscode'];
        $customer_country = $_POST['customer_country'];

        $update_sql = "UPDATE customer SET name='$customer_name', nomobile='$customer_mobile', address='$customer_address', poscode='$customer_poscode', country='$customer_country' WHERE id=$customer_id";

        if (mysqli_query($conn, $update_sql)) {
            // update successful
            echo "<script type='text/javascript'>alert('Customer details updated successfully!');</script>";
        } else {
            // update failed
            $error_message = "Error updating customer details: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    ?>

    <?php
    include('userheader.php');
    ?>

    <br><br><br><br>
    <h1>Your Profile</h1>

    <div class="center">
        <form method="POST">
            <table>
                <tr>
                    <td>Subject</td>
                    <td>Customer details</td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><?php echo $row["email"]; ?></td>
                </tr>
                <tr>
                    <td>Full Name :</td>
                    <td><?php echo $customer_name; ?></td>
                </tr>
                <tr>
                    <td>Mobile :</td>
                    <td><input type="text" name="customer_mobile" value="<?php echo $customer_mobile; ?>" maxlength="11"></td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td><input type="text" name="customer_address" value="<?php echo $customer_address; ?>"></td>
                </tr>
                <tr>
                    <td>Poscode :</td>
                    <td><input type="text" name="customer_poscode" value="<?php echo $customer_poscode; ?>" maxlength="5" minlength="5"></td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td>
                        <select name="customer_country">
                            <option value="Johor" <?php if ($customer_country === 'Johor') echo 'selected'; ?>>Johor</option>
                            <option value="Melaka" <?php if ($customer_country === 'Melaka') echo 'selected'; ?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php if ($customer_country === 'Negeri Sembilan') echo 'selected'; ?>>Negeri Sembilan</option>
                            <option value="Selangor" <?php if ($customer_country === 'Selangor') echo 'selected'; ?>>Selangor</option>
                            <option value="Perak" <?php if ($customer_country === 'Perak') echo 'selected'; ?>>Perak</option>
                            <option value="Kedah" <?php if ($customer_country === 'Kedah') echo 'selected'; ?>>Kedah</option>
                            <option value="Perlis" <?php if ($customer_country === 'Perlis') echo 'selected'; ?>>Perlis</option>
                            <option value="Pulau Pinang" <?php if ($customer_country === 'Pulau Pinang') echo 'selected'; ?>>Pulau Pinang</option>
                            <option value="Kelantan" <?php if ($customer_country === 'Kelantan') echo 'selected'; ?>>Kelantan</option>
                            <option value="Terengganu" <?php if ($customer_country === 'Terengganu') echo 'selected'; ?>>Terengganu</option>
                            <option value="Pahang" <?php if ($customer_country === 'Pahang') echo 'selected'; ?>>Pahang</option>
                            <option value="Sabah" <?php if ($customer_country === 'Sabah') echo 'selected'; ?>>Sabah</option>
                            <option value="Sarawak" <?php if ($customer_country === 'Sarawak') echo 'selected'; ?>>Sarawak</option>
                            <!-- Add more states as needed -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td>
                        <input type="button" name="Reset" id="button" value="Change" onclick="location.href='newpass.php ?>'">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update"></td>
                </tr>
                <?php if (isset($success_message)) { ?>
                    <tr>
                        <td></td>
                        <td><span class="success"><?php echo $success_message; ?></span></td>
                    </tr>
                <?php } ?>
                <?php if (isset($error_message)) { ?>
                    <tr>
                        <td></td>
                        <td><span class="error"><?php echo $error_message; ?></span></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </div>
</body>
</html>


