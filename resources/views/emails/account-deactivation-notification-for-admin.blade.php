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
        .header {
            background-color: #f44336;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 0 0 5px 5px;
        }
        .user-details {
            background-color: #eeeeee;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
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
        <h2>Notification de désactivation de compte</h2>
    </div>

    <div class="content">
        <p>Bonjour Administrateur,</p>
        
        <p>Nous vous informons qu'un compte utilisateur a été <strong>désactivé</strong> sur la plateforme Cocollab.</p>
        
        <div class="user-details">
            <h3>Détails de l'utilisateur :</h3>
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Type de compte :</strong> {{ ucwords($user->role) }}</p>
            <p><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <p><strong>Date de désactivation :</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
        
        <p>Pour consulter les détails complets de ce compte ou le réactiver, veuillez vous connecter au tableau de bord d'administration.</p>
        
        <p>Cordialement,<br>
        Système Cocollab</p>
    </div>
</body>
</html>