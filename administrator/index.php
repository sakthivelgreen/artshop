<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Arts_Shop - Administrator</title>

	<link type="text/css" href="./style.css" rel="stylesheet" />
	<meta charset="UTF-8">
</head>

<body>

	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
				<div id="menu">
				</div>
			</div>
			<div id="primary_right">
				<div class="inners">

					<h1>LOGIN ADMINISTRATOR</h1>
					<form method="post" action="">

						<div class="two_third column">
							<h5><br />Username:</h5>
							<input type="text" name="aduser">
							<h5><br />Password:</h5>
							<input type="password" name="adpass">
							<h5></h5>
							<input type="submit" value="LOGIN" name="login">

					</form>
					<?PHP
					$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost', 'root', '', 'arts_shop'));
					if (!$conn) {
						die ('Could not connect: ' . mysqli_error($GLOBALS["___mysqli_ston"]));
					}
					if (isset ($_POST['login'])) {
						if (isset ($_POST['aduser'])) {
							if (isset ($_POST['adpass'])) {
								$username = $_POST['aduser'];
								$pass = $_POST['adpass'];
								($result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM admin WHERE admin_id = '$username' AND  password = '$pass'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
								if (!$result) {
									die ("Query to show fields from table failed");
								}

								$numberOfRows = mysqli_num_rows($result);
								if ($numberOfRows == 0) {
									echo " <font color= 'red'>Invalid username and password!</font>";
								} elseif ($numberOfRows > 0) {
									session_start();
									$_SESSION['user'] = $user_name;
									$_SESSION['isvalid'] = "true";
									header("location:../administrator/bids.php");
								}
							}
						} else {
							echo "please check your password";
						}
					}
					?>

				</div>
				<div class="one_third last column">
				</div>
				<hr />
				<HR>
				<HR />
				<div class="clearboth"></div>
			</div><!-- three_fourth last -->
		</div>
		<div class="clearboth" style="padding-bottom:20px;"></div>
	</div> <!-- inner -->
	</div> <!-- primary_right -->
	</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>

</html>