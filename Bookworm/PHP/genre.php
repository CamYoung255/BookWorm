<!DOCTYPE PHP>

<?php
	session_start();

?>

<html>

<head>

	<link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>" type ="text/css" >
	<link rel="shortcut icon" href="../Media/icon.png">

	<title>Genre</title>

	<div>
	<meta name ="Creater" content = "Kieran Frew">
	<meta name = "Content" content = "Book review website">
	<meta name = "Keywords" content ="books, rating, reviews">
	</div>

</head>

<body>

	<?PHP
	include_once('nav.php');
	?>
	<!--php code to add the header-->
	<br><br><br><br><br>
	
	<main>
	<h3>Genre</h3>
	
	<form action="genreAfter.php" method="post" class="textbox">
	Enter the name of the book, genre or author:<br><input type="text" name="UserName">
	<input type="submit">
	</form>
	<br>
	

	</main>
	
	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
	
</body>
</html>