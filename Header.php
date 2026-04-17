
<link rel="stylesheet" href="header.css"></link>
	<div class="container">
		<nav class="navbar navbar-expand-md navbar-light">
			
			<!-- Toggler/collapsibe Button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Navbar links -->
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<?php
					session_start();
					if (isset($_SESSION["CustomerName"])) {
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="shoppingcart.php">SHOPPING CART</a>';
						echo '</li>';

						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="order_history.php">ORDER HISTORY</a>';
						echo '</li>';
					}
					?>
			</div>
		</nav>
	</div>

				<?php
				include("Connectdb.php");
				?>

					
