<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .cta-btn a,.cta-btn a:hover,.cta-btn a:active,.cta-btn a:visited {
            color:white;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rappel de renouvellement</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $name ?? '' }},</p>

        <p>Nous vous rappelons que votre pack actuel expirera le <strong>{{ $end_date }}</strong>, soit dans une semaine.</p>

        <p>Si vous avez des questions, notre équipe est à votre disposition à <a href="mailto:contact@cocollab.ma">contact@cocollab.ma</a>.</p>

        <p>Cordialement,<br>L’équipe Cocollab</p>
    </div>
</body>
</html>
