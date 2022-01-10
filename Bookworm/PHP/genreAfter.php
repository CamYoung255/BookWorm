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
	
	<?php
	include 'db_connection.php';
	$conn = OpenCon();
	//echo "Connected Successfully";//
	
	//echo $_POST['UserName'];//
	$Text = $_POST['UserName'];
	$sql = "SELECT * FROM books WHERE BookName LIKE '%".$Text."%' OR Author LIKE '%".$Text."%' OR Genre LIKE '%".$Text."%' ORDER BY BookName ASC";
	$result = $conn->query($sql);
	
	if ($result->num_rows >0) {
		
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
		
		//while($row = $result->fetch_assoc()) {
			//echo "Name: ".$row["BookName"]. ", ".$row["Author"]."<br>"; 
			
			
		}
		
	 else {
	echo "0 results";}
	CloseCon($conn);
	?>
	
	<br>
	<a class="Back" href="genre.php">Back</a>
	<br><br>
	
	</main>
	
	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
	
</body>
</html>