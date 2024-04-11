<?php
session_start();
require (__DIR__ . "/db.php");
require "vendor/autoload.php";

function update(){
    $artID = $_SESSION['artID'];
    $name = $_SESSION['customerName'];
    $amount = $_SESSION['amount'];
    $pay_id = $_POST['razorpay_payment_id'];
    mysqli_query($GLOBALS['___mysqli_ston'], "UPDATE art_details SET art_status='sold' where art_id='$artID'");
    mysqli_query($GLOBALS['___mysqli_ston'], "UPDATE bidreport SET art_status='sold' where art_id='$artID'");
    mysqli_query($GLOBALS['___mysqli_ston'], "UPDATE winners SET payment='paid' where art_id='$artID'");
    mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO orders (art_id,customer_name,price,payment_id,payment_status) 
        VALUES ($artID,'$name','$amount','$pay_id','paid')");
}


$keyID = "rzp_test_9MzPWng6C6djUl";
$keySecret = "5ySvFyOdNuQ1DYWDoNHxmk1E";

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyID, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    // updating database
    update();
    // end update
    $html = "<!DOCTYPE html>
    <html>
    <title>Payment Success</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #4CAF50; /* Green */
        }
    
        .payment-success {
            text-align: center;
            color: #fff;
        }
    
        .success-text {
            font-size: 36px;
            margin-bottom: 20px;
        }
    
        .payment-details {
            font-size: 24px;
            margin-bottom: 20px;
        }
    
        .goto-profile-btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            background-color: #45a049; /* Darker Green */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        .goto-profile-btn:hover {
            background-color: #357533; /* Darker shade */
        }
    </style>
    </head>
    <body>
    <div class='payment-success'>
        <p class='success-text'>Your payment was successful</p>
        <p class='payment-details'>Payment ID: {$_POST['razorpay_payment_id']}</p>
        <a href='myaccount.php' class='goto-profile-btn'>Go to Profile</a>
    </div>
    </body>
    </html>    
    ";
} else {
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;