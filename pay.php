<?php
session_start();
require (__DIR__ . "/db.php");
require "vendor/autoload.php";

use Razorpay\Api\Api;

$keyID = "rzp_test_9MzPWng6C6djUl";
$keySecret = "5ySvFyOdNuQ1DYWDoNHxmk1E";

$api = new Api($keyID, $keySecret);

// Assuming you have a database connection established already
// Fetch payment amount from the winners table based on bid_id
$bid_id = $_GET['bid_id']; // Assuming bid_id is passed through GET parameter
$customerName = $_GET['customer_name'];
$customerID = $_GET['customer_id'];
$artID = $_GET['art_id'];
$artName = $_GET['art_name'];
$payable_amount = $_GET['bid_amount'];

$receipt = str_replace('.', '', microtime(true)) . rand(1, 1000) . '_' . $customerID;

$order = $api->order->create(array('receipt' => $receipt, 'amount' => $payable_amount * 100, 'currency' => 'INR'));

$order_id = $order['id'];
$order_receipt = $order['receipt'];
$order_amount = $order['amount'];
$_SESSION['razorpay_order_id'] = $order_id;
$_SESSION['customerID'] = $customerID;
$_SESSION['bidID'] = $bid_id;
$_SESSION['customerName'] = $customerName;
$_SESSION['artID'] = $artID;
$_SESSION['artName'] = $artName;
$_SESSION['amount'] = $payable_amount;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .razorpay-payment-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            background-color: #4CAF50;
            /* Green */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .razorpay-payment-button:hover {
            background-color: #45a049;
            /* Darker Green */
        }

        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="process_payment.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Art Name:</label>
                                    <input type="text" value="<?php echo $artName; ?>" class="form-control" id="name"
                                        name="name" required readonly>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="amount">Payable Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    value="<?php echo $payable_amount; ?>" required readonly>
                            </div>
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?= $keyID ?>"
                                data-amount="<?= $order_amount ?>" data-currency="INR" data-order_id="<?= $order_id ?>"
                                data-buttontext="Proceed Payment" data-name="Online Arts Shop" data-description=""
                                data-image="https://example.com/your_logo.jpg" data-prefill.name="<?= $customerName ?>"
                                data-theme.color="#32b288"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>