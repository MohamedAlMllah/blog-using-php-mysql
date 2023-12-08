<?php

session_start();

include "logic.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$userName = $_POST['userName'];
	$password = $_POST['password'];

	if (!empty($userName) && !empty($password)) {
		$query = "select * from users where user_name = '$userName' limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {
				$userData = mysqli_fetch_assoc($result);
				if ($userData['password'] === $password) {
					$_SESSION['email'] = $userData['email'];
					header("Location: index.php");
					die;
				}
			}
		}
		$errorMessage = "wrong username or password!";
		header("Location: login.php?error=$errorMessage");
		die;
	} else {
		$errorMessage = "please enter some valid informations!";
		header("Location: login.php?error=$errorMessage");
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
	<title>Login</title>
</head>

<body>

	<div class="container text-center">
		<form method="post">
			<h1 class="mb-5 mt-5">Login</h1>
			<input class="form-control" type="text" name="userName"><br><br>
			<input class="form-control" type="password" name="password"><br><br>
			<div class="text-center">
				<input class="btn btn-success" type="submit" value="Login"><br><br>
				<a class="btn btn-primary" href="signup.php">Click to Signup</a><br><br>
			</div>
		</form>
	</div>
	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>