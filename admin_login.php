<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
        $conn = mysqli_connect($host, $username, $password, $dbname);	
	?>

    <section class="container">
			<div class="col-md-12">
			  <div class="card bg-light mt-3 mb-3">
          <div class="card-header">
              <h5 class="card-title"><img src ="image/user.png">
              <fieldset data-role="controlgroup">
      </fieldset>
              <h5 style="text-align:center;">Login</h5>
        
			
			</div>
          <div class="card-body">
					<form  method="post">

						<div class="form-group">
							<label>Email :</label>						
							<input type="email" class="form-control" name="email" required>
						</div>

                        <div class="form-group">
                            <label>Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" required minlength="8"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,11}" id="password">
                                <div class="input-group-append">
                                    <span class="input-group-text password-toggle" onclick="togglePasswordVisibility('password')">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
						<div class="text-left">
							<button type="submit" name="login" class="btn btn-primary">
                            <i class="fa fa-user"></i> Login
							</button>
  							<br>
						</div>

                        <?php
@include 'Connectdb.php';

if (isset($_POST['login'])) {
   $email = $_POST['email'];
    $password = $_POST['password'];

   $select = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      if ($password == $row['password']) {
         // Password is correct, start a new session
         $_SESSION['email'] = $email;
         echo '<script>alert("Login successful!")</script>';
         echo "<script>window.location.href = 'admin_page.php'</script>";
         exit;
      } else {
         // Password is not correct
         echo '<script>alert("Incorrect password!")</script>';
      }
   } else {
      // User not found
      echo '<script>alert("User not found!")</script>';
   }
}
?>
    <!-- JavaScript import -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Password visibility toggle
        function togglePasswordVisibility(inputId) {
            var input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                document.querySelector(".password-toggle i").className = "bi bi-eye";
            } else {
                input.type = "password";
                document.querySelector(".password-toggle i").className = "bi bi-eye-slash";
            }
        }
    </script>
      </body>
      </html>