<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>menu</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  
  <style>
/* Google Fonts */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap");

.home 
{
  width: 100%;
  min-height: 100vh;
  background-image: url(assets/background.jpeg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: right;
  background-attachment: fixed;
  display: flex;
  align-items: center;
}

.home-text h1 
{
  font-size: 2.7rem;
}

.home-text p 
{
  font-size: 0.938rem;
  margin: 0.4rem 0 1.8rem;
}

.home-text span 
{
  color: var(--main-color);
}

.btn 
{
  padding: 0.6rem 1rem;
  background: var(--green-color);
  color: var(--bg-color);
  font-weight: 400;
  border-radius: 5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  column-gap: 00.5rem;
  max-width: 160px;
}

.btn .bx 
{
  padding: 4px;
  background: var(--bg-color);
  color: var(--text-color);
  border-radius: 1rem;
  font-size: 20px;
  margin: auto;
}

.btn:hover 
{
  background: var(--light-orange-color);
  transition: 0.2s ease;
}

.heading 
{
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.heading h1 
{
  font-size: 1.6rem;
  font-weight: 600;
}

.heading span 
{
  color: var(--green-color);
}

.box1 
{
  background: #fef4ea;
}

.box2 
{
  background: #e9f4e3;
}

.box3 
{
  background: #faeaea;
}

.box4 
{
  background: #eeeef9;
}

.box5 
{
  background: #f7f6d7;
}

.products 
{
  max-width: 968px;
  margin-left: auto;
  margin-right: auto;
}

.products-conatiner 
{
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, auto));
  gap: 1.5rem;
  margin-top: 2rem;
}

.products-conatiner .box 
{
  padding: 20px;
  box-shadow: 1px 2px 11px 4px rgb(14 55 54 / 15%);
  border-radius: 0.5rem;
  position: relative;
}

.products-conatiner .box img 
{
  width: 100%;
  height: 200px;
  object-fit: contain;
  object-position: center;
}

.products-conatiner .box span 
{
  font-weight: 500;
  font-size: 13px;
}

.products-conatiner .box h2 
{
  font-size: 1.2rem;
  font-weight: 600;
}

.products-conatiner .box .price 
{
  font-size: 1rem;
  font-weight: 600;
  margin-top: 0.5rem;
  color: var(--light-orange-color);
}

.products-conatiner .box .price span 
{
  color: var(--text-color);
}

.products-conatiner .box .bx-cart-alt 
{
  position: absolute;
  right: 0;
  bottom: 0;
  padding: 10px;
  background: var(--green-color);
  color: var(--bg-color);
  font-size: 20px;
  border-radius: 0.5rem 0 0.5rem 0;
}

.products-conatiner .box .bx-cart-alt:hover 
{
  background: var(--whie-color);
  transition: 0.2s all linear;
}

.products-conatiner .box .bx-heart 
{
  position: absolute;
  top: 1rem;
  right: 1rem;
  font-size: 20px;
  color: var(--light-orange-color);
}

footer 
{
    position: absolute;
    bottom: 0; 
    margin-left: -280px;
    display: block;
    top: 1000px;
}
.nav-item{
  display: none;
}
h2 {
            text-align: center;
        }
    </style>
</head>
<body>
   
<?php
require 'user_valid.php';
include('userheader.php');
?>

    <div class="home-text" style="text-align: center;">
    <br>
    <h1><Span>Welcome to F&amp;C Fast Food</span></h1>
</div>

<section class="products" id="products">
        <div class="heading">
            <h1><span>Menu</h1>
                <a href="burger.php" class="btn">Order Now<i class='bx bx-right-arrow-alt' ></i></a>

        </div>
        <!-- Product Content -->
        <div class="products-conatiner">
            <!-- Box 1 -->
            <div class="box">
            <a href="burger.php">
    <img src="menu/burger/b.jpg" alt="">
</a>
               
                <h2>Burger</h2>
                
               
                
            </div>
            <!-- Box 2 -->
            <div class="box">
            <a href="pizza.php">
    <img src="menu/pizza/s.jpg" alt="">
</a>
                
                <h2>Pizza</h2>
                
              
                
            </div>
            <!-- Box 3 -->
            <div class="box">
            <a href="snack.php">
    <img src="menu/snack/cb.jpg" alt="">
</a>
                
                <h2>Snack</h2>
                
  
                
            </div>
            <!-- Box 4 -->
            <div class="box">
            <a href="drink.php">
    <img src="menu/drink/Cola.jpg" alt="">
</a>
                
                <h2>Drink</h2>
</div>
  
<?php
include('userfooter.php');
?>                

</body>


</html>


