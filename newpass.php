<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot Password</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        form {
            background-color: white;
            width: 30%;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label 
        {
            display: block;
            margin-top: 10px;
        }

        input[type="text"] 
        {
            width: 50%;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        input[type="submit"] 
        {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover 
        {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label>Enter your Old password :</label>
        <input type="password" name="password" required>
        <br>
        <?php
        include("Connectdb.php");
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Get the user input
            $password = $_POST['password'];

            //link the cutomer password
            $query = "SELECT * FROM customer WHERE password = '$password'";

            // Execute the query
            $result = mysqli_query($conn, $query);

            // Check if a user was found
            if (mysqli_num_rows($result) == 1) 
            {
                    header("Location: new pass.php?password=$password");
                        exit();
            }
            else 
            {
            // User not found, display an error message
            echo "<script type='text/javascript'>alert('Please enter old password was correct!');</script>";
            
            }
    }
    ?>
    <input type="submit" value="Submit">
</form>
</body>
</html>