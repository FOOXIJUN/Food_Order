<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://fontawesome.com/search?q=door&c=users-people&o=r">
<style>

* {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  scroll-padding-top: 2rem;
  scroll-behavior: smooth;
}
/* Some Variables */
:root {
  --green-color: #3cb815;
  --light-green-color: #c0eb7b;
  --orange-color: #ff7e00;
  --light-orange-color: #f75f1d;
  --text-color: #1a2428;
  --bg-color: #fff;
}

section {
  padding: 4.5rem 0 1.5rem;
}
img {
  width: 100%;
}
body {
  color: var(--text-color);
}
nav {
  position: fixed;
  width: 100%;
  top: 0;
  right: 0;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: var(--bg-color);
  box-shadow: 0 8px 11px rgb(14 55 54 / 15%);
  padding: 20px 100px;
  transition: 0.5s;
}
.head-icon{
  margin-left: 30px;
  cursor: pointer;
  transition: color 0.4s linear;
  font-size: 30px;
  color: black;
}
.head-icon:hover{
  color: #1ca9c9;
}
.logo {
  display: flex;
  align-items: right;
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--text-color);
  column-gap: 0.5rem;
}
.logo .bx {
  font-size: 24px;
  color: var(--orange-color);
}
.navbar {
  display: flex;
  column-gap: 0.5rem;
}
.navbar a {
  font-size: 1rem;
  font-weight: 500;
  color: var(--text-color);
  padding: 0.5rem 1rem;
}
.navbar a:hover,
.navbar .home-active {
  background: var(--green-color);
  border-radius: 5rem;
  color: var(--bg-color);
  transition: background 0.5s;
}
#menu-icon {
  font-size: 24px;
  cursor: pointer;
  z-index: 10001;
  display: none;
}
.navbar .dropdown {
  position: relative;
      display: flex;
      align-items: center;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: var(--bg-color);
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  top: 100%;
      left: 0;
}

.dropdown-content a {
  color: var(--text-color);
  padding: 12px 16px;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}
    /* Floating Action Button */
.fab {
      position: fixed;
      bottom: 50px;
      right: 70px;
      width: 56px;
      height: 56px;
      background-color: var(--green-color);
      border-radius: 50%;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 24px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      background-image: url("image/delivery.jpg");
      background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  transition: transform 0.2s ease-in-out 0.15s; 
    }

    .fab:hover {
      background-color: var(--light-green-color);
transform: scale(1.2); /* Increase the scale of the element */
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 6px 10px rgba(0, 0, 0, 0.2); /* Add a box shadow */
    }
    /* Balloon Styles */
    .fab .balloon {
      position: absolute;
      top: -80px;
      right: 20px;
      width: 240px;
      height: 80px;
      background-color: var(--green-color);
      border-radius: 50%;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      transform: scale(0);
      opacity: 0;
      transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
      
    }
    
    .fab:hover .balloon {
      transform: scale(1);
      opacity: 1;
    }
</style>

</head>
<body>
<nav>
<a href="main.php" class="logo"><i class='bx bxs-basket'></i>F&C Fast Food</a>
  <!-- Logo and other menu items -->

  <ul class="navbar">
    <a href="main.php"><i class="fa fa-home"></i> Home</a>
    <a href="aboutus.php"><i class="fa fa-file"></i> About Us</a>
    <li class="dropdown">
      <a class="dropdown-btn" href="pizza.php"><i class="fa fa-cutlery" aria-hidden="true"></i> Category</a>
      <div class="dropdown-content">
        <a href="pizza.php">Pizza</a>
        <a href="burger.php">Burger</a>
        <a href="drink.php">Drink</a>
        <a href="snack.php">Snack</a>
      </div>
    </li>
    <a href="contact.php"><i class="fa fa-phone"></i> Contact</a>
    <a href="order_user.php"><i class="fa fa-file"></i> Order</a>
    <a href="userlogout.php">Log out</a>
  </ul>
        <!-- Menu Icon  -->

        <div class="bx bx-menu" id="menu-icon"></div>
        <div >
            <a class = "head-icon" href="customerprofile.php">
                <i class = "fas fa-user-circle"></i>
              </a>
        </div>
        <div class="nav-item">
        <a class="nav-link" href="cart.php" id="cart-icon"><i class="fas fa-shopping-cart"></i> 
        <span id="cart-item" class="badge badge-danger"></span></a>
        </div>
</nav>
<div class="cdit">
  <span class="balloon"></span>
  <a href="status.php" class="fab">
    <span class="balloon">Track Your Item Here !!!</span>
  </a>
</div>

  <script>
    // JavaScript to show and hide the balloon periodically
    document.addEventListener('DOMContentLoaded', () => {
      const balloon = document.querySelector('.balloon');

      const showBalloon = () => {
        balloon.style.transform = 'scale(1)';
        balloon.style.opacity = '1';
        setTimeout(() => {
          balloon.style.transform = 'scale(0)';
          balloon.style.opacity = '0';
        }, 2000);
      };

      showBalloon(); // Show balloon initially

      setInterval(showBalloon, 4000); // Show balloon every 4 seconds (2 seconds visible, 2 seconds hidden)
    });
  </script>
</body>
</html>