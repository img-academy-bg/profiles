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
        $fileContent = file_get_contents('data/users');
        $allUsers = json_decode($fileContent, true);
        if (array_key_exists($_POST['email'], $allUsers)) {
            $user = $allUsers[$_POST['email']];
            if (password_verify($_POST['pass'], $user['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                header('Location: index.php?success=' . SUCCESS_LOGIN);
                die();
            } else {
                // ...
            }
        } else {
            // ...
        }
    }
} else {
    // Потребителят Е логнат
    // Пренасочване на потребителя към началната страница:
    header('Location: ?page=' . DEFAULT_PAGE . '&action=' . DEFAULT_ACTION);
    exit();
}