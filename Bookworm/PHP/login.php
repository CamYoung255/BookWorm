<!DOCTYPE PHP>


<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
	header("location: home.php");
	exit;
}

require_once "loginconn.php";

$username = $pass = "";
$username_er = $pass_er = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if (empty(trim($_POST["username"]))){
		$username_er = "Please enter a username.";
	} else {
		$username = trim($_POST["username"]);
	}
	
	if (empty(trim($_POST["password"]))){
		$pass_er = "Please enter a password.";
	} else {
		$pass = trim($_POST["password"]);
	}
	
	if (empty($username_er) && empty($pass_er)) {
		$sql = "SELECT ID, username, password FROM users WHERE username = ?";
		
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = $username;
			
			if (mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				
				if (mysqli_stmt_num_rows($stmt) == 1) {
					mysqli_stmt_bind_result($stmt, $ID, $username, $hashed_password);
					
					if (mysqli_stmt_fetch($stmt)) {
						$passer = password_verify($pass, $hashed_password);
						if (password_verify($pass, $hashed_password)){
							session_start();
					
							
							$_SESSION["loggedin"] = true;
							$_SESSION["ID"] = $ID;
							$_SESSION["username"] = $username;
						
							header("location: home.php");
						} else{
							
							$pass_er = "The password you entered is not valid.";
						}
					}
				} else{
					$username_er = "No account was found with that username.";
				}
			} else {
				echo "Opps something went wrong, please try again later.";
			}
			
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($conn);
}	

?>

<head>

	<link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>" type ="text/css" >
	<link rel="shortcut icon" href="../Media/icon.png">

	<title>Log In</title>

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
        <h3>Login</h3>
		
        <p>Please fill in your details to login.</p>
        
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
			<div class="form-group <?php echo (!empty($username_er)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_er; ?></span>
            </div>  <br> 
            
			<div class="form-group <?php echo (!empty($pass_er)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $pass_er; ?></span>
            </div><br>
            
			<div class="form-group">
                <input type="submit" class="submit" value="Login">
            </div><br><br>
            
			<p>Don't have an account?</p>
			<a href="reg.php">Sign up now!</a><br><br>
        </form>
    </div>  
	
	</main>
	
	<?PHP
	include_once('footer.php');
	?>
	<!--php code to add the footer-->
</body>