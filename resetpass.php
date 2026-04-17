<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }
        form 
        {
            background-color: white;
            width: 50%;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        label 
        {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] 
        {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        button[type="submit"] 
        {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover 
        {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label>Your Email:</label>
        <input type="email" name="email" required>
        <label>What is you hero?</label>
        <input type="text" name="hero" required>
        <br>
        <?php
        include("Connectdb.php");
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Get the user input
            $email = $_POST['email'];
            $hero = $_POST['hero'];

            // Prepare a SQL query to retrieve the user with the matching username and email
            $query = "SELECT * FROM customer WHERE email = '$email'";
            $query = "SELECT * FROM customer WHERE hero = '$hero'";
            // Execute the query
            $result = mysqli_query($conn, $query);

            // Check if a user was found
            if (mysqli_num_rows($result) == 1) {
                    header("Location: changepass.php?email=$email");
                        exit();
            }
            else 
            {
            // User not found, display an error message
            echo "<script type='text/javascript'>alert('invalid email or hero !');</script>";
            }
    }
    ?>
    <input type="submit" value="Submit">
</form>
</body>
</html>