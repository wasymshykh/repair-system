<?php 

require_once 'app/start.php';

require_once 'app/auth.php';

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['save_profile'])) {

        $changes = [];

        $change_log = 'Profile has been successfully updated at '.current_date('M d, Y h:i A') . '. ';

        if (isset($_POST['user_name']) && !empty(normal_text($_POST['user_name']))) {
            $user_name = normal_text($_POST['user_name']);

            if ($user_name != $logged_user['user_name']) {
                $changes['user_name'] = $user_name;
                $change_log .= "Name is changed from '{$logged_user['user_name']}' to '$user_name'. ";
            }
        } else {
            $errors[] = "Full name cannot be empty";
        }
        
        $user_phone = "";
        if (isset($_POST['user_phone']) && !empty($_POST['user_phone'])) {
            $user_phone = normal_text($_POST['user_phone']);
        }
        if ($user_phone != $logged_user['user_phone']) {
            $changes['user_phone'] = $user_phone;
            $change_log .= "Phone is changed from '{$logged_user['user_phone']}' to '$user_phone'. ";
        }

        if (empty($errors)) {
            if (empty($changes)) {
                message_move('success', 'No changes are made to the data.', 'user_settings.php');
            } else {
                $result = $Users->update($changes, $logged_user['user_id']);
                if ($result['status']) {
                    $Users->record_log($logged_user['user_id'], 'PROFILE_UPDATE', $change_log);
                    message_move('success', 'Profile details has been updated', 'user_settings.php');
                } else {
                    message_move('error', 'Unable to update profile details', 'user_settings.php');
                }
            }
        }

    } else if (isset($_POST['save_email'])) {

        $changes = [];
        $change_log = 'Email has been successfully updated at '.current_date('M d, Y h:i A') . '. ';

        if (isset($_POST['user_email']) && !empty(normal_text($_POST['user_email']))) {
            $user_email = normal_text($_POST['user_email']);

            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                if ($user_email != $logged_user['user_email']) {
                    $result = $Users->get_by('user_email', $user_email);
                    if ($result['status']) {
                        $errors[] = "Email address already exists. Use different email address";
                    } else {
                        $changes['user_email'] = $user_email;
                        $change_log .= "Email is changed from '{$logged_user['user_email']}' to '$user_email'.";
                    }
                }
            } else {
                $errors[] = "Email address format is incorrect";
            }
        } else {
            $errors[] = "Email address cannot be empty";
        }
        
        if (empty($errors)) {
            if (empty($changes)) {
                message_move('success', 'No changes are made to the data.', 'user_settings.php');
            } else {
                $result = $Users->update($changes, $logged_user['user_id']);
                if ($result['status']) {
                    $Users->record_log($logged_user['user_id'], 'EMAIL_UPDATE', $change_log);
                    message_move('success', 'Email address has been updated', 'user_settings.php');
                } else {
                    message_move('error', 'Unable to update email address', 'user_settings.php');
                }
            }
        }

    } else if (isset($_POST['save_password'])) {

        if (isset($_POST['user_password']) && !empty(normal_text($_POST['user_password']))) {
            $user_password = normal_text($_POST['user_password']);

            if (isset($_POST['user_cpassword']) && !empty(normal_text($_POST['user_cpassword']))) {

                $user_cpassword = normal_text($_POST['user_cpassword']);

                if ($user_password != $user_cpassword) {
                    $errors[] = "Password does not match, re-check and submit again";
                }

            } else {
                $errors[] = "Confirm your password";
            }
        } else {
            $errors[] = "Password cannot be empty";
        }

        if (empty($errors)) {

            $user_password = password_hash($user_password, PASSWORD_BCRYPT);

            $result = $Users->update(['user_password' => $user_password], $logged_user['user_id']);
            if ($result['status']) {
                $Users->record_log($logged_user['user_id'], 'PASSWORD_UPDATE', 'Password has been successfully updated at '.current_date('M d, Y h:i A'));
                message_move('success', 'Password has been updated', 'user_settings.php');
            } else {
                message_move('error', 'Unable to update your password', 'user_settings.php');
            }

        }

    }

}


$page_title = "Profile Settings";
$page_type = "user_settings";
$page_description = "User profile settings";


require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/user_settings.view.php';
require_once DIR.'views/layout/foot.view.php';
