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
}
