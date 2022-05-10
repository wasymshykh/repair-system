<?php 

require_once 'app/start.php';

require_once DIR.'app/auth.php';

$Roles = new Roles ($db);

$permissions = $Roles->get_permissions();

$permission_admin = false;
$role_permissions = [];

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['role_name']) && !empty(normal_text($_POST['role_name']))) {
        $role_name = normal_text($_POST['role_name']);

        // checking if name already exists
        $result = $Roles->get_by('role_name', $role_name);
        if ($result['status']) {
            $errors[] = 'Role name already exists. Edit the existing role by <a href="'.href('roles_edit.php?i='.$result['data']['role_id'], false).'">clicking here</a>';
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

    if (empty($errors)) {

        $result = $Roles->insert_transaction($role_name, $permissions_text, $logged_user['user_id'], $Users);
        if ($result['status']) {
            message_move('success', 'Role is successfully created. <a href="'.href('roles_edit.php?i='.$result['role_id'], false).'" class="btn btn-sm btn-success">Edit <i class="bi bi-arrow-right"></i></a>', 'roles.php');
        } else {
            $errors[] = "Unable to create new role";
        }

    }

}

$page_title = "Create Role";
$page_type = "users";

$custom_footer_script = '<script>
KTUtil.onDOMContentLoaded(function () {
    handleSelectAll();
});</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/roles_create.view.php';
require_once DIR.'views/layout/foot.view.php';
