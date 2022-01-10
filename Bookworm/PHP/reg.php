<?php 

require_once "loginconn.php";

$username = $pass = $confirmpass = "";
$username_er = $pass_er = $confirmpass_er = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(empty(trim($_POST["username"]))){
		$username_er = "Please enter a username.";
	} else {
		$sql = "SELECT ID FROM users WHERE username = ?";
	
		if ($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			$param_username = trim($_POST["username"]);
			
			
			if (mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1){
					$username_er = "That username is not available.";
				} else { 
					$username = trim($_POST["username"]);
				}
			} else {
				echo "Oops something went wrong. Please try again later.";
			}
			
			mysqli_stmt_close($stmt);
			
		}
	}
	
	if (empty(trim($_POST["password"]))){
		$pass_er = "Please enter a password.";
	} elseif (strlen(trim($_POST["password"])) < 6) {
		$pass_er = "Passwords must be at least 6 characters.";
	} else {
		$pass = trim($_POST["password"]);
	}
	
	if (empty(trim($_POST["confirmpass"]))) {
		$confirmpass_er = "Please confirm your password.";
	} else {
		$confirmpass = trim($_POST["confirmpass"]);
		if (empty($pass_er) && ($pass != $confirmpass)){
			$confirmpass_er = "Passwords do not match.";
		}
	}
	
	if(empty($username_er) && empty($pass_er) && empty($confirmpass_er)) {
		$sql = "INSERT INTO users (username, password) VALUES (?,?)";
		
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_pass);
			
			$param_username = $username;
			$param_pass = password_hash($pass, PASSWORD_DEFAULT);
			
			if (mysqli_stmt_execute($stmt)) {
				header("location: login.php");
			} else {
				echo "Something went wrong. Please try again.";
			}
			
			mysqli_stmt_close($stmt);
			
		}
	}
	
	mysqli_close($stmt);
}
?>
<html>

<head>
	
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../CSS/style.css?<?php echo time(); ?>" type ="text/css" >
	<link rel="shortcut icon" href="../Media/icon.png">

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
	<br><br><br><br><br><br>
	
	<main>
	
		<div>
		
		<h3>Sign Up</h3>
		
		<p>Please fill out this form to create an account</p>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		
		<div class="form-group <?php echo (!empty($username_er)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_er; ?></span>
            </div><br>
            <div class="form-group <?php echo (!empty($pass_er)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $pass; ?>">
                <span class="help-block"><?php echo $pass_er; ?></span>
            </div><br>
            <div class="form-group <?php echo (!empty($confirmpass_er)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirmpass" class="form-control" value="<?php echo $confirmpass; ?>">
                <span class="help-block"><?php echo $confirmpass_er; ?></span>
            </div><br>
            <div class="form-group">
                <input type="submit" class="submit" value="Submit">
            </div><br><br>
            <p>Already have an account?</p> 
			<a href="login.php">Login here</a><br><br>
        </form>
    </div
	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
	
</body>
</html>
		
