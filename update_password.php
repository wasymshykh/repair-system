<?php 

require_once 'app/start.php';


if (isset($_POST) && !empty($_POST)) {

    $Codes = new Codes($db);

    if (isset($_POST['code']) && !empty(normal_text($_POST['code']))) {

        $code = normal_text($_POST['code']);

        $_code = $Codes->get_by('code_uuid', $code);

        if (!$_code['status']) {
            $errors[] = "Reset code is invalid";
        } else {
            $_code = $_code['data'];

            if ($_code['code_used'] == 'Y') {
                $errors[] = "Reset code is already used";
            }
        }

    } else {
        $errors[] = "Reset code cannot be empty";
    }

    if (isset($_POST['password']) && !empty(normal_text($_POST['password']))) {
        $password = normal_text($_POST['password']);

        if (isset($_POST['cpassword']) && !empty(normal_text($_POST['cpassword']))) {

            $cpassword = normal_text($_POST['cpassword']);

            if ($password != $cpassword) {
                $errors[] = "Password does not match, re-check and submit again";
            }

        } else {
            $errors[] = "Confirm your password";
        }
    } else {
        $errors[] = "Password cannot be empty";
    }

    if (empty($errors)) {

        $Logs = new Logs($db);

        $password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $db->beginTransaction();

            $Users->update(['user_password' => $password], $_code['code_user_id']);

            $Users->record_log($_code['code_user_id'], 'RESET_SUCCESS', 'Password has been successfully updated at '.current_date('M d, Y h:i A').' with code ('.$_code['code_uuid'].') of email address ('.$_code['user_email'].')');

            $Codes->update_code(['code_used' => 'Y', 'code_used_date' => current_date()], $code);

            $db->commit();

            message_move('success', "Password has been changed, you can now login with new password", 'login.php');

        } catch (Exception $e) {
            $db->rollBack();
            $Logs->create('update_password.php - exception', json_encode(['error' => $e->getMessage(), 'exception' => $e]));

            $errors[] = "Unable to update your password";
        }
        
    }    

}

$page_title = "Update Password";

require_once DIR.'views/layout/header.view.php';
require_once DIR.'views/update_password.view.php';
require_once DIR.'views/layout/footer.view.php';
