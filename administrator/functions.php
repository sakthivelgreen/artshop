<?php
require (__DIR__ . "/../db.php");
function cats(){
		($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_categories`")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
		  echo "<select name ='category'>";
		  echo "<option>Select Category</option>";
		while($row = mysqli_fetch_array($query)){
				
				echo "<option value='".$row['categoryid']."'>".$row['categoryname']."</option>";							
		}
				echo "</select>";
}

function categoryadd(){
	if (isset($_POST['cmdadd'])) 
 	{
 	$name = $_FILES["catimage"] ["name"];
	$type = $_FILES["catimage"] ["type"];
	$size = $_FILES["catimage"] ["size"];
	$temp = $_FILES["catimage"] ["tmp_name"];
	$error = $_FILES["catimage"] ["error"];
	if ($error > 0) {
     die("Error uploading file! Code $error.");
 } elseif ($size > 1000000000) {
     //conditions for the file
     die("Format is not allowed or file size is too big!");
 } else{
			move_uploaded_file($temp,"images/category/".$name);
			echo "Upload Complete!";
		} 			
	$categoryname = $_POST['categoryname'];
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO art_categories(categoryname, catimage) VALUES('$categoryname','$name')") || die(mysqli_error($GLOBALS["___mysqli_ston"]));  
	echo " One record successfully added!";
	}
}
	