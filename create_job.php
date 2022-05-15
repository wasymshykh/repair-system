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

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['create'])) {

        if (isset($_POST['customer_name']) && !empty(normal_text($_POST['customer_name']))) {
            $customer_name = normal_text($_POST['customer_name']);
        } else {
            $error_field['customer_name'] = "Customer name cannot be empty";
        }

        if (isset($_POST['customer_email']) && !empty(normal_text($_POST['customer_email']))) {
            $customer_email = normal_text($_POST['customer_email']);
            if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
                $error_field['customer_email'] = "Customer email format is incorrect";
            }
        } else {
            $error_field['customer_email'] = "Customer email cannot be empty";
        }
        
        if (isset($_POST['customer_phone']) && !empty(normal_text($_POST['customer_phone']))) {
            $customer_phone = normal_text($_POST['customer_phone']);
        } else {
            $customer_phone = "";
        }

        if (isset($_POST['item_manufacturer']) && !empty(normal_text($_POST['item_manufacturer']))) {
            $item_manufacturer = normal_text($_POST['item_manufacturer']);
        } else {
            $error_field['item_manufacturer'] = "Manufacturer cannot be empty";
        }

        if (isset($_POST['item_type']) && !empty(normal_text($_POST['item_type']))) {
            $item_type = normal_text($_POST['item_type']);
        } else {
            $error_field['item_type'] = "Item type cannot be empty";
        }

        if (isset($_POST['item_name']) && !empty(normal_text($_POST['item_name']))) {
            $item_name = normal_text($_POST['item_name']);
        } else {
            $error_field['item_name'] = "Item name cannot be empty";
        }

        if (isset($_POST['receiving_date']) && !empty(normal_text($_POST['receiving_date']))) {
            $receiving_date = normal_text($_POST['receiving_date']);
        } else {
            $error_field['receiving_date'] = "Receiving date cannot be empty";
        }

        if (isset($_POST['job_description']) && !empty(normal_text($_POST['job_description']))) {
            $job_description = normal_text($_POST['job_description']);
        } else {
            $error_field['job_description'] = "Job description cannot be empty";
        }
        
        if (isset($_POST['assign_roles']) && !empty($_POST['assign_roles']) && is_array($_POST['assign_roles'])) {
            $assign_roles = $_POST['assign_roles'];

            foreach ($assign_roles as $i => $_ar) {
                $assign_roles[$i] = normal_text($_ar);
            }
        } else {
            $error_field['assign_roles'] = "Assign job to atleast one role";
        }

        if (empty($error_field) && empty($errors)) {
            $result = $Jobs->insert_transaction($item_manufacturer, $item_type, $customer_name, $customer_email, $customer_phone, $item_name, $job_description, null, $receiving_date, 'PINK', $assign_roles, $logged_user['user_id'], $Users);
            if ($result['status']) {
                message_move('success', 'A job has successfully added to the system.', 'job.php?i='.$result['job_id']);
            } else {
                $errors[] = "Unable to create a job";
            }
        } else {
            $errors[] = "Error in one or more fields";
        }

    }

}

$page_title = "Create Job";
$page_type = "create_job";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/create_job.view.php';
require_once DIR.'views/layout/foot.view.php';
