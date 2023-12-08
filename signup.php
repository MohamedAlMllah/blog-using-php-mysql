<?php
session_start();
include "logic.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$email = $_POST['email'];
	$userName = $_POST['userName'];
	$password = $_POST['password'];

	$query = "SELECT * FROM users WHERE email = '$email'";
	$users = mysqli_query($con, $query);

	foreach ($users as $user) {
		if ($email == $user['email']) {
			$errorMessage = "This email is already exist!";
			header("Location: signup.php?error=$errorMessage");
			die;
		}
	}
	if (!empty($userName) && !empty($password) && !empty($email)&& !is_numeric($userName)) {

		//save to database
		$query = "INSERT into users (email,user_name,password) values ('$email','$userName','$password')";
		mysqli_query($con, $query);
		header("Location: login.php");
		die;
	} else {
		$errorMessage = "Please enter some valid information!";
		header("Location: signup.php?error=$errorMessage");
		die;
	}
}
?>

<?php if (isset($_REQUEST['error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<?php echo $_GET['error']; ?>
	</div>
<?php } ?>

<!DOCTYPE html>
<html>

<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>Signup</title>
</head>

<body>
	<div class="container text-center">
		<form class="form-group" method="post">
			<h1 class="mb-5 mt-5">Signup</h1>
			<input class="form-control" type="text" name="email" placeholder="e-mail"><br><br>
			<input class="form-control" type="text" name="userName" placeholder="user name"><br><br>
			<input class="form-control" type="password" name="password" placeholder="password"><br><br>
			<div class="text-center">
				<input class="btn btn-success" type="submit" value="Signup"><br><br>
				<a class="btn btn-primary" href="login.php">Click to Login</a><br><br>
			</div>
		</form>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>