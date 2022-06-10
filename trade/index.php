<?php
	session_start();
	
	if(isset($_SESSION['user'])){
		header('Location: home.php');
		exit(0);
	}
?>

<!DOCTYPE HTML>

<html>

<head>

	<link rel="stylesheet" href="bootstrap_3.3.7/css/bootstrap.min.css">
	<script src="bootstrap_3.3.7/js/bootstrap.min.js"></script>
	<script src="bootstrap_3.3.7/jquery.js"></script>
	<link rel="stylesheet" href="style.css"></link>
	
</head>


<body>

	<div class="container" style="text-align: center; height: 100%;">
		<div style="text-align: center; display: inline-block; background-color: #060f2a; width: 70%; height: 100%;">
			<h1 style="color: white;"><img src="logo-top.png" width=120 height=59><strong>Trading Platform</strong></h1>
			<div class="jumbotron" style="text-align: center;background-color: #060f2a; display: inliine-block; margin: 10px; height: 90%; padding: 0px;">
				<div class="jumbotron" style="display: inline-block; width: 95%; height: 50%; margin: 5px; padding: 10px;">
					<div class="jumbotron" style="color: white; margin: 100px; height: 100%; width: 68%; background-color: #687a8e; float: left; margin: 0px; padding: 10px; text-align: left;">
						<h3>Updates:</h3>
						Registrations are currently closed</br>
						WAF has been deployed
						<h3>What is CryptoBank Trading Platform?</h3>
						<br>
						CryptoBank TP is the best way to store and trade your crypto securely
						<br>
						<h3>What services does our platform offer?</h3>
						<ul>
							<li><h5><strong>SECURE</strong> transcations such as:</h5>
								<ul>
									<li>Crypto credit transfer</li>
									<li>Balance Checking</li>
									<li>Online Loan Application</li>
								</ul>
							</li>
						</ul>
						<br>
					</div>
					<div class="jumbotron" style="color: white; height: 100%; width: 30%; background-color: #2d343b; float:right; margin: 0px; padding: 10px">
						<form action="login_auth.php" method="post" class="form-group">
							<h4 ><strong>Secure Login </strong><span class="glyphicon glyphicon-lock"></span></h4>
							<?php
								if(isset($_SESSION['error']) AND $_SESSION['error'] == 1){
									echo "
										<div class='alert alert-danger'>
											<strong>Login Failed!</strong> Wrong username or password
										</div>
									";
								}
								$_SESSION['error'] = 0;
								$_SESSION['success'] = 0;
							?>
							<br>
							<label for="user">Username: </label>
							<input class="form-control" type="text" name="user" id="user" value="">
							<br>
							<br>
							<label for="user">Password: </label>
							<input class="form-control" type="password" name="pass" id="passs" value="">
							<br>
							<input style="color: white;" class="btn btn-navbar" type="submit" name="login" value="Login">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>


</html>