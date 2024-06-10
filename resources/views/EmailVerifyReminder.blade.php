<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 50px auto;
            max-width: 600px;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #4CAF50;
            color: #ffffff;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px 20px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            margin: 0 0 20px;
        }
        .content a {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #dddddd;
            background-color: #f9f9f9;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            <p>Thank you for registering! Please click the button below to verify your email address:</p>
            <a href="{{ $verificationUrl }}">Verify Email</a>
        </div>
        <div class="footer">
            <p>If you did not create an account, no further action is required.</p>
        </div>
    </div>
</body>
</html>
