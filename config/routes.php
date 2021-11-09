<?php

// config/routes.php

// page=user -> action = [login, register, forgot pass, profile, logout]
// Пътищата до файловете са релативни спрямо папка controllers/

return [
    DEFAULT_PAGE => [
        DEFAULT_ACTION => 'profiles_list_controller',
        'single' => 'profiles_single_controller',
    ],
    'user' => [
        'login' => 'user_login_controller',
        'register' => 'user_register_controller',
        'logout' => 'user_logout_controller',
    ]
];