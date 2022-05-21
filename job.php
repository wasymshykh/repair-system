<?php

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$Jobs = new Jobs($db);

if (isset($_GET['i']) && !empty($_GET['i']) && is_numeric($_GET['i'])) {
    $job_id = normal_text($_GET['i']);

    $job = $Jobs->get_detailed_by('job_id', $job_id);
    if (!$job['status']) {
        message_move('error', 'Job does not exists', 'jobs.php');
    }
    $job = $job['data'];
} else {
    message_move('error', 'Job does not exists', 'jobs.php');
}

$modal_open = "";
$error_field = [];
if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['repaired'])) {

        $modal_open = 'repaired';

        $changes = [];

        if ($job['job_status'] != 'GREEN') {
            $changes['job_status'] = 'GREEN';
        }

        $repair_date = "";
        if (isset($_POST['repair_date']) && !empty(normal_text($_POST['repair_date']))) {
            $repair_date = normal_text($_POST['repair_date']);

            if ($repair_date != $job['job_repair_date']) {
                $changes['job_repair_date'] = $repair_date;
            }
        } else {
            $error_field['repair_date'] = "Repair date cannot be empty";
        }

        $repair_cost = "";
        if (isset($_POST['repair_cost']) && !empty(normal_text($_POST['repair_cost']))) {
            $repair_cost = normal_text($_POST['repair_cost']);

            if (!is_numeric($repair_cost)) {
                $error_field['repair_cost'] = "Repair cost must be numeric";
            } else if ($repair_cost != $job['job_price']) {
                $changes['job_price'] = $repair_cost;
            }
        } else {
            $error_field['repair_cost'] = "Repair cost cannot be empty";
        }

        $repair_description = "";
        if (isset($_POST['repair_description']) && !empty(normal_text($_POST['repair_description']))) {
            $repair_description = normal_text($_POST['repair_description']);

            if ($repair_description != $job['job_repair_description']) {
                $changes['job_repair_description'] = $repair_description;
            }
        } else {
            $error_field['repair_description'] = "Repair description cannot be empty";
        }

        if (empty($error_field) && empty($errors)) {
            if (!empty($changes)) {
                $result = $Jobs->mark_job_transaction($changes, $job, $job_id, $logged_user['user_id'], $Users);
                if ($result['status']) {
                    message_move('success', 'Job has been successfully marked as repaired', 'job.php?i='.$job_id);
                } else {
                    $error_field['repaired'] = "Unable to mark job as repaired";
                }
            } else {
                message_move('success', 'Details are up to date', 'job.php?i='.$job_id);
            }
        }

    } else if (isset($_POST['notrepaired'])) {

        $modal_open = 'notrepaired';

        $changes = [];

        if ($job['job_status'] != 'RED') {
            $changes['job_status'] = 'RED';
        }

        $diagnose_date = "";
        if (isset($_POST['diagnose_date']) && !empty(normal_text($_POST['diagnose_date']))) {
            $diagnose_date = normal_text($_POST['diagnose_date']);

            if ($diagnose_date != $job['job_repair_date']) {
                $changes['job_repair_date'] = $diagnose_date;
            }
        } else {
            $error_field['diagnose_date'] = "Diagnose date cannot be empty";
        }

        $diagnose_cost = "";
        if (isset($_POST['diagnose_cost']) && !empty(normal_text($_POST['diagnose_cost']))) {
            $diagnose_cost = normal_text($_POST['diagnose_cost']);

            if (!is_numeric($diagnose_cost)) {
                $error_field['diagnose_cost'] = "Diagnose cost must be numeric";
            } 
        } else {
            $diagnose_cost = "";
        }

        if ($diagnose_cost != $job['job_price']) {
            $changes['job_price'] = $diagnose_cost;
        }

        $diagnose_description = "";
        if (isset($_POST['diagnose_description']) && !empty(normal_text($_POST['diagnose_description']))) {
            $diagnose_description = normal_text($_POST['diagnose_description']);

            if ($diagnose_description != $job['job_repair_description']) {
                $changes['job_repair_description'] = $diagnose_description;
            }
        } else {
            $error_field['diagnose_description'] = "Diagnose description cannot be empty";
        }

        if (empty($error_field) && empty($errors)) {
            if (!empty($changes)) {
                $result = $Jobs->mark_job_transaction($changes, $job, $job_id, $logged_user['user_id'], $Users, 'Diagnose');
                if ($result['status']) {
                    message_move('success', 'Job has been successfully marked as not repaired', 'job.php?i='.$job_id);
                } else {
                    $error_field['notrepaired'] = "Unable to mark job as not repaired";
                }
            } else {
                message_move('success', 'Details are up to date', 'job.php?i='.$job_id);
            }
        }

    } else if (isset($_POST['change_status'])) {

        $changes = [];

        if (isset($_POST['change_status_type']) && !empty($_POST['change_status_type'])) {

            if ($_POST['change_status_type'] == 'parts') {
                if ($job['job_status'] != 'ORANGE') {
                    $changes['job_status'] = 'ORANGE';
                }
            } else if ($_POST['change_status_type'] == 'awaiting') {
                if ($job['job_status'] != 'PINK') {
                    $changes['job_status'] = 'PINK';
                }
            } else {
                $errors[] = "Invalid field action is selected";
            }
        } else {
            $errors[] = "Select the action";
        }

        if (empty($errors)) {
            if (!empty($changes)) {
                $result = $Jobs->mark_job_transaction($changes, $job, $job_id, $logged_user['user_id'], $Users);
                if ($result['status']) {
                    message_move('success', 'Job status is successfully updated.', 'job.php?i='.$job['job_id']);
                } else {
                    $errors[] = "Unable to update job status.";
                }
            } else {
                message_move('success', 'Data is up to date', 'job.php?i='.$job['job_id']);
            }
        }

    }

}

$page_title = "Job Details";
$page_type = "job";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/jobs/job.view.php';
require_once DIR.'views/layout/foot.view.php';
