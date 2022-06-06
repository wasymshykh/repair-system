<?php 

require_once '../../app/start.php';

require_once DIR.'app/auth_api.php';

if (isset($_POST['key']) && !empty($_POST['key'])) {
    $file_path = DIR.'assets/media/uploads/pictures/'.$_POST['key'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit();
