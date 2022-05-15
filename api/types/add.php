<?php 

require_once '../../app/start.php';
require_once DIR.'app/auth_api.php';

$Types = new Types($db);

if (isset($_POST['name']) && !empty(normal_text($_POST['name']))) {
    $type_name = normal_text($_POST['name']);
    
    $result = $Types->get_by('item_type_name', $type_name);
    if ($result['status']) {
        $result = $result['data'];
        end_response(200, ['message' => 'Type name already exists.', 'item_type_id' => $result['item_type_id'], 'item_type_name' => $result['item_type_name']], true);
    }

    $type = $result['data'];

    $result = $Types->insert_transaction($type_name, null, 'published', $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to insert type.", true);
    }

    end_response(200, ['message' => 'Type inserted successfully', 'item_type_id' => $result['type_id'], 'item_type_name' => $type_name], true);
}

end_response(403, "Data is invalid", false);
