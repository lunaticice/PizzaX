<?php
	session_start();

	if ($_POST) {
	    define('BASE', 'BASE');

		$username = $_POST["username"]; 
		$password = $_POST["password"];

		require_once("database/Database.php");

		$db = new RestoDB();
		$user_id = $db->login_secure($username, $password);

		if ($user_id != -1) {
			$_SESSION["loggedIn"] = true;
			$_SESSION["user_id"] = $user_id;
			header("Location: menu_admin.php");
			exit();
		}
		else {
			$error = "Wrong username or password!";
		}
	}
?>


<!DOCTYPE HTML>
<html>

<head>
	<title>Admin Login</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<!-- Stylesheets -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!--// Stylesheets -->
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
	<!--//fonts-->
</head>

<body>
	<h1 class="w3-animate-opacity" style="text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred">Administrator Login</h1>
	<?php
		if (isset($error)){
			echo "<p style = 'color:white;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred'>$error</p>";
		}
	?>
	<div class="w3ls-login w3-animate-opacity">
		<!-- form starts here -->
		<form action="login_admin.php" method="post">
			<div class="agile-field-txt">
				<label>
					<i class="fa fa-user" aria-hidden="true"></i> Username :</label>
				<input type="text" name="username" placeholder=" " required="" />
			</div>
			<div class="agile-field-txt">
				<label>
					<i class="fa fa-lock" aria-hidden="true"></i> password :</label>
				<a href="#" class="w3ls-right">forgot password?</a>
				<input type="password" name="password" placeholder=" " required="" id="myInput" />
				<div class="agile_label">
					<input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()">
					<label class="check" for="check3">Show password</label>
				</div>
			</div>
			<script>
				function myFunction() {
					var x = document.getElementById("myInput");
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				}
			</script>
			<!-- //script for show password -->
			<div class="w3ls-login  w3l-sub">
				<input type="submit" value="Login">
			</div>
			<br>
			<div class="w3ls-login  w3l-sub w3-large">
				<a href="index.php">Back To Home</a>
			</div>
		</form>
	</div>
	<!-- //form ends here -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>