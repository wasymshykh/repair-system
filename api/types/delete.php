<?php 

require_once '../../app/start.php';

require_once DIR.'app/auth_api.php';

$Types = new Types($db);

if (isset($_POST['id']) && !empty(normal_text($_POST['id'])) && is_numeric($_POST['id'])) {

    $type_id = normal_text($_POST['id']);
    
    $result = $Types->get_by('item_type_id', $type_id);
    if (!$result['status']) {
        end_response(400, "Type ID does not exists. Refresh your page.", true);
    }

    $type = $result['data'];

    $result = $Types->delete_transaction($type['item_type_id'], $type['item_type_name'], $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to delete type.", true);
    }

    end_response(200, 'Deleted successfully', true);
    
}

end_response(403, "Data is invalid", false);
