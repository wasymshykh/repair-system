<?php 

require_once '../../app/start.php';
require_once DIR.'app/auth_api.php';

if (isset($_POST['id']) && !empty(normal_text($_POST['id'])) && is_numeric($_POST['id'])) {

    $user_id = normal_text($_POST['id']);

    if ($user_id == '1') {
        end_response(400, "Not allowed to delete this user.", true);
    }
    
    $result = $Users->get_by('user_id', $user_id);
    if (!$result['status']) {
        end_response(400, "User ID does not exists. Refresh your page.", true);
    }

    $user = $result['data'];

    $result = $Users->delete_transaction($user['user_id'], $user['user_email'], $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to delete user.", true);
    }

    end_response(200, 'Deleted successfully', true);
    
}

end_response(403, "Data is invalid", false);
