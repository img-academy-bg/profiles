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
    
    /*
     * 1. Отворим csv файла с профили
     * 2. Да превърнем информацията в двумерен масив
     * 3. Да сортираме профилите по първо име
     * 4. Странициране на резултатите
     */
    
    $profiles = [];
    
    // 1.
    // отваряме ресурс за четене на файла:
    $fp = fopen('data/profiles.csv', 'r');
    // взимаме първия ред, който съдържа имената на колоните:
    $keys = fgetcsv($fp);
    
    // 2.:
    // Докато fgetcsv дава резултат, различен от false:
    while (($row = fgetcsv($fp)) !== false) {
        // Комбинираме ключовете със стойностите:
        $profile = array_combine($keys, $row);
        // преформатираме рождения ден:
        $birthdayTs = strtotime($profile['birthday']);
        $profile['birthday'] = date('d.m.Y', $birthdayTs); // 04.06.2000
        //  и ги добавяме като нов профил
        $profiles[] = $profile;
    }
    fclose($fp);
    
    // 3.
    /*
     * $profiles = [
     *      [
     *          'first_name' => '...',
     *          'last_name' => '...',
     *          ...
     *      ],
     *      [
     *          'first_name' => '...',
     *          'last_name' => '...',
     *          ...
     *      ],
     *      ...
     * ]
     */
    $compareCallback = function($a, $b) {
        // -1, 0, 1
        return $a['first_name'] <=> $b['first_name'];
    };
    usort($profiles, $compareCallback);
    
    // 4.
    // Елементи на страница - ако не е посочен брой в адрес даваме 10:
    $itemsPerPage = (int) ($_GET['perPage'] ?? 10);
    // Текуща страница - ако не е посочен в адреса даваме 1:
    $currentPage = (int) ($_GET['currentPage'] ?? 1);
    // Брой страници:
    // закръгляне към цяло число нагоре:
    $totalPages = ceil(count($profiles) / $itemsPerPage);
    // Начален индекс от масива с данни:
    // 2 -> 10-19
    // 3 -> 20-29
    $offset = ($currentPage - 1) * $itemsPerPage;
    
    $profiles = array_slice($profiles, $offset, $itemsPerPage);
}
