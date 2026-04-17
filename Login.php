<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- icon link-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="Login.css">
	<style>
body
{
    font-family: Arial;
    padding: 10px;
    background-image:url('menu/pizza/pizza 10.jpg');
}

u{
    text-decoration: underline;
    text-decoration-color: blue;
}

.btn 
{
    background-color: white;
    color:blue;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

</style>
</head>
<body>

<?php        
		$host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'food';
        session_start();
        // Create connection
        $conn = mysqli_connect($host, $username, $password, $dbname);	
	?>

    <section class="container">
			<div class="col-md-12">
			  <div class="card bg-light mt-3 mb-3">
          <div class="card-header">
              <h5 class="card-title"><img src ="image/user.png">
              <fieldset data-role="controlgroup">
      </fieldset>
              <h4 style="text-align:center;">Login</h4>
          
<div>
  <button class="btn"><a href="index.html"><i class="fa fa-home"></i> Home</a></button>
  <button class="btn"><a href="Register.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg> Register</a></button>
</div>
			
			</div>
          <div class="card-body">
					<form  method="post">

						<div class="form-group">
							<label>Email :</label>						
							<input type="email" class="form-control" name="email" required>
						</div>

						<div class="form-group">
							<label>Password :</label>
							<input type="password" class="form-control" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,11}" 
							title="Password must contain between 8 to 11 characters and atleast 1 Alphabet and 1 Number">
						</div>
                        
						<div class="text-left">
							<button type="submit" name="login" class="btn btn-primary">
                            <i class="fa fa-user"></i> Login
							</button>
  							<br>
							<label>Does not have an account?</label>
                            <br>
                            <u><a href="Register.php?register">Create an Account</a> </u>
                            <br><br>
                            <label>Forgot Password?</label><br>
                            <u><a href="resetpass.php">Found Password</a> </u>
						</div>
                        

                        <?php
// Connect to the database
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST["login"])) {
    // Get the user's credentials from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM customer WHERE email = '$email' AND blocked != 1  AND Password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    // Check if the user exists and the password is correct
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Store user details in session variables
        $_SESSION["customeremail"] = $row["email"];
        $_SESSION["user_id"] = $row["id"];

        if ($row['admin'] == 1) {
            // User is an admin, redirect to admin.php
            header("Location: admin.php");
            exit();
        } else if ($row['admin'] == 0) {
            // User is not an admin, redirect to index.html
            header("Location: main.php");
            exit();
        }
    } else {
        // User does not exist or is blocked
        echo "<script type='text/javascript'>alert('The email was invalid or the account was blocked');</script>";
    }
}
?>
      </body>
      </html>