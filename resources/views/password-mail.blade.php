<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans:wght@300;400;500;700&display=swap');

        body {
            font-family: "Google Sans",Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fafafa;
            direction: rtl; /* Set text direction to right-to-left for Arabic */
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: right; /* Align text to the right for Arabic */
        }

        h2 {
            color: #007bff;
            text-align: center;
            direction: rtl !important;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.2;
            word-wrap: normal
        }

        p {
            font-size: 22px;
            color: #333;
            line-height: 1.6;
            direction: rtl;
        }

        .verification-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin: 20px 0;
        }

        .note {
            color: #555;
            margin-bottom: 20px;
            font-size: 22px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>تم تعيين كلمة المرور الخاصة بحسابك</h2>
    <p>مرحبًا <span>{{$message_password['full_name']}}</span></p>
    <p>كلمة المرور الخاصة بحسابك هي</p>
    <div class="verification-code">{{$message_password['password']}}</div>
    <p class="note">لا تعطها أبداً لأي شخص.</p>
    <br>
    <p class="note">من الممكن استخدام كلمة المرور هذه لتسجيل الدخول لحسابك في نظام MQM. لن نطبها لأي غرض آخر</p>
    <br>
    <p class="note">إذا لم تقم بطلب كلمة المرور عن طريق مسؤول النظام، يرجى مراجعة مسؤول النظام لمعرفة سبب إرسال كلمة المرور</p>

</div>

</body>
</html>
