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

$page_title = "Job Details";
$page_type = "job";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/job.view.php';
require_once DIR.'views/layout/foot.view.php';
