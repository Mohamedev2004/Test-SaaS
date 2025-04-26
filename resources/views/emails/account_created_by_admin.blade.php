<div>
    <h2>Bonjour {{ $name }},</h2>

    <p>Un compte vient d’être créé pour vous par un administrateur.</p>

    <p>Voici vos identifiants :</p>

    <ul>
        <li><strong>Email :</strong> {{ $email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>

    <p>Lors de votre première connexion, vous devrez changer votre mot de passe.</p>

    <p>
        Vous pouvez vous connecter ici :
        <a href="{{ route('login') }}">Se connecter</a>
    </p>

    <p>Merci et bienvenue !</p>

    <p>— L'équipe</p>
</div>