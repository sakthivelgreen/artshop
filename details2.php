<?php
session_start();
require (__DIR__ . "/functions.php");
require (__DIR__ . "/db.php");
require (__DIR__ . "/htmls.php");

headhtml();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="main_content">
	<div id="menu_tab">
		<div class="left_menu_corner"></div>
		<ul class="menu">
			<li><a href="home.php" class="nav2">Home</a></li>
			<li class="divider"></li>
			<li><a href="prodcateg.php" class="nav1">Products</a></li>
			<li class="divider"></li>
			<li><a href="contact.php" class="nav2">About Us</a></li>
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
	<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
	<div class="left_content">
		<div class="title_box">Categories</div>
		<ul class="left_menu">
			<?php
			categories();
			// logform();
			?>
			
	</div>
	<!-- end of left content -->
	<?php
	$id = $_GET['id'];
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
	$row = mysqli_fetch_array($query);
	?>
	<script>
		function showImagePreview(imageSrc) {
			var previewImage = document.getElementById("previewImage");
			previewImage.src = imageSrc;
			document.getElementById("imagePreviewPopup").style.display = "block";
		}

		function hideImagePreview() {
			document.getElementById("imagePreviewPopup").style.display = "none";
		}
	</script>
	<div class="center_content">
		<div class="center_title_bar">Product Details</div>
		<div class="prod_box_big">
			<div class="top_prod_box_big"></div>
			<div class="center_prod_box_big">
				<div class="product_img_big">
					<a href="#"
						onclick="showImagePreview('administrator/images/products/<?php echo $row['art_image']; ?>')"
						title="Click to Preview">
						<img src='administrator/images/products/<?php echo $row['art_image']; ?>' width='169'
							height='155' alt='' border='0' />
					</a>
					<br><br>
					<div class='bid_border_box'>
						<div class='details'><div class="product_title_big">
							<?php echo $row['art_name']; ?>
						</div></div>
					</div>
				</div>
				<div id="imagePreviewPopup">
					<img id="previewImage" src="" alt="Image Preview">
					<span onclick="hideImagePreview()">Close</span>
				</div>

				<div class="details_big_box">
					<div class='proddet'>
						<div class="specificationss">Description: <span class="blue">
								<?php echo $row['art_description']; ?>
							</span><br /><br />
							Category: <span class="blue">
								<?php
								$categid = $row['category_id'];
								($categ = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_categories WHERE categoryid = '$categid'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
								$catega = mysqli_fetch_array($categ);
								echo $catega['categoryname'];
								?>
							</span><br/><br/>
							Artist Name: <span class="blue">
							<?php 
								$ArtistID = $row['artist_id']; 
								$query = mysqli_query($GLOBALS['___mysqli_ston'],"SELECT artist_name FROM artist WHERE artist_id = '$ArtistID' ");
								$artistQ = mysqli_fetch_array($query);
								echo $artistQ['artist_name'];
								?>
							</span><br/><br/>
                            Sold to: <span class="blue">
								<?php 
                                $win=mysqli_query($GLOBALS["___mysqli_ston"],"SELECT * FROM winners WHERE art_id = '$id'");
                                $row = mysqli_fetch_array($win);
                                if(!empty($row)){
                                echo $row['customer_name'];
                            }else{
                                echo "The product is not bid by anyone!";
                            } ?>
							</span>

						</div>
					</div>
				</div>

				<div class="bottom_prod_box_big"></div>
			</div>
		</div>
	</div>
	<!-- end of center content -->
	<!-- end of right content -->
</div>
<!-- end of main content -->
<?php foothtml(); ?>
<style>
	#imagePreviewPopup {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.7);
		z-index: 9999;
		text-align: center;
		overflow: visible;
		/* don't Allow scrolling if the image is too large */
	}

	#imagePreviewPopup img {
		max-width: 90%;
		max-height: 80%;
		margin: 5% auto;
		border-radius: 5px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		/* Add shadow for depth */
	}

	#imagePreviewPopup span {
		position: absolute;
		top: 10px;
		right: 10px;
		color: #fff;
		cursor: pointer;
		font-size: 20px;
		font-weight: bold;
		padding: 5px 10px;
		background-color: rgba(0, 0, 0, 0.5);
		border-radius: 50%;
		/* Make it circular */
		transition: background-color 0.3s;
		/* Smooth transition */
	}

	#imagePreviewPopup span:hover {
		background-color: rgba(255, 255, 255, 0.5);
		/* Change color on hover */
	}
</style>