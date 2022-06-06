<?php 

require_once 'app/start.php';

require_once DIR.'app/auth.php';

if (!$role_permission['manufacturers']['create']) {
    message_move('error', 'Permission is not allowed', 'manufacturers.php');
}

$Manufacturers = new Manufacturers ($db);

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['name']) && !empty(normal_text($_POST['name']))) {
        $name = normal_text($_POST['name']);

        // checking if name already exists
        $result = $Manufacturers->get_by('manufacturer_name', $name);
        if ($result['status']) {
            $errors[] = 'Manufacturer name already exists. Edit the existing manufacturer by <a href="'.href('manufacturers_edit.php?i='.$result['data']['manufacturer_id'], false).'">clicking here</a>';
        }
        
    } else {
        $errors[] = "Manufacturer name cannot be empty";
    }

    if (isset($_POST['status']) && !empty(normal_text($_POST['status']))) {
        $status = normal_text($_POST['status']);

        if ($status != "published" && $status != "unpublished") {
            $errors[] = "Status field value is incorrect";
        }
    } else {
        $errors[] = "Status cannot be empty";
    }

    if (isset($_POST['description']) && !empty(normal_text($_POST['description']))) {
        $desc = normal_text($_POST['description']);
    } else {
        $desc = "";
    }

    if (empty($errors)) {

        $result = $Manufacturers->insert_transaction($name, $desc, $status, $logged_user['user_id'], $Users);
        if ($result['status']) {
            message_move('success', 'Manufacturer is successfully inserted. <a href="'.href('manufacturers_edit.php?i='.$result['manufacturer_id'], false).'" class="btn btn-sm btn-success">Edit <i class="bi bi-arrow-right"></i></a>', 'manufacturers.php');
        } else {
            $errors[] = "Unable to insert manufacturer";
        }

    }

}

$page_title = "Create Manufacturer";
$page_type = "manufacturers";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleStatus();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/manufacturers_create.view.php';
require_once DIR.'views/layout/foot.view.php';
