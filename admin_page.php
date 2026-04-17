<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
	echo 'Please Login First';
	echo '<script>window.location.href = "admin_login.php";</script>';
	exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="admin_page.css">
    <style>
    main 
    {
        margin: 20px;
    }

    header h1
    {
        height: 20px;
        text-align: center;
    }

    footer 
    {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
    }
    </style>
</head>
<body>
    
    <header>
        <h1>ADMIN HOMEPAGE</h1>
    </header>
    
    <?php
    include('admin_header.php');
    ?>

    <main>
        <br>
        <br>
        <br>
    </main>
    
    <footer>
        <p>F & C FAST FOOD</p>
    </footer>
    
</body>
</html>
