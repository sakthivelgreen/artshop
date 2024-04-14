<?php
// Include necessary files and start session if required
require_once (__DIR__ . "/functions.php");
require_once (__DIR__ . "/db.php");

// Check if the action parameter is set and call the corresponding function
?>
<html>

<body>
     <!-- // Call the updatestatus function -->
    <?php updatestatus(); ?>
</body>

</html>
<?php
// Define the updatestatus function
function updatestatus()
{
    // Retrieve variables
    // For getting product id
    $id = $_GET['id'];
    ($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
    $row = mysqli_fetch_array($query);
    $starting_bid = $row['starting_bid'];

    //for Getting highest bid amount from report table
    ($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
    $highbid = 0;
    while ($highonthis = mysqli_fetch_array($query2)) {
        $checkthis = $highonthis['bidamount'];
        if ($checkthis > $highbid) {
            $highbid = $checkthis; 
        }
    }
    if ($starting_bid == $highbid) {
        mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE art_details SET bidding_status = 'closed' WHERE art_id = '$id'");
    } else {

        // Retrieving details (customer id, bidding id and art id) using higest bid amount - $highbid 
        ($highestbidder = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE bidamount = '$highbid' AND art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
        $highestbiddera = mysqli_fetch_array($highestbidder);
        if (empty ($highestbiddera)) {
            $highbid_customerID = "";
            $highbid_id = "";
            $art_id = "";
        } else {
            $highbid_customerID = $highestbiddera['customer_id'];
            $highbid_id = $highestbiddera['bidid'];
            $art_id = $highestbiddera['art_id'];
        }

        //Getting the Bid status from art_details
        $query1 = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT * FROM art_details WHERE art_id = '$id'");
        $row1 = mysqli_fetch_array($query1);
        if (empty ($row1)) {
            $bidding_status = "";
        } else {
            $bidding_status = $row1['bidding_status'];
        }
        // Inserting in Winners table
        if ($bidding_status == 'open') {
            mysqli_query($GLOBALS['___mysqli_ston'], "INSERT INTO winners (bid_id,customer_id,price,art_id,payment) 
				VALUES ('$highbid_id','$highbid_customerID','$highbid','$art_id','pending')");
            mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE art_details SET bidding_status = 'closed' WHERE art_id = '$id'");
            echo "Time Up!, The Bidding for this product is closed! <a href='/home.php'>Back to Home</a>";
        } else {
            mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE art_details SET bidding_status = 'closed' WHERE art_id = '$id'");
            echo "The Bidding for this product is closed! <a href='/home.php'>Back to Home</a>";
        }
        exit;

    }


}

// If the action parameter is not set or is invalid, redirect to an appropriate page
header("Location: error_page.php");
exit;
?>