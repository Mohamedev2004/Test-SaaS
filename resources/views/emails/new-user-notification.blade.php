<table style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px;">
    <tr>
        <td>
            <h2 style="color: #1a202c;">Nouvelle inscription</h2>
            <p>Bonjour Admin,</p>
            <p>Un nouvel utilisateur vient de s'inscrire sur la plateforme. Voici les détails :</p>

            <ul>
                <li><strong>Nom :</strong> {{ $user->name }}</li>
                <li><strong>Email :</strong> {{ $user->email }}</li>
                <li><strong>Type de compte :</strong> {{ ucwords($user->role) }}</li>
                <li><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</li>
            </ul>

            <p>Veuillez vérifier les informations dans le tableau de bord si nécessaire.</p>

            <p>Merci,</p>
            <p>L'équipe du site</p>
        </td>
    </tr>
</table>