<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$Manufacturers = new Manufacturers($db);
$ms = $Manufacturers->get_all();
if ($ms['status']) {
    $ms = $ms['data'];
} else {
    $ms = [];
}

$Types = new Types($db);
$types = $Types->get_all();
if ($types['status']) {
    $types = $types['data'];
} else {
    $types = [];
}

$Roles = new Roles($db);
$roles = $Roles->get_all();
if ($roles['status']) {
    $roles = $roles['data'];
} else {
    $roles = [];
}

$error_field = [];

$Jobs = new Jobs($db);

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $job_id = normal_text($_GET['i']);

    $job = $Jobs->get_detailed_by('job_id', $job_id);
    if (!$job['status']) {
        message_move('error', 'Job does not exists', 'jobs.php');
    }
    $job = $job['data'];
} else {
    message_move('error', 'Job does not exists', 'jobs.php');
}


$job_roles = $Jobs->get_job_roles_by_job_id($job['job_id']);
if ($job_roles['status']) {
    $job_roles = $job_roles['data'];
} else {
    $job_roles = [];
}

$assign_roles = [];
foreach ($job_roles as $job_role) {
    $assign_roles[] = $job_role['job_roles_role_id'];
}


$customer_name = $job['job_customer_name'];
$customer_email = $job['job_customer_email'];
$customer_phone = $job['job_customer_phone'];

$manufacturer_id = $job['job_manufacturer_id'];
$item_type_id = $job['job_item_type_id'];
$item_name = $job['job_item_name'];

$job_receiving_date = $job['job_receiving_date'];
$job_description = $job['job_description'];


if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['save'])) {

        $changes = [];

        $customer_name = "";
        if (isset($_POST['customer_name']) && !empty(normal_text($_POST['customer_name']))) {
            $customer_name = normal_text($_POST['customer_name']);
            if ($customer_name != $job['job_customer_name']) {
                $changes['job_customer_name'] = $customer_name;
            }
        } else {
            $error_field['customer_name'] = "Customer name cannot be empty";
        }
        
        $customer_email = "";
        if (isset($_POST['customer_email']) && !empty(normal_text($_POST['customer_email']))) {
            $customer_email = normal_text($_POST['customer_email']);

            if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
                $error_field['customer_email'] = "Customer email format is incorrect";
            } else if ($customer_email != $job['job_customer_email']) {
                $changes['job_customer_email'] = $customer_email;
            }
        } else {
            $error_field['customer_email'] = "Customer name cannot be empty";
        }

        $customer_phone = "";
        if (isset($_POST['customer_phone']) && !empty(normal_text($_POST['customer_phone']))) {
            $customer_phone = normal_text($_POST['customer_phone']);
        }
        if ($customer_phone != $job['job_customer_phone']) {
            $changes['job_customer_phone'] = $customer_phone;
        }

        $manufacturer_id = "";
        if (isset($_POST['item_manufacturer']) && !empty(normal_text($_POST['item_manufacturer']))) {
            $item_manufacturer = normal_text($_POST['item_manufacturer']);
            if ($item_manufacturer != $job['job_manufacturer_id']) {
                $changes['job_manufacturer_id'] = $item_manufacturer;
            }
        } else {
            $error_field['item_manufacturer'] = "Manufacturer cannot be empty";
        }

        $item_type_id = "";
        if (isset($_POST['item_type']) && !empty(normal_text($_POST['item_type']))) {
            $item_type_id = normal_text($_POST['item_type']);
            if ($item_type_id != $job['job_item_type_id']) {
                $changes['job_item_type_id'] = $item_type_id;
            }
        } else {
            $error_field['item_type'] = "Item type cannot be empty";
        }

        $item_name = "";
        if (isset($_POST['item_name']) && !empty(normal_text($_POST['item_name']))) {
            $item_name = normal_text($_POST['item_name']);
            if ($item_name != $job['job_item_name']) {
                $changes['job_item_name'] = $item_name;
            }
        } else {
            $error_field['item_name'] = "Item name cannot be empty";
        }

        $job_receiving_date = "";
        if (isset($_POST['receiving_date']) && !empty(normal_text($_POST['receiving_date']))) {
            $job_receiving_date = normal_text($_POST['receiving_date']);
            if ($job_receiving_date != $job['job_receiving_date']) {
                $changes['job_receiving_date'] = $job_receiving_date;
            }
        } else {
            $error_field['receiving_date'] = "Receiving date cannot be empty";
        }
        
        $job_description = "";
        if (isset($_POST['job_description']) && !empty(normal_text($_POST['job_description']))) {
            $job_description = normal_text($_POST['job_description']);

            if ($job_description != $job['job_description']) {
                $changes['job_description'] = $job_description;
            }
        } else {
            $error_field['job_description'] = "Job description cannot be empty";
        }
        
        $old_assign_roles = $assign_roles;
        $roles_changes = [];
        $assign_roles = [];
        if (isset($_POST['assign_roles']) && !empty($_POST['assign_roles']) && is_array($_POST['assign_roles'])) {
            $assign_roles = $_POST['assign_roles'];
            foreach ($assign_roles as $i => $_ar) {
                $assign_roles[$i] = normal_text($_ar);
            }

            if (json_encode($old_assign_roles) != json_encode($assign_roles)) {
                $roles_changes = $assign_roles;
            }
        } else {
            $error_field['assign_roles'] = "Assign job to atleast one role";
        }

        if (empty($error_field) && empty($errors)) {

            if (!empty($changes)) {

                $result = $Jobs->update_transaction($changes, $roles_changes, $job_id, $logged_user['user_id'], $Users);
                if ($result['status']) {
                    message_move('success', "Job has been updated", 'job_edit.php?i='.$job['job_id']);
                } else {
                    $errors[] = "Unable to update the job";
                }

            } else {
                message_move('success', "Data is up to date", 'job_edit.php?i='.$job['job_id']);
            }

        } else {
            $errors[] = "Error in one or more fields";
        }



    }

}


$page_title = "Edit Job (J-".$job['job_id'].")";
$page_type = "job";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/jobs/job_edit.view.php';
require_once DIR.'views/layout/foot.view.php';

