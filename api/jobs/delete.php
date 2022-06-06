<?php 

require_once '../../app/start.php';

require_once DIR.'app/auth_api.php';

$Jobs = new Jobs ($db);

if (isset($_POST['id']) && !empty(normal_text($_POST['id'])) && is_numeric($_POST['id'])) {

    $job_id = normal_text($_POST['id']);
    
    $result = $Jobs->get_detailed_by ('job_id', $job_id);
    if (!$result['status']) {
        end_response(400, "Job ID does not exists. Refresh your page.", true);
    }

    $job = $result['data'];

    $result = $Jobs->delete_transaction($job['job_id'], $job['job_item_name'], $logged_user['user_id'], $Users);
    if (!$result['status']) {
        end_response(400, "Unable to delete job.", true);
    }

    end_response(200, 'Deleted successfully', true);
    
}

end_response(403, "Data is invalid", false);
