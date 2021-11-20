<?php

// config/defaults.php

// page по подразбиране
define('DEFAULT_PAGE', 'profiles');

// action по подразбиране
define('DEFAULT_ACTION', 'list');

// папка с контролери:
define('CONTROLLERS_DIR', 'controllers');

// папка с изгледи
define('VIEWS_DIR', 'views');

// Грешки при вход:
define('ERR_MISSING_LOGIN_PARAM', 1);
define('ERR_INVALID_LOGIN_PARAM', 2);

// Грешки и предупреждение при регистрация:
define('ERR_REGISTER_MISS_FIRSTNAME', 3);
define('ERR_REGISTER_MISS_LASTNAME', 4);
define('ERR_REGISTER_MISS_EMAIL', 5);
define('ERR_REGISTER_MISS_PASS', 6);
define('ERR_REGISTER_MISS_CONFIRMPASS', 7);
define('ERR_REGISTER_MISS_TANDT', 8);
define('ERR_REGISTER_CONFIRM_PASS', 9);
define('ERR_REGISTER_EMAIL_EXISTS', 10);


define('WARN_ALREADY_LOGGED', 1);

define('SUCCESS_REGISTER', 1);
define('SUCCESS_LOGIN', 2);

// Други константи:
define('MAX_PAGE_LINKS', 5);
