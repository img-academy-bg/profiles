<?php

// ./index.php
// config, controllers, views

// Стартиране на сесията
session_start();

// Добавяме конфигурация по подразбиране:
require_once 'config/defaults.php';

// Проверяваме дали съществува ключа page в URL параметрите:
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = DEFAULT_PAGE;
}

// Проверяваме дали съществува ключа action в URL параметрите:
$action = $_GET['action'] ?? DEFAULT_ACTION;

$routes = require_once 'config/routes.php';

// Проверка дали $routes е масив, дали има ключ $page и дали стойността му е масив:
if (is_array($routes) && array_key_exists($page, $routes) && is_array($routes[$page])) {
    if (array_key_exists($action, $routes[$page]) && is_string($routes[$page][$action])) {
        $controller = CONTROLLERS_DIR . '/' . $routes[$page][$action];
        // проверяваме дали съществува такъв файл:
        if (file_exists($controller)) {
            require_once $controller;
        } else {
            http_response_code(500);
            die();
        }
    } else {
        http_response_code(404);
        die();
    }
} else {
    http_response_code(404);
    die();
}
// Проверяваме дали HTTP метода е GET:
if (strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
    $stringTpl = '%s/%s/%s.php';
    $viewFile = sprintf($stringTpl, VIEWS_DIR, $page, $action);
    if (!file_exists($viewFile)) {
        http_response_code(500);
        die('No such view');
    }
    // Стартиране на буферирането на изхода:
    ob_start();
    // Добавяме файла с изгледа за конкретния контролер:
    require_once $viewFile;
    // Взимаме съдържанието на буфера:
    $content = ob_get_clean();
    // Спираме буферирането:
    ob_end_clean();
    require_once VIEWS_DIR . '/layout.php';
}
