<!DOCTYPE PHP>

<?php
	session_start();

?>
	<script>
	function hide() {
   
    var H = document.getElementById('newComment');
    var displaySetting = H.style.display;

    if (displaySetting == 'block') {
      H.style.display = 'none';
    }
    else {  
      H.style.display = 'block';
      }
  }
	</script>
<head>

	<link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>" type ="text/css" >
	<link rel="shortcut icon" href="../Media/icon.png">

	<title>Ratings</title>

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
	
		<h3>Reviews</h3>
		
		<?php 
		include 'db_connection.php';
		$conn = OpenCon();
	
		$sql = "SELECT comments.Content, comments.GOrB, users.username, books.BookName, comments.TimePosted FROM comments, users, books WHERE comments.UserID = users.ID AND comments.BookID = books.BookID ORDER BY comments.TimePosted DESC;";
		$result = $conn->query($sql);
		
		if ($result && $result->num_rows) {
			
			echo "<table border='1'>
			<tr>
			<th>Review
			<th>Overall
			<th>Username
			<th>Book Title
			<th>Time Posted
			</tr>";
			
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["Content"]."</td>";
				echo "<td>".$row["GOrB"]."</td>";
				echo "<td>".$row["username"]."</td>";
				echo "<td>".$row["BookName"]."</td>";
				echo "<td>".$row["TimePosted"]."</td>";
				echo "</tr>";}
			
			echo"</table>";
		
				
			}
			
		 else {
		echo "0 results";}
		CloseCon($conn);
		?>
		<br>
	
	<?php
		if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
			echo '<p>Log in to leave a review!</p>';
		} else {
			echo '<button style="margin-left:20px" onclick="hide()">Click to add a review</button>'; 
		}
		
	?><br><br>
	
	<div id="newComment" style="display:none">
			
			<form action="addReview.php" method="post">
				
			Book:
			<?php
				$conn = OpenCon();
				
				$sql = "SELECT BookID, BookName  FROM books ORDER BY BookName ASC";
				
				echo '<select name=book value="">Book Title</option>';
				foreach ($conn->query($sql) as $row){
					echo "<option required value={$row['BookID']}>{$row['BookName']}</option>";
				}
				echo "</select>";
			?><br><br>
				
			Review:
			<input type="text" name="review" required maxlength="250"><br><br>
			
			Was this book good or bad?:<br>
			<input type="radio" name="GOrB" value="good" required>Good<br>
			<input type="radio" name="GOrB" value="bad" required>Bad<br><br>
			
			<input type="hidden" name="userID" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>">
			
			<input type="submit" style="margin-left:10px; margin-bottom:10px" value="Submit">
			<br>
			</form>
	
		</div>
	
	</main>
	

	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
</body>