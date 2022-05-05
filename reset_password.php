<?php 

use Ramsey\Uuid\Uuid;

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

    if (empty($errors)) {

        $Codes = new Codes($db);
        $Mailer = new Mailer($db, $Settings);
        $Logs = new Logs($db);

        try {
            $db->beginTransaction();

            $code_uuid = Uuid::uuid4()->toString();
            $code_result = $Codes->insert_code($code_uuid, $_user['user_id'], 'RESET');            
            
            $Users->record_log($_user['user_id'], 'RESET_REQUEST', 'Password reset email has been sent at '.current_date('M d, Y h:i A').' to your email address ('.$_user['user_email'].')');

            $reset_link = URL.'/update_password.php?c='.$code_uuid;
            $mailer_result = $Mailer->send_email($Settings->fetch('mail_from_email'), $Settings->fetch('mail_from_name'), $_user['user_email'], $_user['user_name'], 'Password Reset Request', 'Hello, Password reset request was received.<br>Follow this link to reset your password: <a href="'.$reset_link.'">'.$reset_link.'</a>');

            $db->commit();

            message_move('success', "Mail has been successfully sent to your email ({$_user['user_email']})", 'reset_password.php?done');
            
        } catch (Exception $e) {
            $db->rollBack();
            $Logs->create('reset_password.php - exception', json_encode(['error' => $e->getMessage(), 'exception' => $e]));

            $errors[] = "Unable to send reset email";
        }

    }

}

$page_title = "Reset Password";

require_once DIR.'views/layout/header.view.php';
require_once DIR.'views/reset_password.view.php';
require_once DIR.'views/layout/footer.view.php';
