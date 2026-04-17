<?php
$receiver = "1211204752@student.mmu.edu.my";
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there... This is a test email send from Localhost.";
$sender = "From: benb50596@gmail.com";

if(mail($receiver, $subject, $body, $sender))
{
	echo "Email sent successfully to $receiver";
}
else
{
	echo "Sorry, failed while sending mail!";
}
?>