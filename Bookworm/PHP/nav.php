<header>

	<?php
		if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
			echo '<a class="login" href="login.php">Log In</a>';
		} else {
			echo '<a class="login" href="logout.php">Logout '; 
			echo $_SESSION["username"]; 
			echo '</a>'; 
		}
		
	?>
	
	<img src="../Media/icon.png" style="float:left" width="80" height="70">
		
	<a href="home.php" style="text-decoration:none" ><h1>BookWorms</h1></a>
	<br>
	<nav class="navbar">
	<a href="home.php">Home</a>
	<a href="reviews.php">Reviews</a>
	<a href="topbooks.php">Top Rated Books</a>
	<a href="Genre.php">Genre</a>
	<a href="aboutus.php">About Us</a>
	</nav>
	<br>
	
</header>
