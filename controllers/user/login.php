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
        // ...
    }
} else {
    // Потребителят Е логнат
    // Пренасочване на потребителя към началната страница:
    header('Location: ?page=' . DEFAULT_PAGE . '&action=' . DEFAULT_ACTION);
    exit();
}