<?php

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$Roles = new Roles ($db);

$permissions = $Roles->get_permissions();

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $role_id = normal_text($_GET['i']);

    $role = $Roles->get_by('role_id', $role_id);
    if (!$role['status']) {
        message_move('error', 'Role does not exists', 'roles.php');
    }
    $role = $role['data'];
} else {
    message_move('error', 'Role does not exists', 'roles.php');
}

$role_name = $role['role_name'];
$role_permissions = $role['role_permission'];
$permission_admin = false;

if ($role_permissions != '*') {
    $role_permissions = json_decode($role_permissions, true);
} else {
    $permission_admin = true;
}

if (isset($_POST) && !empty($_POST)) {

    $changes = [];

    if (isset($_POST['role_name']) && !empty(normal_text($_POST['role_name']))) {
        $role_name = normal_text($_POST['role_name']);

        if ($role_name != $role['role_name']) {
            // checking if name already exists
            $result = $Roles->get_by('role_name', $role_name);
            if ($result['status']) {
                $errors[] = 'Role name already exists. Edit the existing role by <a href="'.href('roles_edit.php?i='.$result['data']['role_id'], false).'">clicking here</a>';
            } else {
                $changes['role_name'] = $role_name;
            }
        }
    } else {
        $errors[] = "Role name cannot be empty";
    }
    
    $permissions_text = "";
    if (isset($_POST['permission_admin'])) {
        $permissions_text = '*';
        $permission_admin = true;
    } else {
        if (isset($_POST['permissions']) && !empty($_POST['permissions'])) {
            $permissions_text = json_encode($_POST['permissions']);

            if (empty($permissions_text)) {
                $errors[] = "Permission field data is invalid";
            } else {
                $role_permissions = json_decode($permissions_text, true);
            }
        } else {
            $errors[] = "Select atleast one permission for the role";
        }
    }

    if ($permissions_text != $role['role_permission']) {
        $changes['role_permission'] = $permissions_text;
    }

    if (empty($errors)) {

        if (!empty($changes)) {
            $result = $Roles->update_transaction($changes, $role_id, $logged_user['user_id'], $Users);
            if ($result['status']) {
                message_move('success', 'Role is successfully Updated.', 'roles_edit.php?i='.$role_id);
            } else {
                $errors[] = "Unable to create new role";
            }
        }

    }

}


$page_title = "Edit Role";
$page_type = "users";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleSelectAll();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/roles_create.view.php';
require_once DIR.'views/layout/foot.view.php';
