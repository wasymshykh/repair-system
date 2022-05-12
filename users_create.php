<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$Roles = new Roles($db);

$roles = $Roles->get_all();
if ($roles['status']) {
    $roles = $roles['data'];
} else {
    $roles = [];
}

$statuses = [
    'A' => 'Active',
    'N' => 'Inactive'
];

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['name']) && !empty(normal_text($_POST['name']))) {
        $name = normal_text($_POST['name']);
    } else {
        $errors[] = "Name cannot be empty";
    }

    if (isset($_POST['email']) && !empty(normal_text($_POST['email']))) {
        $email = normal_text($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email format is incorrect";
        } else {
            // checking if email already exists
            $result = $Users->get_by('user_email', $email);
            // __d($result);
            if ($result['status']) {
                $errors[] = "Email already exists. Choose different email.";
            }
        }

    } else {
        $errors[] = "Email cannot be empty";
    }
    
    if (isset($_POST['password']) && !empty(normal_text($_POST['password']))) {
        $password = normal_text($_POST['password']);
    } else {
        $errors[] = "Password cannot be empty";
    }

    if (isset($_POST['role']) && !empty(normal_text($_POST['role']))) {
        $role = normal_text($_POST['role']);
    } else {
        $errors[] = "Select a user role";
    }
    
    if (isset($_POST['phone']) && !empty(normal_text($_POST['phone']))) {
        $phone = normal_text($_POST['phone']);
    } else {
        $phone = "";
    }

    if (isset($_POST['status']) && !empty(normal_text($_POST['status']))) {
        $status = normal_text($_POST['status']);
    } else {
        $errors[] = "Select a user status";
    }

    if (empty($errors)) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $result = $Users->insert_transaction($name, $email, $password_hashed, $role, $phone, $status, $logged_user['user_id'], $Users);
        if ($result['status']) {
            message_move('success', 'User is successfully inserted. <a href="'.href('users_edit.php?i='.$result['user_id'], false).'" class="btn btn-sm btn-success">Edit <i class="bi bi-arrow-right"></i></a>', 'users.php');
        } else {
            $errors[] = "Unable to create user";
        }
    }

}

$page_title = "Create User";
$page_type = "users";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/users/users_create.view.php';
require_once DIR.'views/layout/foot.view.php';
