<?php

// config/routes.php

// page=user -> action = [login, register, forgot pass, profile, logout]
// Пътищата до файловете са релативни спрямо папка controllers/

return [
    DEFAULT_PAGE => [
        DEFAULT_ACTION => 'profiles/list.php',
        'single' => 'profiles/single.php',
    ],
    'user' => [
        'login' => 'user/login.php',
        'register' => 'user/register.php',
    ]
];