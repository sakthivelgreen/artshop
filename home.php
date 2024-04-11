<?php
	session_start();
	require(__DIR__ . "/functions.php");
	require(__DIR__ . "/htmls.php");
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_status = 'forSale'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
	while($row = mysqli_fetch_array($query))
	{
		$datenow = date("Y-m-d");
		$duedate = $row['due_date'];
		$prodid = $row['art_id'];
		if($datenow >= $duedate){
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE art_details SET art_status = 'sold' WHERE art_id = '$prodid'") || die (mysqli_error($GLOBALS["___mysqli_ston"]));
		}
	}
	headhtml();
?>
  <div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav1">Home</a></li>
        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav2">Products</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav2">About Us</a></li>
        <li class="divider"></li>
<?php account(); ?>
<script type='text/javascript'>
	jQuery(document).ready( function() {
		jQuery('.nav3').hide();
		jQuery('.nav4').click( function() {
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
			logform();
	?>
      <div></div>
      <div class="border_box"></div>
        </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="center_title_bar">Products On Bid</div>
     	<?php
	  		latest();
		?>
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div><br><br>
  <!-- end of main content -->
<?php foothtml(); ?>
