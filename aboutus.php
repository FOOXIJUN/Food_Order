<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us | Company Name</title>
  <meta name="description" content="Learn about our company and our mission to provide high-quality products and excellent customer service.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://fontawesome.com/search?q=door&c=users-people&o=r">
  <link rel="stylesheet" href="aboutus.css">
  <style>
body 
{
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
}


.menu-bar 
{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #444;
    padding: 1em 2em;
    font-size: 1.2em;
}

.menu-bar a 
{
    text-decoration: none;
    color: white;
    margin: 0 1em;
    font-weight: bold;
    border-radius: 16px;
    padding: 1em 2em;
    transition: 0.2s ease;
}

.menu-bar a:hover 
{
    background-color: #666;
}

button 
{
    background-color: #8bc34a;
    border: none;
    color: white;
    padding: 1em 2em;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1em;
    margin: 0.5em;
    cursor: pointer;
    border-radius: 16px;
    transition:  0.2s ease;
    box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.1);
}
  
main 
{
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}
  
section 
{
    margin-bottom: 2rem;
}
  
.about h1 
{
    font-size: 3rem;
    margin-bottom: 1rem;
}
  
.about p 
{
    font-size: 1.2rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}
  
.about a 
{
    color: #e0ac1c;
}
  
.about a:hover 
{
    text-decoration: underline;
}

.about .center 
{
    text-align: center;
}
  
.about .center img
{
    max-width: 100%;
    height: auto;
    display: inline-block;
    margin: 0 auto;
}

footer {
    position: absolute;
    bottom: 0; 
    display: block;
    top: 2270px;
}

    </style>
</head>
<body>
  <?php
  require 'user_valid.php';
  include('userheader.php')
  ?>
  
  <main>
    <section class="about">
      <h1>About Us</h1>
      <p>At F&C Fast Food, we are passionate about serving up delicious, affordable food for our customers. Since our founding in 2020, we have been committed to providing fast, convenient meals without sacrificing quality or taste.</p>
      <p>Our menu features a wide variety of classic fast food options, including burgers, fries, and pizzas, as well as some unique twists on old favorites. We use only the freshest ingredients in our food, and we pride ourselves on cooking everything to order. Whether you're in the mood for a quick snack or a full meal, we've got you covered.</p>
      <p>At F&C Fast Food, we believe that everyone should have access to great food, no matter their budget. That's why we work hard to keep our prices low without sacrificing quality. We also care deeply about our impact on the environment and are constantly looking for ways to reduce waste and minimize our carbon footprint.</p>
      <div class="row">
    <div class="video-container">
    <video src="image/foodv2.mp4" loop autoplay muted></video>
    </div>
      <p>Our friendly staff are always here to make your experience at F&C Fast Food as enjoyable as possible. Whether you're dining in or taking out, we want you to leave feeling satisfied and happy. We value your feedback and are always striving to improve our service and menu offerings.</p>
      <p>If you have any questions or feedback, please don't hesitate to <a href="contact.php">Contact us</a>. We are always happy to hear from our customers and are committed to providing the best possible support.We will also do our best to improve and reply to any feedback as soon as possible.</p>
      <p>Thank you for choosing F&C Fast Food for your next meal. We can't wait to serve you!</p>
    </section>
  </main>

  <div class="center">
    <img src="menu/image_1.jpg" alt="Image Description">
</div>

<?php
include('userfooter.php');
?>
  
</body>
</html>
