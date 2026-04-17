<?php
    session_start();
    include ("Connectdb.php");

    $email = "";
    $name = "";
    $errors = array();


    if(isset($_POST['check-email']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM customer WHERE email ='$email'";
    $run_sql = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($run_sql) > 0)
    {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE customer SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);

        if($run_query)
        {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: 1211204752@student.mmu.edu.my";

            if(mail($email, $subject, $message, $sender))
            {
                $info = "We've sent a password reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;

                header('location: otp.php');

                exit();
            }
            else
            {
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        else
        {
            $errors['db-error'] = "Something went wrong!";
        }
    }
    else
    {
        $errors['email'] = "This email address does not exist!";
    }
}

if(isset($_POST['check-reset-otp']))
{
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM customer WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);

    if(mysqli_num_rows($code_res) > 0)
    {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;

        header('location: changepass.php');

        exit();

    }
    else
    {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

if(isset($_POST['change-password']))
{
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if($password !== $cpassword)
    {
        $errors['password'] = "Confirm password not matched!";
    }
    else
    {
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE customer SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);

            if($run_query)
            {
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;

                header('Location: changepass.php');
            }
            else
            {
                $errors['db-error'] = "Failed to change your password!";
            }
    }
}
?>
