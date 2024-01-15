<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Blocked</title>
    <style>
        body {
            font-family: "Google Sans", Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            direction: rtl; /* Set text direction to right-to-left for Arabic */
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #dc3545;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }

        .warning-icon {
            font-size: 48px;
            color: #dc3545;
        }

        .contact-support {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    @if($block_account['block'])
        <i class="warning-icon">&#9888;</i>
        <h2>تم حظر حسابك</h2>
        <p>للأسف، تم حظر حسابك بشكل مؤقت. يرجى التواصل مع دعم العملاء للمزيد من المساعدة.</p>
        <p class="contact-support">للتواصل مع دعم العملاء: support@example.com</p>
    @else
        <h2>تم رفع الحظر عن حسابك</h2>
    @endif

</div>

</body>
</html>
