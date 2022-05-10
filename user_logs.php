<?php 

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$logs = $Users->get_user_logs($logged_user['user_id'], 20);

if (!$logs['status']) {
    $logs = [];
    $errors[] = "Unable get logs";
} else {
    $logs = $logs['data'];
}

$page_title = "User Logs";
$page_type = "user_logs";
$page_description = "User security logs";


require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/user_logs.view.php';
require_once DIR.'views/layout/foot.view.php';
