<?php 

require_once 'app/start.php';

require_once 'app/auth.php';

$Jobs = new Jobs($db);

$jobs = $Jobs->get_all_detailed_by(true);
if ($jobs['status']) {
    $jobs = $jobs['data'];
} else {
    $jobs = [];
}


$job_stats = [
    'PINK' => 0,
    'ORANGE' => 0,
    'RED' => 0,
    'GREEN' => 0
];

foreach ($jobs as $job) {

    $job_stats[$job['job_status']] += 1;
    

}


$page_title = "Dashboard";
$page_type = "dashboard";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/index.view.php';
require_once DIR.'views/layout/foot.view.php';
