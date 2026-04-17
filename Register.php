<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
	<!--icon link-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="Register.css">
	
	<style>
body
{
    font-family: Arial;
    padding: 10px;
    background-image:url('menu/pizza/pizza 10.jpg');
}

.btn {
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
	include("Connectdb.php");		
		include("Header.php");
	?>

<body style="background-color:powderblue;">
    <section class="container">
			<div class="col-md-12">
			  <div class="card bg-light mt-3 mb-3">
          <div class="card-header">
              <h5 class="card-title"><img src ="image/user.png"><h5 style="text-align:center;">Register</h5>
          
              
              <div>
  <button class="btn"><a href="index.html"><i class="fa fa-home"></i> Home</a></button>
  <button class="btn"><a href="Login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log In</a></button>
</div>


			</div>
          <div class="card-body">
					<form action="register.php" method="post">
						<div class="form-group">
							<label>Full Name :</label>
							<input type="text" class="form-control" name="name" required>
						</div>

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

						<div class="form-group">
							<label>Contact Number :</label>
							<input type="text" class="form-control" name="nomoblie" minlength="10" maxlength = "11" required>
						</div>

						<div class="form-group">
							<label>Address :</label>
							<input  class="form-control" name="address" required> 
						</div>

						<div class="form-group">
							<label>Postcode :</label>
							<input name="poscode" minlength="5"  maxlength="5"  required> 
						</div>

						<div class="form-group">
							<label>State:</label>
							<select name="country">
								<option>Johor</option>
								<option>Melaka</option>
								<option>Negeri Sembilan</option>
								<option>Selangor</option>
								<option>Perak</option>
								<option>Kedah</option>
								<option>Perlis</option>
								<option>Pulau Pinang</option>
								<option>Kelantan</option>
								<option>Terangganu</option>
								<option>Pahang</option>
								<option>Sabah</option>
								<option>Sarawak</option>
							</select>
						</div>

						<div class="form-group">
							<label>What is your hero? Please remember answer for you forget password!</label>
							<input type="text" class="form-control" name="hero" required>
					</div>
						<div class="text-left">
							<button type="submit" name="register" class="btn btn-primary">
								<i class="fa fa-user"> Register</i> 
							</button>
							<br>
<?php

	if(isset($_POST['register']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$Password = $_POST['password'];
		$nomobile = $_POST['nomoblie'];
		$address = $_POST['address'];
		$country = $_POST['country'];
		$poscode = $_POST['poscode'];
		$hero = $_POST['hero'];

$checkexisting = "SELECT email FROM customer WHERE email = '$email'";
$checkemail = mysqli_query($conn, $checkexisting);

if (!$checkemail) 
{
    echo "Error: " . mysqli_error($conn);
} 
else if (mysqli_num_rows($checkemail) != 0) 
{
	echo "<script type='text/javascript'>alert('The email was register ! Please register with other email !');</script>";
} else 
{
    $sql = "INSERT INTO customer (name, email, Password, nomobile, address, country, poscode, hero)
            VALUES ('$name', '$email', '$Password', '$nomobile', '$address', '$country', '$poscode', '$hero')";

    if (mysqli_query($conn, $sql)) 
	{
		echo "<script type='text/javascript'>alert('New account was successfully!');</script>";
    } 
	else 
	{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
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

						</div>
					</form>
				</div>
			</div>	
	</section>
	</body>
</html>