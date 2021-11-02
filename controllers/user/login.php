<?php

// controllers/user/login.php

if (empty($_SESSION['logged'])) {
    // Потребителят НЕ е логнат.
    // Проверяваме дали HTTP метода е GET:
    if (strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
        // показваме формата за вход...
        $pageTitle = 'Users :: Login';
        $pageHeader = 'Login';
    } else {
        // METHOD == POST -> проверяваме стойностите от формата за вход:
        if (empty($_POST['email']) || empty($_POST['pass'])) {
            header('Location: index.php?page=user&action=login&err=' . ERR_MISSING_LOGIN_PARAM);
            die();
        }
        // validation...
        if (strlen($_POST['pass']) < 6) {
            header('Location: index.php?page=user&action=login&err=' . ERR_INVALID_LOGIN_PARAM);
            die();
        }
        // ...
    }
} else {
    // Потребителят Е логнат
    // Пренасочване на потребителя към началната страница:
    header('Location: ?page=' . DEFAULT_PAGE . '&action=' . DEFAULT_ACTION);
    exit();
}