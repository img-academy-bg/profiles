<?php

// controllers/profiles/list.php

if (empty($_SESSION['logged'])) {
    // Потребителят не е логнат...
    header('Location: index.php?page=user&action=login');
    die();
} else {
    // Потребителят Е логнат -> показваме списък с профили:
    $pageTitle = 'Home :: Profile list';
    $pageHeader = 'Profile List';
}
