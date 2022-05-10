<?php

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$Types = new Types($db);

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $type_id = normal_text($_GET['i']);

    $type = $Types->get_by('item_type_id', $type_id);
    if (!$type['status']) {
        message_move('error', 'Type does not exists', 'types.php');
    }
    $type = $type['data'];
} else {
    message_move('error', 'Type does not exists', 'types.php');
}

$type_name = $type['item_type_name'];
$type_desc = $type['item_type_description'];
$type_status = $type['item_type_status'];

if (isset($_POST) && !empty($_POST)) {

    $changes = [];

    if (isset($_POST['type_name']) && !empty(normal_text($_POST['type_name']))) {
        $type_name = normal_text($_POST['type_name']);

        if ($type_name != $type['item_type_name']) {
            // checking if type name already exists
            $result = $Types->get_by('item_type_name', $type_name);
            if ($result['status']) {
                $errors[] = 'Type name already exists. Edit the existing type by <a href="'.href('types_edit.php?i='.$result['data']['item_type_id'], false).'">clicking here</a>';
            } else {
                $changes['item_type_name'] = $type_name;
            }
        }
        
    } else {
        $errors[] = "Type name cannot be empty";
    }

    if (isset($_POST['type_status']) && !empty(normal_text($_POST['type_status']))) {
        $type_status = normal_text($_POST['type_status']);

        if ($type_status != "published" && $type_status != "unpublished") {
            $errors[] = "Status field value is incorrect";
        } else {

            if ($type_status != $type['item_type_status']) {
                $changes['item_type_status'] = $type_status;
            }

        }
    } else {
        $errors[] = "Status cannot be empty";
    }

    if (isset($_POST['type_description']) && !empty(normal_text($_POST['type_description']))) {
        $type_desc = normal_text($_POST['type_description']);
    } else {
        $type_desc = "";
    }

    if ($type_desc != $type['item_type_description']) {
        $changes['item_type_description'] = $type_desc;
    }

    if (empty($errors)) {

        if (!empty($changes)) {
            $result = $Types->update_transaction($changes, $type_id, $logged_user['user_id'], $Users);
            if ($result['status']) {
                message_move('success', 'Type is successfully updated.', 'types_edit.php?i='.$type_id);
            } else {
                $errors[] = "Unable to update the type";
            }
        } else {
            $success[] = "No changes are made to the data";
        }
        
    }

}

$page_title = "Edit Type";
$page_type = "types";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleStatus();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/types_create.view.php';
require_once DIR.'views/layout/foot.view.php';
