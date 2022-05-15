<?php 

require_once '../../app/start.php';
require_once DIR.'app/auth_api.php';

$Manufacturers = new Manufacturers ($db);

if (isset($_POST['name']) && !empty(normal_text($_POST['name']))) {
    $manufacturer_name = normal_text($_POST['name']);

    $result = $Manufacturers->get_by('manufacturer_name', $manufacturer_name);
    if ($result['status']) {
        $result = $result['data'];
        end_response(200, ['message' => "Manufacturer name already exists.", 'manufacturer_id' => $result['manufacturer_id'], 'manufacturer_name' => $result['manufacturer_name']], true);
    }

    $manufacturer = $result['data'];
    $result = $Manufacturers->insert_transaction($manufacturer_name, null, 'published', $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to add manufacturer.", true);
    }

    end_response(200, ['message' => 'Manufacturer added successfully', 'manufacturer_id' => $result['manufacturer_id'], 'manufacturer_name' => $manufacturer_name], true);
}

end_response(403, "Data is invalid", false);
