<?php 

require_once 'app/start.php';


if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['email']) && !empty(normal_text($_POST['email']))) {
        $email = normal_text($_POST['email']);

        $_user = $Users->get_by('user_email', $email);

        if (!$_user['status']) {
            $errors[] = "No user exists with the provided email";
        } else {
            $_user = $_user['data'];
        }
    } else {
        $errors[] = "Email is required";
    }

    if (isset($_POST['password']) && !empty(normal_text($_POST['password']))) {
        $password = normal_text($_POST['password']);

        if (empty($errors) && !password_verify($password, $_user['user_password'])) {
            $errors[] = 'Password is invalid. <a href="'.href('reset_password').'">Reset Password <i class="bi bi-arrow-right"></i></a>';
        }
    } else {
        $errors[] = "Password is required";
    }
    
    if (empty($errors)) {
        if ($_user['user_status'] === 'A') {
            $_SESSION['logged'] = $_user['user_id'];
            $Users->record_log($_user['user_id'], 'LOGIN_SUCCESS', 'Account is logged at '.current_date('M d, Y h:i A'));
            move('index.php');
        } else {
            $errors[] = "Account is inactive";
        }
    }

}



$page_title = "Login";

require_once DIR.'views/layout/header.view.php';
require_once DIR.'views/login.view.php';
require_once DIR.'views/layout/footer.view.php';
