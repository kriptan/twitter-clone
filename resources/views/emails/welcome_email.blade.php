
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Team!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Team!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for joining our team! We're thrilled to have you on board.</p>
            <p>Here are a few things you can do to get started:</p>
            <ul>
                <li>Complete your profile</li>
                <li>Explore our resources</li>
                <li>Connect with your teammates</li>
            </ul>
            <p>If you have any questions, please don't hesitate to reach out to our support team.</p>
           
            <p>Best regards,<br>The Team</p>
        </div>
    </div>
</body>
</html>
