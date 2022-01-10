<!DOCTYPE PHP>

<?php
	session_start();

?>1

<head>

	<link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>" type ="text/css" >
	<link rel="shortcut icon" href="../Media/icon.png">

	<title>Top Reviewed Books</title>

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
	<h3>Top Rated Books</h3>
	
	<?php
	include 'db_connection.php';
	$conn = OpenCon();
	
	$sql = "SELECT * FROM books ORDER BY Rating DESC limit 5";
	$result = $conn->query($sql);
	
	if ($result && $result->num_rows) {
		
		echo "<table border='1'>
		<tr>
		<th>Name
		<th>Genre
		<th>Rating
		<th>Author
		<th>NumOfPages
		</tr>";
		
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["BookName"]."</td>";
			echo "<td>".$row["Genre"]."</td>";
			echo "<td>".$row["Rating"]."</td>";
			echo "<td>".$row["Author"]."</td>";
			echo "<td>".$row["NumOfPages"]."</td>";
			echo "<td></td>";
		echo "</td>";}
		
		echo"</table>";
	
			
		}
		
	 else {
	echo "0 results";}
	CloseCon($conn);
	?>
	</main>
	
	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
</body>