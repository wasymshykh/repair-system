<?php 

require_once 'app/start.php';
require_once DIR.'app/auth.php';

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $user_id = normal_text($_GET['i']);
    $user = $Users->get_by('user_id', $user_id);
    if (!$user['status']) {
        message_move('error', 'User does not exists', 'users.php');
    }
    $user = $user['data'];
} else {
    message_move('error', 'User does not exists', 'users.php');
}

$Roles = new Roles($db);

$roles = $Roles->get_all();
if ($roles['status']) {
    $roles = $roles['data'];
} else {
    $roles = [];
}

$role = $user['user_role_id'];

$statuses = [
    'A' => 'Active',
    'N' => 'Inactive'
];

$status = $user['user_status'];


if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['save_profile'])) {

        $changes = [];
        $change_log = 'User [USER_ID-'.$user['user_id'].'] got updated at '.current_date('M d, Y h:i A').'.';

        if (isset($_POST['user_name']) && !empty(normal_text($_POST['user_name']))) {
            $user_name = normal_text($_POST['user_name']);
            if ($user_name != $user['user_name']) {
                $changes['user_name'] = $user_name;
                $change_log .= " Full name changed from '{$user['user_name']}' to '{$user_name}'.";
            }
        } else {
            $errors[] = "Full name cannot be empty";
        }
        
        if (isset($_POST['user_role']) && !empty(normal_text($_POST['user_role']))) {
            $role = normal_text($_POST['user_role']);
            if ($role != $user['user_role_id']) {
                $changes['user_role_id'] = $role;
                $change_log .= " Role changed from '{$user['user_role_id']}' to '{$role}'.";
            }
        } else {
            $errors[] = "Role cannot be empty";
        }
        
        if (isset($_POST['user_status']) && !empty(normal_text($_POST['user_status']))) {
            $status = normal_text($_POST['user_status']);
            if ($status != $user['user_status']) {
                $changes['user_status'] = $status;
                $change_log .= " User status changed from '".($user['user_status']=='A'?'Active':'Inactive')."' to '".($status=='A'?'Active':'Inactive')."'.";
            }
        } else {
            $errors[] = "User status cannot be empty";
        }
        
        if (isset($_POST['user_phone']) && !empty($_POST['user_phone'])) {
            $user_phone = normal_text($_POST['user_phone']);
        } else {
            $user_phone = "";
        }

        if ($user_phone != $logged_user['user_phone']) {
            $changes['user_phone'] = $user_phone;
            $change_log .= " Phone changed from '{$user['user_phone']}' to '{$user_phone}'.";
        }

        if (empty($errors)) {

            if (!empty($changes)) {
                try {
                    $db->beginTransaction();

                    $Users->update($changes, $user_id);
                    $Users->record_log($logged_user['user_id'], 'ADMIN_PROFILE_UPDATE', $change_log);

                    $db->commit();

                    message_move('success', "Profile details has been successfully updated.", 'users_edit.php?i='.$user['user_id']);
                } catch (Exception $e) {
                    $db->rollBack();
                    $Logs->create('users_edit.php - exception', json_encode(['error' => $e->getMessage(), 'exception' => $e]));
                    $errors[] = "Unable to update your password";
                }
            } else {
                message_move('success', "No changes are made to profile details.", 'users_edit.php?i='.$user['user_id']);
            }
        }
        
    } else if (isset($_POST['save_email'])) {

        $changes = [];
        $change_log = 'User [USER_ID-'.$user['user_id'].'] got updated at '.current_date('M d, Y h:i A').'.';

        if (isset($_POST['user_email']) && !empty(normal_text($_POST['user_email']))) {
            $user_email = normal_text($_POST['user_email']);

            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                if ($user_email != $user['user_email']) {
                    $result = $Users->get_by('user_email', $user_email);
                    if ($result['status']) {
                        $errors[] = "Email address already exists. Use different email address";
                    } else {
                        $changes['user_email'] = $user_email;
                        $change_log .= " Email is changed from '{$user['user_email']}' to '$user_email'.";
                    }
                }
            } else {
                $errors[] = "Email address format is incorrect";
            }
        } else {
            $errors[] = "Email address cannot be empty";
        }

        if (empty($errors)) {
            if (!empty($changes)) {
                try {
                    $db->beginTransaction();

                    $Users->update($changes, $user_id);
                    $Users->record_log($logged_user['user_id'], 'ADMIN_EMAIL_UPDATE', $change_log);

                    $db->commit();

                    message_move('success', "Email has been successfully updated.", 'users_edit.php?i='.$user['user_id']);
                } catch (Exception $e) {
                    $db->rollBack();
                    $Logs->create('users_edit.php - exception', json_encode(['error' => $e->getMessage(), 'exception' => $e]));
                    $errors[] = "Unable to update your password";
                }
            } else {
                message_move('success', "No changes are made to email.", 'users_edit.php?i='.$user['user_id']);
            }
        }

    } else if (isset($_POST['save_password'])) {

        $change_log = 'User [USER_ID-'.$user['user_id'].'] got updated at '.current_date('M d, Y h:i A').'.';

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
            try {
                $db->beginTransaction();

                $Users->update(['user_password' => $user_password], $user_id);
                $Users->record_log($logged_user['user_id'], 'ADMIN_PASSWORD_UPDATE', $change_log);

                $db->commit();

                message_move('success', "Password has been successfully updated.", 'users_edit.php?i='.$user['user_id']);
            } catch (Exception $e) {
                $db->rollBack();
                $Logs->create('users_edit.php - exception', json_encode(['error' => $e->getMessage(), 'exception' => $e]));
                $errors[] = "Unable to update your password";
            }
        }

    }

}

$page_title = "Edit User";
$page_type = "users";
$page_type_sub = "users_edit";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/users/users_edit.view.php';
require_once DIR.'views/layout/foot.view.php';
