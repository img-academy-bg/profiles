<?php

// controllers/profiles.php

function profiles_list_controller() {
    if (!user_is_logged()) {
        redirect_to('user', 'login');
    }
    $pageTitle = 'Home :: Profile list';
    $pageHeader = 'Profile List';

    $profiles = get_profiles();
    $viewModel = paginate_profiles($profiles);
    $viewModel['pageTitle'] = $pageTitle;
    $viewModel['pageHeader'] = $pageHeader;

    return $viewModel;
}

function paginate_profiles(array $profiles): array {
    $itemsPerPage = (int) ($_GET['perPage'] ?? 10);
    $currentPage = (int) ($_GET['currentPage'] ?? 1);
    $totalPages = ceil(count($profiles) / $itemsPerPage);
    $offset = ($currentPage - 1) * $itemsPerPage;
    $profiles = array_slice($profiles, $offset, $itemsPerPage);

    return [
        'itemsPerPage' => $itemsPerPage,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'offset' => $offset,
        'profiles' => $profiles
    ];
}

/**
 * Loads all profiles from the csv file
 * 
 * @return array
 */
function get_profiles(): array {
    $fp = fopen('data/profiles.csv', 'r');
    $keys = fgetcsv($fp);
    $profiles = [];
    while (($row = fgetcsv($fp)) !== false) {
        $profile = array_combine($keys, $row);
        $birthdayTs = strtotime($profile['birthday']);
        $profile['birthday'] = date('d.m.Y', $birthdayTs);
        $profiles[] = $profile;
    }
    fclose($fp);

    $compareCallback = function ($a, $b) {
        return $a['first_name'] <=> $b['first_name'];
    };
    usort($profiles, $compareCallback);

    return $profiles;
}

function profiles_single_controller() {
    if (!user_is_logged()) {
        redirect_to('user', 'login');
    }

    if (empty($_GET['id'])) {
        redirect_to(DEFAULT_PAGE, DEFAULT_ACTION);
    }

    $viewModel = [
        'pageTitle' => 'Single Profile',
        'pageHeader' => 'Profile ',
    ];
    
    $id = $_GET['id'];
    $profile = get_profile_by_id($id);
    $viewModel['pageHeader'] .= ' :: ' . $profile['first_name'] . ' ' . $profile['last_name'];
    $viewModel['profile'] = $profile;
    
    return $viewModel;
}

function get_profile_by_id(string $id): array {
    $fp = fopen('data/profiles.csv', 'r');
    $keys = fgetcsv($fp);
    $profile = [];

    while (($row = fgetcsv($fp)) !== false) {
        $combined = array_combine($keys, $row);
        if ($combined['id'] === $id) {
            $profile = $combined;
            $birthdayTs = strtotime($profile['birthday']);
            $profile['birthday'] = date('d.m.Y', $birthdayTs);
            break;
        }
    }
    fclose($fp);
    
    return $profile;
}
