<?php 

// look for the logged user access
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {

    $logged_user = $Users->get_by('user_id', $_SESSION['logged']);
    if (!$logged_user['status']) {
        $Users->logout();
        end_response(403, 'Invalid login session', true);
    }

    $logged_user = $logged_user['data'];

    if ($logged_user['user_status'] != 'A') {
        $Users->logout();
        end_response(403, 'Your account is inactive', true);
    }

} else {
    end_response(403, 'Login to access the page', true);
}
