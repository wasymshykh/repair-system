<?php 

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$Types = new Types($db);

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['type_name']) && !empty(normal_text($_POST['type_name']))) {
        $type_name = normal_text($_POST['type_name']);

        // checking if type name already exists
        $result = $Types->get_by('item_type_name', $type_name);
        if ($result['status']) {
            $errors[] = 'Type name already exists. Edit the existing type by <a href="'.href('types_edit.php?i='.$result['data']['item_type_id'], false).'">clicking here</a>';
        }
        
    } else {
        $errors[] = "Type name cannot be empty";
    }

    if (isset($_POST['type_status']) && !empty(normal_text($_POST['type_status']))) {
        $type_status = normal_text($_POST['type_status']);

        if ($type_status != "published" && $type_status != "unpublished") {
            $errors[] = "Status field value is incorrect";
        }
    } else {
        $errors[] = "Status cannot be empty";
    }

    if (isset($_POST['type_description']) && !empty(normal_text($_POST['type_description']))) {
        $type_desc = normal_text($_POST['type_description']);
    } else {
        $type_desc = "";
    }

    if (empty($errors)) {

        $result = $Types->insert_transaction($type_name, $type_desc, $type_status, $logged_user['user_id'], $Users);
        if ($result['status']) {
            message_move('success', 'Type is successfully inserted. <a href="'.href('types_edit.php?i='.$result['type_id'], false).'" class="btn btn-sm btn-success">Edit <i class="bi bi-arrow-right"></i></a>', 'types.php');
        } else {
            $errors[] = "Unable to insert the type";
        }

    }

}

$page_title = "Create Type";
$page_type = "types";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleStatus();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/types_create.view.php';
require_once DIR.'views/layout/foot.view.php';
