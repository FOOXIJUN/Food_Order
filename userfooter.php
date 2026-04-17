<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer - Sagar Developer</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">

    <style>
@import url('http://fonts.googleapis.com/css?family=Open+Sans:400,700');
* {
    padding: 0;
    margin: 0;
}

body {
    font-family: 'Poppins', sans-serif;
}

.footer-distributed {
    background-color: #2d2a30;
    box-sizing: border-box;
    width: 100%;
    height: 250px;
    text-align: left;
    font: bold 16px sans-serif;
    padding: 50px 10px 50px 50px;
    margin-top: 80px;
}

.footer-distributed .footer-left, .footer-distributed .footer-center, .footer-distributed .footer-right {
    display: inline-block;
    vertical-align: top;
}
/* 调整左右位置(align) */
.footer-right
{
    float: right;
    margin-right: 40px;
}
.footer-left
{
    margin-left: 40px;
}
.footer-distributed .footer-left {
    width: 15%;
    
}

.footer-distributed h3 {
    color: #ffffff;
    font: normal 36px 'Cookie', cursive;
    margin: 0;
}

.footer-distributed h3 span {
    color: #e0ac1c;
}

.footer-distributed .footer-links {
    color: #ffffff;
    margin: 20px 0 12px;
}

.footer-distributed .footer-links a {
    display: inline-block;
    line-height: 1.8;
    text-decoration: none;
    color: #e0ac1c;
}

.footer-distributed .footer-company-name {
    color: #8f9296;
    font-size: 14px;
    font-weight: normal;
    margin: 0;
}

.footer-distributed .footer-center {
    width: 40%;
    padding-left: 190px;
}

.footer-distributed .footer-center i {
    background-color: #33383b;
    color: #ffffff;
    font-size: 25px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    text-align: center;
    line-height: 42px;
    margin: 10px 15px;
    vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope {
    font-size: 17px;
    line-height: 38px;
}

.footer-distributed .footer-center p {
    display: inline-block;
    color: #ffffff;
    vertical-align: middle;
    margin: 0;
}


.footer-distributed .footer-center p a {
    color: #e0ac1c;
    text-decoration: none;
}

.footer-distributed .footer-center p a:hover {
    color: green;
}


.footer-distributed .footer-right {
    width: 30%;
}

.footer-distributed .footer-company-about {
    line-height: 20px;
    color: #92999f;
    font-size: 13px;
    font-weight: normal;
    margin: 0;
}

.footer-distributed .footer-company-about span a
{
    color: #e0ac1c;
    display: block;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
}

.footer-distributed .footer-company-about span a:hover
{
    color:green;
}

.footer-distributed .footer-icons {
    margin-top: 25px;
}

.footer-distributed .footer-icons a {
    display: inline-block;
    width: 35px;
    height: 35px;
    cursor: pointer;
    background-color: #33383b;
    border-radius: 2px;
    font-size: 20px;
    color: #ffffff;
    text-align: center;
    line-height: 35px;
    margin-right: 3px;
    margin-bottom: 5px;
}

.footer-distributed .footer-icons a:hover {
    background-color: green;
}

.footer-links a:hover {
    color: green;
}

@media (max-width: 880px) 
{
    .footer-distributed .footer-left, .footer-distributed .footer-center, .footer-distributed .footer-right 
    {
        display: block;
        width: 100%;
        margin-bottom: 40px;
        text-align: center;
    }
    .footer-distributed .footer-center i 
    {
        margin-left: 0;
    }
}       

    </style>
</head>


    <footer class="footer-distributed">

        <div class="footer-left">
            <h3>F & C FAST FOOD </h3>

            <p class="footer-links">
                <a href="main.php">Home |</a>
                
                <a href="aboutus.php">About |</a>
                
                <a href="contact.php">Contact</a>
            </p>

            <p class="footer-company-name">WELCOME TO F & C FAST FOOD</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><a href="https://www.google.com/maps/search/mmu/@2.2484738,102.2759246,17.09z">F & C</a></p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p><a href="contact.php">+60 19-590-9369</a></p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:1211204752@student.mmu.edu.my">1211204752@student.mmu.edu.my</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span><a href="aboutus.php">About the company</a></span>
                <strong>F & C FAST FOOD</strong> is a good and has a good service to customer. Even that we also hope 
                customer can protect their health.
            </p>
            <div class="footer-icons">
                <a href="https://www.facebook.com/DominosMY/"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/dominosmy/?hl=en"><i class="fa fa-instagram"></i></a>
                <a href="https://www.instagram.com/dominosmy/?hl=en"><i class="fa fa-linkedin"></i></a>
                <a href="https://twitter.com/DominosMY"><i class="fa fa-twitter"></i></a>
                <a href="https://www.youtube.com/user/dominosmy"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>

</html>
