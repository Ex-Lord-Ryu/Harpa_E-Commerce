<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
            background-color: #f9f7ed;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #c9a253;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #c9a253;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .code-container {
            background-color: #f9f7ed;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin: 25px 0;
            border: 1px solid #e7e3d0;
        }
        .code {
            font-size: 30px;
            letter-spacing: 5px;
            font-weight: bold;
            color: #4a3e27;
            padding: 10px;
        }
        .instructions {
            margin-bottom: 25px;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Code</h1>
            <p>Hello {{ $name ?? 'there' }},</p>
        </div>

        <div class="instructions">
            <p>You've requested to reset your password. Use the following verification code to complete the process:</p>
        </div>

        <div class="code-container">
            <div class="code">{{ $otp }}</div>
        </div>

        <p>This code will expire in 60 minutes. If you didn't request this password reset, please ignore this email.</p>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
