<?php

session_start();
unset($_SESSION['email']);
header("location: admin_login.php");

?>