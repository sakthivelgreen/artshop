<?php
session_start();
require (__DIR__ . "/db.php");
require (__DIR__ . "/htmls.php");
require (__DIR__ . "/functions.php");
headhtml();

if (isset ($_POST['userReg'])) {

	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contactno = $_POST['contactno'];
	$email = $_POST['email1'];
	$userid = $_POST['loginid'];
	$password = $_POST['pass1'];
	
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO customer(customer_lastName,customer_firstName,gender,userid,password,email,contact_no,address,verification,customer_img) VALUES ('$lname','$fname','$gender','$userid','$password','$email','$contactno','$address','yes','people.png')");
	
	echo '<script>alert("Registration successful!");</script>';
	echo '<script> location.replace("login.php");</script>';
}
?>

<?php
if (isset ($_POST['register'])) {
	// Retrieve form data
	$artist_id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['artist_id']);
	$artist_name = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['artist_name']);
	$email = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	$mobile_no = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['mobile_no']);
	$address = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['address']);
	$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['password']);

	// Insert data into the artist table
	$query = "INSERT INTO artist (artist_id,artist_name, email_id, mobile_no, address, password,artist_pic) 
              VALUES ('$artist_id','$artist_name', '$email', '$mobile_no', '$address', '$password','people.png')";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
	if ($result) {
		// Registration successful
		echo '<script>alert("Registration successful!");</script>';
		// Redirect to login page or any other page
		echo '<script>location.replace("login.php");</script>';
		exit;
	} else {
		// Registration failed
		echo '<script>alert("Registration failed. Please try again.");</script>';
	}
}
if (isset ($_POST['artist_login'])) {
	if (isset ($_POST['artist_user']) && isset ($_POST['artist_pass'])) {
		$artist_user = $_POST['artist_user'];
		$artist_pass = $_POST['artist_pass'];

		// Query the artist table for login
		$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artist WHERE artist_id = '$artist_user' AND password = '$artist_pass'");
		$artist = mysqli_fetch_array($query);

		if ($artist) {
			// Artist login successful
			$_SESSION['artist_id'] = $artist['artist_id'];
			$_SESSION['artist_logged'] = true;
			$_SESSION['ID'] = $user['artist_id'];
			$_SESSION['logged'] = $user['artist_id'];
			$_SESSION['user'] = $artist_user;
			// Redirect to artist account page
			//header('Location: artist_account.php');
			?>
			<script>alert('Login Successful')</script>
			<script> location.replace("artist_account.php"); </script>
			<?php
			exit;
		} else {
			// Artist login failed
			echo "<script>alert('Incorrect artist email or password.')</script>";
			
		}
	} else {
		echo "Please provide both email and password for artist login.";
	}
}

