<?php

require_once 'app/start.php';

require_once DIR.'app/auth.php';

if (!$role_permission['manufacturers']['write']) {
    message_move('error', 'Permission is not allowed', 'manufacturers.php');
}

$Manufacturers = new Manufacturers ($db);

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $manufacturer_id = normal_text($_GET['i']);

    $manufacturer = $Manufacturers->get_by('manufacturer_id', $manufacturer_id);
    if (!$manufacturer['status']) {
        message_move('error', 'Manufacturer does not exists', 'manufacturers.php');
    }
    $manufacturer = $manufacturer['data'];
} else {
    message_move('error', 'Manufacturer does not exists', 'manufacturers.php');
}

$name = $manufacturer['manufacturer_name'];
$desc = $manufacturer['manufacturer_desc'];
$status = $manufacturer['manufacturer_status'];

if (isset($_POST) && !empty($_POST)) {

    $changes = [];

    if (isset($_POST['name']) && !empty(normal_text($_POST['name']))) {
        $name = normal_text($_POST['name']);

        if ($name != $manufacturer['manufacturer_name']) {
            // checking if name already exists
            $result = $Manufacturers->get_by('manufacturer_name', $name);
            if ($result['status']) {
                $errors[] = 'Manufacturer name already exists. Edit the existing manufacturer by <a href="'.href('manufacturers_edit.php?i='.$result['data']['manufacturer_id'], false).'">clicking here</a>';
            } else {
                $changes['manufacturer_name'] = $name;
            }
        }
        
    } else {
        $errors[] = "Manufacturer name cannot be empty";
    }

    if (isset($_POST['status']) && !empty(normal_text($_POST['status']))) {
        $status = normal_text($_POST['status']);

        if ($status != "published" && $status != "unpublished") {
            $errors[] = "Status field value is incorrect";
        } else {

            if ($status != $manufacturer['manufacturer_status']) {
                $changes['manufacturer_status'] = $status;
            }

        }
    } else {
        $errors[] = "Status cannot be empty";
    }

    if (isset($_POST['description']) && !empty(normal_text($_POST['description']))) {
        $desc = normal_text($_POST['description']);
    } else {
        $desc = "";
    }

    if ($desc != $manufacturer['manufacturer_desc']) {
        $changes['manufacturer_desc'] = $desc;
    }

    if (empty($errors)) {

        if (!empty($changes)) {
            $result = $Manufacturers->update_transaction($changes, $manufacturer_id, $logged_user['user_id'], $Users);
            if ($result['status']) {
                message_move('success', 'Manufacturer is successfully updated.', 'manufacturers_edit.php?i='.$manufacturer_id);
            } else {
                $errors[] = "Unable to update the manufacturer";
            }
        } else {
            $success[] = "No changes are made to the data";
        }
        
    }

}

$page_title = "Edit Manufacturer";
$page_type = "manufacturers";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleStatus();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/manufacturers_create.view.php';
require_once DIR.'views/layout/foot.view.php';
