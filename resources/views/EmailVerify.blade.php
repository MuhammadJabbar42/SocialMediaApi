<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
        }
        .verification-code {
            font-size: 24px;
            text-align: center;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 5px;
        }
        .instructions {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="verification-code">
            <p>Your verification code:</p>
            <h2>{{ $verificationCode }}</h2>
        </div>
        <div class="instructions">
            <p>Please use the verification code above to verify your email address.</p>
        </div>
    </div>
</body>
</html>
