<?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
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
					<div class="jumbotron" style="color: white; margin: 100px; height: 100%; width: 100%; background-color: #687a8e; float: left; margin: 0px; padding: 10px; text-align: left;">
						<?php
							echo "<h2>Welcome, ".$_SESSION['user']."</h2>";
						?>
						<br>
						<h3>Services</h3>
						<div class="list-group">
							<a href="money_transfer.php" class="list-group-item">Money Transfer</a>
							<a href="balance_checking.php" class="list-group-item">Balance Checking</a>
							<a href="view_loans.php" class="list-group-item">Apply A Loan</a>
						<div>
						<br>
						<form action="logout.php" class="form-group">
							<input type="submit" name="logout_btn" style="background-color: #2d343b" class="btn btn-navbar" value="Log Out">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>


</html>