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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View customer feedback</title>
    <link rel="stylesheet" href="contact_admin.css">
    <link rel="stylesheet" href="admin_homepage.css">
<style>
header h1
{
    height: 20px;
    text-align: center;
}
table 
{
    width: 100%;
    border-collapse: collapse;
    border: 5px solid #ddd;
}
  
th, td 
{
    text-align: center;
    padding: 12px;
    
}
  
th 
{
    background-color: #f2f2f2;
}
  
tbody tr:nth-child(even) 
{
    background-color: #f2f2f2;
}

  
input[type="text"], input[type="number"], textarea 
{
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}
  
button[type="submit"] 
{
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

        </style>
</head>
<body>
<header>
        <h1>FILE FEEDBACK</h1>
</header>
<?php
include('admin_header.php')
?>
    <br>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Message</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
$host = "localhost";
$product ="root";
$pass = "";
$database =  "food"; //database name.

$connect = mysqli_connect($host, $product, $pass, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $delete_contact = "DELETE FROM contact WHERE id=$id";
    mysqli_query($connect, $delete_contact);
}

if (isset($_POST["reply"])) {
    $to_email = $_POST["to_email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $headers = "From: your-email@domain.com";
    mail($to_email, $subject, $message, $headers);
    echo "<script type='text/javascript'>alert('Email sent successful!');</script>";
}

$get_contacts = "SELECT * FROM contact";
$run_contacts = mysqli_query($connect, $get_contacts);

while ($row = mysqli_fetch_assoc($run_contacts)) 
{
    $id = $row["id"];
    $name = $row["name"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
    $message = $row["message"];

    echo "<tr>";
    echo "<form method='post'>";
    echo "<td>$id</td>";
    echo "<td>$name</td>";
    echo "<td>$email</td>";
    echo "<td> $phone_number</td>";
    echo "<td><textarea>$message</textarea></td>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<td>";
    echo "<button type='submit' name='delete'>Delete</button>";
    echo "<td><button type='button' onclick='showReplyForm(\"$email\")'>Reply</button></td>";
    echo "</td>";
    echo "</form>";
    echo "</tr>";
}
mysqli_close($connect);
?>

        </tbody>
    </table>
</div>
<div id="reply-form-container" style="display:none;">
    <form method="post">
    <h3>Reply to customer</h3>
    <label for="to_email">To:</label>
    <input type="email" name="to_email" id="to_email" required>
    <br>
    <label for="subject">Subject:</label>
    <input type="text" name="subject" id="subject" required>
    <br>
    <label for="message">Message:</label>
    <textarea name="message" id="message" rows="10" required></textarea>
    <br>
    <button type="submit" name="reply">Send</button>
</form>
</div>
<script>
    function showReplyForm(email) {
        const replyForm = document.getElementById("reply-form-container");
        replyForm.style.display = "block";

        const toEmailInput = document.getElementById("to_email");
        toEmailInput.value = email;
    }
</script>
</body>
</html>
