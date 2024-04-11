<?php
	session_start();
	$_SESSION['logged'] = 'guest';
	require(__DIR__ . "/functions.php");
	require(__DIR__ . "/htmls.php");
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_status = 'forSale'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
	while($row = mysqli_fetch_array($query))
	{
		$datenow = date("Y-m-d");
		$due_date = $row['due_date'];
		$art_id = $row['art_id'];
		if($datenow >= $due_date){
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE art_details SET art_status = 'sold' WHERE art)id = '$art_id'") || die (mysqli_error($GLOBALS["___mysqli_ston"]));
		}
	}
	$date = date("Y-m-d");
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
        <li class="divider">
		</li>
		<?php account(); ?>
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
      <div class="border_box">
       </div>
      <div ></div>
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
    
  </div>
  <!-- end of main content -->
<?php foothtml(); ?>
