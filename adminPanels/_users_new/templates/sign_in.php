<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Sign In/Sign Up</title>
		<!-- <link rel="icon" href="/resources/icons/favicon.ico" type="image/x-icon"> -->
		<link rel="stylesheet" type="text/css" href="../css/layout.css">
		<script type="text/javascript" src="../js/layout.js"></script>
	</head>
	
	<body>
		<h2>SIGN IN</h2>
		<form method="POST" action="actions/sign_in.php">
			<input type="text" name="login" placeholder="login">
			<br>
			<input type="password" name="password">
			<br>
			<input type="submit" value="sign in">
		</form>
		<hr>
		<h2>SIGN UP</h2>
		<form id="sign_up" method="POST" action="actions/sign_up.php" onsubmit="checkpass()">
			<input type="text" name="login" placeholder="login">
			<br>
			<input type="text" name="name" placeholder="name">
			<br>
			<input id="pass" type="password" name="password">
			<br>
			<input id="repeatPass" type="password" name="">
			<br>
			<input type="submit" value="sign up">
		</form>
		<script>
			function checkpass() {
				var p1 = document.getElementById('pass');
				var p2 = document.getElementById('repeatPass');

				if(p1.value != p2.value) {
					alert("Passwords are not the same!");
				} else {
					document.getElementById('sign_up').submit();
				}
			}
		</script>
	</body>
</html>