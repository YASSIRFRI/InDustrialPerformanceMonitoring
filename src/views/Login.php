<?php
echo
'<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link rel="stylesheet" href="../../assets/css/Login.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>';

if (isset($_GET['error'])) {
	$errorCode = $_GET['error'];

	// Display the appropriate error message based on the error code
	if ($errorCode === '1') {
		echo '
		<div class="error-container p-3">
			<p class="error-container">Email not found. Please try again.</p>
		</div>';
	}
	// Add more error conditions and corresponding error messages as needed
}
echo '
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
		<div class="signup">
			<form action="../controllers/RegistrationController.php" method="POST">
				<label for="chk" aria-hidden="true">Sign up</label>
				<input type="email" name="email" placeholder="Email" required="">
				<input type="text" name="username" placeholder="Username" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<input type="password" name="confirmPassword" placeholder="Confirm Password" required="">
				<button>Sign up</button>
			</form>
		</div>
		<div class="login">
			<form action="../controllers/LoginController.php" method="POST">
				<label for="chk" aria-hidden="true">Login</label>
				<input type="email" name="email" placeholder="Email" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<button>Login</button>
			</form>
			</div>'
			;
			// Check if 'error' parameter is present in the URL
			if (isset($_GET['error'])) {
				$errorCode = $_GET['error'];

				// Display the appropriate error message based on the error code
				if ($errorCode === '1') {
					echo '
					<div class="error-container">
						<p class="error-container">Email not found. Please try again.</p>
					</div>';
				}
				// Add more error conditions and corresponding error messages as needed
			}
			?>
			<script>
    const errorContainer = document.querySelector('.error-container');

    errorContainer.style.display = 'block';
	errorContainer.style.color = 'red';

    setTimeout(function() {
      errorContainer.style.display = 'block';
    }, 5000);
  </script>
	</div>
</body>
</html>
