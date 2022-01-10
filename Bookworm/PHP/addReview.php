<?php

session_start();

include 'db_connection.php';
$conn = OpenCon();
/*Connects to the                          */

$book = mysqli_real_escape_string($conn, $_REQUEST['book']);
$review = mysqli_real_escape_string($conn, $_REQUEST['review']);
$GOrB = mysqli_real_escape_string($conn, $_REQUEST['GOrB']);
$User = $_REQUEST['userID'];
/*Gets the data from the form*/

$sql = "SELECT ID FROM users WHERE Username = '{$User}';";
$result = $conn->query($sql);
/*SQL statement to find the IserID from  the 
  database, to include that in the comments database*/


if ($result && $result->num_rows) {
	while($row = $result->fetch_assoc()) {
		$UserID = $row["ID"];
	/*Pulls the UserID from the table and assigns
	  it to tje varible $UserID to be used in PHP commands*/
	} 
	
} 

$sql = "INSERT INTO Comments (Content, UserID, BookID, GOrB) VALUES ('{$review}', '{$UserID}', '{$book}', '{$GOrB}');";

if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

/*creates and impliments an SQL statement to add 
  a review to the comments database*/

$sql = "SELECT Rating FROM books WHERE BookID = {$book};";
$result = $conn->query($sql);
/*finds what the book was rated at before the review*/


if ($result && $result->num_rows) {
	while($row = $result->fetch_assoc()) {
		if ($GOrB == "good"){
			$temp = $row["Rating"] + 1;
		} else {
			$temp = $row["Rating"] - 1;
		/*sets the temp varible to either plus one*
		  or minus one the original rating depending
		  on the user's opinion*/	
		}
	}
}

$sql = "UPDATE books SET Rating = {$temp} WHERE BookID = {$book};";

if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
/*updates the database with the new rating*/

mysqli_close($conn);
/*cloes the connection*/

header("location: reviews.php");
exit;
/*goes back to the reviews page*/

?>