<?php
session_start();
require (__DIR__ . "/db.php");
require (__DIR__ . "/htmls.php");
require (__DIR__ . "/functions.php");
headhtml();
?>
<div id="main_content">
	<div id="menu_tab">
		<div class="left_menu_corner"></div>
		<ul class="menu">
			<li><a href="home.php" class="nav2"> Home</a></li>
			<li class="divider"></li>
			<li><a href="prodcateg.php" class="nav2">Products</a></li>
			<li class="divider"></li>
			<li><a href="contact.php" class="nav1">About Us</a></li>
			<li class="divider"></li>
			<?php account(); ?>
			<script type='text/javascript'>
				jQuery(document).ready(function () {
					jQuery('.nav3').hide();
					jQuery('.nav4').click(function () {
						jQuery('.nav3').toggle('fade');
					});
				});
			</script>
		</ul>
		<div class="right_menu_corner"></div>
	</div>
	<!-- end of menu tab -->
	<div class="crumb_navigation"> Navigation: <a href="home.php">Home</a> &lt; <span class="current">About Us</span>
	</div>
	<div class="left_content">
		<div class="title_box">Online Art Gallery Autction Zone</div>
		<ul class="left_menu">
			<div class="mandm">
				<li class="even"><a>Mission & Objectives</a></li>
			</div>
			<div class="dev">
				<li class="odd"><a>The Developer</a></li>
			</div>
		</ul>
		<?php logform(); ?>
		</div>
	<!-- end of left content -->
	<div class="center_content">
		<!-- Mission and Vission -->
		<div class="mandms">
			<div class="center_title_bar">Mission and Vission</div>
			<div class="prod_box_big">
				<div class="top_prod_box_big"></div>
				<div class="center_prod_box_big">
					<div class="welc">
						<center>Welcome to the Online Art Gallery Autction Zone</center>
					</div>
					<div class='missobj'>
						<div class="loginb">
							<div class="top_prod_box"></div>
							<div class="center_prod_box">
								<div class="product_title"><a>Our Mission</a></div>
								<div class="product_img"><a><img src="images/mission.jpg" alt="" border="0" /></a></div>
							</div>
						</div>
						<div class="regb">
							<div class="top_prod_box"></div>
							<div class="center_prod_box">
								<div class="product_title"><a>Objectives</a></div>
								<div class="product_img"><a><img src="images/objectives.jpg" alt="" border="0" /></a>
								</div>
							</div>
						</div>

					</div>
					<script type='text/javascript'>
						jQuery(document).ready(function () {

							jQuery('.contact_form').hide();
							jQuery('.reg_form').hide();
							jQuery('.loginb').click(function () {
								jQuery('.contact_form').toggle('slow');
								jQuery('.reg_form').hide();
							});
							jQuery('.regb').click(function () {
								jQuery('.reg_form').toggle('slow');
								jQuery('.contact_form').hide();
							});
						});
					</script>
					<div class="contact_form">
						<div id="form_row1a">
							<center><span class="blue">&nbsp; &nbsp; The Online Art Gallery Auction Zone purpose is to give
								and provide excelled services, creating an appropriate online auction webpage that
								promotes different kinds of Art Products.</span></center>
						</div>
					</div>

					<div class="reg_form">
						<div id="regstep1">
							<span class="blue">
								<li>To provide fast and easy online auction transactions &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;to customers with a user
									friendly online system.</li><br/>
								<li>Provide a system that can accommodate auction &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;transaction 24/7. </li>
							</span>
						</div>
					</div>
				</div>
				<div class="bottom_prod_box_big"></div>
			</div>
		</div>
		<!-- end of it -->

		<!-- The Developer -->
		<div class="developer">
			<div class="center_title_bar">The Developer</div>
			<div class="prod_box_big">
				<div class="top_prod_box_big"></div>
				<div class="center_prod_box_big">
					<div class="welc">
						<center>Lakshmi G</center>
					</div>
					<div class="welcsub">
						<center>
							<p>Developed for Final Year Project <br>With the Guidance of Below Staff
							<p>
								<br><span class="blue" style="font-size:large;">Mrs. P.Sundhari B.E., MCA,
									M.Phil,</span>
								<br><span class="blue">Department of Information Technology,</span>
								<br><span class="blue">Government Arts College(Autonomous) Coimbatore - 641 018</span>
						</center>
					</div>
				</div>
				<div class="bottom_prod_box_big"></div>
			</div>
		</div>
		<!-- end of it -->
		<!-- Script for Category lists toggle and fade-->
		<script type='text/javascript'>
			jQuery(document).ready(function () {

				//jQuery('.mandm').hide();
				jQuery('.history').hide();
				jQuery('.location').hide();
				jQuery('.contacts').hide();
				jQuery('.organization').hide();
				jQuery('.companyfeedback').hide();
				jQuery('.developer').hide();
				jQuery('.mandm').click(function () {
					jQuery('.mandms').toggle('slow');
					jQuery('.history').hide();
					jQuery('.location').hide();
					jQuery('.contacts').hide();
					jQuery('.organization').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.developer').hide();
				});
				jQuery('.loc').click(function () {
					jQuery('.location').toggle('slow');
					jQuery('.history').hide();
					jQuery('.mandms').hide();
					jQuery('.contacts').hide();
					jQuery('.organization').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.developer').hide();
				});
				jQuery('.hist').click(function () {
					jQuery('.history').toggle('slow');
					jQuery('.mandms').hide();
					jQuery('.location').hide();
					jQuery('.contacts').hide();
					jQuery('.organization').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.developer').hide();
				});
				jQuery('.con').click(function () {
					jQuery('.contacts').toggle('slow');
					jQuery('.history').hide();
					jQuery('.location').hide();
					jQuery('.mandms').hide();
					jQuery('.organization').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.developer').hide();
				});
				jQuery('.org').click(function () {
					jQuery('.organization').toggle('slow');
					jQuery('.history').hide();
					jQuery('.location').hide();
					jQuery('.contacts').hide();
					jQuery('.mandms').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.developer').hide();
				});
				jQuery('.feed').click(function () {
					jQuery('.companyfeedback').toggle('slow');
					jQuery('.history').hide();
					jQuery('.location').hide();
					jQuery('.contacts').hide();
					jQuery('.organization').hide();
					jQuery('.mandms').hide();
					jQuery('.developer').hide();
				});
				jQuery('.dev').click(function () {
					jQuery('.developer').toggle('slow');
					jQuery('.history').hide();
					jQuery('.location').hide();
					jQuery('.contacts').hide();
					jQuery('.organization').hide();
					jQuery('.companyfeedback').hide();
					jQuery('.mandms').hide();
				});
			});
		</script>
		<!-- end of Script -->
	</div>
	<!-- end of center content -->
	<!-- end of right content -->
</div>
<!-- end of main content -->
<?php foothtml(); ?>
<style>
	.reg_form {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.missobj {
		right: 10%;
		display: flex;
		justify-content: center;

	}

	.center_prod_box_big {

		width: 720px;
		height: auto;
		background: url(images/details_box_center.png) repeat-y;
		float: left;
		/*text-align:center;*/
		padding: 0px;
		margin: 0px;
	}
</style>