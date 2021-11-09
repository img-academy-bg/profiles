<?php

// controllers/user.php

function user_login_controller() {
    if (user_is_logged()) {
        redirect_to(DEFAULT_PAGE, DEFAULT_ACTION);
    }

    if (method_is_get()) {
        return [
            'pageTitle' => 'Users :: Login',
            'pageHeader' => 'Login'
        ];
    }
    
    process_login_form();
}

function process_login_form() {
    if (empty($_POST['email']) || empty($_POST['pass'])) {
        redirect_to('user', 'login', ['err' => ERR_MISSING_LOGIN_PARAM]);
    }
    if (strlen($_POST['pass']) < 6) {
        redirect_to('user', 'login', ['err' => ERR_INVALID_LOGIN_PARAM]);
    }

    $user = get_user_by_email($_POST['email']);
    if (!$user) {
        redirect_to('user', 'login', ['err' => ERR_INVALID_LOGIN_PARAM]);
    }

    if (password_verify($_POST['pass'], $user['password'])) {
        $_SESSION['logged'] = true;
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        redirect_to(DEFAULT_PAGE, DEFAULT_ACTION, ['success' => SUCCESS_LOGIN]);
    }

    redirect_to('user', 'login', ['err' => ERR_INVALID_LOGIN_PARAM]);
}

/**
 * Loads user by email
 * 
 * @param string $email
 * 
 * @return array
 */
function get_user_by_email(string $email): array {
    $fileContent = file_get_contents('data/users');
    $allUsers = json_decode($fileContent, true);
    if (array_key_exists($email, $allUsers)) {
        return $allUsers[$email];
    }

    return [];
}

function user_register_controller() {
    if (user_is_logged()) {
        redirect_to(DEFAULT_PAGE, DEFAULT_ACTION, ['warn' => WARN_ALREADY_LOGGED]);
    }

    if (method_is_get()) {
        return [
            'pageTitle' => 'User :: Login',
            'pageHeader' => 'Register'
        ];
    }
    validate_register_form();
    if (get_user_by_email($_POST['email'])) {
        redirect_to('user', 'register', ['err' => ERR_REGISTER_EMAIL_EXISTS]);
    }
    add_user([
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
        'avatar' => upload_user_avatar(),
    ]);

    redirect_to('user', 'login', ['success' => SUCCESS_REGISTER]);
}

function add_user(array $user) {
    $fileContent = file_get_contents('data/users');
    $allUsers = json_decode($fileContent, true);
    $allUsers[$user['email']] = $user;
    file_put_contents('data/users', json_encode($allUsers, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function upload_user_avatar(): string {
    if (empty($_FILES['avatar']) || !is_array($_FILES['avatar'])) {
        return '';
    }
    if ($_FILES['avatar']['error']) {
        return '';
    }
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
        return '';
    }
    $allowedSize = 1024 * 1024 * 2;
    if ($_FILES['avatar']['size'] > $allowedSize) {
        return '';
    }
    if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
        $ext = ($_FILES['avatar']['type'] === 'image/jpeg') ? 'jpg' : 'png';
        $fileName = md5($_POST['email']);
        $path = 'data/avatars/' . $fileName . '.' . $ext;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
            return $path;
        }
        return '';
    }
    return '';
}

function validate_register_form() {
    if (empty($_POST['first_name'])) {
        redirect_to('user', 'register', ['err' => ERR_REGISTER_MISS_FIRSTNAME]);
    }
    if (empty($_POST['last_name'])) {
        redirect_to('user', 'register', ['err' => ERR_REGISTER_MISS_LASTNAME]);
    }
    if (empty($_POST['email'])) {
        header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_EMAIL);
        die();
    }
    if (empty($_POST['pass'])) {
        header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_PASS);
        die();
    }
    if (empty($_POST['confirm_pass'])) {
        header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_CONFIRMPASS);
        die();
    }
    if (empty($_POST['t_and_t'])) {
        header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_MISS_TANDT);
        die();
    }
    if ($_POST['pass'] !== $_POST['confirm_pass']) {
        header('Location: index.php?page=user&action=register&err=' . ERR_REGISTER_CONFIRM_PASS);
        die();
    }
}

/**
 * Destroys the user's session and redirect to home page
 */
function user_logout_controller() {
    session_destroy();

    redirect_to('user', 'login');
}