if (isset ($_POST['login'])) {
	if (isset ($_POST['user'])) {
		if (isset ($_POST['pass'])) {
			$username = $_POST['user'];
			$pass = $_POST['pass'];
			($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE userid = '$username' AND  password = '$pass'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
			$user = mysqli_fetch_array($query);
			if ($user['verification'] == 'yes') {
				$_SESSION['ID'] = $user['customer_id'];
				$_SESSION['logged'] = $user['customer_id'];
				$_SESSION['user'] = $username;
				/*header('Location: myaccount.php');*/
				?>
				<script>alert('Login Successful!')</script>
				<script> location.replace("myaccount.php"); </script>
				<?php
			}  else {
				echo "<script>alert('please check user credentials')</script>";
				echo "<script>location.replace('login.php');</script>";
			}
		} 
	} else {
		echo "please check login detail";
		/* 	header("location: errorlogin.php"); */
	}
}

?>
<div id="main_content">
	<div id="menu_tab">
		<div class="left_menu_corner"></div>
		<ul class="menu">
			<li><a href="home.php" class="nav2"> Home</a></li>
			<li class="divider"></li>
			<li><a href="prodcateg.php" class="nav2">Products</a></li>
			<li class="divider"></li>
			<li><a href="contact.php" class="nav2">About Us</a></li>
			<li class="divider"></li>
		</ul>
		<div class="right_menu_corner"></div>
	</div>
	<!-- end of menu tab -->
	<div class="crumb_navigation"> Navigation: <a href="home.php">Home</a> &lt; <span class="current">Sign In</span>
	</div>
	<div class="left_content">
		<div class="title_box">Categories</div>
		<ul class="left_menu">
			<?php
			categories();
			?>
			<!-- <div class="title_box">Announcements</div>
			<div class="border_box">
				<input type="text" name="newsletter" class="newsletter_input" value="your email" />
				<a href="http://all-free-download.com/free-website-templates/" class="join">join</a>
			</div> -->
	</div>
	<!-- end of left content -->
	<div class="center_content">
		<div class="center_title_bar">Log In</div>
		<div class="prod_box_big">
			<div class="top_prod_box_big"></div>
			<div class="center_prod_box_big">
				<div class='logreg1'>
					<div class="loginUser">
						<div class="top"></div>
						<div class="center">
							<div class="product_title"><a>Log in as a User</a></div>
							<div class="product_img"><a><img src="administrator/icons/53.png" alt="" border="0" /></a>
							</div>
						</div>
					</div>
					<div class="loginArtist">
						<div class="top"></div>
						<div class="center">
							<div class="product_title"><a>Log in as a Artist</a></div>
							<div class="product_img"><a><img src="administrator/icons/53.png" alt="" border="0" /></a>
							</div>
						</div>
					</div>
					<div class="userRegister">
						<div class="top"></div>
						<div class="center">
							<div class="product_title"><a>Register as a User</a></div>
							<div class="product_img"><a><img src="administrator/icons/54.png" alt="" border="0" /></a>
							</div>
						</div>
					</div>
					<div class="artistRegister">
						<div class="top"></div>
						<div class="center">
							<div class="product_title"><a>Register as a Artist</a></div>
							<div class="product_img"><a><img src="administrator/icons/54.png" alt="" border="0" /></a>
							</div>
						</div>
					</div>
				</div>


				<script type='text/javascript'>
					jQuery(document).ready(function () {
						jQuery('.contact_form').hide();
						jQuery('.reg_form').hide();
						jQuery('.artist_login_form').hide();
						jQuery('.artistreg').hide();
						jQuery('.loginUser').click(function () {
							jQuery('.contact_form').toggle('slow').css('display','flex');
							jQuery('.reg_form').hide();
							jQuery('.artist_login_form').hide();
							jQuery('.artistreg').hide();
						});

						jQuery('.loginArtist').click(function () {
							jQuery('.contact_form').hide();
							jQuery('.reg_form').hide();
							jQuery('.artistreg').hide();
							jQuery('.artist_login_form').toggle('slow').css('display','flex');
							// Redirect to artist login page

						});

						jQuery('.userRegister').click(function () {
							jQuery('.reg_form').toggle('slow').css('display','flex');
							jQuery('.contact_form').hide();
							jQuery('.artist_login_form').hide();
							jQuery('.artistreg').hide();
						});

						jQuery('.artistRegister').click(function () {
							// Redirect to artist registration page
							jQuery('.contact_form').hide();
							jQuery('.reg_form').hide();
							jQuery('.artistreg').toggle('slow').css('display','flex');
							jQuery('.artist_login_form').hide();

						});
					});
				</script>
				<div id="artist_login_form" class="artist_login_form">
				<div class="artistCSS" id="artistCSS">	
				<form method="post" action="">
						<span class="blue"><strong>Artist Username:</strong></span><input type="text"
							name="artist_user">
						<span class="blue"><strong>Password</strong></span><input type="password" name="artist_pass">
						<br>
						<br>
						<span class="blue"><a href="artist_pass_reset.php">Forgot Password?</a></span><br><br>
						<input type="submit" value="Login" name="artist_login">
					</form>
				</div>
				</div>
				<div class="contact_form">
					<div id="form_row1">
						<form method="post" action="" id="logins-form" class="logins-form">

							<span class="blue"><strong>Username</strong></span><input type="text" name="user">
							<span class="blue"><strong>Password</strong></span><input type="password" name="pass">
							<br>
							<br>
							<span class="blue"><a href="user_pass_reset.php">Forgot Password?</a></span><br><br>
							<input type="submit" value="Login" name="login">
						</form>
					</div>
				</div>
				<div class="artistreg">
					<form method="post" action="">
						<label for="artist_id">Username:</label><br>
						<input type="text" id="artist_id" name="artist_id" required><br><br>

						<label for="artist_name">Artist Name:</label><br>
						<input type="text" id="artist_name" name="artist_name" required><br><br>

						<label for="email">Email:</label><br>
						<input type="email" id="email" name="email" required><br><br>

						<label for="mobile_no">Mobile No:</label><br>
						<input type="text" id="mobile_no" maxlength="10" name="mobile_no" required><br><br>

						<label for="address">Address:</label><br>
						<input type="text" id="address" name="address" required><br><br>

						<label for="password">Password:</label><br>
						<input type="password" id="password" name="password" required><br><br>

						<input type="submit" name="register" value="Register">
					</form>
				</div>
				<div class="reg_form">
					<div id="regstep1">
						<form action="" method="post" name="contacts-form" id="contacts-form">
							<strong>Firstname:</strong>
							<input type="text" name="firstname" class="required" /></br></br>
							<strong>Lastname:</strong>
							<input type="text" name="lastname" class="required" /></br></br>
							<strong>Gender:</strong>
							<select name="gender">
								<option>Male</option>
								<option>Female</option>
							</select></br></br>
							<strong>Address:</strong>
							<input type="text" name="address" class="required" /></br></br>
							<strong>Contact:</strong>
							<input type="tel" maxlength="10" name="contactno" class="required"
								onKeyPress="return isNumberKey(event)" /></br></br>
							<strong>Email:</strong>
							<input type="text" name="email1" id="email1" class="required email" /></br></br>
							<strong>Desired Username:</strong>
							<input type="text" name="loginid" id="loginid" class="required" /></br></br>
							<strong>Desired Password:</strong>
							<input type="password" name="pass1" id="pass1" class="required"
								onKeyUp="checkPass(); return false;" /></br></br>
							<strong>Confirm Password:</strong>
							<input type="password" name="pass2" id="pass2" onkeyup="checkPass(); return false;" /><span
								id="confirmMessage" class="confirmMessage"></span></br></br>
							<input type="submit" name="userReg" value="Register" />
						</form>
					</div>
				</div>
			</div>
			<div class="bottom_prod_box_big"></div>
		</div>
	</div>
	<!-- end of center content -->
	<!-- end of right content -->
</div>
<!-- end of main content -->
<?php foothtml(); ?>
<style>
	.logreg1 {
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: row;
	}
	.logreg1 > div{
		margin:2%;
	}

	.center_prod_box_big {
		display: block;
		justify-content: flex-start;
		width: 720px;
		height: auto;
		background: url(images/details_box_center.png) repeat-y;
		float: left;
		/*text-align:center;*/
		padding: 0px;
		margin: 0px;
	}
</style>