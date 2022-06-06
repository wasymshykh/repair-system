<?php 

require_once '../../app/start.php';

require_once DIR.'app/auth_api.php';

header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit();
