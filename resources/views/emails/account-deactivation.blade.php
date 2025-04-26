<!-- resources/views/emails/account/deactivated.blade.php -->
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
            background-color: #ff6b6b;
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
        <h1>Information importante concernant votre compte</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $user->name ?? '' }},</p>
        
        <p>Nous vous informons que votre compte Cocollab a été <strong>désactivé</strong>.</p>
        
        <p>Cela peut être dû à l'une des raisons suivantes :</p>
        
        <ul>
            <li>Votre abonnement est arrivé à expiration</li>
            <li>Votre compte a été désactivé à votre demande</li>
            <li>Une violation des conditions d'utilisation a été détectée</li>
        </ul>
        
        <p>Si vous pensez qu'il s'agit d'une erreur ou si vous souhaitez réactiver votre compte, veuillez contacter notre service client dès que possible :</p>
        
        <div class="cta-btn" style="text-align: center;">
            <a href="mailto:contact@cocollab.ma" class="button">Contacter le support</a>
        </div>
        
        <p>Cordialement,<br>
        L'équipe Cocollab</p>
    </div>
</body>
</html>