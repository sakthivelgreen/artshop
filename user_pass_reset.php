<?php 
session_start();
require (__DIR__ . "/db.php");

if (isset ($_POST['reset'])){
    $username = $_POST['userid'];
    $email = $_POST['email'];
    $password = $_POST['new_password'];

    //reseting password updating in database
    $query = mysqli_query($GLOBALS['___mysqli_ston'],"SELECT * FROM customer WHERE userid = '$username'");
    $row = mysqli_fetch_array($query);
    $tblUsername = $row["userid"];
    $tblEmail = $row["email"];

    if ($username == $tblUsername || $email == $tblEmail) {
    mysqli_query($GLOBALS['___mysqli_ston'],"UPDATE customer SET password = '$password' WHERE userid = '$username'") or die(mysqli_error($con));
    echo '<script>alert("Password Reset successful!");</script>';
	echo '<script> location.replace("login.php");</script>';
}else{
    echo '<script>alert("Account doesn'."'".'t exist!");</script>';
    echo '<script> location.replace("user_pass_reset.php");</script>';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 50px;
        }
        .card {
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-reset {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h2 class="text-center">Password Reset</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="userid">User ID:</label>
                            <input type="text" id="userid" name="userid" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" name="reset" class="btn btn-primary btn-reset">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
