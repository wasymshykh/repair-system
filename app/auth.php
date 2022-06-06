<?php 

// look for the logged user access
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {

    $logged_user = $Users->get_by('user_id', $_SESSION['logged']);
    if (!$logged_user['status']) {
        $Users->logout();
        message_move('error', 'Invalid login session', 'login.php');
    }

    $logged_user = $logged_user['data'];

    if ($logged_user['user_status'] != 'A') {
        $Users->logout();
        message_move('error', 'Your account is inactive', 'login.php');
    }

} else {
    message_move('error', 'Login to access the page', 'login.php');
}

$role_permission = $Users->get_permission($logged_user['role_permission']);
