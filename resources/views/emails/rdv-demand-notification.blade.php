<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle demande de rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 5px;
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
        <h1>Nouvelle demande de rendez-vous</h1>
    </div>

    <div class="content">
        <p>Bonjour Admin,</p>
        
        <p>Une nouvelle demande de rendez-vous a été soumise avec les détails suivants :</p>
        
        <ul>
            <li><strong>Nom :</strong> {{ $meeting->name }}</li>
            <li><strong>Email :</strong> {{ $meeting->email }}</li>
            <li><strong>Téléphone :</strong> {{ $meeting->phone }}</li>
            <li><strong>Date du rendez-vous :</strong> {{ $meeting->meeting_date }}</li>
        </ul>
        
        <p>Veuillez traiter cette demande dès que possible.</p>
        
        <p>Cordialement,<br>
        L'équipe du site</p>
    </div>

    <div class="footer">
        <p>Ce message a été envoyé automatiquement. Merci de ne pas y répondre directement.</p>
    </div>
</body>
</html>