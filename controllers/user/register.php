<?php

// controllers/user/register.php

/*
 * 1. Ако потребителят е логнат -> пренасочваме към началната страница с предупреждение
 * 2. Ако потребителят НЕ е логнат ->
 * 2.1. Ако HTTP метода е GET -> Показваме форма за регистрация
 * 2.2. Ако HTTP метода е POST -> обработваме данните от формата
 */

if (!empty($_SESSION['logged'])) {
    // 1. ...
    header('Location: index.php?warn=' . WARN_ALREADY_LOGGED);
    die();
} else {
    // 2. ...
    if (strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
        // 2.1.
        $pageTitle = 'User :: Login';
        $pageHeader = 'Register';
    } else {
        // 2.2.
        // Проверка дали съществува стойност за първо име:
        if (empty($_POST['first_name'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_FIRSTNAME);
            die();
        }
        // Проверка дали съществува стойност за фамилно име:
        if (empty($_POST['last_name'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_LASTNAME);
            die();
        }
        // Проверка дали съществува стойност за email:
        if (empty($_POST['email'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_EMAIL);
            die();
        }
        // Проверка дали съществува стойност за парола:
        if (empty($_POST['pass'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_PASS);
            die();
        }
        // Проверка дали съществува стойност за потвърждаване на паролата:
        if (empty($_POST['confirm_pass'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_CONFIRMPASS);
            die();
        }
        // Проверка дали съществува стойност за terms & conditions:
        if (empty($_POST['t_and_t'])) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_TANDT);
            die();
        }
        // Проверка дали паролата е правилно потвърдена:
        if ($_POST['pass'] !== $_POST['confirm_pass']) {
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_CONFIRM_PASS);
            die();
        }
        // regex validations...
        /*
         * 1. Проверка дали email-a е вече регистриран? Ако е -> пренасочване...
         * 2. Ако не е -> 
         * 2.1. събираме данните в асоц. масив
         * 2.2. добавяме ги към списъка с потребители от data/users
         * 2.3. записваме данните във файла
         */
        /*
         * $allUsers = [
         *      'j.doe@example.com' => [
         *          'first_name' => '...',
         *          'last_name' => '...',
         *          'avatar' => '....',
         *          'password' => '...',
         *      ],
         *      'jane.doe@example.com' => [
         *          'first_name' => '...',
         *          'last_name' => '...',
         *          'avatar' => '....',
         *          'password' => '...',
         *      ],
         * ]
         */
        /*
         * JSON - JavaScript Object Notation
         */
        // 1.
        $fileContent = file_get_contents('data/users');
        $allUsers = json_decode($fileContent, true);
        if (array_key_exists($_POST['email'], $allUsers)) {
            // Email-а вече е регистриран -> пренасочваме:
            header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_EMAIL_EXISTS);
            die();
        }
        
        // 2.1.
        $user = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
        ];
        // 2.2.
        $allUsers[$_POST['email']] = $user;
        file_put_contents('data/users', json_encode($allUsers, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        
        // 2.3. Avatar processing...
        
        header('Location: index.php?success=' . SUCCESS_REGISTER);
        die();
    }
}
