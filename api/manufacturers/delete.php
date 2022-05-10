<?php 

require_once '../../app/start.php';

require_once DIR.'app/auth_api.php';

$Manufacturers = new Manufacturers ($db);

if (isset($_POST['id']) && !empty(normal_text($_POST['id'])) && is_numeric($_POST['id'])) {

    $manufacturer_id = normal_text($_POST['id']);
    
    $result = $Manufacturers->get_by('manufacturer_id', $manufacturer_id);
    if (!$result['status']) {
        end_response(400, "Manufacturer ID does not exists. Refresh your page.", true);
    }

    $manufacturer = $result['data'];

    $result = $Manufacturers->delete_transaction($manufacturer['manufacturer_id'], $manufacturer['manufacturer_name'], $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to delete manufacturer.", true);
    }

    end_response(200, 'Deleted successfully', true);
    
}

end_response(403, "Data is invalid", false);
