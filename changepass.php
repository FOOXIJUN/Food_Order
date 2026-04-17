<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f7f7f7;
		}
		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			max-width: 400px;
			margin: 0 auto;
			margin-top: 50px;
		}
		label {
			display: block;
			margin-bottom: 5px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.2s;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>

        <?php
            include("Connectdb.php");
            $email = $_GET['email'];

            if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                 // Check if new password and confirm password match
                 if ($_POST['new_password'] === $_POST['confirm_password']) {
                     $new_password = $_POST['new_password'];
                     // Update the user's password in the database
                     mysqli_query($conn, "update customer set Password='$new_password' where email='$email'");
                     // Show success message and redirect to mainmenu.php after a delay
                     echo "<script>alert('Password updated successfully!');setTimeout(function(){window.location.href='login.php';}, 500);</script>";
                 } else {
                     echo "New Password is Not Match with the Confirm Password.";
                 }
             }
        ?>
	<form method="POST">
	    <h1>Update Password</h1>
	    <label for="new_password">New Password:</label>
	    <input type="password" name="new_password" id="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,11}" 
							title="Password must contain between 8 to 11 characters and atleast 1 Alphabet and 1 Number">
	    <br>
	    <label for="confirm_password">Confirm New Password:</label>
	    <input type="password" name="confirm_password" id="confirm_password" required>
	    <br>
	    <input type="submit" value="Update Password">
	</form>
</body>
</html> 