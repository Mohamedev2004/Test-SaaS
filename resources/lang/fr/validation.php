<?php

return [
    'required' => 'Le champ est obligatoire.',

    'max' => [
        'string' => 'Le champ ne doit pas dépasser :max caractères.',
    ],

    'min' => [
        'string' => 'Le champ doit contenir au moins :min caractères.',
    ],

    'string' => 'Le champ doit être une chaîne de caractères.',

    'regex' => 'Le champ n\'est pas valide.',

    // Custom messages for the current_password rule
    'custom' => [
        'current_password' => [
            'required' => 'Le mot de passe actuel est obligatoire.',
            'current_password' => 'Le mot de passe actuel que vous avez entré est incorrect.',
        ],
    ],

    // Nom personnalisés des champs
    'attributes' => [
        'name' => 'nom du pack',
        'description' => 'description du pack',
        'features' => 'caractéristiques',
    ],
];
