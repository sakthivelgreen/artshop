<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
        }

        .error-message {
            font-size: 24px;
            font-weight: bold;
            color: red;
        }

        .error-description {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-message">Error</div>
        <div class="error-description">
            <?php
            // Check for specific error conditions and display corresponding messages
                echo "Somthing Went Wrong <a href='/home.php'>Click here to Goto HomePage</a>";
            
            ?>
        </div>
    </div>
</body>
</html>
