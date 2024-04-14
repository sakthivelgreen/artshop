<?php
session_start();

require(__DIR__ . "/functions.php");
require(__DIR__ . "/htmls.php");

ob_start();
headhtml();
?>

<!-- HTML and PHP code for header and menu -->

<?php
$userid = $_SESSION['ID'];
$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$userid'");
if (!$query) {
    die("Error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}

$row = mysqli_fetch_array($query);
$username = $row['userid'];


if (isset($_POST['save'])) {
    $last_save = $_POST['lname'];
    $fname_save = $_POST['fname'];
    $gender_save = $_POST['gender'];
    $address_save = $_POST['address'];
    $bday_save = $_POST['bday'];
    $contact_save = $_POST['contactno'];

    $update_query = "UPDATE customer SET customer_lastName='$last_save', customer_firstName='$fname_save', gender='$gender_save', address='$address_save', contact_no='$contact_save', dob='$bday_save' WHERE customer_id='$userid'";
    $update_result = mysqli_query($GLOBALS["___mysqli_ston"], $update_query);
    if (!$update_result) {
        die("Error updating record: " . mysqli_error($GLOBALS["___mysqli_ston"]));
    }

    // Redirect to myaccount.php after successful update
    header("Location: myaccount.php");
    exit();
}
?>

<!-- HTML and PHP code for user profile -->
<div id="main_content">
    <div id="menu_tab">
        <div class="left_menu_corner"></div>
        <ul class="menu">
            <li><a href="home.php" class="nav2">Home</a></li>
            <li class="divider"></li>
            <li><a href="prodcateg.php" class="nav2">Products</a></li>
            <li class="divider"></li>
            <li><a href="contact.php" class="nav2">About Us</a></li>
            <?php account(); ?>
            <script type='text/javascript'>
                jQuery(document).ready(function() {
                    jQuery('.nav3').hide();
                    jQuery('.nav4').click(function() {
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
            ?>
            <?php logform(); ?>
    </div>
    <!-- end of left content -->
    <?php
    $userid = $_SESSION['ID'];
    ($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$userid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
    $row = mysqli_fetch_array($query);
    $username = $row['userid'];
    if (!$row) {
        die("Error: Data not found..");
    }
    if (isset($_POST['prodsave'])) {

        $art_name = $_POST['art_name'];
        $startingbid = $_POST['starting_bid'];
        $category = $_POST['category'];
        $descrpt = $_POST['descrpt'];
        if ($startingbid > 10000) {
            $fdate = time() + (31 * 24 * 60 * 60);
            $duedate = date('l,F d,Y', $fdate);
        } else {
            $fdate = time() + (14 * 24 * 60 * 60);
            $duedate = date('l,F d,Y', $fdate);
        }
        $datenow = date('l,F d,Y');
        $name = $_FILES["imagep"]["name"];
        $type = $_FILES["imagep"]["type"];
        $size = $_FILES["imagep"]["size"];
        $temp = $_FILES["imagep"]["tmp_name"];
        $error = $_FILES["imagep"]["error"];
        mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO art_details(art_name,category_id,art_description,starting_bid,art_image,date_posted,due_date,art_status) 
						VALUES ('$art_name','$category','$descrpt','$startingbid','$name','$datenow','$duedate','forSale')") || die(mysqli_error($GLOBALS["___mysqli_ston"]));
        echo "Product has been successfully added to database!!!<br>";
        if ($error > 0) {
            die("Error uploading file! Code $error.");
        } elseif ($size > 10000000) {
            //conditions for the file
            die("Format is not allowed or file size is too big!");
        } else {
            move_uploaded_file($temp, "administrator/images/art_details/" . $name);
        }
    }
    ?>
    <div class="center_content">
        <div class="center_title_bar">USER PROFILE</div>
        <div class="prod_box_big">
            <div class="top_prod_box_big"></div>
            <div class="center_prod_box_big">
                <div class="product_img_big">
                    <?php echo "<a><img src='administrator/images/upload/" . $row['customer_img'] . "' width='169' height='155' alt='' border='0' /></a>"; ?>
                    <script type='text/javascript'>
                        jQuery(document).ready(function() {

                            jQuery('#regstep1').hide();
                            jQuery('#form_row1').hide();
                            jQuery('.one').click(function() {
                                jQuery('#regstep1').toggle('fade');
                                jQuery('.specifications').hide();
                                jQuery('#form_row1').hide();
                            });

                            jQuery('.three').click(function() {
                                jQuery('.specifications').toggle('fade');
                                jQuery('#regstep1').hide('fade');
                                jQuery('#form_row1').hide();
                            });

                            jQuery('.two').click(function() {
                                jQuery('#form_row1').toggle('fade');
                                jQuery('.specifications').hide('fade');
                                jQuery('#regstep1').hide('fade');
                            });

                        });
                    </script>
                    <div class="thumbs">
                        <center>
                            <div class="one product_title"><a href="#" style="text-decoration: none;">Edit Personal
                                    Info</a></div> <br />
                            <div class="two product_title"><a href="#" style="text-decoration: none;">Change Password
                                    and Account Pic</a></div><br />
                            <div class="three product_title"><a href="#" style="text-decoration: none;">View Personal
                                    Info</a></div>
                        </center>
                    </div>
                </div>
                <div class="details_big_box">
                    <div class="product_title_big">
                        <?php echo $row['userid']; ?>
                    </div><br /><br />
                    <div class="specifications">
                        Name: <span class="blue">
                            <?php echo "" . $row['customer_firstName'] . " " . $row['customer_lastName'] . ""; ?>
                        </span><br />
                        Contact no: <span class="blue">
                            <?php echo $row['contact_no']; ?>
                        </span><br />
                        Address: <span class="blue">
                            <?php echo $row['address']; ?>
                        </span><br />
                        Gender: <span class="blue">
                            <?php echo $row['gender']; ?>
                        </span><br />
                        Email Address: <span class="blue">
                            <?php echo $row['email']; ?>
                        </span><br />

                    </div>
                    <div id="regstep1">
                        <?php

                        if (isset($_POST['save'])) {
                            $last_save = $_POST['lname'];
                            $fname_save = $_POST['fname'];
                            $gender_save = $_POST['gender'];
                            $address_save = $_POST['address'];
                            $bday_save = $_POST['bday'];
                            $contact_save = $_POST['contact_no'];

                            mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE customer SET customer_lastName='$last_save', customer_firstName='$fname_save', gender='$gender_save', address='$address_save', birthdate='$bday_save', contact_no = '$contact_save' WHERE customer_id='$userid'") || die(mysqli_error($GLOBALS["___mysqli_ston"]));

                            header("Location: myaccount.php ");
                            // echo '<script> location.replace("myaccount.php"); </script>';
                        }

                        ?>
                        <form action="" method="post" name="contacts-form" class="contacts-form">
                            <strong>Firstname:</strong>
                            <input type="text" name="fname" class="required" value="<?php echo $row['customer_firstName']; ?>" /></br></br>
                            <strong>Lastname:</strong>
                            <input type="text" name="lname" class="required" value="<?php echo $row['customer_lastName']; ?>" /></br></br>
                            <strong>Gender:</strong>
                            <select name="gender">
                                <option>
                                    <?php echo $row['gender']; ?>
                                </option>
                                <option>Male</option>
                                <option>Female</option>
                            </select></br></br>
                            <strong>Address:</strong>
                            <input type="text" name="address" class="required" value="<?php echo $row['address']; ?>" /></br></br>
                            <strong>Contact:</strong>
                            <input type="tel" name="contactno" maxlength="10" class="required" onKeyPress="return isNumberKey(event)" value="<?php echo $row['contact_no']; ?>" /></br></br>
                            <input type="submit" name="save" value="Save" />
                        </form>

                    </div>
                    <div id="form_row1">
                        <?php
                        if (isset($_POST['btnsave'])) {

                            $password_save = $_POST['pass1'];

                            $name = $_FILES["image"]["name"];
                            $type = $_FILES["image"]["type"];
                            $size = $_FILES["image"]["size"];
                            $temp = $_FILES["image"]["tmp_name"];
                            $error = $_FILES["image"]["error"];

                            if ($error > 0) {
                                die("Error uploading file! Code $error.");
                            } elseif ($size > 10000000) {
                                //conditions for the file
                                die("Format is not allowed or file size is too big!");
                            } else {
                                move_uploaded_file($temp, "administrator/images/upload/" . $name);
                            }

                            mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE customer SET password='$password_save', customer_img='$name' WHERE customer_id='$userid'") || die(mysqli_error($GLOBALS["___mysqli_ston"]));
                            //mysql_query("INSERT INTO customer (customer_img) VALUES '$name' WHERE customer_id='$userid'") or die(mysql_error());
                            header("location: myaccount.php");
                        }
                        ?>
                        <form action="" method="post" name="contacts-form" class="contacts-form" enctype='multipart/form-data'>
                            <input type="hidden" name="email1" id="email1" class="required email" />
                            <strong>Upload Desire Account Pic:</strong>
                            <input type="file" name="image" required /></br></br>
                            <strong>Old Password:</strong>
                            <input type="text" name="loginid" id="loginid" class="required" required /></br></br>
                            <strong>Desired Password:</strong>
                            <input type="password" name="pass1" id="pass1" class="required" onKeyUp="checkPass(); return false;" required /></br></br>
                            <strong>Confirm Password:</strong>
                            <input type="password" name="pass2" id="pass2" onkeyup="checkPass(); return false;" required /><span id="confirmMessage" class="confirmMessage"></span></br></br>

                            <input type="submit" name="btnsave" value="Save" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="bottom_prod_box_big"></div>
        </div>
        <div class="center_title_bar"> Aution Winnings</div>
        <?php
        // Assuming you have a database connection established already
        // Fetch data from the database
        $query3 = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT * FROM customer WHERE customer_id = '$userid' ");
        $row3 = mysqli_fetch_array($query3);
        $customerName = $row3['customer_firstName'] . ' ' . $row3['customer_lastName'];
        $query = "SELECT * FROM winners WHERE customer_id = '$userid'";
        $result = mysqli_query($GLOBALS['___mysqli_ston'], $query);
        ?>
        <div class="center_prod_box_bigs">
            <div class="winners_table">
                <table>
                    <thead>
                        <tr>
                            <th>Bid ID</th>
                            <th>Art ID</th>
                            <th>Art Name</th>
                            <th>Bid Amount</th>
                            <th>Paymnet Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {

                            $aID = $row['art_id'];
                            $queryArt = mysqli_query($GLOBALS['___mysqli_ston'], " SELECT art_name FROM art_details where art_id = '$aID' ");
                            $row2 = mysqli_fetch_assoc($queryArt);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $row['bid_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['art_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row2['art_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['price']; ?>
                                </td>
                                <td>
                                    <?php if ($row['payment'] == 'pending') { ?>
                                        <a href="pay.php?bid_id=<?php echo $row['bid_id']; ?>&customer_name=<?php echo $customerName; ?>&customer_id=<?php echo $row['customer_id']; ?>&bid_amount=<?php echo $row['price']; ?>&art_id=<?php echo $row['art_id']; ?>&art_name=<?php echo $row2['art_name']; ?>" class="pending pay">Pay</a>
                                    <?php } else { ?>
                                        <span class="won">Paid</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <style>
            .center_prod_box_bigs {
                /* display: flex;
    justify-content: flex-start; */
                width: 720px;
                height: auto;
                float: left;
                /*text-align:center;*/
                padding: 0px;
                margin: 20px;
            }

            .won {
                color: green;
            }


            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }

            .pay {
                background-color: #4CAF50;
                color: white;
                padding: 6px 12px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>

    </div>
    <!-- end of center content -->
</div>
<!-- end of main content -->
<?php foothtml(); ?>
<?php ob_end_flush(); ?>
</div>
<!-- end of main_container -->
<script type='text/javascript'>
    jQuery(document).ready(function() {

        jQuery('.msgandnotifs').hide();
        jQuery('#showmsgandnotifs').click(function() {
            jQuery('.msgandnotifs').toggle('fade');
        });

        jQuery('.hidemsg').hide();
        jQuery('#showmsg').click(function() {
            jQuery('.hidemsg').toggle('fade');
            jQuery('.hidenotif').hide('fade');
        });

        jQuery('.hidenotif').hide();
        jQuery('#shownotif').click(function() {
            jQuery('.hidenotif').toggle('fade');
            jQuery('.hidemsg').hide('fade');
        });
    });
</script>
</body>

</html>