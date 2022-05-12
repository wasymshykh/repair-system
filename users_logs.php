<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $user_id = normal_text($_GET['i']);
    $user = $Users->get_by('user_id', $user_id);
    if (!$user['status']) {
        message_move('error', 'User does not exists', 'users.php');
    }
    $user = $user['data'];
} else {
    message_move('error', 'User does not exists', 'users.php');
}

$logs = $Users->get_user_logs($user_id, 20);

if (!$logs['status']) {
    $logs = [];
    $errors[] = "Unable get logs";
} else {
    $logs = $logs['data'];
}

$page_title = "User Logs";
$page_type = "users";
$page_type_sub = "users_logs";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/users/users_logs.view.php';
require_once DIR.'views/layout/foot.view.php';
