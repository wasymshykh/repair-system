<?php

require_once 'app/start.php';
require_once DIR.'app/auth.php';

$Jobs = new Jobs($db);

$job_permission = $logged_user['role_permission'];

if ($job_permission == '*') {
    $jobs = $Jobs->get_all_detailed_by(true);
    if ($jobs['status']) {
        $jobs = $jobs['data'];
    } else {
        $jobs = [];
    }
} else {
    $jobs = $Jobs->get_all_detailed_by_role_id($logged_user['user_role_id'], true);
    if ($jobs['status']) {
        $jobs = $jobs['data'];
    } else {
        $jobs = [];
    }
}

$page_title = "Jobs";
$page_type = "jobs";

$custom_head_css = ['assets/plugins/custom/datatables/datatables.bundle.css'];

$custom_footer_js = ['assets/plugins/custom/datatables/datatables.bundle.js'];

$custom_footer_script = '
<script>
    KTUtil.onDOMContentLoaded(function () {
        initDatatable();
        handleSearchDatatable();
        handleDeleteRows();
    });
</script>';

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/jobs/jobs.view.php';
require_once DIR.'views/layout/foot.view.php';
